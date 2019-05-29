<?php
if(isset($_SESSION["id_sesion"])){
		if(($_SESSION["id_sesion"]=="administrador" || $_SESSION["id_sesion"]=="gerente" || $_SESSION["id_sesion"]=="barra")&& $_SESSION["ruta"]==SUCURSAL){
				// if($visible=="true"){
?>
						<section>
							<div class="container">
								<div class="table-responsive">
										<table class="table">
										<thead class="thead-dark small">
											<tr>
												<th>Descripción</th>
												<th>Pedido</th>
												<th>Subtotal</th>
												<!-- <th>Empaque</th> -->
												<!-- <th>Codigo <br>Familia</th> -->
												<!-- <th>Stock <br>Minimo</th> -->
												<th>Stock <br>Maximo</th>
												<th>Existencia</th><!--inventaria1-->
												<!-- <th>Costo <br>promedio</th> -->
												<!-- <th>Impuesto</th> -->
												<!-- <td>Estatus</td> -->
												<th>Precio <br> Unitario</th>
												<!-- <th>Unidad</th> -->
												<!-- <th>Equivale</th> -->
												<!-- <th>Codigo <br>Ingrediente</th> -->
												<!-- <td colspan=2 >Acciones</td> -->
											</tr>
										</thead>
										<tbody>
												<?php
												$costo_total=0;
												$total_prod=0;
												if(!empty($productos)){
												foreach ($productos as $producto) {
													//Se agrega para evitar pedir con negativos
													if($producto->inventa1>=0){
														$pedido1 = $producto->stockma1 - $producto->inventa1;
													}elseif($producto->inventa1 < 0){
														$pedido1=$producto->stockma1 - 0;
													}//fin negativos

													if($pedido1>=0){
														$costo_producto = $producto->ultcosto*$pedido1;
													}else{
														$costo_producto = 0;
													}

													if($producto->redondeo == 1){
														// $pedido=round($pedido,2);
														$pedido1=ceil($pedido1);
														// $pedido=round($pedido,2)
													}elseif($producto->redondeo == 0){
														$pedido1=$pedido1;
													}

													// $pedido = round($pedido,2);
													$costo_producto = round($costo_producto,2);
													// if($producto->inventa1 >=0 && $producto->inventa1 < $producto->stockmax){
													?>
														<tr>
															<td class="small"><?php echo $producto->descrip;?></td>
															<!-- <td bgcolor="#3ADF00"><?//php echo $pedido;?></td> -->
															<td><input class="cantidad" type="text" name="<?php echo $producto->codingre;?>" value="<?php if($pedido1>=0){echo number_format($pedido1,2);}else{echo 0;};?>" required></td> <!--Permite modificar la cantidad pedida-->
															<td class="costo_producto"><?php echo number_format($costo_producto,2); ?></td>
															<?php 	$costo_total=$costo_total+$costo_producto;
																   	$total_prod=$total_prod+1;
															?>
															<!-- <td><?php //echo $producto->familia;?></td> -->
															<!-- <td><?php //echo $producto->empaque;?></td> -->
															<!-- <td class="stock_mix"><?php //echo $producto->stockmin;?></td> -->
															<td class="stock_max"><?php echo $producto->stockma1;?></td>
															<td class="existencia"><?php echo $producto->inventa1;?></td>
															<td class="precio_unitario"><?php echo $producto->ultcosto;?></td>
															<!-- <td><?php //echo $producto->costoprome;?></td> -->
															<!-- <td><?php //echo $producto->impuesto;?></td> -->
															<!-- <td><?php //echo $producto->status;?></td> -->
															<!-- <td><a href="Controllers/producto_controller.php?action=update&codingre=<?php// echo $producto->codingre ?>">Actualizar</a> </td> -->
															<!-- <td><a href="Controllers/producto_controller.php?action=delete&codingre=<?php// echo $producto->codingre ?>">Eliminar</a> </td> -->
															<!-- <td><?php //echo $producto->unidad;?></td> -->
															<!-- <td><?php //echo $producto->equivale;?></td> -->
															<!-- <td><?php //echo $producto->codingre; ?></td> -->
															<td> <input class="redondeo" type="hidden" name="redondeo" value="<?php echo $producto->redondeo; ?>"> </td>
														</tr>
												<?php //}//end if
												}//end for each
												//require_once("../librerias/js/verifica_cambio_pedido.js");
												//Recupera los datos modificados en la vista
												//$modificados = "<script>datos</script>";
	 										?>
	 													<tr>
																<?php $costo_total=round($costo_total,2)?>
																<td colspan="10" id="costo_total">Total de Compra = <?php echo number_format($costo_total,2);?></td>
														</tr>
											<?php
												}//End empty productos
											?>
										</tbody>
										</table>
								</div>
							</div>
						</section>


		<?php if($total_prod>0){
								?>
								<form action="Controllers/producto_controller.php" method="post" id="pedido_form">
									<input type="hidden" name="action" value="pedido">
									<input type="hidden" name="familia" value="<?php echo $producto->familia;?>" >
									<input type="hidden" name="costo_total" value="<?php echo $costo_total;?>" id="costo_total_mod">
									<input type="hidden" name="total_prod" value="<?php echo $total_prod;?>">
									<input type="hidden" name="modificados" value="" id="array_modifica">
									<input type="hidden" name="observacion" value="">
									<input type="hidden" name="visible" value="false">
									<center>
											<!-- <input type="submit" value="Pedido" class="btn btn-success" onclick="return foor();"> -->
											<!-- <button type="submit" class="btn btn-success" onclick="return autoriza_pedido();"> --> <!--Muestra mensaje, se usaba-->
											<button type="submit" class="btn btn-success">
												Pedido &nbsp; <span class="oi" data-glyph="cart"></span>
											</button>
									</center>
								</form>
								<br><br>

								<form action="Controllers/producto_controller.php" method="post">
									<input type="hidden" name="action" value="cancelado">
									<input type="hidden" name="perfil" value="barra">
									<center>
										<!-- <button type="submit" class="btn btn-danger"  onclick="return cancela_pedido();"> -->
										<button type="submit" class="btn btn-danger">
											Cancelar &nbsp; <span class="oi" data-glyph="x"></span>
										</button>
									</center>
								</form>
								<br><br><br>

								<script type="text/javascript">
					  			if(history.forward(1)){
					    			location.replace( history.forward(1) );
					  			}
								</script>

					<?php
					}else{

								echo "<h1 align='center'>No hay productos a pedir</h1>
								<div align='center'>
								<a href='javascript:window.history.back();' class='btn btn-primary'>&laquo; Volver atrás</a>
								</div>";


					}


				// }else{//end if visible
				//
				// 			// echo "<h1 align='center'>Pagina expirada, has cancelado tu pedido o ya se realizo<h1>
				// 			// <div align='center'>
				// 			// <a href='javascript:window.history.back();' class='btn btn-primary'>&laquo; Volver atrás</a>
				// 			// </div>";
				// 			header("Location: index.php?controller=producto&action=search_prod_bar");
				//
				// }
					?>
					<!-- <script src="Public/librerias/verifica_cambio_pedido.js"></script> --> <!--Sirve para validar las entradas -->
		<?php
	}else{//End if verifica usuario
			//Inclur una pagina para redireccionar a index
			header('Location: ../Views/sesion/no_sesion.php');
		}
}//End if verifica que la variable de sesion este definida
?>
<script src="Public/jquery/jquery-3.3.1.min.js"></script>
<script src="Public/librerias/verifica_cambio_pedido.js"></script>
<script>
	function cancela_pedido(){
		alert("Pedido Canceladose...");
		return true;
	 }
	function autoriza_pedido(){
		alert("Pedido Realizandose...");
		return true;
	}
</script>
