<?php

	if(isset($_SESSION["id_sesion"])){
		if($_SESSION["id_sesion"]=="root"){
?>

 		<section>
			<h3 align="center">Registro de Usuario:</h3>
   			<div class="container">
    			<form action='Controllers/usuario_controller.php' method='post'>
      				<input type='hidden' name='action' value='register'>
					<div class="form-group">
      					<label>Usuario:</label>
      					<input class="form-control" type="text" name="username" maxlength="30" placeholder="Nombre" required>
      				</div>

      				<div class="form-group">
      					<label >Password:</label>
      					<input class="form-control" type="password" name="password" maxlength="30" placeholder="Password" autocomplete="off" required>
      				</div>

	  				<div class="form-group">
	  					<label class="form-group">Cargo:</label>
	  					<select class="form-control"  name="cargo">
		 					<option value="barra">Barra</option>
							<option value="cocina">Cocina</option>
							<option value="gerente">Gerente</option>
	  					</select>
	  				</div>

      				<div class="form-group">
      					<label >Nombre:</label>
      					<input class="form-control" type='text' name='nombre' maxlength="30" placeholder="Cargo" required>
      				</div>

      				<div class="form-group">
      					<label >E-mail:</label>
      					<input class="form-control" type="email" name="email" maxlength="30" placeholder="E-mail" required>
      				</div>

					<div class="form-group">
      					<label >Almacen:</label>
      					<input class="form-control" type="number" name="id_almacen" maxlength="30" placeholder="almacen" required>
      				</div>

					<div class="form-group">
      					<label >Nombre de la carpeta del almacen:</label>
      					<input class="form-control" type="text" name="ruta" maxlength="30" placeholder="PATH" required>
      				</div>

      				<button class="btn btn-primary">Enviar</button>
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
