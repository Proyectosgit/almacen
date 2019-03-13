<?php
	session_start();
	if(isset($_SESSION["id_sesion"])){
		if($_SESSION["id_sesion"]=="administrador"){
?>

	<body>
		<head>
			<div class="container">
			<h1>Detalles del pedido</h1>
			</div>
		</head>
		<section>
				<div class="container small">
					<div class="table-responsive">
						<table class="table">
							<thead class="thead-dark">
								<tr>
									<td>Id Pedido</td>
									<td>Id Producto</td>
									<td>Fecha</td>
									<td>Descripcion</td>
									<td>Numero <br> productos</td>
									<td>Numero productos<br> recibidos</td>
								</tr>
							</thead>
							<tbody>
								<?php
								foreach ($select->fetchAll() as $order) { ?>
									<tr>
										<td><?php echo $order['id_pedido']; ?></td>
										<td><?php echo $order['codingre']; ?></td>
										<td><?php echo $order['fecha']; ?></td>
										<td><?php echo $order['descrip'];?></td>
										<td><?php echo $order['num_prod'];?></td>
										<td><input type="text" name="<?php echo $order['codingre'];?>" value="<?php echo $order['num_prod']; ?>"</td>
										<!-- <td><a href="Controllers/pedido_controller.php?action=update&id_pedido=<?php// echo $pedido->id_pedido ?>">Actualizar</a> </td> -->
										<!-- <td><a href="Controllers/pedido_controller.php?action=delete&id_pedido=<?php// echo $pedido->id_pedido ?>">Eliminar</a> </td> -->
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</section>
</body


<?php
	}else{
		//Inclur una pagina para redireccionar a index
		header('Location: Views/sesion/no_sesion.php');
	}
}
?>
