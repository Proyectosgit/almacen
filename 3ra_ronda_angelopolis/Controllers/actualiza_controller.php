<?php
    class ActualizaController{

        public function __construct(){}

        public function get_info_archivo(){
            $ruta = "C:\PUE\\3ajuarez";
            $nombre_archivo = "OCOMPRA.CSV";
            require_once("Config/config.php");
            require_once("Models/actualiza.php");
            $ObjActualiza = Actualiza::get_info_archivo($ruta,$nombre_archivo);
            Actualiza::save($ObjActualiza);
            // print_r($ObjActualiza);
            // print_r($ObjActualiza->nombre_archivo);
            $ObjActualiza = Actualiza::check_actualizacion($ObjActualiza->nombre_archivo, $ObjActualiza->hora, $ObjActualiza->fecha, $ObjActualiza->peso);
            print_r($ObjActualiza);

        }

    }
?>
