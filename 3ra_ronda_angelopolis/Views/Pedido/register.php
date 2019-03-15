<?php

	if(isset($_SESSION["id_sesion"])){
		if($_SESSION["id_sesion"]=="administrador" && $_SESSION["ruta"]==SUCURSAL){
?>

 <!DOCTYPE html>
 <html lang="en">
    <head>
    </head>
 <body>
   <section>
        <h3 align="center">Registro de Pedidos:</h3>
        <div class="container">
            <form action='Controllers/pedido_controller.php' method='post' id="register_form">
                <input type='hidden' name='action' value='register'>
                <div class="form-group">
                    <label for="nombre">Fecha:</label>
                    <input class="form-control" type="date" name="fecha" placeholder="Fecha" maxlength="150">
                  </div>
                  <div class="form-group">
                    <label for="nombre">Hora:</label>
                    <input class="form-control" type='time' name='hora' placeholder="Hora" maxlength="20">
                  </div>
                  <div class="form-group">
                    <label for="nombre">Autoriza:</label>
                    <input class="form-control" type='text' name='autoriza' maxlength='30' placeholder="Autoriza" maxlength="10">
                  </div>
                  <div class="form-group">
                    <label for="nombre">Solicita:</label>
                    <input class="form-control" type='text' name='solicita' maxlength='30' placeholder="Solicita" step='0.0001' maxlength="10">
                  </div>
                  <div class="form-group">
                    <label for="nombre">Estado:</label>
                    <input class="form-control" type='text' name='estado' maxlength='20' placeholder="Estado">
                  </div>
                  <div class="form-group">
                    <label for="nombre"> Observaciones:</label>
                    <input class="form-control" type='text' name='observaciones' maxlength='150' placeholder="Observaciones">
                  </div>
                  <div class="form-group">
                    <label for="nombre">Unidad de Medida:</label>
                    <input class="form-control" type='text' name='unidad_medida' maxlength='10' placeholder="Unidad de Medida">
                  </div>
                  <div class="form-group">
                    <label for="nombre">Total de Productos:</label>
                    <input class="form-control" type='text' name='total_prod' maxlength='10' placeholder="Total de Productos">
                  </div>
                  <div class="form-group">
                    <label for="nombre">Costo Total:</label>
                    <input class="form-control" type='number' step='0.0001' name='costo_total' maxlength='10' placeholder="Costo Total">
                  </div>
                  <button class="btn-primary">Enviar</button>
                </form>
              </div>
      </section>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
 </body>

 </html>
 <?php
 		}else{
 			//Inclur una pagina para redireccionar a index
 			header('Location: ../Views/sesion/no_sesion.php');
 		}
 	}
 ?>
