<!DOCTYPE html>
<script src="librerias/js/jquery-3.3.1.min.js"></script>
<table border="1">
	<tr>
		<td>Codigo Ingrediente</td>
		<td>Descripción</td>
		<td>Codigo Familia</td>
		<td>Unidad</td>
		<td>Empaque</td>
		<td>Equivale</td>
		<td>Existencia(Inventa)</td>
		<td>Stock Maximo</td>
		<td>Costo final</td>
		<td>Costo promedio</td>
		<td>Impuesto</td>
		<td>Pedido</td>
		<td>Estatus</td>
		<td colspan=2 >Acciones</td>
	</tr>
<?php

	$costo_total=0;
	$total_prod=0;
	foreach ($productos as $producto) {
		$pedido=$producto->stockmax-$producto->inventa1;
		$costo_producto=$producto->ultcosto*$pedido;
		?>

			<tr>
				<td><?php echo $producto->codingre; ?></td>
				<td><?php echo $producto->descrip; ?></td>
				<td><?php echo $producto->familia;?></td>
				<td><?php echo $producto->unidad;?></td>
				<td><?php echo $producto->empaque;?></td>
				<td><?php echo $producto->equivale;?></td>
				<td class="existencia"><?php echo $producto->inventa1;?></td>
				<td class="stock_max"><?php echo $producto->stockmax;?></td>
				<td class="precio_unitario"><?php echo $producto->ultcosto;?></td>
				<td><?php echo $producto->costoprome;?></td>
				<td><?php echo $producto->impuesto;?></td>
				<td><input class="cantidad" type="number" name="<?php echo $producto->codingre;?>" value="<?php echo $pedido;?>" required></td>
				<td><?php echo $producto->estatus;?></td>
				<td class="costo_producto"><?php echo $costo_producto;?></td>
						<?php $costo_total=$costo_total+$costo_producto;
									$total_prod=$total_prod+1;
						?>
				<td><a href="Controllers/producto_controller.php?action=udate&id=<?php echo $producto->codingre ?>">Actualizar</a> </td>
				<td><a href="Controllers/producto_controller.php?action=delete&id=<?php echo $producto->codingre ?>">Eliminar</a> </td>
			</tr>
	<?php }
	//require_once("../librerias/js/verifica_cambio_pedido.js");
	//Recupera los datos modificados en la vista
	//$modificados = "<script>datos</script>";
	 ?>
	 		<tr>
				<td colspan="10" id="costo_total">Total de Compra = <?php echo $costo_total?></td>
			</tr>
</table>
<form action="Controllers/producto_controller.php" method="post" id="pedido_form">
	<input type="hidden" name="action" value="pedido">
	<input type="hidden" name="familia" value="<?php echo $producto->fam;?>" >
	<input type="hidden" name="costo_total" value="<?php echo $costo_total;?>" id="costo_total_mod">
	<input type="hidden" name="total_prod" value="<?php echo $total_prod;?>">
	<input type="hidden" name="modificados" value="" id="array_modifica">
	<input type="submit" value="Pedido">
</form>


<script src="librerias/js/verifica_cambio_pedido.js"></script>
