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
	<link href="Public/open-iconic-master/font/css/open-iconic.css" rel="stylesheet">
</head>
<body>
		<section>
		<h1 align="center">Bienvenido al update usuario..!</h1>
		<div class="container">
			<form action='usuario_controller.php' method='post' id="update_form">
				<input type='hidden' name='action' value='update'>
				<input type='hidden' name='password' value='<?php echo $usuario->password; ?>'>
				<input type='hidden' name='id_user' value='<?php echo $usuario->id_user; ?>'>
				<table id="update_table">
					<tr>
						<td><label>Nombre de usuario:</label></td><td><input type='text' name='username' maxlength="30" value='<?php echo $usuario->username; ?>'></td>
					</tr>
					<tr>
						<td><label>Cargo: </label></td><td><input type='text' name='cargo'  maxlength="30" value='<?php echo $usuario->cargo; ?>'></td>
					</tr>
					<tr>
						<td><label>Nombre:</label></td><td><input type='text' name='nombre' maxlength="30" value='<?php echo $usuario->nombre; ?>'></td>
					</tr>
					<tr>
						<td><label>Email:</label></td><td><input type='email' name='email' maxlength="30" value='<?php echo $usuario->email; ?>'></td>
					</tr>
					<tr>
						<td><label>Id almacen:</label></td><td><input type='text' name='id_almacen' maxlength="30" value='<?php echo $usuario->id_almacen; ?>'></td>
					</tr>
					<tr>
						<td><label>Carpeta(PATH):</label></td><td><input type='text' name='ruta' maxlength="30" value='<?php echo $usuario->ruta; ?>'></td>
					</tr>
				</table>

				<input align="center" class= "btn btn-primary" type='submit' value='Actualizar'>
			</form>
		</div>
		<?php echo "<a'windows:'> </a>" ?>
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
