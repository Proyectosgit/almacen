<html>
	<head>
		<title>Bienvenido MVC </title>
		<meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'/>
		<!-- <link rel="stylesheet" href="Views/bootstrap/css/bootstrap.min.css"/> -->
		<link rel="stylesheet" href="Public/assets/bootstrap-4.2.1/css/bootstrap.min.css"/>
		<!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<script src="../librerias/js/verifica_cambio_almacen.js"></script>
	</head>

	<body>
		<head>
			<div class="container"><h1>Detalles del pedido almacen</h1>	</div>
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
				<!-- <td>Recibidos</td> -->
				<!-- <td colspan=2 >Acciones</td> -->
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
					<td class="pedidos"><?php echo $order['num_prod'];?></td>
					<!-- <td><input type="text" value="<?php //echo $order['num_prod'];?>" class="cantidad" name="<?php //echo $order['codingre'];?>"></td> -->
					<!-- <td><a href="Controllers/pedido_controller.php?action=update&id_pedido=<?php// echo $pedido->id_pedido ?>">Actualizar</a> </td> -->
					<!-- <td><a href="Controllers/pedido_controller.php?action=delete&id_pedido=<?php// echo $pedido->id_pedido ?>">Eliminar</a> </td> -->
				</tr>
		 <?php } ?>
		</tbody>
		</table>
	<!-- <form action="Controllers/producto_controller.php" method="post" id="pedido_form"> -->
		<!-- <input type="hidden" name="action" value="registra_pedido"> -->
		<!-- <input type="hidden" name="familia" value="<?php //echo $producto->familia;?>" > -->
		<!-- <input type="hidden" name="costo_total" value="<?php //echo $costo_total;?>" id="costo_total_mod"> -->
		<!-- <input type="hidden" name="total_prod" value="<?php //echo $total_prod;?>"> -->
		<!-- <input type="hidden" name="modificados" value="" id="array_modifica"> -->
		<!-- <input type="hidden" name="todos" value="" id="array_todos"> -->
		<!-- <input type="submit" value="Pedido"> -->
	<!-- </form> -->
		</div>
	</div>
</section>
</body>
</html>
