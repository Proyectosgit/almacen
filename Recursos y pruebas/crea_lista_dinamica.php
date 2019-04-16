<?php
    require_once("3ra_ronda_angelopolis/Config/config.php");
    require_once("3ra_ronda_angelopolis/Config/connection.php");
    require_once("3ra_ronda_angelopolis/Models/familia.php");
    $area="barra";
    $muestraambos="ambos";
    $listaFamilias = Familia::get_fam_tipo($muestraambos);

    // print_r($listaFamilias);
    echo "<select name='argumento'>";
        foreach($listaFamilias as $familia){
            echo "<option value='" . $familia->cod_familia . "'>" . $familia->descripcion . "</option>";
        }
    echo "</select>";
?>
