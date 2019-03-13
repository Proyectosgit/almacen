<?php
	session_start();
	if(isset($_SESSION["id_sesion"])){
		if($_SESSION["id_sesion"]=="administrador"){
?>

<section>
<h1>Bienvenido al update usuario..!</h1>

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
	</table>

	<input type='submit' value='Actualizar'>
</form>
</section>

<?php
	}else{
		//Inclur una pagina para redireccionar a index
		header('Location: Views/sesion/no_sesion.php');
	}
}
?>
