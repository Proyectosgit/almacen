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


	function __construct($codingre, $descrip, $familia, $unidad, $empaque, $equivale, $inventa1,
	 					$stockmax, $stockmin, $ultcosto, $costoprome, $impuesto, $pedido, $status){

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
											$producto['pedido'],$producto['status']);
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
			     							:pedido,:status)');
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
									status=:status
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
								$productoDb['pedido'],$productoDb['status']);
		return $producto;
	}

	//la función para obtener un producto por el id
	public static function getByFam($familia){

		$listaProductos =[];
		$db=Db::getConnect();
		$select=$db->prepare('SELECT * FROM productos WHERE familia=:familia');
		$select->bindValue('familia',$familia);
		$select->execute();
		foreach($select->fetchAll() as $productoDb)
		$productos[]= new Producto($productoDb['codingre'],$productoDb['descrip'], $productoDb['familia'],
									$productoDb['unidad'],$productoDb['empaque'],$productoDb['equivale'],
					  				$productoDb['inventa1'],$productoDb['stockmax'],$productoDb['stockmin'],
									$productoDb['ultcosto'],$productoDb['costoprome'],$productoDb['impuesto'],
									$productoDb['pedido'],$productoDb['status']);
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

}//End class
?>
