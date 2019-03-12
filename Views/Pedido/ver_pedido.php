 <?php
	if(isset($_SESSION["id_sesion"])){
		if($_SESSION["id_sesion"]=="gerente" || $_SESSION["id_sesion"]=="administrador"){

?>

<section>
<div class="container">
<div class="table-responsive">
	<table class="table">
		<thead class="thead-dark">
			<tr>
			<th scope="col">Pedido</th>
			<th colspan="3">Acciones</th>
			<!-- <th>Autoriza</th> -->
			<th scope="col">Costo Total</th>
			<th scope="col">Solicita</th>
			<th scope="col">Estatus</th>
			<!-- <th>Observaciones</th> -->
			<!-- <th>Unidad de medida</th> -->
			<!-- <th>Total de productos por familia</th> -->
			<th scope="col">Fecha Pedido</th>
			<th scope="col">Hora</th>
			</tr>
		</thead>
		<tbody>
		<?php
		foreach ($pedidos as $pedido) { ?>
			<tr>
				<td><?php echo $pedido->id_pedido; ?></td>
				<td><a href="Controllers/pedido_controller.php?action=order&id_pedido=<?php echo $pedido->id_pedido ?>&estatus=<?php echo $pedido->estado?>">Detalles</a> </td>
		<?php if( $pedido->estado=="pedido"){?>
				<td><a href="Controllers/pedido_controller.php?action=change&estado=autorizado&id_pedido=<?php echo $pedido->id_pedido; ?>" class="btn btn-success">Autorizar</a></td>
				<td><a href="Controllers/pedido_controller.php?action=change&estado=cancelado&id_pedido=<?php echo $pedido->id_pedido; ?>" class="btn btn-danger">Cancelar</a></td>
  		<?php }else{?>
				<td> &nbsp; </td>
				<td> &nbsp; </td>
   	   <?php  } ?>
				<!-- <td><?php// echo $pedido->autoriza;?></td> -->
				<td><?php echo $pedido->costo_total;?></td>
				<td><?php echo $pedido->solicita;?></td>
				<td><?php echo $pedido->estado;?></td>
				<!-- <td><?php// echo $pedido->observaciones;?></td> -->
				<!-- <td><?php //echo $pedido->unidad_medida;?></td> -->
				<!-- <td><?php //echo $pedido->total_prod;?></td> -->
				<!-- <td><a href="Controllers/pedido_controller.php?action=update&id_pedido=<?php //echo $pedido->id_pedido ?>">Actualizar</a> </td> -->
				<!-- <td><a href="Controllers/pedido_controller.php?action=delete&id_pedido=<?php //echo $pedido->id_pedido ?>">Eliminar</a> </td> -->
				<td><?php echo $pedido->fecha_pedido; ?></td>
				<td><?php echo $pedido->hora;?></td>
			</tr>
  <?php } ?>
		</tbody>
	</table>
</div>
</div>
</section>
<?php require_once("Views/partials/footer.php");?>

<?php
	}else{
		//Inclur una pagina para redireccionar a index
		header('Location: ../Views/sesion/no_sesion.php');
	}
}
?>
