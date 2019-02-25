 <!DOCTYPE html>
 <html lang="en">
<head>
     <meta charset="UTF-8">
     <title>Inicio de Sesión</title>
     <meta name="description" content="DESCRIPTION">
     <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'/>
     <link rel="stylesheet" href="Public/bootstrap/bootstrap_3.3.6/css/bootstrap.min.css"/>
     <link rel="stylesheet" href="../../Public/css/style.css">
 </head>
 <body>
   <?php require_once("../partials/header.php");?>
   <section>
    <h1>Inicio de Sesión</h1>

    <div class="container">
     <form method="post" action="../../Controllers/usuario_controller.php">
       <div class="form-group">
         <input type="hidden" name="action" value="login">
         <input type="text" name="usuario" placeholder="Ingresa tu E-mail"><br>
         <input type="password" name="password" placeholder="Ingresa tu contraseña">
         <input type="submit" name="login">
      </div>
     </form>
   </div>
  </section>
   <?php require_once("../partials/footer.php");?>
 </body>
 <script src="Public/bootstrap/bootstrap_3.3.6/js/bootstrap.min.js"></script>
 </html>
