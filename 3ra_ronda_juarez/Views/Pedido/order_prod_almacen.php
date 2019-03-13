<?php
	session_start();
	if(isset($_SESSION["id_sesion"])){
		if($_SESSION["id_sesion"]=="administrador" || $_SESSION["id_sesion"]=="gerente" || $_SESSION["id_sesion"]=="cocina" || $_SESSION["id_sesion"]=="barra"){
?>
<html>
	<head>
		<title>Detalles del pedido </title>

		<meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'/>
		<link rel="stylesheet" href="../Public/bootstrap/css/bootstrap.min.css"/>
		<link rel="stylesheet" href="../Public/bootstrap/bootstrap_3.3.6/bootstrap.min.css">
		<!-- <link rel="stylesheet" href="Public/css/logos.css"/> -->
		<link href="Public/open-iconic-master/font/css/open-iconic.css" rel="stylesheet">

		<script src="../librerias/js/verifica_cambio_almacen.js"></script>
	</head>

	<body>
		<head>
			<div class="container"><h1>Detalles del pedido </h1></div>
		</head>
<section>
	<div class="container small">
		<div class="table-responsive">
		<table class="table">
		<thead class="thead-dark">
			<tr>
				<th>Id Pedido</th>
				<th>Id Producto</th>
				<th>Fecha del pedido</th>
				<th>Descripcion</th>
				<th>Numero <br> productos</th>
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
					<td><?php echo $order['fecha_pedido']; ?></td>
					<td><?php echo $order['descrip'];?></td>
					<td class="pedidos"><?php echo $order['num_prod'];?></td><!--Numero de productos de la relacion pedido_productos-->
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
	<div align="center">
		<!-- <a href="?controller=pedido&action=ver_pedido_autorizado" class="btn btn-primary">Regresar</a> -->
		<!-- <a href="<?php //echo $HTTP_REFERER; ?>">Volver atras</a>  -->
		<a href="javascript:window.history.back();" class="btn btn-primary">&laquo; Volver atrás</a>
	</div>
</section>
</body>
</html>
<?php
		}else{
			//
			header('Location: ../Views/sesion/no_sesion.php');
		}
	}
	?>
