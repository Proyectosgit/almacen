<html>
	<head>
		<title>Show_order_prod </title>
		<meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'/>
  		<!-- <link rel="stylesheet" href="Views/bootstrap/css/bootstrap.min.css"/> -->
  		<link rel="stylesheet" href="Public/assets/bootstrap-4.2.1/css/bootstrap.min.css"/>
  		<!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
  		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	</head>

	<body>
		<header>
			<div class="container"><h1>Pedidos por fecha</h1></div>
		</header>
		<section>
						<div class="container small">
							<div class="table-responsive">
								<table class="table">
									<thead class="thead-dark">
										<tr>
											<td>Id Pedido</td>
											<td>Fecha</td>
											<td>Hora</td>
											<td>Autoriza</td>
											<td>Solicita</td>
											<td>Estado</td>
											<td>Observaciones</td>
											<td>Unidad Medida</td>
											<td>Costo Total</td>
											<!-- <td colspan=2 >Acciones</td> -->
										</tr>
									</thead>
									<tbody>
										<?php
										foreach ($select as $order) {
											// if($order->estado=="autorizado" || $order->estado=="cancelado"){?>
												<tr>
													<td><?php echo $order->id_pedido; ?></td>
													<td><?php echo $order->fecha; ?></td>
													<td><?php echo $order->hora; ?></td>
													<td><?php echo $order->autoriza; ?></td>
													<td><?php echo $order->solicita; ?></td>
													<td><?php echo $order->estado; ?></td>
													<td><?php echo $order->observaciones; ?></td>
													<td><?php echo $order->unidad_medida; ?></td>
													<td><?php echo $order->costo_total; ?></td>
													<td><a href="pedido_controller.php?action=order_almacen&id_pedido=<?php echo $order->id_pedido ?>">Detalles</a> </td>
													<!-- <td><a href="Controllers/pedido_controller.php?action=update&id_pedido=<?php// echo $pedido->id_pedido ?>">Actualizar</a> </td> -->
													<!-- <td><a href="Controllers/pedido_controller.php?action=delete&id_pedido=<?php// echo $pedido->id_pedido ?>">Eliminar</a> </td> -->
												</tr>
											<?php //}//end if
										}//end switch ?>
									</tbody>
								</table>
							</div>
						</div>
		</section>
	</body>
<html>
