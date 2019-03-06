<?php
	session_start();
	if(isset($_SESSION["id_sesion"])){
		if($_SESSION["id_sesion"]=="administrador"){
?>

<section>
<h1>Bienvenido al update usuario..!</h1>

<form action='relacion_controller.php' method='post' id="update_form">
	<input type='hidden' name='action' value='update'>
	<input type='hidden' name='id_pedido' value='<?php echo $relacion->id_pedido; ?>'>
	<input type='hidden' name='codingre' value='<?php echo $relacion->codingre; ?>'>
	<table id="update_table">
		<tr>
			<td><label>Fecha del pedido:</label></td><td><input type='date' name='fecha_pedido' value='<?php echo $relacion->fecha_pedido; ?>'></td>
		</tr>
		<tr>
			<td><label>Hora del pedido: </label></td><td><input type='time' name='hora_pedido'  value='<?php echo $relacion->hora_pedido; ?>'></td>
		</tr>
		<tr>
			<td><label>Numero de productos:</label></td><td><input type='number' step='0.0001' name='num_prod' maxlength="10" value='<?php echo $relacion->num_prod; ?>'></td>
		</tr>
		<tr>
			<td><label>Estado del pedido:</label></td><td><input type='text' name='estado_prod' maxlength="20" value='<?php echo $relacion->estado_prod; ?>'></td>
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
