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
								<th>Id</th>
								<th>Nombre de usuario</th>
								<!-- <th>Contraseña</th> -->
								<th>Cargo</th>
								<th>Nombre</th>
								<th>E-mail</th>
								<th colspan=2 >Acciones</th>
							</tr>
						</thead>
						<tbody>
						<?php
						foreach ($usuarios as $usuario) { ?>

								<tr>
									<td><?php echo $usuario->id_user; ?></td>
									<td><?php echo $usuario->username; ?></td>
									<!-- <td><?php //echo $usuario->password;?></td> -->
									<td><?php echo $usuario->cargo;?></td>
									<td><?php echo $usuario->nombre;?></td>
									<td><?php echo $usuario->email;?></td>
									<td><a href="Controllers/usuario_controller.php?action=update&id=<?php echo $usuario->id_user ?>">Actualizar</a> </td>
									<td><a href="Controllers/usuario_controller.php?action=delete&id=<?php echo $usuario->id_user ?>">Eliminar</a> </td>
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
