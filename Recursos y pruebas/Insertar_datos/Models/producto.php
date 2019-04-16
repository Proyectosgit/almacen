<?php
/**
* Modelo para el acceso a la base de datos y funciones CRUD
*/
class Producto
{
	//atributos
	public $id_prod;
	public $descripcion;
	public $cod_fam;
	public $existencia;
	public $precio_unitario;
	public $stock_min;
	public $stock_max;
	public $unidad_medida;

	//constructor de la clase
	function __construct($id_prod, $descripcion, $cod_fam, $existencia, $precio_unitario, $stock_min, $stock_max, $unidad_medida)
	{
		$this->id_prod=$id_prod;
		$this->descripcion=$descripcion;
		$this->cod_fam=$cod_fam;
		$this->existencia=$existencia;
		$this->precio_unitario=$precio_unitario;
		$this->stock_min=$stock_min;
		$this->stock_max=$stock_max;
		$this->unidad_medida=$unidad_medida;
	}

	//función para obtener todos los usuarios
	public static function all(){
		$listaProductos =[];
		$db=Db::getConnect();
		$sql=$db->query('SELECT * FROM producto');

		// carga en la $listaUsuarios cada registro desde la base de datos
		foreach ($sql->fetchAll() as $producto) {
			$listaProductos[]= new Producto($producto['id_prod'],$producto['descripcion'], $producto['cod_fam'],$producto['existencia'],$producto['precio_unitario'],$producto['stock_min'],$producto['stock_max'],$producto['unidad_medida']);
		}
		return $listaProductos;
	}

	//la función para registrar un usuario
	public static function save($producto){
			$db=Db::getConnect();
			$insert=$db->prepare('INSERT INTO producto VALUES(NULL,:descripcion,:cod_fam,:existencia,:precio_unitario,:stock_min,:stock_max,:unidad_medida)');
			$insert->bindValue('descripcion',$producto->descripcion);
			$insert->bindValue('cod_fam',$producto->cod_fam);
			$insert->bindValue('existencia',$producto->existencia);
			$insert->bindValue('precio_unitario',$producto->precio_unitario);
			$insert->bindValue('stock_min',$producto->stock_min);
			$insert->bindValue('stock_max',$producto->stock_max);
			$insert->bindValue('unidad_medida',$producto->unidad_medida);
			$insert->execute();
		}

	//la función para actualizar
	public static function update($producto){
		$db=Db::getConnect();
		$update=$db->prepare('UPDATE producto
													SET descripcion=:descripcion, cod_fam=:cod_fam, existencia=:existencia,
			 												precio_unitario=:precio_unitario, stock_min=:stock_min, stock_max=:stock_max,
															unidad_medida=:unidad_medida
													WHERE id_prod=:id_prod');
		$update->bindValue('id_prod',$producto->id_prod);
		$update->bindValue('descripcion',$producto->descripcion);
		$update->bindValue('cod_fam',$producto->cod_fam);
		$update->bindValue('existencia',$producto->existencia);
		$update->bindValue('precio_unitario',$producto->precio_unitario);
		$update->bindValue('stock_min',$producto->stock_min);
		$update->bindValue('stock_max',$producto->stock_max);
		$update->bindValue('unidad_medida',$producto->unidad_medida);
		$update->execute();
	}

	// la función para eliminar por el id
	public static function delete($id){
		$db=Db::getConnect();
		//$delete=$db->prepare('DELETE FROM usuarios WHERE ID=:id');
		$delete=$db->prepare('DELETE FROM producto WHERE id_prod=:id');
		$delete->bindValue('id',$id);
		$delete->execute();
	}

	//la función para obtener un producto por el id
	public static function getById($id){
		//buscar
		$db=Db::getConnect();
		//$select=$db->prepare('SELECT * FROM usuario WHERE ID=:id');
		$select=$db->prepare('SELECT * FROM producto WHERE id_prod=:id');
		$select->bindValue('id',$id);
		$select->execute();
		//asignarlo al objeto usuario
		$productoDb=$select->fetch();
		$producto= new Producto($productoDb['id_prod'],$productoDb['descripcion'],$productoDb['cod_fam'],
														$productoDb['existencia'],$productoDb['precio_unitario'],$productoDb['stock_min'],
														$productoDb['stock_max'],$productoDb['unidad_medida']);
		return $producto;
	}

	//la función para obtener un producto por el id
	public static function getByFam($cod_fam){
		//buscar
		$listaProductos =[];
		$db=Db::getConnect();
		//$select=$db->prepare('SELECT * FROM usuario WHERE ID=:id');
		$select=$db->prepare('SELECT * FROM producto WHERE cod_fam=:cod_fam');
		$select->bindValue('cod_fam',$cod_fam);
		$select->execute();
		//asignarlo al objeto usuario
		//$productoDb=$select->fetch();
		foreach($select->fetchAll() as $productoDb)
		$productos[]= new Producto($productoDb['id_prod'],$productoDb['descripcion'],$productoDb['cod_fam'],
															 $productoDb['existencia'],$productoDb['precio_unitario'],$productoDb['stock_min'],
															 $productoDb['stock_max'],$productoDb['unidad_medida']);
		return $productos;
	}
}
?>
