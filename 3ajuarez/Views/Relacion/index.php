<?php

	if(isset($_SESSION["id_sesion"])){
		if($_SESSION["id_sesion"]=="administrador"&& $_SESSION["ruta"]==SUCURSAL){
?>

	<section>
		<div class="container">
			<div class="table-responsive">
				<table class="table" >
					<thead class="thead-dark">
							<tr>
								<th>Id Pedido</th>
								<th>Codigo Ingrediente</th>
								<th>Fecha Pedido</th>
								<th>Hora pedido</th>
								<th>Numero de productos</th>
								<th>Estado de producto</th>
								<th colspan=2 >Acciones</th>
							</tr>
					</thead>
					<tbody>
						<?php
							foreach ($relaciones as $relacion) { ?>

									<tr>
										<td><?php echo $relacion->id_pedido; ?></td>
										<td><?php echo $relacion->codingre; ?></td>
										<td><?php echo $relacion->fecha_pedido;?></td>
										<td><?php echo $relacion->hora_pedido;?></td>
										<td><?php echo $relacion->num_prod;?></td>
										<td><?php echo $relacion->estado_prod;?></td>
										<td><a href="Controllers/relacion_controller.php?action=update&id=<?php echo $relacion->id_pedido ?>">Actualizar</a> </td>
										<td><a href="Controllers/relacion_controller.php?action=delete&id=<?php echo $relacion->id_pedido ?>">Eliminar</a> </td>
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
			header('Location: ../Views/sesion/no_sesion.php');
		}
	}
	?>
