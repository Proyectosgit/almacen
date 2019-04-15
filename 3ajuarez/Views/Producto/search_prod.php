<?php
	if(isset($_SESSION["id_sesion"])){

		if(($_SESSION["id_sesion"]=="administrador" ||
			$_SESSION["id_sesion"]=="gerente" ||
			$_SESSION["id_sesion"]=="cocina") &&
			$_SESSION["ruta"]==SUCURSAL){
?>

<section>
<div class="container">
	<div class="row">
		<div class="mx-auto">
		<form action='index.php' method='get' id="search_form">
			<input type='hidden' name='controller' value='producto'>
			<input type='hidden' name='action' value='search_prod_fam'>
			<input type="hidden" name="visible" value="true">
			<table id="update_table">
				<tr>
					<td><label>Productos por categoria: &nbsp; </label></td>
					<td>
						<select name='argumento'>
							<?php
							if(!empty($listaFamilias)){
								foreach($listaFamilias as $familia){
									echo "<option value='" . $familia->cod_familia . "'>" . $familia->descripcion . "</option>";
								}
							}else{
								echo "<h2 align='center'>No existen familias registradas</h2>";
							}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<?php if($_SESSION['actualiza'] == "Listo"){?>
					<td align="center"><br>
						<button type='submit' class="btn btn-info">
							Buscar <span class="oi" data-glyph="magnifying-glass"></span>
						</button>
					</td>
					<?php }else{
						echo "<h2 align='center'>Se está actualizando la información,<br> espera un momento...</h2>";
					}?>
				</tr>
			</table>
		</form>
	</div>
	</div>
</div class="container">
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
			header('Location: ../Views/sesion/no_sesion.php');
		}
	}
	?>
