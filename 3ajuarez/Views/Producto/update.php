<?php
	session_start();
	if(isset($_SESSION["id_sesion"])){
		if($_SESSION["id_sesion"]=="administrador"&& $_SESSION["ruta"]==SUCURSAL){
?>
<section>
<h1>Bienvenido al update usuario..!</h1>

<form action='producto_controller.php' method='post' id="update_form">
	<input type='hidden' name='action' value='update'>
	<input type='hidden' name='codingre' maxlength='10' value='<?php echo $producto->codingre; ?>'>
	<table id="update_table">
		<tr>
			<td><label>Descripción:</label></td><td><input type='text' name='descrip'  maxlength='35' value='<?php echo $producto->descrip; ?>'></td>
		</tr>
		<tr>
			<td><label>Codigo de familia:</label></td><td><input type='text' name='familia' maxlength='10' value='<?php echo $producto->familia; ?>'></td>
		</tr>
		<tr>
			<td><label>Unidad:</label></td><td><input type='text' name='unidad' maxlength='10' value='<?php echo $producto->unidad; ?>'></td>
		</tr>
		<tr>
			<td><label>Empaque:</label></td><td><input type='text' name='empaque' maxlength='15' value='<?php echo $producto->empaque; ?>'></td>
		</tr>
		<tr>
			<td><label>Equivale:</label></td><td><input type='text' name='equivale' maxlength='20' value='<?php echo $producto->equivale; ?>'></td>
		</tr>
		<tr>
			<td><label>Existencia:</label></td><td><input type='text' name='inventa1' maxlength='20' value='<?php echo $producto->inventa1; ?>'></td>
		</tr>
		<tr>
			<td><label>Stock Maximo:</label></td><td><input type='text' name='stockmax' maxlength='20' value='<?php echo $producto->stockmax1; ?>'></td>
		</tr>
		<tr>
			<td><label>Stock Minimo:</label></td><td><input type='text' name='stockmin' maxlength='20' value='<?php echo $producto->stockmin1; ?>'></td>
		</tr>
		<tr>
			<td><label>Costo Final:</label></td><td><input type='text' name='ultcosto' maxlength='20' value='<?php echo $producto->ultcosto; ?>'></td>
		</tr>
		<tr>
			<td><label>Costo Promedio:</label></td><td><input type='text' name='costoprome' maxlength='20' value='<?php echo $producto->costoprome; ?>'></td>
		</tr>
		<tr>
			<td><label>Impuesto:</label></td><td><input type='text' name='impuesto' maxlength='20' value='<?php echo $producto->impuesto; ?>'></td>
		</tr>
		<tr>
			<td><label>Pedido:</label></td><td><input type='text' name='pedido' maxlength='20' value='<?php echo $producto->pedido1; ?>'></td>
		</tr>
		<tr>
			<td><label>Estatus:</label></td><td><input type='text' name='estatus' maxlength='20' value='<?php echo $producto->status1; ?>'></td>
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
