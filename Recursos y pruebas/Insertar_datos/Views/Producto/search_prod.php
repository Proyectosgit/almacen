<p>Bienvenido al update usuario..!</p>

<!--<form action='Controllers/producto_controller.php' method='post' id="search_form">-->
<form action='index.php' method='get' id="search_form">
	<input type='hidden' name='controller' value='producto'>
	<input type='hidden' name='action' value='search_prod_fam'>
	<table id="update_table">
		<tr>
			<td><label>Categoria de Producto: </label></td>
			<td>
				<!--<input type='text' name='descripcion' maxlength='150' value='</*?php echo $producto->descripcion; */?>'>-->
				<!--<select name='cod_fam'>-->
				<select name='argumento'>
					<option value='ABARR'>Abarrote</option>
					<option value='BEBID'>Bebida</option>
					<option value='BRAND'>Brandy</option>
					<option value='CARNE'>Carne</option>
					<option value='CERVE'>Cerveza</option>
					<option value='CHAMP'>champagne</option>
					<option value='CIGAR'>Cigarro</option>
					<option value='COGNA'>Cogna</option>
					<option value='CONGE'>Congelado</option>
					<option value='EMBUT'>Embutido</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>
				<input type='submit' value='Buscar'>
			</td>
		</tr>
	</table>
</form>
