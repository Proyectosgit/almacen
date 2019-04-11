<?php
    class ActualizaController{

        public function __construct(){}

        public function get_info_archivo(){
<<<<<<< HEAD
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
=======
            $ruta = "C:\PUE\\3ajuarez";
            $nombre_archivo = "OCOMPRA1.CSV";
            require_once("Config/config.php");
            require_once("Models/actualiza.php");
            $ObjActualiza = Actualiza::get_info_archivo($ruta,$nombre_archivo);
            if(isset($ObjActualiza)){
                Actualiza::save($ObjActualiza);
                // print_r($ObjActualiza);
                // print_r($ObjActualiza->nombre_archivo);
                $ObjActualiza = Actualiza::check_actualizacion($ObjActualiza->nombre_archivo, $ObjActualiza->hora, $ObjActualiza->fecha, $ObjActualiza->peso);
                print_r($ObjActualiza);
            }else{
                echo "No esta definida";

>>>>>>> aa82b852dbe79133f4fb94711a611074196cdea2
            }
        }

    }

    require_once("../Config/config.php");
    require_once("../Models/actualiza.php");
    Actualiza::actualiza_estado("Listo");
?>
