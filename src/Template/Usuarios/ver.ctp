<?php 
$this->Breadcrumbs->add([
    ['title' => 'Usuarios', 'url' => ['controller' => 'usuarios', 'action' => 'index']],
    ['title' => 'Ver usuario '.$Usuario['IdUsuarios']]
]);

echo $this->Breadcrumbs->render(
    ['class' => 'breadcrumbs'],
);
?>

<div class="row">
	<div class="col-2"></div>
	<div class="col-8">
		<h2>Ver usuario</h2>

		<table class="table table-striped">
			<tbody>
				<tr>
					<td><b>Numero documento indentidad</b></td>
					<td><?=$Usuario['NumeroDocumentoIdentidad']?></td>
				</tr>
				<tr>
					<td><b>Nombres y apellidos</b></td>
					<td><?=$Usuario['Nombres'].' '.$Usuario['Apellidos']?></td>
				</tr>
				<tr>
					<td><b>Correo electronico</b></td>
					<td><?=$Usuario['CorreoElectronico']?></td>
				</tr>
				<tr>
					<td><b>Rol</b></td>
					<td><?=$Usuario['NombreRol']?></td>
				</tr>
				<tr>
					<td><b>Fecha y hora creacion</b></td>
					<td><?=$Usuario['FechaHoraCreacion']?></td>
				</tr>
				<tr>
					<td><b>Fecha y hora modificacion</b></td>
					<td><?=$Usuario['FechaHoraModificacion']?></td>
				</tr>
			</tbody>
		</table>
	</div>
	<div class="col-2"></div>
</div>