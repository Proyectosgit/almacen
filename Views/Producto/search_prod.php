<?php
	if(isset($_SESSION["id_sesion"])){
		if($_SESSION["id_sesion"]=="administrador" || $_SESSION["id_sesion"]=="gerente" || $_SESSION["id_sesion"]=="cocina"){
?>

<section>
<div class="container">
	<div class="row">
		<div class="mx-auto">
		<form action='index.php' method='get' id="search_form">
			<input type='hidden' name='controller' value='producto'>
			<input type='hidden' name='action' value='search_prod_fam'>
			<table id="update_table">
				<tr>
					<td><label>Productos por categoria: &nbsp; </label></td>
					<td>
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
					<td align="center"><br>
						<button type='submit' class="btn btn-info">
							Buscar <span class="oi" data-glyph="magnifying-glass"></span>
						</button>
					</td>
				</tr>
			</table>
		</form>
	</div>
	</div>
</div class="container">
<!-- <img src="Public/imagenes/logo.jpg"/> -->
</section>
<section>
	<div class="container">
		<div class="row">
			<div class="mx-auto">
				<img class="logo_fondo" src="Public/imagenes/logo.jpg"/>
			</div>
		</div>
	</div>
</section>

<?php
		}else{
			//Inclur una pagina para redireccionar a index
			header('Location: Views/sesion/no_sesion.php');
		}
	}
	?>
