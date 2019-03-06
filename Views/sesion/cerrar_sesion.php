<?php
    session_start();
    unset($_SESSION["id_sesion"]);
    session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Sesión Cerrada</title>
        <meta name="description" content="DESCRIPTION">
        <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'/>
        <link rel="stylesheet" href="../../Public/css/style.css">
    </head>
    <body>
        <?php require_once("../partials/header.php");?>
        <h1 id="texto_sesion">Sesión Cerrada <br> Correctamente</h1>
        <a href="formulario.php">Iniciar Sesión</a>
    </body>
</html>
