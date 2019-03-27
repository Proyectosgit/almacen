<?php
	session_start();
	if(isset($_SESSION["id_sesion"])){
		if($_SESSION["id_sesion"]=="root"){
?>
<!DOCTYPE html>
<html>
<head>
	<title>A&B</title>
	<meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'/>
	<link rel="stylesheet" href="../Public/bootstrap/css/bootstrap.min.css"/>
	<link rel="stylesheet" href="../Public/bootstrap/bootstrap_3.3.6/bootstrap.min.css">
	<link rel="stylesheet" href="../Public/css/logos.css"/>
	<!-- <link rel="stylesheet" href="../Public/css/style_user.css"/> -->
	<!-- <link href="Public/open-iconic-master/font/css/open-iconic.css" rel="stylesheet"> -->
</head>
<body>
		<section>
		<div class="container">
			<div class="form-group row">
				<div class="mx-auto">
					<h1> Actualizar datos del usuario..!</h1>
				</div>
			</div>
			<!-- <div class="row"> -->
			<!-- <div class="auto-mx"> -->
			<form action='usuario_controller.php' method='post' id="update_form">
				<input type='hidden' name='action' value='update'>
				<input type='hidden' name='password' value='<?php echo $usuario->password; ?>'>
				<input type='hidden' name='id_user' value='<?php echo $usuario->id_user; ?>'>

				<div class="row form-group">
					<div class="col-md-2">
						<label>Nombre de usuario:</label>
					</div>
					<div class="col-md-5">
						<input class="form-control" type='text' name='username' maxlength="30" value='<?php echo $usuario->username; ?>'>
					</div>
				</div>

				<div class="row form-group">
					<div class="col-md-2">
						<label>Cargo: </label>
					</div>
					<div class="col-md-5">
						<input class="form-control" type='text' name='cargo'  maxlength="30" value='<?php echo $usuario->cargo; ?>'>
					</div>
				</div>

				<div class="row form-group">
					<div class="col-md-2">
						<label>Nombre:</label>
					</div>
					<div class="col-md-5">
						<input class="form-control" type='text' name='nombre' maxlength="30" value='<?php echo $usuario->nombre; ?>'>
					</div>
				</div>

				<div class="row form-group">
					<div class="col-md-2">
						<label>Email:</label>
					</div>
					<div class="col-md-5">
						<input class="form-control" type='email' name='email' maxlength="30" value='<?php echo $usuario->email; ?>'>
					</div>
				</div>

				<div class="row form-group">
					<div class="col-md-2">
						<label>Id almacen:</label>
					</div>
					<div class="col-md-5">
						<input class="form-control" type='text' name='id_almacen' maxlength="30" value='<?php echo $usuario->id_almacen; ?>'>
					</div>
				</div>

				<div class="row form-group">
					<div class="col-md-2">
						<label>Carpeta(PATH):</label>
					</div>
					<div class="col-md-5">
						<input class="form-control" type='text' name='ruta' maxlength="30" value='<?php echo $usuario->ruta; ?>'>
					</div>
				</div>

				<div class="form-group row">
					<div class="mx-auto">
						<input align="center" class= "btn btn-primary" type='submit' value='Actualizar'>
					</div>
				</div>
			</form>


				<div class="form-group row">
					<!-- <div class="mx-auto"> -->
						<?php echo "<a href='javascript:window.history.back();' class='btn btn-success'> &laquo; Volver atrás </a>" ?>
					<!-- </div> -->
				</div>

			<!-- </div> -->
			<!-- </div> -->
		</div>
		</section>
</body>
</html>
<?php
	}else{
		//Inclur una pagina para redireccionar a index
		header('Location: Views/sesion/no_sesion.php');
	}
}
?>
