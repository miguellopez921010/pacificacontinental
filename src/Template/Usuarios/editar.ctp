<?php 
$this->Breadcrumbs->add([
    ['title' => 'Usuarios', 'url' => ['controller' => 'usuarios', 'action' => 'index']],
    ['title' => 'Editar usuario '.$Usuario['IdUsuarios']]
]);

echo $this->Breadcrumbs->render(
    ['class' => 'breadcrumbs'],
);
?>

<div class="row">
	<div class="col-2"></div>
	<div class="col-8">
		<h2>Editar usuario</h2>

		<?php 
		echo $this->Form->create(null, [
		    'id' => 'FormUsuarios',
		    'name' => 'FormUsuarios',
		    'type' => 'POST'
		]);

		echo $this->Form->hidden('_csrfToken', ['id' => '_csrfToken', 'value' => $this->request->getParam('_csrfToken')]);

		if(isset($Usuario)){
			if(!empty($Usuario)){
				echo $this->Form->hidden('IdUsuarios', ['id' => 'IdUsuarios', 'value' => $Usuario['IdUsuarios']]);
			}
		}
		?>

		<div class="row">
			<div class="col-12">
				<div class="form-group">
					<?php
					echo $this->Form->label('NumeroDocumentoIdentidad', 'Numero Documento de Identidad');
					echo $this->Form->text('NumeroDocumentoIdentidad', ['id' => 'NumeroDocumentoIdentidad','class' => 'form-control', 'placeholder' => 'Numero de documento', 'required' => true, 'autocomplete' => 'off', 'onkeypress' => 'return soloNumeros(event)', 'value' => (isset($Usuario)?$Usuario['NumeroDocumentoIdentidad']:'')]);
					?>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-12 col-md-6">
				<div class="form-group">
					<?php
					echo $this->Form->label('Nombres', 'Nombres');
					echo $this->Form->text('Nombres', ['id' => 'Nombres','class' => 'form-control', 'placeholder' => 'Nombres', 'required' => true, 'autocomplete' => 'off', 'onkeyup' => 'Mayusculas(this)', 'value' => (isset($Usuario)?$Usuario['Nombres']:'')]);
					?>
				</div>
			</div>
			<div class="col-12 col-md-6">
				<div class="form-group">
					<?php
					echo $this->Form->label('Apellidos', 'Apellidos');
					echo $this->Form->text('Apellidos', ['id' => 'Apellidos','class' => 'form-control', 'placeholder' => 'Apellidos', 'required' => true, 'autocomplete' => 'off', 'onkeyup' => 'Mayusculas(this)', 'value' => (isset($Usuario)?$Usuario['Apellidos']:'')]);
					?>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-12 col-md-6">
				<div class="form-group">
					<?php 
					echo $this->Form->label('CorreoElectronico', 'Correo Electronico');
					echo $this->Form->control('CorreoElectronico', ['id' => 'CorreoElectronico','type' => 'email', 'class' => 'form-control', 'placeholder' => 'Correo Electronico', 'required' => true, 'autocomplete' => 'off', 'label' => false, 'value' => (isset($Usuario)?$Usuario['CorreoElectronico']:'')]);
					?>
				</div>
			</div>
			<div class="col-12 col-md-6">
				<div class="form-group">
					<?php 
					echo $this->Form->label('Password', 'Contrasena');
					echo $this->Form->password('Password', ['id' => 'Password','class' => 'form-control', 'required' => true, 'autocomplete' => 'off', 'label' => false, 'disabled' => (isset($Usuario)?true:false) ]);
					?>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-12 col-md-6">
				<div class="form-group">
					<?php 
					$OptionsRoles = [];
					$DefectoRol = "";

					foreach($Roles AS $R){
						$OptionsRoles[$R['IdRoles']] = $R['NombreRol'];

						if(isset($Usuario)){
							if(!empty($Usuario)){
								if($R['IdRoles'] == $Usuario['IdRoles']){
									$DefectoRol = $R['IdRoles'];
								}
							}
						}
					}

					echo $this->Form->label('IdRoles', 'Rol');
					echo $this->Form->select('IdRoles', $OptionsRoles, ['default' => $DefectoRol, 'empty' => 'Seleccionar Rol', 'id' => 'IdRoles', 'class' => 'form-control', 'required' => true, 'label' => false]);
					?>
				</div>
			</div>
			<div class="col-12 col-md-6">
				<div class="form-group">
					<?php 
					$OptionsEstados = [
						0 => 'INACTIVO',
						1 => 'ACTIVO',
					];
					$DefectoEstado = 1;

					if(isset($Usuario)){
						if(!empty($Usuario)){
							$DefectoEstado = $Usuario['Estado'];
						}
					}

					echo $this->Form->label('Estado', 'Estado');
					echo $this->Form->select('Estado', $OptionsEstados, ['default' => $DefectoEstado, 'id' => 'Estado', 'class' => 'form-control', 'required' => true, 'label' => false, 'readonly' => (isset($Usuario)?false:true)]);
					?>
				</div>
			</div>
		</div>

		<br>

		<div class="d-grid gap-2 col-6 mx-auto">
		  	<?php 
			echo $this->Form->button('Guardar', ['type' => 'submit', 'class' => 'btn btn-success btn-block']);
			?>
		</div>

		<?php		
		echo $this->Form->end();
		?>
	</div>
	<div class="col-2"></div>
</div>


<script type="text/javascript">
	$(document).ready(function(){
		setTimeout(function(){
			$('form#FormUsuarios input#NumeroDocumentoIdentidad').focus();
		},100);
	});
</script>