<?php

class Actualiza
{

	public $id_actualiza;
	public $nombre_archivo;
    public $hora;
    public $fecha;
	public $peso;

	function __construct($id_actualiza, $nombre_archivo,$hora,$fecha,$peso)
	{
		$this->id_actualiza=$id_actualiza;
		$this->nombre_archivo=$nombre_archivo;
        $this->hora=$hora;
        $this->fecha=$fecha;
		$this->peso=$peso;
	}

	//función para obtener todos los actualizacions
	public static function all(){
		$listaActualizaciones =[];
		$db=Db::getConnect();
		$sql=$db->query('SELECT * FROM actualiza');
		foreach ($sql->fetchAll() as $actualizacion) {
			$listaActualizaciones[]= new Actualiza($actualizacion['id_actualiza'],$actualizacion['nombre_archivo'],$actualizacion['hora'],
                                                    $actualizacion['fecha'],$actualizacion['peso']);
		}
		return $listaActualizaciones;
	}

	//la función para registrar un actializacion
	public static function save($actualizacion){
			$db=Db::getConnect();
			$insert=$db->prepare('INSERT INTO actualiza VALUES(NULL,:nombre_archivo,:hora,:fecha,:peso)');
			$insert->bindValue('nombre_archivo',$actualizacion->nombre_archivo);
            $insert->bindValue('hora',$actualizacion->hora);
			$insert->bindValue('fecha',$actualizacion->fecha);
			$insert->bindValue('peso',$actualizacion->peso);
			$insert->execute();
		}

	//la función para actualizar
	// public static function update($actualizacion){
	// 	$db=Db::getConnect();
	// 	$update=$db->prepare('UPDATE actualiza SET descripcion=:descripcion WHERE cod_actualizacion=:cod_actualizacion');
	// 	$update->bindValue('cod_actualizacion',$actualizacion->cod_actualizacion);
	// 	$update->bindValue('descripcion',$actualizacion->descripcion);
	// 	$update->bindValue('descripcion',$area->area);
	// 	$update->execute();
	// }

	// // la función para eliminar por el id
	// public static function delete($cod_actualizacion){
	// 	$db=Db::getConnect();
	// 	$delete=$db->prepare('DELETE FROM actualizacion WHERE cod_actualizacion=:cod_actualizacion');
	// 	$delete->bindValue('cod_actualizacion',$cod_actualizacion);
	// 	$delete->execute();
	// }

	//la función para obtener un actualizacion por el id
	public static function getByUpdate($cod_actualizacion){
		$db=Db::getConnect();
		$select=$db->prepare('SELECT * FROM actualiza WHERE nombre_archivo =: nombre_archivo AND hora =: hora AND fecha =: fecha and peso =: peso');
        $select->bindValue('nombre_archivo',$nombre_archivo);
        $select->bindValue('hora',$hora);
        $select->bindValue('fecha',$fecha);
		$select->bindValue('peso',$peso);
		$select->execute();
		$actualizacionDb=$select->fetch();
		$actualizacion= new Actualiza($actualizacionDb['id_actualiza'],$actualizacionDb['nombre_archivo'],$actualizacionDb['hora'],$actualizacionDb['fecha'],$actualizacionDb['peso']);
		return $actualizacion;
	}

	public static function get_fam_tipo($area,$ambos=NULL){
		$listaactualizacions =[];
		$db=Db::getConnect();
		$select=$db->prepare('SELECT * FROM actualizacion WHERE area = :area or area = :ambos ORDER BY cod_actualizacion');
		$select->bindValue("area",$area);
		$select->bindValue("ambos",$ambos);
		$select->execute();
		foreach ($select->fetchAll() as $actualizacion) {
			$listaactualizacions[]= new actualizacion($actualizacion['cod_actualizacion'],$actualizacion['descripcion'],$actualizacion['area']);
		}
		return $listaactualizacions;

	}

}
?>
