<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8"/>
</head>
<?php

set_time_limit(500);
require_once("connection.php");
require_once("productos.php");
require_once("../3ra_ronda_angelopolis/Models/actualiza.php");

echo "Espera un momento por favor... se estan ingresado los datos <br>";

$estado="Actualizando";
Actualiza::actualiza_estado($estado);

$linea = 0;
$familias=[];
//Abrimos nuestro archivo
// $archivo = fopen(dirname(__FILE__)."\OCOMPRA.csv", "r");
$archivo = fopen("C:\PUE\\3ajuarez"."\OCOMPRA.csv", "r");
//Lo recorremos
  while (($datos = fgetcsv($archivo, ",")) == true)
  {
    $num = count($datos);
    $linea++;
    //Recorremos las columnas de esa linea
    if($linea==1){

     // echo "salto encabezado";
      continue;}

      // for ($columna = 0; $columna < $num; $columna++){
          // echo ($datos[$columna]);
          // $datos[$columna];
        // }
        // echo $datos[0];
        $existencia=Productos::verifica_existencia($datos[0]);
        // echo "Existencia".$existencia;
        if($existencia==0){
        // echo "Entro al for para guarda";
          $producto = new Productos($datos[0],$datos[1],$datos[2],
                            $datos[3],$datos[4],$datos[5],
                            $datos[6],$datos[7],$datos[8],
                            $datos[9],$datos[10],$datos[11],
                            $datos[12],$datos[12],NULL,NULL);

                            Productos::save($producto);
    }else{
      // echo("(" . "ya existe se actualizara" . $datos[0] . ")" . $linea);
      // Productos::update_existence($datos[0],$datos[6]);//Solo actualiza inventario
    Productos::update_existencia($datos[0],$datos[6],$datos[9],$datos[7],$datos[12],$datos[13]);
       $linea--;
    }
    // if(!in_array($datos[2],$familias)){
      // $familias[]=$datos[2];
    // }
    // echo ("<br>");
  }
// echo "<script>alert(".($linea-1).");</script>";

// print_r($familias);
//Cerramos el archivo
fclose($archivo);

$estado = "Listo";
Actualiza::actualiza_estado($estado);

echo "Exito se han ingresado los datos";

?>
</html>
