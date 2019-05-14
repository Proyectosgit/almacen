<?php

class PedidoProducto
{

	public $id_pedido;
	public $fecha;
	public $hora;
	public $autoriza;
	public $solicita;
	public $estado;
	public $observaciones;
	public $unidad_medida;
	public $total_prod;
	public $costo_total;

	//constructor de la clase
	function __construct($id_pedido, $id_prod, $fecha_pedido, $hora_pedido, $num_prod, $estado_prod)
	{
		$this->id_pedido=$id_pedido;
		$this->id_prod=$id_prod;
		$this->fecha_pedido=$fecha_pedido;
		$this->hora_pedido=$hora_pedido;
		$this->num_prod=$num_prod;
		$this->estado_prod=$estado_prod;
	}

	public static function allPedidosProd(){
		$listaPedidosProd =[];
		$db=Db::getConnect();
		$sql=$db->query('SELECT * FROM pedido_producto');
		// carga en la $listaUsuarios cada registro desde la base de datos
		foreach ($sql->fetchAll() as $pedido) {
			$listaPedidosProd[]= new Pedido($pedido['id_pedido'],$pedido['id_prod'], $pedido['fecha_pedido'],
																	$pedido['num_prod'],$pedido['estado_prod']);
		}
		return $listaPedidosProd;
	}

	public static function change_order_status_relation($id_pedido,$estado_prod){
		$db=Db::getConnect();
		$sql=$db->prepare('UPDATE pedido_producto
						   SET estado_prod=:estado_prod
							WHERE id_pedido=:id_pedido');
		$sql->bindValue("estado_prod",$estado_prod);
		$sql->bindValue("id_pedido",$id_pedido);
		$sql->execute();
	}
}
?>
