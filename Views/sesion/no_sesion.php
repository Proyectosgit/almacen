<?php
    session_start();
    unset($_SESSION["id_sesion"]);
    unset($_SESSION["nombre"]);
    session_destroy();
    if(!isset($_SESSION['id_sesion'])){
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>No Sesión</title>
        <meta name="description" content="DESCRIPTION">
        <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'/>
        <link rel="stylesheet" href="../../Public/css/style.css">
    </head>
    <body>
        <?php require_once("../partials/header.php");?>
        <section>
          <h1 id="texto_sesion">No has iniciado sesión.<br>Inicia sesión <br>e inténtalo de nuevo</h1>
          <a href="formulario.php">Iniciar Sesión</a>
        </section>
    </body>
</html>
<?php
    }
?>
