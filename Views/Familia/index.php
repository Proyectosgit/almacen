<?php
	if(isset($_SESSION["id_sesion"])){
		if($_SESSION["id_sesion"]=="administrador"){
?>

<section>
	<div class="container">
	<div class="table-responsive">
		<table class="table" >
		<thead class="thead-dark">
			<tr>
				<th>Codigo de Familia</th>
				<th>Descripcion</th>
				<!-- <th colspan=2 >Acciones</th> -->
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ($familias as $familia) { ?>
			<tr>
				<td><?php echo $familia->cod_familia; ?></td>
				<td><?php echo $familia->descripcion; ?></td>
				<!-- <td><a href="Controllers/familia_controller.php?action=update&cod_familia=<?php //echo $familia->cod_familia ?>">Actualizar</a> </td> -->
				<!-- <td><a href="Controllers/familia_controller.php?action=delete&cod_familia=<?php //echo $familia->cod_familia ?>">Eliminar</a> </td> -->
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
