<?php
    class ActualizaController{

        public function __construct(){}

        public function get_info_archivo(){
            $ruta = "C:\PUE\\3ajuarez";
            $nombre_archivo="OCOMPRA.CSV";
            require_once("Config/config.php");
            require_once("Models/actualiza.php");
            Actualiza::get_info_archivo($ruta,$nombre_archivo);
        }

    }
?>
