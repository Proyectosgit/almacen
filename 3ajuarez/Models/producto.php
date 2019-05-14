<?php

class Producto
{

	public $codingre;
	public $descrip;
	public $familia;
	public $unidad;
	public $empaque;
	public $equivale;
	public $inventa0;
	public $inventa1;
	public $stockmax0;
	public $stockmax1;
	public $stockmin0;
	public $stockmin1;
	public $ultcosto;
	public $costoprome;
	public $impuesto;
	public $pedido0;
	public $pedido1;
	public $status0;
	public $status1;
	public $redondeo;
	public $inventafisico0;
	public $inventafisico1;
	public $diferencia0;
	public $diferencia1;


	function __construct($codingre,	$descrip, 	$familia, 	$unidad, 	$empaque, 		 $equivale, 		$inventa0, 		$inventa1,
	 					$stockmax0,	$stockmax1, $stockmin0, $stockmin1, 	$ultcosto, 		 $costoprome, 		$impuesto, 		$pedido0,
						$pedido1,	$status0, 	$status1,	$redondeo, 	$inventafisico0, $inventafisico1,	$diferencia0, 	$diferencia1){

		$this->codingre = $codingre;
		$this->descrip  = $descrip;
		$this->familia  = $familia;
		$this->unidad   = $unidad;
		$this->empaque  = $empaque;
		$this->equivale = $equivale;
		$this->inventa0 = $inventa0;
		$this->inventa1 = $inventa1;
		$this->stockmax0 = $stockmax0;
		$this->stockmax1 = $stockmax1;
		$this->stockmin0 = $stockmin0;
		$this->stockmin1 = $stockmin1;
		$this->ultcosto = $ultcosto;
		$this->costoprome = $costoprome;
		$this->impuesto = $impuesto;
		$this->pedido0  = $pedido0;
		$this->pedido1  = $pedido1;
		$this->status0  = $status0;
		$this->status1  = $status1;
		$this->redondeo = $redondeo;
		$this->inventafisico0 = $inventafisico0;
		$this->inventafisico1 = $inventafisico1;
		$this->diferencia0 = $diferencia0;
		$this->diferencia1 = $diferencia1;
	}


	public static function all(){

		$listaProductos = [];
		$db	 =	Db::getConnect();
		$sql =	$db->query('SELECT * FROM productos');
		foreach ($sql->fetchAll() as $producto) {
			$listaProductos[] = new Producto(	$producto['codingre'],		$producto['descrip'], 		$producto['familia'],
												$producto['unidad'],		$producto['empaque'],		$producto['equivale'],
												$producto['inventa0'], 		$producto['inventa1'],		$producto['stockmax0'],
												$producto['stockmax1'],		$producto['stockmin0'],		$producto['stockmin1'],
												$producto['ultcosto'],		$producto['costoprome'],	$producto['impuesto'],
												$producto['pedido0'],		$producto['pedido1'],		$producto['status0'],
												$producto['status1'],		$producto['redondeo'],		$producto['inventafisico0'],
												$producto['inventafisico1'],$producto['diferencia0'], 	$producto['diferencia1'] );
		}
		return $listaProductos;
	}


	public static function save($producto){

			$db = Db::getConnect();
			$insert = $db->prepare('INSERT INTO productos
			     					VALUES(	:codingre, 		:descrip, 		:familia,
			     							:unidad, 		:empaque, 		:equivale,
			     							:inventa0,		:inventa1,		:stockmax0,
											:stockmax1,		:stockmin0, 	:stockmin1,
			     							:ultcosto,		:costoprome,	:impuesto,
			     							:pedido0,		:pedido1,		:status0,
											:status1,		:redondeo,		:inventafisico0,
											:inventafisico1,:diferencia0,	:diferencia1 )');
			$insert->bindValue('codingre',		$producto->codingre);
			$insert->bindValue('descrip',		$producto->descrip);
			$insert->bindValue('familia',		$producto->familia);
			$insert->bindValue('unidad',		$producto->unidad);
			$insert->bindValue('empaque',		$producto->empaque);
			$insert->bindValue('equivale',		$producto->equivale);
			$insert->bindValue('inventa0',		$producto->inventa0);
			$insert->bindValue('inventa1',		$producto->inventa1);
			$insert->bindValue('stockmax0',		$producto->stockmax0);
			$insert->bindValue('stockmax1',		$producto->stockmax1);
			$insert->bindValue('stockmin0',		$producto->stockmin0);
			$insert->bindValue('stockmin1',		$producto->stockmin1);
			$insert->bindValue('ultcosto',		$producto->ultcosto);
			$insert->bindValue('costoprome',	$producto->costoprome);
			$insert->bindValue('impuesto',		$producto->impuesto);
			$insert->bindValue('pedido0',		$producto->pedido0);
			$insert->bindValue('pedido1',		$producto->pedido1);
			$insert->bindValue('status0',		$producto->status0);
			$insert->bindValue('status1',		$producto->status1);
			$insert->bindValue('redondeo',		$producto->redondeo);
			$insert->bindValue('inventafisico0',$producto->inventafisico0);
			$insert->bindValue('inventafisico1',$producto->inventafisico1);
			$insert->bindValue('diferencia0',	$producto->diferencia0);
			$insert->bindValue('diferencia1',	$producto->diferencia1);
			$insert->execute();
		}


	//la función para actualizar
	public static function update($producto){

		$db=Db::getConnect();
		$update=$db->prepare('	UPDATE productos
								SET 	descrip=:descrip,		familia=:familia,		unidad=:unidad,
										empaque=:empaque,		equivale=:equivale, 	inventa1=:inventa1,
										stockmax=:stockmax,		stockmin=:stockmin,		ultcosto=:ultcosto,
										costoprome=:costoprome, impuesto=:impuesto, 	pedido=:pedido,
										status=:status,			redondeo=:redondeo
								WHERE 	codingre=:codingre');
		$update->bindValue('codingre',	$producto->codingre);
		$update->bindValue('descrip',	$producto->descrip);
		$update->bindValue('familia',	$producto->familia);
		$update->bindValue('unidad',	$producto->unidad);
		$update->bindValue('empaque',	$producto->empaque);
		$update->bindValue('equivale',	$producto->equivale);
		$update->bindValue('inventa0',	$producto->inventa0);
		$update->bindValue('inventa1',	$producto->inventa1);
		$update->bindValue('stockmax0',	$producto->stockmax0);
		$update->bindValue('stockmax1',	$producto->stockmax1);
		$update->bindValue('stockmin0',	$producto->stockmin0);
		$update->bindValue('stockmin1',	$producto->stockmin1);
		$update->bindValue('ultcosto',	$producto->ultcosto);
		$update->bindValue('costoprome',$producto->costoprome);
		$update->bindValue('impuesto',	$producto->impuesto);
		$update->bindValue('pedido0',	$producto->pedido0);
		$update->bindValue('pedido1',	$producto->pedido1);
		$update->bindValue('status0',	$producto->status0);
		$update->bindValue('status1',	$producto->status1);
		$update->bindValue('redondeo',	$producto->redondeo);
		$update->execute();
		//No se actualizan invetarios, ni diferencias
	}

	// la función para eliminar por el id
	public static function delete($codingre){
		$db = Db::getConnect();
		$delete = $db->prepare('DELETE FROM productos WHERE codingre = :codingre');
		$delete->bindValue('codingre',$codingre);
		$delete->execute();
	}

	//la función para obtener un producto por el id
	public static function getById($codingre){

		$db = Db::getConnect();
		$select = $db->prepare('SELECT * FROM productos WHERE codingre = :codingre');
		$select->bindValue('codingre',$codingre);
		$select->execute();
		$productoDb = $select->fetch();
		$producto = new Producto(	$productoDb['codingre'],		$productoDb['descrip'], 		$productoDb['familia'],
									$productoDb['unidad'],			$productoDb['empaque'],			$productoDb['equivale'],
				  					$productoDb['inventa0'],		$productoDb['inventa1'],			$productoDb['stockmax0'],
									$productoDb['stockmax1'],		$productoDb['stockmin0'],		$productoDb['stockmin1'],
									$productoDb['ultcosto'],		$productoDb['costoprome'],		$productoDb['impuesto'],
									$productoDb['pedido0'],			$productoDb['pedido1'],			$productoDb['status0'],
									$productoDb['status1'],			$productoDb['redondeo'],		$productoDb['inventafisico0'],
									$productoDb['inventafisico1'],	$productoDb['diferencia0'],		$productoDb['diferencia1']	);
		return $producto;
	}

	//la función para obtener un producto por el id
	public static function getByFam($familia){

		$listaProductos = [];
		$db = Db::getConnect();
		$select = $db->prepare('SELECT * FROM productos WHERE familia = :familia ORDER BY descrip ASC');
		$select->bindValue('familia',$familia);
		$select->execute();
		foreach($select->fetchAll() as $productoDb)
		$productos[] = new Producto( 	$productoDb['codingre'],		$productoDb['descrip'],			$productoDb['familia'],
										$productoDb['unidad'],  		$productoDb['empaque'],			$productoDb['equivale'],
					  					$productoDb['inventa0'],		$productoDb['inventa1'],		$productoDb['stockmax0'],
										$productoDb['stockmax1'],		$productoDb['stockmin0'],		$productoDb['stockmin1'],
										$productoDb['ultcosto'],		$productoDb['costoprome'],		$productoDb['impuesto'],
										$productoDb['pedido0'],			$productoDb['pedido1'],  		$productoDb['status0'],
										$productoDb['status1'],			$productoDb['redondeo'],		$productoDb['inventafisico0'],
										$productoDb['inventafisico1'],	$productoDb['diferencia0'],		$productoDb['diferencia1']	);
		if(!empty($productos)){
			return $productos;
		}
	}


	public static function ingresa_pedido_autorizado_cancelado($productos,$status1){
		//$status="autorizado";
		$db = Db::getconnect();
		foreach($productos->fetchAll() as $producto){
			$insert = $db->prepare('UPDATE productos SET pedido1 = :pedido1, status1 = :status1 WHERE codingre = :codingre');
			$insert->bindValue("pedido1",	$producto['num_prod']);
			$insert->bindValue("codingre",	$producto['codingre']);
			$insert->bindValue("status1",	$producto['status1']);
			$insert->execute();
	  }

	}

	public static function change_order_status_db($status1,$codingre){

		$db = Db::getConnect();
		$update = $db->prepare('UPDATE 	productos
								SET 	status1  = :status1
								WHERE 	codingre = :codingre');
		$update->bindValue('status1' , $status1);
		$update->bindvalue('codingre', $codingre);
		// $update->bindValue('autoriza',$_SESSION['nombre']);
		$update->execute();
	}


	public static function create_csv($data,$name_file){

		if(!empty($data)){

			$delimiter = ",";
			$filename = $name_file . date('Y-m-d') . ".csv";
			$f = fopen('php://memory', 'w');
			$fields = array(	'codingre',			'descrip', 		'familia', 		'unidad', 	  	'empaque',
								'equivale', 		'inventa0',		'inventa1', 	'stockmax0',  	'stockmax1',
 								'stockmin0',		'stockmin1', 	'ultcosto',		'costoprome', 	'impuesto',
								'pedido0', 			'pedido1',	  	'status0', 		'status1', 		'redondeo',
								'inventafisico0',	'inventafisico1','diferencia0',	'diferencia1');
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
						$row->inventa0,
						$row->inventa1,
						$row->stockmax0,
						$row->stockmax1,
						$row->stockmin0,
						$row->stockmin1,
						$row->ultcosto,
						$row->costoprome,
						$row->impuesto,
						$row->pedido0,
						$row->pedido1,
						$row->status0,
						$row->status1,
						$row->redondeo,
						$row->inventafisico0,
						$row->inventafisico1,
						$row->diferencia0,
						$row->diferencia1);
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
			$delimiter 	= ",";
			// $filename = $name_file . date('Y-m-d') . ".csv";
			$filename 	= $name_file . ".csv";
			$f = fopen(PATH_DESCARGA_CSV_PEDIDO . '\\' . $filename, 'w');
			$fields = array(	'codingre',			'descrip', 			'familia', 		'unidad', 	  	'empaque',
								'equivale', 		'inventa0',			'inventa1', 	'stockmax0',  	'stockmax1',
 								'stockmin0',		'stockmin1', 		'ultcosto',		'costoprome', 	'impuesto',
								'pedido0', 			'pedido1',	  		'status0', 		'status1', 		'redondeo',
								'inventafisico0',	'inventafisico1',	'diferencia0',	'diferencia1');

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
				$row->inventa0,
				$row->inventa1,
				$row->stockmax0,
				$row->stockmax1,
				$row->stockmin0,
				$row->stockmin1,
				$row->ultcosto,
				$row->costoprome,
				$row->impuesto,
				$row->pedido0,
				$row->pedido1,
				$row->status0,
				$row->status1,
				$row->redondeo,
				$row->inventafisico0,
				$row->inventafisico1,
				$row->diferencia0,
				$row->diferencia1);
			fputcsv($f, $lineData, $delimiter);
			}
		//move back to beginning of file
		// fseek($f, 0);
		//set headers to download file rather than displayed
		//header('Content-Type: text/csv');
		//header('Content-Disposition: attachment; filename="' . $filename . '";');
		//output all remaining data on a file pointer
		// fpassthru($f);
	fclose($f);
		}
	}


	public static function verifica_existencia($codingre){
		$db = Db::getConnect();
		$select = $db->prepare('SELECT COUNT(codingre) as cantidad FROM productos WHERE codingre=:codingre');
		$select->bindValue('codingre', $codingre);
		$select->execute();
		$count = $select->fetch();
		return $count["cantidad"];
	}


	public static function update_existencia($codingre,	$descrip,	$familia,	$unidad,	$empaque,		$equivale,
											$inventa1,	$stockmax,	$stockmin,	$ultcosto,	$costoprome,	$impuesto,
											$pedido,	$status,	$redondeo){
		$db = Db::getConnect();
		$update = $db->prepare('UPDATE productos
								SET descrip = :descrip, familia = :familia, unidad = :unidad, empaque = :empaque,
									equivale = :equivale,	inventa1 = :inventa1, stockmax = :stockmax, stockmin = :stockmin,
									ultcosto = :ultcosto, costoprome = :costoprome, impuesto = :impuesto, pedido = :pedido,
									redondeo = :redondeo
 								WHERE codingre = :codingre LIMIT 1;');
		$update->bindValue('codingre',	$codingre);
		$update->bindValue('descrip',	$descrip);
		$update->bindValue('familia',	$familia);
		$update->bindValue('unidad',	$unidad);
		$update->bindValue('empaque',	$empaque);
		$update->bindValue('equivale',	$equivale);
		$update->bindValue('inventa0',	$inventa0);
		$update->bindValue('inventa1',	$inventa1);
		$update->bindValue('stockmax0',	$stockmax0);
		$update->bindValue('stockmax1',	$stockmax1);
		$update->bindValue('stockmin0',	$stockmin0);
		$update->bindValue('stockmin1',	$stockmin1);
		$update->bindValue('ultcosto',	$ultcosto);
		$update->bindValue('costoprome',$costoprome);
		$update->bindValue('impuesto',	$impuesto);
		$update->bindValue('pedido0',	$pedido0);
		$update->bindValue('pedido1',	$pedido1);
		// $update->bindValue('status',	$status);
		$update->bindValue('redondeo',	$redondeo);
		$update->execute();
		// $update->closeCursor();
		//No se modifica inventariofisico y diferencias
	}



	public static function carga_db(){

		// $tiempo_inicio = microtime(true);
		// set_time_limit(600);
		// require_once("connection.php");
		// require_once("productos.php");

		$linea = 0;
		$familias = [];
		//Abrimos nuestro archivo
		// $archivo = fopen(dirname(__FILE__)."\OCOMPRA.csv", "r");
		$archivo = fopen(PATH_CARGA_CSV_OCOMPRA, "r");
		//Lo recorremos
		echo "Se esta cargando o actualizando la base de datos, por favor espera un momento... <br>";
  		while (($datos = fgetcsv($archivo, ",")) == true)
  		{
    		$num = count($datos);
    		$linea++;
    		//Recorremos las columnas de esa linea
    		if($linea == 1){
     			// echo "salto encabezado";
      			continue;}

      		// for ($columna = 0; $columna < $num; $columna++){

				// echo ($datos[$columna]);
          		// $datos[$columna];
        		// }
        		// echo $datos[0];
        		$existencia = Producto::verifica_existencia($datos[0]);
        		// echo "Existencia".$existencia;
        		if($existencia == 0){
        		// echo "Entro al for para guarda";
          		$producto = new Producto(	$datos[0],	$datos[1],	$datos[2],
                            				$datos[3],	$datos[4],	$datos[5],
                            				$datos[6],	$datos[7],	$datos[8],
                            				$datos[9],	$datos[10],	$datos[11],
                            				$datos[12],	$datos[13],	$datos[14],
											NULL,		NULL , 		NULL,
											NULL,		$datos[19],	NULL,
											NULL,		NULL,		NULL );

            	Producto::save($producto);
    		}else{
      		// echo("(" . "ya existe se actualizara" . $datos[0] . ")" . $linea);
      		Producto::update_existencia( 	$datos[0],	$datos[1],	$datos[2],
											$datos[3],	$datos[4],	$datos[5],
											$datos[6],	$datos[7],	$datos[8],
											$datos[9],	$datos[10],	$datos[11],
											$datos[12],	$datos[13],	$datos[14],
											NULL,		NULL , 		NULL,
											NULL,		$datos[19],	NULL,
											NULL,		NULL,		NULL);
       		// $linea--;
    		}
    		 // if(!in_array($datos[2],$familias)){
      		 // $familias[]=$datos[2];
    		 // }
    		 // echo ("<br>");
  		}
		// echo "<script>alert(".($linea-1).");</script>";
		// print_r($familias);
		echo "Exito.... Actualizacion lista.";
		//Cerramos el archivo
		fclose($archivo);
		// $tiempo_final = microtime(true);
		// echo "Tiempo de ejecucion: " . ($tiempo_final - $tiempo_inicio) ;
	}
}//End class
?>
