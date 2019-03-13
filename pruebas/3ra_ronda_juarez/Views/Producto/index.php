<?php
	if(isset($_SESSION["id_sesion"])){
		if($_SESSION["id_sesion"]=="administrador" || $_SESSION["id_sesion"]=="gerente"){
?>

<section>
<div class="container">
	<div class="table-responsive">
		<table class="table">
			<thead class="thead-dark small">
				<tr>
					<th>Codigo<br>Ingrediente</th>
					<th>Descripción</th>
					<th>Codigo<br>Familia</th>
					<th>Unidad</th>
					<th>Empaque</th>
					<th>Equivale</th>
					<th>Existencia<br>(Inventa)</th>
					<th>Stock<br>Maximo</th>
					<th>Stock<br>Minimo</th>
					<th>Costo<br>Final</th>
					<th>Costo<br>promedio</th>
					<th>Impuesto</th>
					<th>Pedido</th>
					<th>Estatus</th>
					<th colspan=2 >Acciones</th>
				</tr>
			</thead>
			<tbody>
					<?php
					foreach ($productos as $producto) { ?>
						<tr class="small">
							<td><?php echo $producto->codingre; ?></td>
							<td><?php echo $producto->descrip; ?></td>
							<td><?php echo $producto->familia;?></td>
							<td><?php echo $producto->unidad;?></td>
							<td><?php echo $producto->empaque;?></td>
							<td><?php echo $producto->equivale;?></td>
							<td><?php echo $producto->inventa1;?></td>
							<td><?php echo $producto->stockmax;?></td>
							<td><?php echo $producto->stockmin;?></td>
							<td><?php echo $producto->ultcosto;?></td>
							<td><?php echo $producto->costoprome;?></td>
							<td><?php echo $producto->impuesto;?></td>
							<td><?php echo $producto->pedido;?></td>
							<td><?php echo $producto->status;?></td>
							<td><a href="Controllers/producto_controller.php?action=update&codingre=<?php echo $producto->codingre ?>">Actualizar</a> </td>
							<td><a href="Controllers/producto_controller.php?action=delete&codingre=<?php echo $producto->codingre ?>">Eliminar</a> </td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
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
