<?php
// require_once("Config/config.php");
//echo  $_SESSION["ruta"];
	if(isset($_SESSION["id_sesion"])){
		if($_SESSION["id_sesion"]=="administrador" && $_SESSION["ruta"]==SUCURSAL){
			//echo $_SESSION['id_sesion'];
			//echo $_SESSION['ruta'];
			//echo SUCURSAL;
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
	  		<label class="form-group" >Cargo:</label>
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
