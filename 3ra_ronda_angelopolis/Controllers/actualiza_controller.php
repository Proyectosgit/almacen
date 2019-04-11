<?php
    class ActualizaController{

        public function __construct(){}

        public function get_info_archivo(){
            $ruta_and_csv_ocompra = "C:\PUE\\3ajuarez\OCOMPRA.CSV";
            require_once("Config/config.php");
            require_once("Models/actualiza.php");
            $ObjActualiza = Actualiza::get_info_archivo($ruta_and_csv_ocompra);

            $existe = Actualiza::check_actualizacion($ObjActualiza->nombre_archivo, $ObjActualiza->hora, $ObjActualiza->fecha, $ObjActualiza->peso);
            if($existe == true){
                // echo "Ya existe la actualizacion";
                return false;
            }else{
                $inserta = Actualiza::save($ObjActualiza);
                return true;
            }
        }

    }

    require_once("../Config/config.php");
    require_once("../Models/actualiza.php");
    Actualiza::actualiza_estado("Listo");
?>
