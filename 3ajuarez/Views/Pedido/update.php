<?php
	session_start();
	if(isset($_SESSION["id_sesion"])){
		if($_SESSION["id_sesion"]=="administrador" && $_SESSION["ruta"]==SUCURSAL){
?>
<section>
		<h1>Bienvenido al update usuario..!</h1>

		<form action='pedido_controller.php' method='post' id="update_form">
			<input type='hidden' name='action' value='update'>
			<input type='hidden' name='id_pedido' value='<?php echo $pedido->id_pedido; ?>'>
			<table id="update_table">
				<tr>
					<td><label>Fecha:</label></td><td><input type='date' name='fecha' value='<?php echo $pedido->fecha; ?>'></td>
				</tr>
				<tr>
					<td><label>Hora: </label></td><td><input type='time' name='hora'  value='<?php echo $pedido->hora; ?>'></td>
				</tr>
				<tr>
					<td><label>Autoriza:</label></td><td><input type='text' name='autoriza' maxlength='30' value='<?php echo $pedido->autoriza; ?>'></td>
				</tr>
				<tr>
					<td><label>Solicita:</label></td><td><input type='text' name='solicita' maxlength='30' value='<?php echo $pedido->solicita; ?>'></td>
				</tr>
				<tr>
					<td><label>Estado:</label></td><td><input type='text' name='estado' maxlength='20' value='<?php echo $pedido->estado; ?>'></td>
				</tr>
				<tr>
					<td><label>Observaciones:</label></td><td><input type='text' name='observaciones' maxlength='150' value='<?php echo $pedido->observaciones; ?>'></td>
				</tr>
				<tr>
					<td><label>Unidad de Medida:</label></td><td><input type='text' name='unidad_medida' maxlength='10' value='<?php echo $pedido->unidad_medida; ?>'></td>
				</tr>
				<tr>
					<td><label>Total productos:</label></td><td><input type='number' step='0.0001' name='total_prod' maxlength='10' value='<?php echo $pedido->total_prod; ?>'></td>
				</tr>
				<tr>
					<td><label>Costo Total:</label></td><td><input type='number' step='0.0001' name='costo_total' maxlength='10' value='<?php echo $pedido->costo_total; ?>'></td>
				</tr>
			</table>
			<input type='submit' value='Actualizar'>
		</form>
</section>
<?php
		}else{
			//Inclur una pagina para redireccionar a index
			header('Location: ../Views/sesion/no_sesion.php');
		}
	}
	?>
