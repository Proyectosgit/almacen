<html>
	<head>
	</head>
	<body>
	<section>
		<div class="container">
			<div class="table-responsive">		
				<table class="table">
					<thead class="thead-dark">
						<tr>
							<th>Id Pedido</th>
							<th>Id Producto</th>
							<th>Descripcion</th>
							<th>Fecha</th>
							<th>Hora</th>
							<th>Cantidad Recibida</th>
							<th>Cantidad Pedida</th>
							<th>Estatus</th>
						</tr>
					</thead>
					<tbody>	
						<?php
						foreach ($select as $pedido) { ?>

								<tr>
									<td><?php echo $pedido->id_pedido; ?></td>
									<!-- <td><?php //echo $pedido->id_prod; ?></td> -->
									<!-- <td><?php //echo $pedido->descripcion; ?></td> -->
									<td><?php echo $pedido->fecha;?></td>
									<td><?php echo $pedido->hora;?></td> 
									<!-- <td><?php //echo $pedido->num_prod;?></td> -->
									<!-- <td><?php //echo $pedido->estado_prod;?></td> --> 
									<!-- <td><?php //echo $pedido->CantidadRecibida;?></td> -->
								</tr>
						<?php } ?>
					</tbody>	
				</table>
				</div>
			</div>	
		</section>
	</body>
</html>