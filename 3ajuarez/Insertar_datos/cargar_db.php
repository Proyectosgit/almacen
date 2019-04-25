<?php

$tiempo_inicial = microtime(true);

echo "******Importante no cierres la ventana esta se cerrara de forma automatica******";

$unidad_ruta = "3ajuarez";

set_time_limit(500);
require_once("../" . $unidad_ruta . "/Config/connection.php");
// require_once("../Config/connection.php");
require_once("../" . $unidad_ruta . "/Models/actualiza.php");
// require_once("../Models/actualiza.php");
require_once("../" . $unidad_ruta . "/Models/producto.php");
// require_once("../Models/producto.php");

echo "Espera un momento por favor... se estan ingresado los datos";

$estado="Actualizando";

Actualiza::actualiza_estado($estado);

$linea = 0;
$familias=[];
//Abrimos nuestro archivo
// $archivo = fopen(dirname(__FILE__)."\OCOMPRA.csv", "r");
// $archivo = fopen("C:\PUE\\3ajuarez"."\OCOMPRA.csv", "r");

$tiempo_final = microtime(true);
echo ("Tiempo final antes del while " . ($tiempo_final-$tiempo_inicial) . "<br>");

$archivo = fopen(PATH_CARGA_CSV_OCOMPRA, "r");
//Lo recorremos
  while (($datos = fgetcsv($archivo, ",")) == true)
  {

      $tiempo_final = microtime(true);
      echo ("Tiempo final en el while " . ($tiempo_final-$tiempo_inicial) . "<br>");

    $num = count($datos);
    echo "Linea" . $linea++;
    //Recorremos las columnas de esa linea
    if($linea==1){

     // echo "salto encabezado";
      continue;}

      // for ($columna = 0; $columna < $num; $columna++){
          // echo ($datos[$columna]);
          // $datos[$columna];
        // }
        // echo $datos[0];
        $existencia=Producto::verifica_existencia($datos[0]);
        // echo "Existencia".$existencia;
        if($existencia==0){
        // echo "Entro al for para guarda";
          $producto = new Producto($datos[0],$datos[1],$datos[2],
                            $datos[3],$datos[4],$datos[5],
                            $datos[6],$datos[7],$datos[8],
                            $datos[9],$datos[10],$datos[11],
                            $datos[12],$datos[13],$datos[14],NULL,NULL);
                            Producto::save($producto);
    }else{
      // echo("(" . "ya existe se actualizara" . $datos[0] . ")" . $linea);
      // Productos::update_existence($datos[0],$datos[6]);//Solo actualiza inventario
    Producto::update_existencia($datos[0],$datos[1],$datos[2],
                      $datos[3],$datos[4],$datos[5],
                      $datos[6],$datos[7],$datos[8],
                      $datos[9],$datos[10],$datos[11],
                      $datos[12],$datos[13],$datos[14]);
       //$linea--;
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
