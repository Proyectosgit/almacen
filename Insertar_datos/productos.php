	<?php
/**
* Modelo para el acceso a la base de datos y funciones CRUD
*/
class Productos
{
	//atributos
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


	//constructor de la clase
	function __construct($codingre, $descrip, $familia,
											 $unidad, $empaque, $equivale,
											 $inventa1, $stockmax,$stockmin, $ultcosto,
											 $costoprome, $impuesto, $pedido,
											 $status,$inventaFisico,$diferencia)
	{
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
		$this->diferencia=$diferencia;
	}

	//función para obtener todos los usuarios
	public static function all(){
		$listaProductos =[];
		$db=Db::getConnect();
		$sql=$db->query('SELECT * FROM productos');

		// carga en la $listaUsuarios cada registro desde la base de datos
		foreach ($sql->fetchAll() as $producto) {
			$listaProductos[]= new Productos($producto['codingre'],$producto['descrip'], $producto['familia'],
																			$producto['unidad'],$producto['empaque'],$producto['equivale'],
																			$producto['inventa1'],$producto['stockmax'],$producto['ultcosto'],
																			$producto['costoprome'],$producto['impuesto'],$producto['pedido'],
																			$producto['estatus'],$producto['inventaFisico'],$producto['diferencia']);
		}
		return $listaProductos;
	}

	//la función para registrar un usuario
	public static function save($producto){
			$db=Db::getConnect();
			$insert=$db->prepare('INSERT INTO productos
								VALUES(:codingre,:descrip,:familia,
											:unidad,:empaque,:equivale,
											:inventa1,:stockmax,:stockmin,:ultcosto,
											:costoprome,:impuesto,:pedido,
											:status,:inventaFisico,:diferencia)');
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
									stockmax=:stockmax,ultcosto=:ultcosto,costoprome=:costoprome,
									impuesto=:impuesto,pedido=:pedido,estatus=:estatus,inventaFisico=:inventaFisico,
									diferencia=:diferencia
							WHERE codingre=:codingre');
		$update->bindValue('codingre',$producto->codingre);
		$update->bindValue('descrip',$producto->descrip);
		$update->bindValue('familia',$producto->familia);
		$update->bindValue('unidad',$producto->unidad);
		$update->bindValue('empaque',$producto->empaque);
		$update->bindValue('equivale',$producto->equivale);
		$update->bindValue('inventa1',$producto->inventa1);
		$update->bindValue('stockmax',$producto->stockmax);
		$update->bindValue('ultcosto',$producto->ultcosto);
		$update->bindValue('costoprome',$producto->costoprome);
		$update->bindValue('impuesto',$producto->impuesto);
		$update->bindValue('pedido',$producto->pedido);
		$update->bindValue('estatus',$producto->estatus);
		$update->bindValue('inventaFisico',$producto->inventaFisico);
		$update->bindValue('diferencia',$producto->diferencia);
		$update->execute();
	}

	public static function update_existence($codingre,$inventa1){
		$db=Db::getConnect();
		$update=$db->prepare('UPDATE productos SET inventa1=:inventa1 WHERE codingre=:codingre');
		$update->bindValue('inventa1',$inventa1);
		$update->bindValue('codingre',$codingre);
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
		$select=$db->prepare('SELECT * FROM productos WHERE codingre=:codingr');
		$select->bindValue('codingre',$codingre);
		$select->execute();
		$productoDb=$select->fetch();
		$producto= new Producto($productoDb['codingr'],$productoDb['descrip'], $productoDb['familia'],
														$productoDb['unidad'],$productoDb['empaque'],$productoDb['equivale'],
								    				$productoDb['inventa1'],$productoDb['stockmax'],$productoDb['ultcosto'],
														$productoDb['costoprome'],$productoDb['impuesto'],$productoDb['pedido'],
														$productoDb['estatus'],$productoDb['inventaFisico'],$producto['diferecia']);
		return $producto;
	}

	//la función para obtener un producto por el familia
	public static function getByFam($familia){

		$listaProductos =[];
		$db=Db::getConnect();
		$select=$db->prepare('SELECT * FROM productos WHERE familia=:familia');
		$select->bindValue('familia',$familia);
		$select->execute();
		foreach($select->fetchAll() as $productoDb)
		$productos[]= new Producto($productoDB['codingr'],$productoDB['descrip'], $productoDB['familia'],
														$productoDB['unidad'],$productoDB['empaque'],$productoDB['equivale'],
								    				$productoDB['inventa1'],$productoDB['stockmax'],$productoDB['ultcosto'],
														$productoDB['costoprome'],$productoDB['impuesto'],$productoDB['pedido'],
														$productoDB['estatus'],$productoDB['inventaFisico'],$productoDB['diferecia']);
		return $productos;
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
}
?>
