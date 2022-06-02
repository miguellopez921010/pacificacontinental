<?php
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\Datasource\ConnectionManager;
use Cake\Auth\DefaultPasswordHasher;

class UsuariosController extends AppController
{	
	public function initialize()
	{
	    parent::initialize();
	    $this->loadComponent('Csrf');
	}

	public function ValidarPermisoUsuarioLogueado($Controller, $Action){
		$IdUsuarios = $this->request->session()->read('Auth.User.IdUsuarios');

		$NombrePermiso = $Controller.'.'.$Action;

		$session = $this->getRequest()->getSession();
        $Permisos = $session->read('Permisos');

        if(!in_array($NombrePermiso, $Permisos)){
        	return false;
        }
        return true;
	}

	public function index(){
		$Permiso = $this->ValidarPermisoUsuarioLogueado($this->request->getParam('controller'),$this->request->getParam('action'));

		if($Permiso){
			$Usuarios = ConnectionManager::get('default')->execute('SELECT U.*, IF(U.Estado=1,"ACTIVO","INACTIVO") AS EstadoUsuario, R.NombreRol FROM users U INNER JOIN roles R ON R.IdRoles = U.IdRoles ORDER BY FechaHoraModificacion DESC')->fetchAll('assoc');


			$this->set(['Usuarios' => $Usuarios]);
		}else{
			$this->Flash->error('No tiene permiso para realizar la tarea '.$this->request->getParam('action'));
			return $this->redirect(['action' => 'index']);		
		}
	}

	public function crear(){
		$Permiso = $this->ValidarPermisoUsuarioLogueado($this->request->getParam('controller'),$this->request->getParam('action'));

		if($Permiso){
			$Roles = ConnectionManager::get('default')->execute('SELECT IdRoles, NombreRol FROM roles R')->fetchAll('assoc');

			$this->set(['Roles' => $Roles]);
		}else{
			$this->Flash->error('No tiene permiso para realizar la tarea '.$this->request->getParam('action'));
			return $this->redirect(['action' => 'index']);			
		}
	}

	public function editar($IdUsuarios = null){
		$Permiso = $this->ValidarPermisoUsuarioLogueado($this->request->getParam('controller'),$this->request->getParam('action'));

		if($Permiso){
			$IdUsuarios = $_REQUEST['IdUsuarios'];

			$connection = ConnectionManager::get('default');

			$Roles = $connection->execute('SELECT IdRoles, NombreRol FROM roles R')->fetchAll('assoc');

			$Usuario = $connection->execute('SELECT * FROM users WHERE IdUsuarios = '.$IdUsuarios)->fetch('assoc');

			$this->set(['Roles' => $Roles, 'IdUsuarios' => $IdUsuarios, 'Usuario' => $Usuario]);
		}else{
			$this->Flash->error('No tiene permiso para realizar la tarea '.$this->request->getParam('action'));
			return $this->redirect(['action' => 'index']);			
		}
	}

	public function ver($IdUsuarios = null){
		$Permiso = $this->ValidarPermisoUsuarioLogueado($this->request->getParam('controller'),$this->request->getParam('action'));

		if($Permiso){
			$IdUsuarios = $_REQUEST['IdUsuarios'];

			$connection = ConnectionManager::get('default');

			$Usuario = $connection->execute('SELECT * FROM users U INNER JOIN roles R ON R.IdRoles = U.IdRoles WHERE IdUsuarios = '.$IdUsuarios)->fetch('assoc');

			$this->set(['IdUsuarios' => $IdUsuarios, 'Usuario' => $Usuario]);
		}else{
			$this->Flash->error('No tiene permiso para realizar la tarea '.$this->request->getParam('action'));
			return $this->redirect(['action' => 'index']);			
		}
	}

	public function HashearPassword($Password){
		return (new DefaultPasswordHasher)->hash($Password);
	}

	public function guardar(){
		$Estado = 0;
		$Mensaje = null;

		$IdUsuarios = null;
		if(isset($_REQUEST['IdUsuarios'])){
			if($_REQUEST['IdUsuarios'] != null){
				$IdUsuarios = $_REQUEST['IdUsuarios'];	
			}
		}
		$NumeroDocumentoIdentidad = $_REQUEST['NumeroDocumentoIdentidad'];
		$Nombres = $_REQUEST['Nombres'];
		$Apellidos = $_REQUEST['Apellidos'];
		$CorreoElectronico = $_REQUEST['CorreoElectronico'];
		$IdRoles = $_REQUEST['IdRoles'];
		$EstadoUsuario = $_REQUEST['Estado'];
		$Password = null;
		if(isset($_REQUEST['Password'])){
			if($_REQUEST['Password'] != null){
				$Password = $_REQUEST['Password'];	
			}
		}

		$connection = ConnectionManager::get('default');

		if($NumeroDocumentoIdentidad != null && $Nombres != null && $Apellidos != null && $CorreoElectronico != null && $IdRoles != null){
			
			if(is_numeric($NumeroDocumentoIdentidad)){
				$ValidarExistenciaUsuarioPorDocumento = $connection->execute('SELECT IFNULL(NumeroDocumentoIdentidad,null) FROM users WHERE NumeroDocumentoIdentidad = '.$NumeroDocumentoIdentidad.' '.($IdUsuarios!=null?' AND IdUsuarios != '.$IdUsuarios:''))->fetch('assoc');

				if($ValidarExistenciaUsuarioPorDocumento == null){
					//No existe registro, permite continuar
					$ValidarExistenciaUsuarioPorCorreoElectronico = $connection->execute('SELECT IFNULL(CorreoElectronico,null) FROM users WHERE CorreoElectronico = "'.$CorreoElectronico.'" '.($IdUsuarios!=null?' AND IdUsuarios != '.$IdUsuarios:''))->fetch('assoc');

					if($ValidarExistenciaUsuarioPorCorreoElectronico == null){
						//No existe registro, permite continuar

						$connection->begin();

						$Datos = [
							'NumeroDocumentoIdentidad' => $NumeroDocumentoIdentidad,
							'Nombres' => $Nombres,
							'Apellidos' => $Apellidos,
							'CorreoElectronico' => $CorreoElectronico,
							'IdRoles' => $IdRoles,
							'Estado' => $EstadoUsuario,
						];

						if($Password != null){
							//Si viene la contrasena, se hashea para luego registrarla en la bd
							$Datos['Password'] = $this->HashearPassword($Password);
						}

						if($IdUsuarios!=null){
							$statement = $connection->update('users', $Datos, ['IdUsuarios' => $IdUsuarios]);	
						}else{
							$statement = $connection->insert('users', $Datos);	
						}

						if($statement){
							$Estado = 1;
							$Mensaje .= ($IdUsuarios!=null?'Actualizacion exitosa':'Registro exitoso.').PHP_EOL;
							$connection->commit();
						}else{
							$Mensaje .= ($IdUsuarios!=null?'Error al actualizar usuario':'Error al registrar usuario').PHP_EOL;
							$connection->rollback();
						}
					}else{
						$Mensaje .= 'Ya existe un usuario con el correo electronico '.$CorreoElectronico.' registrado en la base de datos.'.PHP_EOL;
					}
				}else{
					$Mensaje .= 'Ya existe un usuario con el numero de documento '.$NumeroDocumentoIdentidad.' registrado en la base de datos.'.PHP_EOL;
				}
			}else{
				$Mensaje .= 'El campo numero de documento debe ser un valor numerico.'.PHP_EOL;
			}
		}else{
			$Mensaje .= 'Hay algunos campos obligatorios que no han sido enviados: '.PHP_EOL;
			if($NumeroDocumentoIdentidad == null){
				$Mensaje.= "- Numero documento de indentidad".PHP_EOL;
			}
			if($Nombres == null){
				$Mensaje.= "- Nombres".PHP_EOL;
			}
			if($Apellidos == null){
				$Mensaje.= "- Apellidos".PHP_EOL;
			}
			if($CorreoElectronico == null){
				$Mensaje.= "- Correo Electronico".PHP_EOL;
			}
			if($IdRoles == null){
				$Mensaje.= "- Rol".PHP_EOL;
			}
		}

		$result = json_encode([
			'Estado' => $Estado,
			'Mensaje' => $Mensaje,
		]);

        $this->response->type('json');
        $this->response->body($result);
        return $this->response;
	}

	public function eliminar(){
		$Estado = 0;
		$Mensaje = null;

		$IdUsuarios = $_REQUEST['IdUsuarios'];

		$connection = ConnectionManager::get('default');

		$connection->begin();
		$statement = $connection->delete('users', ['IdUsuarios' => $IdUsuarios]);

		if($statement){
			$Estado = 1;
			$Mensaje .= 'Se elimino registro con exito.'.PHP_EOL;
			$connection->commit();
		}else{
			$Mensaje .= 'Error al eliminar registro de la base de datos'.PHP_EOL;
			$connection->rollback();
		}

		$result = json_encode([
			'Estado' => $Estado,
			'Mensaje' => $Mensaje,
			'IdUsuarios' => $IdUsuarios,
		]);

        $this->response->type('json');
        $this->response->body($result);
        return $this->response;
	}

	public function cambiarContrasena(){
		$Permiso = $this->ValidarPermisoUsuarioLogueado($this->request->getParam('controller'),$this->request->getParam('action'));

		if($Permiso){
			$IdUsuarios = $_REQUEST['IdUsuarios'];

			$this->set(['IdUsuarios' => $IdUsuarios]);
		}else{
			$this->Flash->error('No tiene permiso para realizar la tarea '.$this->request->getParam('action'));
			return $this->redirect(['action' => 'index']);			
		}
	}

	public function guardarContrasena(){
		$Estado = 0;
		$Mensaje = null;

		$IdUsuarios = $_REQUEST['IdUsuarios'];
		$Password = $_REQUEST['Password'];
		$Password2 = $_REQUEST['Password2'];

		if($Password != null && $Password2 != null){
			if($Password === $Password2){
				
				$connection = ConnectionManager::get('default');

				$connection->begin();
				$statement = $connection->update('users', ['Password' => $this->HashearPassword($Password)], ['IdUsuarios' => $IdUsuarios]);	

				if($statement){
					$Estado = 1;
					$Mensaje .= 'Se actualizo contrasena exitosamente'.PHP_EOL;
					$connection->commit();
				}else{
					$Mensaje .= 'Error al actualizar la contrasena'.PHP_EOL;
					$connection->rollback();
				}
			}else{
				$Mensaje .= 'Las contrasenas no coinciden.'.PHP_EOL;
			}
		}else{
			$Mensaje .= 'Todos los campos son obligatorios.'.PHP_EOL;
		}


		$result = json_encode([
			'Estado' => $Estado,
			'Mensaje' => $Mensaje,
			'IdUsuarios' => $IdUsuarios,
		]);

        $this->response->type('json');
        $this->response->body($result);
        return $this->response;
	}
}