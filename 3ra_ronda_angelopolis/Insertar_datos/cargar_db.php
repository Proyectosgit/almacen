<?php

set_time_limit(500);
// require_once("../Config/config.php");
require_once("../Config/config.php");
require_once("../Config/connection.php");
// require_once("Config/connection.php");
require_once("../Models/producto.php");
require_once("productos.php");
require_once("../Models/actualiza.php");
// require_once("Models/actualiza.php");
$conexion = Db::getConnect();
$estado="Actualizando";
Actualiza::actualiza_estado($estado);

$linea = 0;
$familias = [];
//Abrimos nuestro archivo
// $archivo = fopen(dirname(__FILE__)."\OCOMPRA.csv", "r");
echo "Se estan cargando los datos por favor espere...";
$archivo = fopen(PATH_CARGA_CSV_OCOMPRA, "r");
//Lo recorremos
$i=0;
while (($datos = fgetcsv($archivo,',')) == true){
    $matrizDatos[$i] = $datos;
    $i++;
    // for($j=0;$j<=14;$j++){
    // echo $matrizDatos[0];
    // }
}

print_r($matrizDatos);

  // while (($datos = fgetcsv($archivo, ",")) == true)
  // {
    // $num = count($datos);
    // $linea++;
    //Recorremos las columnas de esa linea
    // if($linea==1){
     // echo "salto encabezado";
        // continue;
    // }

    // for ($columna = 0; $columna < $num; $columna++){
      // echo ($datos[$columna]);
        // $datos[$columna];
    // }
    // echo $datos[0];
    // $existencia = Producto::verifica_existencia($datos[0]);

    // if($existencia == 0){
    //   $producto = new Producto($datos[0],$datos[1],$datos[2],
    //                     $datos[3],$datos[4],$datos[5],
    //                     $datos[6],$datos[7],$datos[8],
    //                     $datos[9],$datos[10],$datos[11],
    //                     $datos[12],$datos[13],NULL,NULL);
    //
    //                     Producto::save($producto);
    // }else{
      // echo("(" . "ya existe se actualizara" . $datos[0] . ")" . $linea);
      // Productos::update_existence($datos[0],$datos[6]);//Solo actualiza inventario
//**************
//Producto::update_existencia($conexion,$datos[0],$datos[6],$datos[9],$datos[7],$datos[12],$datos[13]);
// $str_query = "UPDATE productos SET inventa1 = 100 WHERE codingre = 0002";
// $update=$conexion->query($str_query);
// $update=$conexion->prepare('UPDATE productos
                    // SET inventa1=:inventa1, ultcosto=:ultcosto, stockmax=:stockmax,
                        // pedido=:pedido, status=:status
                    // WHERE codingre=:codingre');
// $update->bindValue('codingre',$datos[0]);
// $update->bindValue('inventa1',$datos[6]);
// $update->bindValue('ultcosto',$datos[9]);
// $update->bindValue('stockmax',$datos[7]);
// $update->bindValue('pedido',$datos[12]);
// $update->bindValue('status',$datos[13]);
// $update->execute();
//***********+++
       // $linea--;
    // }

    // if(!in_array($datos[2],$familias)){
      // $familias[]=$datos[2];
    // }
    // echo ("<br>");
  // }
// echo "<script>alert(".($linea-1).");</script>";

// print_r($familias);
//Cerramos el archivo
fclose($archivo);

$estado = "Listo";
Actualiza::actualiza_estado($estado);
echo "Listo datos cargados";
?>
</html>
