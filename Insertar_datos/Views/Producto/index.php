<?php
require("../../connection.php");
require_once("../../Models/productos.php");
require_once("../../Controllers/productos_controller.php");
$productos=Productos::all();
?>
<table border='1'>
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
	foreach ($productos as $producto) { ?>

			<tr>
				<td><?php echo $producto->codingre; ?></td>
				<td><?php echo $producto->descrip; ?></td>
				<td><?php echo $producto->familia;?></td>
				<td><?php echo $producto->unidad;?></td>
				<td><?php echo $producto->empaque;?></td>
				<td><?php echo $producto->equivale;?></td>
				<td><?php echo $producto->inventa1;?></td>
				<td><?php echo $producto->stockmax;?></td>
				<td><?php echo $producto->ultcosto;?></td>
				<td><?php echo $producto->costoprome;?></td>
				<td><?php echo $producto->impuesto;?></td>
				<td><?php echo $producto->pedido;?></td>
				<td><?php echo $producto->estatus;?></td>
				<td><a href="Controllers/producto_controller.php?action=update&id=<?php echo $producto->id_prod ?>">Actualizar</a> </td>
				<td><a href="Controllers/producto_controller.php?action=delete&id=<?php echo $producto->id_prod ?>">Eliminar</a> </td>
			</tr>
	<?php } ?>
</table>
