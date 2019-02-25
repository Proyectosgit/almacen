  	<head>
		<title>Bienvenido MVC </title>
		<meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'/>
	    <!-- <link rel="stylesheet" href="Views/bootstrap/css/bootstrap.min.css"/> -->
	    <link rel="stylesheet" href="Public/assets/bootstrap-4.2.1/css/bootstrap.min.css"/>
		<!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<script src="../librerias/js/verifica_cambio_relacion.js"></script>
		<script>
			function foor(){
				alert("Guardando Modificaciones");
				return true;
			}
		</script>
	</head>

	<body>
		<header>
			<div class="container">
			<h1>Detalles del pedido</h1>
			</div>
		</header>
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
		                <td>Existencia</td>
                        <td>Stock <br> maximo</td>
                        <td>Costo unitario</td>
		                <td>Costo total</td>
                        <td>Costo productos</td>
		                <td>Numero <br> productos pedido</td>
		                <!-- <td colspan=2 >Acciones</td> -->
	                </tr>
                </thead>
                <tbody>
                    <?php
	                $costo_total=0;
                    $total_prod=0;
	                foreach ($select->fetchAll() as $order) {
                        $costo_producto=$order['ultcosto']*$order['num_prod'];
                    ?>
			            <tr>
                        <!-- <td id="id_pedido"><?php echo $order['id_pedido']; ?></td> -->
				        <td><?php echo $order['id_pedido']; ?></td>
				        <td><?php echo $order['codingre']; ?></td>
				        <td><?php echo $order['fecha']; ?></td>
				        <td><?php echo $order['descrip'];?></td>
				        <td class="existencia"><?php echo $order['inventa1'];?></td>
				        <td class="stock_max"><?php echo $order['stockmax'];?></td>
                        <td class="precio_unitario"><?php echo $order["ultcosto"]?></td>
                        <td id="costototalmod"><?php echo $order["costo_total"]?></td>
                        <td class="costo_producto"><?php echo $costo_producto;?></td>
                    <?php $costo_total=$costo_total+$costo_producto;
                    $total_prod=$total_prod+1;
                    ?>
				    <?php if($_GET["estatus"]=="pedido"){ ?>
				        <td><input class="cantidad" type="number" name="<?php echo$order['codingre']?>" value="<?php echo $order['num_prod'];?>" required></td>
				        <!-- <td><a href="Controllers/pedido_controller.php?action=update&id_pedido=<?php// echo $pedido->id_pedido ?>">Actualizar</a> </td> -->
				        <!-- <td><a href="Controllers/pedido_controller.php?action=update&id_pedido=<?php// echo $pedido->id_pedido ?>">Actualizar</a> </td> -->
				        <!-- <td><a href="Controllers/pedido_controller.php?action=delete&id_pedido=<?php// echo $pedido->id_pedido ?>">Eliminar</a> </td> -->
			        <?php }else{?>
				        <td><?php echo $order["num_prod"]?></td>
				    <?php } ?>
			             </tr>
	          <?php } ?>
                </tbody>
	        </table>
	     </div>
     </div>

        <?php   if($_GET["estatus"]=="pedido"){ ?>
        			<form action="../Controllers/relacion_controller.php" method="post" id="pedido_form">
        				<input type="hidden" name="action" value="updateRelation">
        				<input type="hidden" name="id_pedido" value="<?php echo $order['id_pedido'];?>" >
        				<input type="hidden" name="costo_total" value="<?php echo $costo_total;?>" id="costo_total_mod">
        				<!-- <input type="hidden" name="total_prod" value="<?php //echo $total_prod;?>"> -->
        				<input type="hidden" name="modificados" value="" id="array_modifica">
        				<center><input type="submit" value="Guardar" class="btn btn-success" ></center>
        			</form>
        <?php   }?>
      </section>
</body>
