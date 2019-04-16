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
	public $ultcosto;
	public $costoprome;
	public $impuesto;
	public $pedido;
	public $estatus;

	//constructor de la clase
	function __construct($codingre, $descrip, $familia,
											 $unidad, $empaque, $equivale,
											 $inventa1, $stockmax, $ultcosto,
											 $costoprome, $impuesto, $pedido,
											 $estatus)
	{
		$this->codingre=$codingre;
		$this->descrip=$descrip;
		$this->familia=$familia;
		$this->unidad=$unidad;
		$this->empaque=$empaque;
		$this->equivale=$equivale;
		$this->inventa1=$inventa1;
		$this->stockmax=$stockmax;
		$this->ultcosto=$ultcosto;
		$this->costoprome=$costoprome;
		$this->impuesto=$impuesto;
		$this->pedido=$pedido;
		$this->estatus=$estatus;
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
																			$producto['estatus']);
		}
		return $listaProductos;
	}

	//la función para registrar un usuario
	public static function save($producto){
			$db=Db::getConnect();
			$insert=$db->prepare('INSERT INTO productos
														VALUES(:codingre,:descrip,:familia,
																	:unidad,:empaque,:equivale,
																	:inventa1,:stockmax,:ultcosto,
																	:costoprome,:impuesto,:pedido,
																	:estatus)');
			$insert->bindValue('codingre',$producto->codingre);
			$insert->bindValue('descrip',$producto->descrip);
			$insert->bindValue('familia',$producto->familia);
			$insert->bindValue('unidad',$producto->unidad);
			$insert->bindValue('empaque',$producto->empaque);
			$insert->bindValue('equivale',$producto->equivale);
			$insert->bindValue('inventa1',$producto->inventa1);
			$insert->bindValue('stockmax',$producto->stockmax);
			$insert->bindValue('ultcosto',$producto->ultcosto);
			$insert->bindValue('costoprome',$producto->costoprome);
			$insert->bindValue('impuesto',$producto->impuesto);
			$insert->bindValue('pedido',$producto->pedido);
			$insert->bindValue('estatus',$producto->estatus);
			$insert->execute();
		}

	//la función para actualizar
	public static function update($producto){
		$db=Db::getConnect();
		$update=$db->prepare('UPDATE productos
													SET descrip=:descrip, familia=:familia, unidad=:unidad,
			 												empaque=:empaque, equivale=:equivale, inventa1=:inventa1,
															stockmax=:stockmax,ultcosto=:ultcosto,costoprome=:costoprome,
															impuesto=:impuesto,pedido=:pedido,estatus=:estatus
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
		$update->execute();
	}

	// la función para eliminar por el id
	public static function delete($codingre){
		$db=Db::getConnect();
		//$delete=$db->prepare('DELETE FROM usuarios WHERE ID=:id');
		$delete=$db->prepare('DELETE FROM productos WHERE codingre=:codingre');
		$delete->bindValue('codingre',$codingre);
		$delete->execute();
	}

	//la función para obtener un producto por el id
	public static function getById($codingre){
		//buscar
		$db=Db::getConnect();
		//$select=$db->prepare('SELECT * FROM usuario WHERE ID=:id');
		$select=$db->prepare('SELECT * FROM productos WHERE codingre=:codingr');
		$select->bindValue('codingre',$codingre);
		$select->execute();
		//asignarlo al objeto usuario
		$productoDb=$select->fetch();
		$producto= new Producto($productoDb['codingr'],$productoDb['descrip'], $productoDb['familia'],
														$productoDb['unidad'],$productoDb['empaque'],$productoDb['equivale'],
								    				$productoDb['inventa1'],$productoDb['stockmax'],$productoDb['ultcosto'],
														$productoDb['costoprome'],$productoDb['impuesto'],$productoDb['pedido'],
														$productoDb['estatus']);
		return $producto;
	}

	//la función para obtener un producto por el id
	public static function getByFam($familia){
		//buscar
		$listaProductos =[];
		$db=Db::getConnect();
		//$select=$db->prepare('SELECT * FROM usuario WHERE ID=:id');
		$select=$db->prepare('SELECT * FROM productos WHERE familia=:familia');
		$select->bindValue('familia',$familia);
		$select->execute();
		//asignarlo al objeto usuario
		//$productoDb=$select->fetch();
		foreach($select->fetchAll() as $productoDb)
		$productos[]= new Producto($productoDB['codingr'],$productoDB['descrip'], $productoDB['familia'],
														$productoDB['unidad'],$productoDB['empaque'],$productoDB['equivale'],
								    				$productoDB['inventa1'],$productoDB['stockmax'],$productoDB['ultcosto'],
														$productoDB['costoprome'],$productoDB['impuesto'],$productoDB['pedido'],
														$productoDB['estatus']);
		return $productos;
	}

	public static function verifica_existencia($codingre){
		require_once("../Views/connection.php");
		$db=Db::getConnect();
		echo "Entra y $Db";
		$db->prepare('SELECT COUNT(codingre) FROM productos WHERE codingre=:codingre');
		$db->bindValue('codingre',$codingre);
		$existencia=$db->execute();
		return $existencia;
	}
}
?>
