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
               <button class="btn-primary">Enviar</button>
            </div>
        </form>
    </div>
</section>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>

<?php
		}else{
			//Inclur una pagina para redireccionar a index
			header('Location: Views/sesion/no_sesion.php');
		}
	}
	?>
