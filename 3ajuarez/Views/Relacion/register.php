<?php

	if(isset($_SESSION["id_sesion"])){
		if($_SESSION["id_sesion"]=="administrador"&& $_SESSION["ruta"]==SUCURSAL){
?>

 <section>
    <h3 align="center">Registro de Relación Pedido - Producto:</h3>
    <div class="container">
        <form action='Controllers/relacion_controller.php' method='post' id="register_form">
            <input type='hidden' name='action' value='register'>
            <div class="form-group">
                <label >Id Pedido:</label>
                <input class="form-control" type="text" type='number' name='id_pedido' maxlength="10" placeholder="Id pedido">
            </div>
            <div class="form-group">
                <label >Codigo de Ingrediente:</label>
                <input class="form-control" type='text' name='codingre' maxlength="7" placeholder="Id Producto">
            </div>
            <div class="form-group">
                <label >Fecha Pedido:</label>
                <input class="form-control" type='date' name='fecha_pedido' placeholder="Fecha Pedido">
            </div>
            <div class="form-group">
                <label >Hora del Pedido:</label>
                <input class="form-control" type='time' name='hora_pedido' placeholder="Hora Pedido">
            </div>
            <div class="form-group">
                <label >Número de Productos:</label>
                <input class="form-control" type='number' step='0.0001' name='num_prod' maxlength='10' placeholder="No. Productos">
            </div>
            <div class="form-group">
                <label >Estado del Pedido:</label>
                <input class="form-control" type='text' name='estado_prod' maxlength="20" placeholder="Estado del producto">
            </div>
						<div class="form-group">
								<label >Observaciones:</label>
								<input class="form-control" type='text' name='observacion' maxlength="150" placeholder="Estado del producto">
						</div>
                <button class="btn-primary">Enviar</button>
        </form>
  </div>

  <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script> -->
</section>

<?php
		}else{
			//Inclur una pagina para redireccionar a index
			header('Location: ../Views/sesion/no_sesion.php');
		}
	}
	?>
