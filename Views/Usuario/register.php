<?php

	if(isset($_SESSION["id_sesion"])){
		if($_SESSION["id_sesion"]=="root"){
?>

<!-- <style type="text/css" media="screen">
	@import url("Public/css/style_user2.css");
</style> -->
 		<section>
			<h3 align="center">Registro de Usuario:</h3><br>

   			<div class="container">
    			<form action='Controllers/usuario_controller.php' method='post'>

      				<input type='hidden' name='action' value='register'>

				<div class="form-group row">
					<div class="col-md-2">
      					<label>Usuario:</label>
					</div>
					<div class="col-md-5">
      					<input class="form-control" type="text" name="username" maxlength="30" placeholder="Nombre" aria-describedby="usernameHelpBlock" required>
						<small id="usernameHelpBlock" class="form-text text-muted">
							Ingresa el nombre de usuario.
						</small>
      				</div>
				</div>

				<div class="form-group row">
					<div class="col-md-2">
      					<label >Password:</label>
					</div>
      				<div class="col-md-5">
      					<input class="form-control" type="password" name="password" maxlength="30" placeholder="Password" aria-describedby="passwordHelpBlock" autocomplete="off" required>
						<small id="passwordHelpBlock" class="form-text text-muted">
							Ingresa la contraseña que usara el usuario.
						</small>
      				</div>
				</div>

				<div class="form-group row">
					<div class="col-md-2">
	  					<label>Cargo:</label>
					</div>
	  				<div class="col-md-5">
	  					<select class="form-control"  name="cargo" aria-describedby="cargoHelpBlock">
		 					<option value="barra">Barra</option>
							<option value="cocina">Cocina</option>
							<option value="gerente">Gerente</option>
	  					</select>
					<small id="cargoHelpBlock" class="form-text text-muted">
						Selecciona el cargo que tiene la persona.
					</small>
	  				</div>
				</div>

				<div class="form-group row">
					<div class="col-md-2">
      					<label> Nombre:</label>
					</div>
      				<div class="col-md-5">
      					<input class="form-control" type='text' name='nombre' maxlength="30" placeholder="Cargo" aria-describedby="nombreHelpBlock" required>
						<small id="nombreHelpBlock" class="form-text text-muted">
							(Nombre Apellido Materno Apellido Materno).
	 					</small>
      				</div>
				</div>

				<div class="form-group row">
					<div class="col-md-2">
      					<label >E-mail:</label>
					</div>
      				<div class="col-md-5">
      					<input class="form-control" type="email" name="email" maxlength="30" placeholder="E-mail" aria-describedby="emailHelpBlock" required/>
						<small id="emailHelpBlock" class="form-text text-muted">
							Ingresa tu correo electronico.
						</small>
					</div>
				</div>

				<div class="form-group row">
					<div class="col-md-2">
      					<label >Almacen:</label>
					</div>
					<div class="col-md-5">
      					<input class="form-control" type="number" name="id_almacen" maxlength="30" placeholder="almacen" aria-describedby="almacenHelpBlock" required>
						<small id="almacenHelpBlock" class="form-text text-muted">
							Selecciona el almacen al que pertenece.
						</small>
      				</div>
				</div>

				<div class="form-group form-group row">
					<div class="col-md-2">
						<label >Nombre de la carpeta del almacen:</label>
					</div>
					<div class="col-md-5">
      					<input class="form-control" type="text" name="ruta" maxlength="30" placeholder="PATH" aria-describedby="pathHelpBlock" required>
						<small id="pathHelpBlock" class="form-text text-muted">
							Escribe el nombre de la carpeta de la unidad a la que pertenece.
						</small>
					</div>
      			</div>

				<div class="form-group row">
					<div class="col-md-6 ml-auto" >
      					<button class="btn btn-primary">Enviar</button>
					</div>
				</div>
    			</form>

			</div>
		</section>
<?php
		}else{
			//Inclur una pagina para redireccionar a index
			header('Location: ../Views/sesion/no_sesion.php');
		}
	}
?>
