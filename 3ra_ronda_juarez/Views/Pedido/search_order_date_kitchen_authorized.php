<?php

	if(isset($_SESSION["id_sesion"])){
		if($_SESSION["id_sesion"]=="administrador" || $_SESSION["id_sesion"]=="gerente" || $_SESSION["id_sesion"]=="cocina" || $_SESSION["id_sesion"]=="barra"){
?>
<section>
    <div class="container">
        <div class="row">
        <div class="mx-auto">
            <form action="Controllers/pedido_controller.php" method="get">
              <center>
                <label>Buscar pedido(s) Autorizado(s) </span></label><br><br>
                <input id="date" type="date" name="date" value="<?php echo date("Y-m-d");?>">
                <input type="hidden" name="action" value="search_order_date_kitchen_authorized"><br><br>
                <label>Buscar por:</label><br>
                <label>Dia:</label> <input type="radio" name="tipo" value="dia" checked><br>
                <label>Mes:</label> <input type="radio" name="tipo" value="mes"><br><br>
                <button type="submit" class="btn btn-success">
								 Buscar Autorizados  <span class="oi" data-glyph="check"></span>
							 	</button>
                </center>
            </form>
        </div>
        </div>
    </div>
</section>
<section>
	<div class="container">
		<div class="row">
			<div class="mx-auto">
				<img class="logo_fondo" src="Public/imagenes/logo.jpg"/>
			</div>
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
