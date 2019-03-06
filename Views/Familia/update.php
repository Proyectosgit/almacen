<?php
	session_start();
	if(isset($_SESSION["id_sesion"])){
		if($_SESSION["id_sesion"]=="administrador"){
?>

<section>
	<h1>Bienvenido al update familia..!</h1>

	<form action='familia_controller.php' method='post' id="update_form">
		<input type='hidden' name='action' value='update'>
		<table id="update_table">
			<!--<tr>
				<td><label>Codigo de familia:</label></td><td><input type='text' name='cod_familia' maxlength="20" value='<?php //Secho $familia->cod_familia; ?>'></td>
			</tr>-->
			<tr>
				<td><label>Codigo de familia: </label></td><td><?php echo $familia->cod_familia; ?></td>
			</tr>
			<tr>
				<td><label>Descripcion: </label></td><td><input type='text' name='descripcion'  maxlength="50" value='<?php echo $familia->descripcion; ?>'></td>
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
