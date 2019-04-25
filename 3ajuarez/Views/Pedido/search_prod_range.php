<?php
     if(isset($_SESSION["id_sesion"])){
         if((   $_SESSION["id_sesion"]=="gerente"   || $_SESSION["id_sesion"]=="administrador" ||
                $_SESSION["id_sesion"]=="barra"     || $_SESSION["id_sesion"]=="cocina")       &&   $_SESSION["ruta"]==SUCURSAL){
?>

<section>
    <h1 align="center">Buscar pedidos</h1>
    <div class="container">
        <div class="row">
        <div class="mx-auto">
            <form action="Controllers/pedido_controller.php" method="get">
                <input type="hidden" name="action" value="ver_pedidos_rango_estatus"/>
                <table class="table">
                    <tr>
                        <td colspan="2" align="center">
                            <label>Estado</label>
                            <select name="status">
                                <option value="autorizado">Autorizado</option>
                                <option value="pedido">Pedido</option>
                                <option value="cancelado">Cancelado</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Fecha Inicio</label>
                        </td>
                        <td>
                            <input type="date" name="fecha_inicio" value="<?php echo date("Y-m-d");?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Fecha Fin</label>
                        </td>
                        <td>
                            <input type ="date" name="fecha_fin" value="<?php echo date("Y-m-d");?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                            <input class="btn btn-info" type="submit" value="Buscar pedido"/>
                        </td>
                    </tr>
                </table>
            </form>
        <div>
        <div>
    <div>
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
            //Pagina que redirecciona al index
            header('Location: ../Views/sesion/no_sesion.php');
        }
    }
 ?>
