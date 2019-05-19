<?php

class Actualiza
{

	public $id_actualiza;
	public $nombre_archivo;
    public $hora;
    public $fecha;
	public $peso;
	public $estado;

	function __construct($id_actualiza, $nombre_archivo,$hora,$fecha,$peso,$estado)
	{
		$this->id_actualiza	  =	$id_actualiza;
		$this->nombre_archivo =	$nombre_archivo;
        $this->hora	 = $hora;
        $this->fecha = $fecha;
		$this->peso	 = $peso;
		$this->estado= $estado;
	}

	//función para obtener todos los actualizacions
	public static function all(){
		$listaActualizaciones =[];
		$db=Db::getConnect();
		$sql=$db->query('SELECT * FROM actualiza');
		foreach ($sql->fetchAll() as $actualizacion) {
			$listaActualizaciones[]= new Actualiza($actualizacion['id_actualiza'],$actualizacion['nombre_archivo'],$actualizacion['hora'],
                                                    $actualizacion['fecha'],$actualizacion['peso'],$actualizacio["estado"]);
		}
		return $listaActualizaciones;
	}

	//la función para registrar un actializacion
	public static function save($actualizacion){
			$db=Db::getConnect();
			$insert=$db->prepare('INSERT INTO actualiza VALUES(NULL,:nombre_archivo,:hora,:fecha,:peso,:estado)');
			$insert->bindValue('nombre_archivo',$actualizacion->nombre_archivo);
            $insert->bindValue('hora',$actualizacion->hora);
			$insert->bindValue('fecha',$actualizacion->fecha);
			$insert->bindValue('peso',$actualizacion->peso);
			$insert->bindValue('estado',$actualizacion->estado);
			$insert->execute();

		return true;
	}

	//la función para obtener un actualizacion por el id
	public static function check_actualizacion($nombre_archivo,$hora,$fecha,$peso,$estado){
		$db=Db::getConnect();
		$select=$db->prepare('	SELECT 	* FROM actualiza
								WHERE 	nombre_archivo = :nombre_archivo
								AND 	hora = :hora
								AND 	fecha = :fecha
								AND 	peso = :peso');
        $select->bindValue('nombre_archivo',$nombre_archivo);
        $select->bindValue('hora',	$hora);
        $select->bindValue('fecha',	$fecha);
		$select->bindValue('peso',	$peso);
		$select->execute();
		$actualizacionDb = $select->fetch();
		// $actualizacion= new Actualiza($actualizacionDb['id_actualiza'],$actualizacionDb['nombre_archivo'],$actualizacionDb['hora'],$actualizacionDb['fecha'],$actualizacionDb['peso']);
		// return $actualizacio;
		if(empty($actualizacionDb)){
			return false;
		}else{
			return true;
		}
	}


	// public static function get_info_archivo($ruta,$nombre_archivo){
	public static function get_info_archivo($ruta_and_csv_ocompra){

		if(file_exists($ruta_and_csv_ocompra)){
			$id_actualiza 	= NULL;
			$nombre_archivo = basename($ruta_and_csv_ocompra);
			$fecha 	= date("Y-m-d",filemtime($ruta_and_csv_ocompra));
			$hora 	= date("H:i:s",filemtime($ruta_and_csv_ocompra));
			$tam 	= filesize($ruta_and_csv_ocompra);
			$estado = NULL;
			$ObjActualiza = new Actualiza($id_actualiza, $nombre_archivo,$hora,$fecha,$tam,$estado);
			return $ObjActualiza;
		}else{
			return false;
		}
	}

	public static function insert_actualizacion_metodo($ruta_and_csv_ocompra){

		if(file_exists($ruta_and_csv_ocompra)){
			require_once("../Config/config.php");
			require_once("actualiza.php");

			$ObjActualiza = Actualiza::get_info_archivo($ruta_and_csv_ocompra);
			$existe = Actualiza::check_actualizacion(	$ObjActualiza->nombre_archivo, 	$ObjActualiza->hora,
														$ObjActualiza->fecha, 			$ObjActualiza->peso,
														$ObjActualiza->estado);

			if($existe == true){
				$arrayActualiza = array("actualiza" => 'false', 'hora' => $ObjActualiza->hora, 'fecha' => $ObjActualiza->fecha);
				return $arrayActualiza;
			}else{
				$arrayActualiza = array("actualiza" => 'true', 'hora' => $ObjActualiza->hora, 'fecha' => $ObjActualiza->fecha);
				$inserta = Actualiza::save($ObjActualiza);
				return $arrayActualiza;
			}
		}else{
			return false;
		}
	}

	public static function actualiza_estado($estado){

		$db = Db::getConnect();
		$select = $db->query('SELECT MAX(id_actualiza) AS id_actualiza FROM actualiza');
		$resultados = $select->fetch();
		$max_id = $resultados['id_actualiza'];

		$db = Db::getConnect();
		$select = $db->prepare('UPDATE actualiza SET estado = :estado WHERE id_actualiza = :max_id');
		$select->bindValue('estado',$estado);
	    $select->bindValue('max_id',$max_id);
		$select->execute();
	}

	public static function get_estado(){

		$db = Db::getConnect();
		$select = $db->query("SELECT MAX(id_actualiza) as id_actualiza FROM actualiza");
		$resultados = $select->fetch();
		$max_id = $resultados['id_actualiza'];

		$db = Db::getConnect();
		$select=$db->prepare("SELECT estado from actualiza WHERE id_actualiza = :max_id");
		$select->bindValue("max_id" , $max_id);
		$select->execute();
		$resultados=$select->fetch();

		return $resultados['estado'];
	}

}//End Class
?>
