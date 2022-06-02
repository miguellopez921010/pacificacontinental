<?php 
$this->Breadcrumbs->add([
    ['title' => 'Inicio', 'url' => ['controller' => 'Home', 'action' => 'index']],
    ['title' => 'Login']
]);

echo $this->Breadcrumbs->render(
    ['class' => 'breadcrumbs'],
);
?>

<div class="row">
	<div class="col-12 col-md-4"></div>
	<div class="col-12 col-md-4 card">
		<div class="card-body"> 
			<h2>Iniciar sesion</h2>

			<?php 
			echo $this->Form->create(null, [
			    'id' => 'FormLogin',
			    'name' => 'FormLogin',
			    'type' => 'POST'
			]);

			echo $this->Form->hidden('_csrfToken', ['id' => '_csrfToken', 'value' => $this->request->getParam('_csrfToken')]);

			if(isset($Usuario)){
				if(!empty($Usuario)){
					echo $this->Form->hidden('IdUsuarios', ['id' => 'IdUsuarios', 'value' => $Usuario['IdUsuarios']]);
				}
			}
			?>

			<div class="form-group">
				<?php 
				echo $this->Form->label('CorreoElectronico', 'Correo Electronico');
				echo $this->Form->control('CorreoElectronico', ['id' => 'CorreoElectronico','type' => 'email', 'class' => 'form-control', 'placeholder' => 'Ingresar Correo Electronico', 'required' => true, 'autocomplete' => 'off', 'label' => false]);
				?>
			</div>

			<div class="form-group">
				<?php 
				echo $this->Form->label('Password', 'Contrasena');
				echo $this->Form->password('Password', ['id' => 'Password','class' => 'form-control', 'placeholder' => 'Ingresar contrasena','required' => true, 'autocomplete' => 'off', 'label' => false ]);
				?>
			</div>
			<br>

			<div class="d-grid gap-2 col-6 mx-auto">
			  	<?php 
				echo $this->Form->button('Iniciar sesion', ['type' => 'submit', 'class' => 'btn btn-success']);
				?>
			</div>

			<?php		
			echo $this->Form->end();
			?>
		</div>
	</div>
	<div class="col-12 col-md-4"></div>
</div>