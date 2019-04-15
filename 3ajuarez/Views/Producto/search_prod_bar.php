<?php
	if(isset($_SESSION["id_sesion"])){
		if(($_SESSION["id_sesion"]=="administrador" || $_SESSION["id_sesion"]=="gerente" || $_SESSION["id_sesion"]=="barra")&& $_SESSION["ruta"]==SUCURSAL){
?>

				<section>
				<div class="container">
					<div class="row">
						<div class="mx-auto">
						<form action='index.php' method='get' id="search_form_bar">
							<input type='hidden' name='controller' value='producto'>
							<input type='hidden' name='action' value='search_prod_barra'>
							<table id="update_table">
								<tr>
									<td><label>Productos por categoria: &nbsp; </label></td>
									<td>
										<select name='argumento'>
											<?php
											if(!empty($listaFamilias)){
												foreach($listaFamilias as $familia){
													echo "<option value='" . $familia->cod_familia . "'>" .$familia->descripcion. "</option>";
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
										<!-- <input type='submit' value='Buscar' class="btn btn-info" > -->
										<button type="submit" class="btn btn-info">
											Buscar &nbsp;<span class="oi" data-glyph="magnifying-glass"></span>
										</button>
									</td>
									<?php }else{
										echo "<h2 align='center'>Se esta actualizando la informacion,<br> espera un momento...</h2>";
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
		}else{//End if verifica usuario autorizado
			//Inclur una pagina para redireccionar a index
			header('Location: ../Views/sesion/no_sesion.php');
		}
	}//End if verififca que exista variable para sesion
?>
