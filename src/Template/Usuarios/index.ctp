<?php 
$session = $this->getRequest()->getSession();
$Permisos = $session->read('Permisos');
?>

<h1>Usuarios</h1>

<?php 
if(in_array('Usuarios.crear', $Permisos)){
	echo $this->Html->link(
	    'Crear',
	    ['controller' => 'usuarios', 'action' => 'crear'],
	    ['class' => 'btn btn-sm btn-success']
	);
}
?>

<div class="table-responsive">
	<table class="table table-condensed table-striped table-bordered">
		<thead>
			<tr>
				<th class="text-center">Numero de documento</th>
				<th class="text-center">Nombre completo</th>
				<th class="text-center">Correo electronico</th>
				<th class="text-center">Rol</th>
				<th class="text-center">Estado</th>
				<th class="text-center">Fecha modificacion</th>
				<th colspan="4"></th>
			</tr>
		</thead>
		<tbody>
			<?php 
			if(!empty($Usuarios)){
				foreach($Usuarios AS $U){
					?>
			<tr class="text-center">
				<td><?=$U['NumeroDocumentoIdentidad']?></td>
				<td><?=$U['Nombres'].' '.$U['Apellidos']?></td>
				<td><?=$U['CorreoElectronico']?></td>
				<td><?=$U['NombreRol']?></td>
				<td><?=$U['EstadoUsuario']?></td>
				<td><?=$U['FechaHoraModificacion']?></td>
				<td>
					<?php 
					if(in_array('Usuarios.ver', $Permisos)){
						echo $this->Html->link(
						    'Ver',
						    ['controller' => 'usuarios', 'action' => 'ver', '?' => ['IdUsuarios' => $U['IdUsuarios']]],
						    ['class' => 'btn btn-sm btn-info', 'title' => 'Ver usuario', 'alt' => 'Ver usuario']
						);
					}
					?>
				</td>
				<td>
					<?php 
					if(in_array('Usuarios.editar', $Permisos)){
						echo $this->Html->link(
						    'Editar',
						    ['controller' => 'usuarios', 'action' => 'editar', '?' => ['IdUsuarios' => $U['IdUsuarios']]],
						    ['class' => 'btn btn-sm btn-primary', 'title' => 'Editar usuario', 'alt' => 'Editar usuario']
						);
					}
					?>
				</td>
				<td>
					<?php 
					if(in_array('Usuarios.cambiarContrasena', $Permisos)){
						echo $this->Html->link(
						    'Contrasena',
						    ['controller' => 'usuarios', 'action' => 'cambiarContrasena', '?' => ['IdUsuarios' => $U['IdUsuarios']]],
						    ['class' => 'btn btn-sm btn-warning', 'title' => 'Cambiar contrasena', 'alt' => 'Cambiar contrasena']
						);
					}
					?>
				</td>
				<td>
					<?php 
					if(in_array('Usuarios.eliminar', $Permisos)){
						echo $this->Html->link(
						    'Eliminar',
						    ['controller' => 'usuarios', 'action' => 'index'],
						    ['onclick' => 'EliminarUsuario('.$U['IdUsuarios'].')', 'type' => 'button', 'class' => 'btn btn-sm btn-danger', 'title' => 'Eliminar usuario', 'alt' => 'Eliminar usuario']
						);
					}
					?>
				</td>		
			</tr>
					<?php
				}
			}else{
				?>
			<tr class="text-center">
				<td colspan="7">No hay registros</td>
			</tr>
				<?php
			}
			?>
		</tbody>
	</table>
</div>