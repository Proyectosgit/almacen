<?php

class Familia
{

	public $cod_familia;
	public $descripcion;

	function __construct($cod_familia, $descripcion)
	{
		$this->cod_familia=$cod_familia;
		$this->descripcion=$descripcion;
	}

	//función para obtener todos los familias
	public static function all(){
		$listaFamilias =[];
		$db=Db::getConnect();
		$sql=$db->query('SELECT * FROM familia');
		foreach ($sql->fetchAll() as $familia) {
			$listaFamilias[]= new Familia($familia['cod_familia'],$familia['descripcion']);
		}
		return $listaFamilias;
	}

	//la función para registrar un familia
	public static function save($familia){
			$db=Db::getConnect();
			$insert=$db->prepare('INSERT INTO familia VALUES(:cod_familia,:descripcion)');
			$insert->bindValue('cod_familia',$familia->cod_familia);
			$insert->bindValue('descripcion',$familia->descripcion);
			$insert->execute();
		}

	//la función para actualizar
	public static function update($familia){
		$db=Db::getConnect();
		$update=$db->prepare('UPDATE familia SET descripcion=:descripcion WHERE cod_familia=:cod_familia');
		$update->bindValue('cod_familia',$familia->cod_familia);
		$update->bindValue('descripcion',$familia->descripcion);
		$update->execute();
	}

	// la función para eliminar por el id
	public static function delete($cod_familia){
		$db=Db::getConnect();
		$delete=$db->prepare('DELETE FROM familia WHERE cod_familia=:cod_familia');
		$delete->bindValue('cod_familia',$cod_familia);
		$delete->execute();
	}

	//la función para obtener un familia por el id
	public static function getById($cod_familia){
		$db=Db::getConnect();
		$select=$db->prepare('SELECT * FROM familia WHERE cod_familia=:cod_familia');
		$select->bindValue('cod_familia',$cod_familia);
		$select->execute();
		$familiaDb=$select->fetch();
		$familia= new Familia($familiaDb['cod_familia'],$familiaDb['descripcion']);
		return $familia;
	}
}
?>
