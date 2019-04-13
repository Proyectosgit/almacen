<?php

class Producto
{

	public $codingre;
	public $descrip;
	public $familia;
	public $unidad;
	public $empaque;
	public $equivale;
	public $inventa1;
	public $stockmax;
	public $stockmin;
	public $ultcosto;
	public $costoprome;
	public $impuesto;
	public $pedido;
	public $status;
	public $inventaFisico;
	public $diferencia;


	function __construct($codingre, $descrip, $familia, $unidad, $empaque, $equivale, $inventa1,
	 					$stockmax, $stockmin, $ultcosto, $costoprome, $impuesto, $pedido, $status,$inventaFisico,$diferencia){

		$this->codingre=$codingre;
		$this->descrip=$descrip;
		$this->familia=$familia;
		$this->unidad=$unidad;
		$this->empaque=$empaque;
		$this->equivale=$equivale;
		$this->inventa1=$inventa1;
		$this->stockmax=$stockmax;
		$this->stockmin=$stockmin;
		$this->ultcosto=$ultcosto;
		$this->costoprome=$costoprome;
		$this->impuesto=$impuesto;
		$this->pedido=$pedido;
		$this->status=$status;
		$this->inventaFisico=$inventaFisico;
		$this->pedido=$pedido;
	}

	public static function all(){

		$listaProductos =[];
		$db=Db::getConnect();
		$sql=$db->query('SELECT * FROM productos');
		foreach ($sql->fetchAll() as $producto) {
			$listaProductos[]= new Producto($producto['codingre'],$producto['descrip'], $producto['familia'],
											$producto['unidad'],$producto['empaque'],$producto['equivale'],
											$producto['inventa1'],$producto['stockmax'],$producto['stockmin'],
											$producto['ultcosto'],$producto['costoprome'],$producto['impuesto'],
											$producto['pedido'],$producto['status'],$producto['inventaFisico'],$producto['pedido']);
		}
		return $listaProductos;
	}


	public static function save($producto){

			$db=Db::getConnect();
			$insert=$db->prepare('INSERT INTO productos
			     				VALUES(:codingre,:descrip,:familia,
			     							:unidad,:empaque,:equivale,
			     							:inventa1,:stockmax,:stockmin,
			     							:ultcosto,:costoprome,:impuesto,
			     							:pedido,:status,:inventaFisico,:diferencia)');
			$insert->bindValue('codingre',$producto->codingre);
			$insert->bindValue('descrip',$producto->descrip);
			$insert->bindValue('familia',$producto->familia);
			$insert->bindValue('unidad',$producto->unidad);
			$insert->bindValue('empaque',$producto->empaque);
			$insert->bindValue('equivale',$producto->equivale);
			$insert->bindValue('inventa1',$producto->inventa1);
			$insert->bindValue('stockmax',$producto->stockmax);
			$insert->bindValue('stockmin',$producto->stockmin);
			$insert->bindValue('ultcosto',$producto->ultcosto);
			$insert->bindValue('costoprome',$producto->costoprome);
			$insert->bindValue('impuesto',$producto->impuesto);
			$insert->bindValue('pedido',$producto->pedido);
			$insert->bindValue('status',$producto->status);
			$insert->bindValue('inventaFisico',$producto->inventaFisico);
			$insert->bindValue('diferencia',$producto->diferencia);
			$insert->execute();
		}

	//la función para actualizar
	public static function update($producto){

		$db=Db::getConnect();
		$update=$db->prepare('UPDATE productos
							SET descrip=:descrip, familia=:familia, unidad=:unidad,
										empaque=:empaque, equivale=:equivale, inventa1=:inventa1,
									stockmax=:stockmax,stockmin=:stockmin,ultcosto=:ultcosto,
									costoprome=:costoprome,impuesto=:impuesto,pedido=:pedido,
									status=:status,inventaFisico=:inventaFisico,diferencia=:diferencia
							WHERE codingre=:codingre');
		$update->bindValue('codingre',$producto->codingre);
		$update->bindValue('descrip',$producto->descrip);
		$update->bindValue('familia',$producto->familia);
		$update->bindValue('unidad',$producto->unidad);
		$update->bindValue('empaque',$producto->empaque);
		$update->bindValue('equivale',$producto->equivale);
		$update->bindValue('inventa1',$producto->inventa1);
		$update->bindValue('stockmax',$producto->stockmax);
		$update->bindValue('stockmin',$producto->stockmin);
		$update->bindValue('ultcosto',$producto->ultcosto);
		$update->bindValue('costoprome',$producto->costoprome);
		$update->bindValue('impuesto',$producto->impuesto);
		$update->bindValue('pedido',$producto->pedido);
		$update->bindValue('status',$producto->status);
		$update->bindValue('inventaFisico',$producto->inventaFisico);
		$update->bindValue('status',$diferencia->diferencia);
		$update->execute();
	}

	// la función para eliminar por el id
	public static function delete($codingre){
		$db=Db::getConnect();
		$delete=$db->prepare('DELETE FROM productos WHERE codingre=:codingre');
		$delete->bindValue('codingre',$codingre);
		$delete->execute();
	}

	//la función para obtener un producto por el id
	public static function getById($codingre){
		$db=Db::getConnect();
		$select=$db->prepare('SELECT * FROM productos WHERE codingre=:codingre');
		$select->bindValue('codingre',$codingre);
		$select->execute();
		$productoDb=$select->fetch();
		$producto= new Producto($productoDb['codingre'],$productoDb['descrip'], $productoDb['familia'],
								$productoDb['unidad'],$productoDb['empaque'],$productoDb['equivale'],
				  				$productoDb['inventa1'],$productoDb['stockmax'],$productoDb['stockmin'],
								$productoDb['ultcosto'],$productoDb['costoprome'],$productoDb['impuesto'],
								$productoDb['pedido'],$productoDb['status'],$productoDb['inventaFisico'],$productoDb['diferencia']);
		return $producto;
	}

	//la función para obtener un producto por el id
	public static function getByFam($familia){

		$listaProductos =[];
		$db=Db::getConnect();
		$select=$db->prepare('SELECT * FROM productos WHERE familia=:familia ORDER BY descrip ASC');
		$select->bindValue('familia',$familia);
		$select->execute();
		foreach($select->fetchAll() as $productoDb)
		$productos[]= new Producto($productoDb['codingre'],$productoDb['descrip'], $productoDb['familia'],
									$productoDb['unidad'],$productoDb['empaque'],$productoDb['equivale'],
					  				$productoDb['inventa1'],$productoDb['stockmax'],$productoDb['stockmin'],
									$productoDb['ultcosto'],$productoDb['costoprome'],$productoDb['impuesto'],
									$productoDb['pedido'],$productoDb['status'],$productoDb['inventaFisico'],$productoDb['diferencia']);
		return $productos;
	}

	public static function ingresa_pedido_autorizado_cancelado($productos,$status){
		//$status="autorizado";
		$db=Db::getconnect();
		foreach($productos->fetchAll() as $producto){
			$insert=$db->prepare('UPDATE productos SET pedido=:pedido, status=:status WHERE codingre=:codingre');
			$insert->bindValue("pedido",$producto['num_prod']);
			$insert->bindValue("codingre",$producto['codingre']);
			$insert->bindValue("status",$status);
			$insert->execute();

	  }
	}

	public static function change_order_status_db($status,$codingre){
		$db=Db::getConnect();
		$update=$db->prepare('UPDATE productos
							SET status=:status
							WHERE codingre=:codingre');
		$update->bindValue('status',$status);
		$update->bindvalue('codingre',$codingre);
		// $update->bindValue('autoriza',$_SESSION['nombre']);
		$update->execute();
	}
//Descomentar este es el que funciona y descarga toda la DB
	// public static function create_csv($data,$name_file){
	// 	// $db=Db::getConnect();
	// 	// $query = $db->query("SELECT * FROM productos ORDER BY codingre ASC");
	// 	if(!empty($data)){
    // 	$delimiter = ",";
    // 	$filename = $name_file . date('Y-m-d') . ".csv";
    // 	$f = fopen('php://memory', 'w');
    // 	$fields = array('codingre', 'descrip', 'familia', 'unidad', 'empaque',
	// 		 								'equivale', 'inventa1', 'stockmax', 'stockmin', 'ultcosto',
	// 										'costoprome', 'impuesto', 'pedido', 'status');
    // 	fputcsv($f, $fields, $delimiter);
    // 	//Escribe cada uno de los registros de la tabla usuarios en líneas separadas de nuestro csv
    // 	foreach($data as $row){
    //     	//$status = ($row['status'] == '1')?'Active':'Inactive';
    //     	$lineData = array(
    //                 $row->codingre,
    //                 $row->descrip,
    //                 $row->familia,
    //                 $row->unidad,
    //                 $row->empaque,
    //                 $row->equivale,
    //                 $row->inventa1,
    //                 $row->stockmax,
    //                 $row->stockmin,
    //                 $row->ultcosto,
    //                 $row->costoprome,
    //                 $row->impuesto,
    //                 $row->pedido,
    //                 $row->status);
    //     	fputcsv($f, $lineData, $delimiter);
    // 		}
    // 	//move back to beginning of file
    // 	fseek($f, 0);
    // 	//set headers to download file rather than displayed
    // 	header('Content-Type: text/csv');
    // 	header('Content-Disposition: attachment; filename="' . $filename . '";');
    // 	//output all remaining data on a file pointer
    // 	fpassthru($f);
    // fclose($f);
	// 	}
	// 	exit;
	// }

	public static function create_csv($data,$name_file){
		// $db=Db::getConnect();
		// $query = $db->query("SELECT * FROM productos ORDER BY codingre ASC");
		if(!empty($data)){
		$delimiter = ",";
		$filename = $name_file . date('Y-m-d') . ".csv";
		$f = fopen('php://memory', 'w');
		$fields = array('codingre', 'descrip', 'familia', 'unidad', 'empaque',
											'equivale', 'inventa1', 'stockmax', 'stockmin', 'ultcosto',
											'costoprome', 'impuesto', 'pedido', 'status');
		fputcsv($f, $fields, $delimiter);
		//Escribe cada uno de los registros de la tabla usuarios en líneas separadas de nuestro csv
		foreach($data as $row){
			//$status = ($row['status'] == '1')?'Active':'Inactive';
			$lineData = array(
					$row->codingre,
					$row->descrip,
					$row->familia,
					$row->unidad,
					$row->empaque,
					$row->equivale,
					$row->inventa1,
					$row->stockmax,
					$row->stockmin,
					$row->ultcosto,
					$row->costoprome,
					$row->impuesto,
					$row->pedido,
					$row->status);
			fputcsv($f, $lineData, $delimiter);
			}
		//move back to beginning of file
		fseek($f, 0);
		//set headers to download file rather than displayed
		header('Content-Type: text/csv');
		header('Content-Disposition: attachment; filename="' . $filename . '";');
		//output all remaining data on a file pointer
		fpassthru($f);
	fclose($f);
		}
		exit;
	}

	public static function create_csv_automatic($data,$name_file){
		require_once("../Config/config.php");
		if(!empty($data)){
		$delimiter = ",";
		$filename = $name_file . date('Y-m-d') . ".csv";
		// $f = fopen('C:\OCOMPRA'.'\\'.$filename, 'w');
		$f = fopen(PATH_DESCARGA_CSV_PEDIDO.'\\'.$filename, 'w');
		$fields = array('codingre', 'descrip', 'familia', 'unidad', 'empaque',
											'equivale', 'inventa1', 'stockmax', 'stockmin', 'ultcosto',
											'costoprome', 'impuesto', 'pedido', 'status');
		fputcsv($f, $fields, $delimiter);
		//Escribe cada uno de los registros de la tabla usuarios en líneas separadas de nuestro csv
		foreach($data as $row){
			//$status = ($row['status'] == '1')?'Active':'Inactive';
			$lineData = array(
					$row->codingre,
					$row->descrip,
					$row->familia,
					$row->unidad,
					$row->empaque,
					$row->equivale,
					$row->inventa1,
					$row->stockmax,
					$row->stockmin,
					$row->ultcosto,
					$row->costoprome,
					$row->impuesto,
					$row->pedido,
					$row->status);
			fputcsv($f, $lineData, $delimiter);
			}
		//move back to beginning of file
		//fseek($f, 0);
		//set headers to download file rather than displayed
		//header('Content-Type: text/csv');
		//header('Content-Disposition: attachment; filename="' . $filename . '";');
		//output all remaining data on a file pointer
		// fpassthru($f);
	fclose($f);
		}
	}

	public static function verifica_existencia($codingre){
		$db=Db::getConnect();
		$select=$db->prepare('SELECT COUNT(*) as cantidad FROM productos WHERE codingre=:codingre');
		$select->bindValue('codingre',$codingre);
		$select->execute();
		$count=$select->fetch();
		// print_r($count["cantidad"]);
		return $count["cantidad"];
	}

	public static function update_existencia($conexion,$codingre,$inventa1,$ultcosto,$stockmax,$pedido,$status){
		// $db=Db::getConnect();
		$db=$conexion;
		$update=$db->prepare('UPDATE productos
							SET inventa1=:inventa1, ultcosto=:ultcosto, stockmax=:stockmax,
 								pedido=:pedido, status=:status
 							WHERE codingre=:codingre');
		$update->bindValue('codingre',$codingre);
		$update->bindValue('inventa1',$inventa1);
		$update->bindValue('ultcosto',$ultcosto);
		$update->bindValue('stockmax',$stockmax);
		$update->bindValue('pedido',$pedido);
		$update->bindValue('status',$status);
		$update->execute();
	}

	public static function carga_db(){

		set_time_limit(500);
		// require_once("connection.php");
		// require_once("productos.php");

		$linea = 0;
		$familias=[];
		//Abrimos nuestro archivo
		// $archivo = fopen(dirname(__FILE__)."\OCOMPRA.csv", "r");
		$archivo = fopen(PATH_CARGA_CSV_OCOMPRA, "r");
		//Lo recorremos
		echo "Se esta cargando o actualizando la base de datos <br> por favor espera un momento...";
  		while (($datos = fgetcsv($archivo, ",")) == true)
  		{
    		$num = count($datos);
    		$linea++;
    		//Recorremos las columnas de esa linea
    		if($linea==1){

     		// echo "salto encabezado";
      		continue;}

      		for ($columna = 0; $columna < $num; $columna++){
          		// echo ($datos[$columna]);
          		$datos[$columna];
        		}
        		// echo $datos[0];
        		$existencia=Producto::verifica_existencia($datos[0]);
        		// echo "Existencia".$existencia;
        		if($existencia==0){
        		// echo "Entro al for para guarda";
          		$producto = new Producto($datos[0],$datos[1],$datos[2],
                            		$datos[3],$datos[4],$datos[5],
                            		$datos[6],$datos[7],$datos[8],
                            		$datos[9],$datos[10],$datos[11],
                            		$datos[12],$datos[12],NULL,NULL);

                            		Producto::save($producto);
    		}else{
      		// echo("(" . "ya existe se actualizara" . $datos[0] . ")" . $linea);
      		Producto::update_existencia($datos[0],$datos[6],$datos[9],$datos[7],$datos[12],$datos[13]);
       		$linea--;
    		}
    		 if(!in_array($datos[2],$familias)){
      		 $familias[]=$datos[2];
    		 }
    		 echo ("<br>");
  		}
		echo "<script>alert(".($linea-1).");</script>";
		echo "Exito....";
		print_r($familias);
		//Cerramos el archivo
		fclose($archivo);
	}
}//End class
?>
