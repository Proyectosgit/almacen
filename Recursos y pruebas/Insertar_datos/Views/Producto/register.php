<p>Bienvenido al registro de Productos..!</p>

<!-- <form action='Controllers/producto_controller.php' method='post' id="register_form"> -->
<form action='../../Controllers/productos_controller.php' method='post' id="register_form">
	<input type='hidden' name='action' value='register'>
	<table id="register_table">
		<tr>
			<td><label>Codigo Ingrediente:</label></td><td><input type='text' name='codingre' maxlength="10"></td>
		</tr>
		<tr>
			<td><label>Descripción:</label></td><td><input type='text' name='descrip' maxlength="35"></td>
		</tr>
		<tr>
			<td><label>Codigo de familia: </label></td><td><input type='text' name='familia' maxlength="10"></td>
		</tr>
		<tr>
			<td><label>Unidad:</label></td><td><input type='text' name='unidad' maxlength="10"></td>
		</tr>
		<tr>
			<td><label>Empaque:</label></td><td><input type='text' name='empaque' maxlength="15"></td>
		</tr>
		<tr>
			<td><label>Equivale:</label></td><td><input type='text' name='equivale' maxlength="20"></td>
		</tr>
		<tr>
			<td><label>Existencia:</label></td><td><input type="text" name='inventa1' maxlength="20"></td>
		</tr>
		<tr>
			<td><label>Stock Maximo:</label></td><td><input type="text" name='stockmax' maxlength="20"></td>
		</tr>
		<tr>
			<td><label>Costo Final:</label></td><td><input type="text" name='ultcosto' maxlength="20"></td>
		</tr>
		<tr>
			<td><label>Costo Promedio:</label></td><td><input type="text" name='costoprome' maxlength="20"></td>
		</tr>
		<tr>
			<td><label>Impuesto:</label></td><td><input type="text" name='impuesto' maxlength="20"></td>
		</tr>
		<tr>
			<td><label>Pedido:</label></td><td><input type="text" name='pedido' maxlength="20"></td>
		</tr>
		<tr>
			<td><label>Estatus:</label></td><td><input type="text" name='estatus' maxlength="20"></td>
		</tr>
	</table>
	<input type='submit' value='Guardar'>
</form>
