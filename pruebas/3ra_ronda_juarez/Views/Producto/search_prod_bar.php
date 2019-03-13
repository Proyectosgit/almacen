<?php
	if(isset($_SESSION["id_sesion"])){
		if($_SESSION["id_sesion"]=="administrador" || $_SESSION["id_sesion"]=="gerente" || $_SESSION["id_sesion"]=="barra"){

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
											<option value='BEBID'>Bebida</option>
											<option value='BRAND'>Brandy</option>
											<option value='CERVE'>Cerveza</option>
											<option value='CHAMP'>Champagne</option>
											<option value='CIGAR'>Cigarro</option>
											<option value='ENERG'>Energéticas</option>
											<option value='GINEB'>Ginebra</option>
											<option value='HIELO'>Hielo</option>
											<option value='COGNA'>Cogna</option>
											<option value='JEREZ'>Jerez</option>
											<option value='LICOR'>Licor</option>
											<option value='MEZCA'>Mezcal</option>
											<option value='RONN'>Ron</option>
											<option value='TEQUI'>Tequila</option>
											<option value='VINOS'>Vino</option>
											<option value='VODKA'>Vodka</option>
											<option value='WHISK'>Whisky</option>
										</select>
									</td>
								</tr>
								<tr>
									<td align="center"><br>
										<!-- <input type='submit' value='Buscar' class="btn btn-info" > -->
										<button type="submit" class="btn btn-info">
											Buscar &nbsp;<span class="oi" data-glyph="magnifying-glass"></span>
										</button>
									</td>
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
			header('Location: Views/sesion/no_sesion.php');
		}
	}//End if verififca que exista variable para sesion
?>
