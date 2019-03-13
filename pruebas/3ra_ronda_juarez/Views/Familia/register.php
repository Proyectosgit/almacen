<?php
	if(isset($_SESSION["id_sesion"])){
		if($_SESSION["id_sesion"]=="administrador"){
?>

<section>
   <h3 align="center">Registro de Familias:</h3>
   <div class="container">
       <form action='Controllers/familia_controller.php' method='post' id="register_form">
           <input type='hidden' name='action' value='register'>
           <div class="form-group">
               <label for="nombre">Código de Familia:</label>
               <input class="form-control" type="text" name='cod_familia' maxlength="20" placeholder="Código de Familia">
           </div>
           <div class="form-group">
               <label for="nombre">Descripción:</label>
               <input class="form-control" type="text" name='descripcion' maxlength="50" placeholder="Descripción">
            </div>
			<button class="btn btn-primary">Enviar</button>
        </form>
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
			header('Location: Views/sesion/no_sesion.php');
		}
	}
	?>
