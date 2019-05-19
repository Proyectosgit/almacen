<?php

class Relacion
{

	public $id_pedido;
	public $codingre;
	public $fecha_pedido;
	public $hora_pedido;
	public $num_prod;
	public $estado_prod;
	public $observacion;

	function __construct($id_pedido, $codingre, $fecha_pedido, $hora_pedido, $num_prod, $estado_prod, $observacion){
		$this->id_pedido=$id_pedido;
		$this->codingre=$codingre;
		$this->fecha_pedido=$fecha_pedido;
		$this->hora_pedido=$hora_pedido;
		$this->num_prod=$num_prod;
		$this->estado_prod=$estado_prod;
		$this->observacion=$observacion;
	}

	//función para obtener todos los usuarios
	public static function all(){
		$listaRelaciones = [];
		$db = Db::getConnect();
		$sql = $db->query('SELECT * FROM pedido_producto');
		foreach ($sql->fetchAll() as $relacion){
			$listaRelaciones[] = new Relacion(	$relacion['id_pedido'],$relacion['codingre'], $relacion['fecha_pedido'],
											 	$relacion['hora_pedido'],$relacion['num_prod'],$relacion['estado_prod'],
										 	 	$relacion['observacion']);
		}
		return $listaRelaciones;
	}


	public static function save($relacion){

		$db=Db::getConnect();
		$insert=$db->prepare('	INSERT INTO pedido_producto
							 	VALUES(	:id_pedido,:codingre,:fecha_pedido,
									 	:hora_pedido,:num_prod,:estado_prod,
										:observacion)	');
		$insert->bindValue('id_pedido',$relacion->id_pedido);
		$insert->bindValue('codingre',$relacion->codingre);
		$insert->bindValue('fecha_pedido',$relacion->fecha_pedido);
		$insert->bindValue('hora_pedido',$relacion->hora_pedido);
		$insert->bindValue('num_prod',$relacion->num_prod);
		$insert->bindValue('estado_prod',$relacion->estado_prod);
		$insert->bindValue('observacion',$relacion->observacion);
		$insert->execute();
	}


	public static function update($relacion){
		$db = Db::getConnect();
		$update = $db->prepare('UPDATE	pedido_producto
								SET 	codingre=:codingre, fecha_pedido=:fecha_pedido,	hora_pedido=:hora_pedido,
								    	num_prod=:num_prod,estado_prod=:estado_prod, observacion=:observacion
								WHERE 	id_pedido=:id_pedido');
		$update->bindValue('id_pedido',		$relacion->id_pedido);
		$update->bindValue('codingre',		$relacion->codingre);
		$update->bindValue('fecha_pedido',	$relacion->fecha_pedido);
		$update->bindValue('hora_pedido',	$relacion->hora_pedido);
		$update->bindValue('num_prod',		$relacion->num_prod);
		$update->bindValue('estado_prod',	$relacion->estado_prod);
		$update->bindValue('observacion',	$relacion->observacion);
		$update->execute();
	}

	public static function updateProductsOrder($id_pedido,$modificados){

		$db=Db::getConnect();
		if(!empty($modificados)){
			$lista_productos=[];
			$lista_cantidad=[];
			$datos_modificados = explode(" ",$_POST['modificados']);
			for($i=0; $i< count($datos_modificados)-1; $i++){
				$id_and_cantidad=explode(':',$datos_modificados[$i]);
				$lista_productos[]=$id_and_cantidad[0];
				$lista_cantidad[]=$id_and_cantidad[1];
			}

		    for($i=0; $i<count($lista_productos); $i++){

				$update=$db->prepare('	UPDATE pedido_producto
										SET num_prod=:num_prod
		    							WHERE id_pedido=:id_pedido AND codingre=:codingre');
		    				$update->bindValue('id_pedido',$id_pedido);
		    	$update->bindValue('codingre',$lista_productos[$i]);
		    	// $update->bindValue('fecha_pedido',$relacion->fecha_pedido);
		    	// $update->bindValue('hora_pedido',$relacion->hora_pedido);
		    	$update->bindValue('num_prod',$lista_cantidad[$i]);
		    	// $update->bindValue('estado_prod',$relacion->estado_prod);
		    	$update->execute();
		    	// echo "Me ejecuto con normalidad";
			}
		}
	}//End Function updateProductsOrder

	public static function delete($id){
		$db=Db::getConnect();
		$delete=$db->prepare('DELETE FROM pedido_producto WHERE id_pedido=:id');
		$delete->bindValue('id',$id);
		$delete->execute();
	}

	public static function getById($id){

		$db=Db::getConnect();
		$select=$db->prepare('SELECT * FROM pedido_producto WHERE id_pedido=:id');
		$select->bindValue('id',$id);
		$select->execute();
		//asignarlo al objeto usuario
		$relacionDb=$select->fetch();
		$relacion= new Relacion($relacionDb['id_pedido'],$relacionDb['codingre'],$relacionDb['fecha_pedido'],
								$relacionDb['hora_pedido'],$relacionDb['num_prod'],$relacionDb['estado_prod'],
								$relacionDb['observacion']);
		return $relacion;
	}
}
?>
