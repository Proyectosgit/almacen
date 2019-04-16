<?php
if(isset($_POST['modificados'])){
    if(!empty($_POST['modificados'])){
      //echo $_POST['costo_total'];
      $lista_productos=[];
      $lista_cantidad=[];
      $datos_modificados = explode(" ",$_POST['modificados']);
          for($i=0; $i< count($datos_modificados)-1; $i++){
            $id_and_cantidad=explode(':',$datos_modificados[$i]);
            $lista_productos[]=$id_and_cantidad[0];
            $lista_cantidad[]=$id_and_cantidad[1];
            // echo 'I: '.$i;
            // echo 'ID: '.$id_aux;
            // echo 'Cantidad: '.$cantidad_aux;
          }
          print_r($lista_productos);
          print_r($lista_cantidad);
    }else{
      print('no hay datos');
    }
}
?>
