<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\Datasource\ConnectionManager;


/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link https://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class HomeController extends AppController
{
	public function index(){
		//echo 'Prueba';        
	}

	public function login(){
        if($this->request->is('post')){
            $CorreoElectronico = $_REQUEST['CorreoElectronico'];
            $Password = $_REQUEST['Password'];

            $connection = ConnectionManager::get('default');

            $Usuario = $connection->execute('SELECT * FROM users WHERE CorreoElectronico = "'.$CorreoElectronico.'"')->fetch('assoc');

            if(!empty($Usuario)){
                if($Usuario['Estado'] == 1){
                    $user = $this->Auth->identify();
                    if($user){
                        $this->Auth->setUser($user);

                        $session = $this->getRequest()->getSession();
                        $Permisos = [];

                        //Crear sesion con los permisos segun el rol de la persona
                        $PermisosRol = $connection->execute('SELECT * FROM permisos WHERE IdRoles = '.$Usuario['IdRoles'])->fetchAll('assoc');
                        if(!empty($PermisosRol)){
                            foreach($PermisosRol AS $P){
                                $Permisos[] = $P['NombrePermiso'];
                            }
                        }

                        $session->write([
                          'Permisos' => $Permisos,
                        ]);

                        return $this->redirect(['controller' => 'usuarios']);
                    }

                    $this->Flash->error('Datos incorrectos');
                }else{
                    $this->Flash->error('El usuario no se encuentra activo.');
                }
            }else{
                $this->Flash->error('El usuario no esta registrado en la base de datos.');
            }            
        }

        if($this->request->session()->read('Auth.User.IdUsuarios') != null){
            return $this->redirect(['controller' => 'usuarios']);
            $this->Flash->error('Ya habias iniciado sesion con anterioridad');
        }
	}

    public function logout(){
        $this->Flash->success('Cerraste sesion');

        $session = $this->getRequest()->getSession();
        if ($session->check('Permisos')) {
            $session->destroy();
        }
        
        return $this->redirect($this->Auth->logout());
    }
}