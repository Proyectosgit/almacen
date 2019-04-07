<?php
     if(isset($_SESSION["id_sesion"])){
         if(($_SESSION["id_sesion"]=="gerente" || $_SESSION["id_sesion"]=="administrador" || $_SESSION["id_sesion"]=="barra" || $_SESSION["id_sesion"]=="cocina") && $_SESSION["ruta"]==SUCURSAL){
?>
<!DOCTYPE html>
<html>
<head></head>
<body>
<section>
    <h1 align="center">Buscar pedidos</h1>
    <div class="container">
        <div class="row">
        <div class="mx-auto">
            <form action="Controllers/pedido_controller.php" method="get">
                <input type="hidden" name="action" value="ver_pedidos_rango_estatus"/>
                <select name="status"/>
                    <option value="autorizado">Autorizado</option>
                    <option value="pedido">Pedido</option>
                    <option value="cancelado">Cancelado</option>
                </select>
                <label>Fecha Inicio</label>
                    <input type="date" name="fecha_inicio" value="<?php echo date("Y-m-d");?>"/>
                <label>Fecha Final</label>
                    <input type ="date" name="fecha_fin" value="<?php echo date("Y-m-d");?>"/>
                <input class="btn btn-info" type="submit" value="Buscar pedido"/>
            </form>
        <div>
        <div>
    <div>
</section>
</body>
</html>
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
            //Pagina que redirecciona al index
            header('Location: ../Views/sesion/no_sesion.php');
        }
    }
 ?>
