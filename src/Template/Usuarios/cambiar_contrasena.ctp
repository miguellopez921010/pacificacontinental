<?php 
$this->Breadcrumbs->add([
    ['title' => 'Usuarios', 'url' => ['controller' => 'usuarios', 'action' => 'index']],
    ['title' => 'Cambiar contrasena']
]);

echo $this->Breadcrumbs->render(
    ['class' => 'breadcrumbs'],
);
?>

<div class="row">
	<div class="col-2"></div>
	<div class="col-8">
		<h2>Cambiar contrasena</h2>

		<?php 
		echo $this->Form->create(null, [
		    'id' => 'FormCambioContrasena',
		    'name' => 'FormCambioContrasena',
		    'type' => 'POST'
		]);

		echo $this->Form->hidden('_csrfToken', ['id' => '_csrfToken', 'value' => $this->request->getParam('_csrfToken')]);
		echo $this->Form->hidden('IdUsuarios', ['id' => 'IdUsuarios', 'value' => $IdUsuarios]);
		?>

		<div class="row">
			<div class="col-12 col-md-6">
				<div class="form-group">
					<?php 
					echo $this->Form->label('Password', 'Contrasena');
					echo $this->Form->password('Password', ['id' => 'Password','class' => 'form-control', 'required' => true, 'autocomplete' => 'off', 'label' => false]);
					?>
				</div>
			</div>
			<div class="col-12 col-md-6">
				<div class="form-group">
					<?php 
					echo $this->Form->label('Password2', 'Repetir Contrasena');
					echo $this->Form->password('Password2', ['id' => 'Password2','class' => 'form-control', 'required' => true, 'autocomplete' => 'off', 'label' => false]);
					?>
				</div>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-12 col-md-4"></div>
			<div class="col-12 col-md-4">
				<div class="form-group">
					<?php 
					echo $this->Form->button('Guardar', ['type' => 'submit', 'class' => 'btn btn-success btn-block']);
					?>
				</div>
			</div>
			<div class="col-12 col-md-4"></div>
		</div>

		<?php		
		echo $this->Form->end();
		?>
	</div>
	<div class="col-2"></div>
</div>