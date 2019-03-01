<?php
	session_start();
	if(isset($_SESSION["id_sesion"])){
		if($_SESSION["id_sesion"]=="administrador" || $_SESSION["id_sesion"]=="gerente"){
?>
  	<head>
		<title>Productos del pedido</title>
		<meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'/>
		<!-- <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"> -->
		<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script> -->
		<!-- <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> -->
		<link rel="stylesheet" href="../Public/bootstrap/css/bootstrap.min.css"/>
		<link rel="stylesheet" href="../Public/bootstrap/bootstrap_3.3.6/bootstrap.min.css">
		<link href="Public/open-iconic-master/font/css/open-iconic.css" rel="stylesheet">


		<script src="../Public/librerias/verifica_cambio_relacion.js"></script>
		<script>
			function foor(){
				alert("Guardando Modificaciones");
				return true;
			}
		</script>
	</head>

	<body>
		<header>
			<div align="center">
				<h1>Detalles del pedido</h1>
			</div>
		</header>
    <section>
	  <div class="container">
			<div class="table-responsive">
				<table class="table">
							 <thead class="thead-dark">
	                <tr>
		                <th>Id Pedido</th>
										<th>Productos <br> pedido</th>
										<th>Descripción</th>
										<th>Costo <br>unitario</th>
										<th>Costo <br>productos</th>
		                <th>Id Producto</th>
		                <!-- <th>Fecha</th> -->
		                <th>Existencia</th>
                    <th>Stock <br> máximo</th>
		                <!-- <th>Costo total</th> -->
		                <!-- <th colspan=2 >Acciones</th> -->
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
                <!-- <td id="id_pedido"><?php //echo $order['id_pedido']; ?></td> -->
				        <td><?php echo $order['id_pedido']; ?></td>
								<td bgcolor=#3ADF00><?php echo $order["num_prod"];?></td>
								<td><?php echo $order['descrip'];?></td>
								<td class="precio_unitario"><?php echo $order["ultcosto"];?></td>
								<!-- <td id="costototalmod"><?php //echo $order["costo_total"];?></td> -->
								<td class="costo_producto"><?php echo $costo_producto;?></td>
								<?php $costo_total=$costo_total+$costo_producto;
								$total_prod=$total_prod+1;
								?>
				        <td><?php echo $order['codingre']; ?></td>
				        <!-- <td><?php //echo $order['fecha']; ?></td> -->
				        <td class="existencia"><?php echo $order['inventa1'];?></td>
				        <td class="stock_max"><?php  echo $order['stockmax'];?></td>
				        <?php //if($_GET["estatus"]=="pedido"){ ?>
									<!-- <td bgcolor="#b8ff54"><?php //echo $order['num_prod'];?></td> -->
				        <!-- <td><input class="cantidad" type="number" name="<?php //echo$order['codingre']?>" value="<?php //echo $order['num_prod'];?>" required></td> modifica cantidad-->
				        <!-- <td><a href="Controllers/pedido_controller.php?action=update&id_pedido=<?php// echo $pedido->id_pedido ?>">Actualizar</a> </td> -->
				        <!-- <td><a href="Controllers/pedido_controller.php?action=update&id_pedido=<?php// echo $pedido->id_pedido ?>">Actualizar</a> </td> -->
				        <!-- <td><a href="Controllers/pedido_controller.php?action=delete&id_pedido=<?php// echo $pedido->id_pedido ?>">Eliminar</a> </td> -->
			        <?php //}else{?>
				    <?php //} ?>
			             </tr>
	          <?php }//End foreach ?>
                </tbody>
	        </table>
	     </div>
     </div>
	    <!-- <?php   //if($_GET["estatus"]=="pedido"){ ?>
        			<form action="../Controllers/relacion_controller.php" method="post" id="pedido_form">
        				<input type="hidden" name="action" value="updateRelation">
        				<input type="hidden" name="id_pedido" value="<?php //cho $order['id_pedido'];?>" >
        				<input type="hidden" name="costo_total" value="<?php //echo $costo_total;?>" id="costo_total_mod">
        				<!- <input type="hidden" name="total_prod" value="<?php //echo $total_prod;?>"> -->
        				<!-- <input type="hidden" name="modificados" value="" id="array_modifica"> -->
        				<!-- <center><input type="submit" value="Guardar" class="btn btn-success" ></center> -->
        			<!-- </form> -->
        <?php   //}?>
      </section>

			<div align="center">
				<h2 id="costototalmod">Costo Total: <?php echo $costo_total;?> </h2>
				<h4 id="costototalmod">Fecha del pedido: <?php echo $order['fecha'];?> </h4>
				 <a href="../?controller=pedido&action=ver_pedidos" class="btn btn-primary">Regresar</a><br>
			<div>
</body>
<?php
		}else{
			//Inclur una pagina para redireccionar a index
			header('Location: ../Views/sesion/no_sesion.php');
		}
	}
	?>
