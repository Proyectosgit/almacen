<?php

class Pedido
{

	public $id_pedido;
	public $fecha_pedido;
	public $fecha_autoriza_cancela;
	public $hora;
	public $hora_autoriza_cancela;
	public $autoriza;
	public $solicita;
	public $estado;
	public $observaciones;
	public $unidad_medida;
	public $total_prod;
	public $costo_total;


	function __construct($id_pedido, $fecha_pedido, $fecha_autoriza_cancela, $hora, $hora_autoriza_cancela, $autoriza, $solicita, $estado, $observaciones, $unidad_medida, $total_prod, $costo_total){

		$this->id_pedido=$id_pedido;
		$this->fecha_pedido=$fecha_pedido;
		$this->fecha_autoriza_cancela=$fecha_autoriza_cancela;
		$this->hora=$hora;
		$this->hora_autoriza_cancela=$hora_autoriza_cancela;
		$this->autoriza=$autoriza;
		$this->solicita=$solicita;
		$this->estado=$estado;
		$this->observaciones=$observaciones;
		$this->unidad_medida=$unidad_medida;
		$this->total_prod=$total_prod;
		$this->costo_total=$costo_total;
	}

	//función para obtener todos los usuarios
	public static function all(){

		$listaPedidos =[];
		$db=Db::getConnect();
		$sql=$db->query('SELECT * FROM pedidos ORDER BY id_pedido DESC');
		foreach ($sql->fetchAll() as $pedido) {
			$listaPedidos[]= new Pedido($pedido['id_pedido'],$pedido['fecha_pedido'],$pedido['fecha_autoriza_cancela'],
										$pedido['hora'],$pedido['hora_autoriza_cancela'],$pedido['autoriza'],$pedido['solicita'],
										$pedido['estado'],$pedido['observaciones'],$pedido['unidad_medida'],
										$pedido['total_prod'],$pedido['costo_total']);
		}
		return $listaPedidos;
	}

	public static function ver_pedidos(){
/**Funcion que regresa los pedidos con estado de pedido, para autorizarlos,
*agregar filtro para que vea solo los de su almacen
**/
		$listaPedidos =[];
		$db=Db::getConnect();
		$sql=$db->prepare('SELECT * FROM pedidos WHERE estado=:estado ORDER BY id_pedido DESC');
		$sql->bindValue('estado','pedido');
		$sql->execute();

		foreach ($sql->fetchAll() as $pedido) {
			$listaPedidos[]= new Pedido($pedido['id_pedido'],$pedido['fecha_pedido'],$pedido['fecha_autoriza_cancela'],
										$pedido['hora'],$pedido['hora_autoriza_cancela'],$pedido['autoriza'],$pedido['solicita'],
										$pedido['estado'],$pedido['observaciones'],$pedido['unidad_medida'],
										$pedido['total_prod'],$pedido['costo_total']);
		}
		return $listaPedidos;
	}

	public static function autorizados(){

		$listaPedidos =[];
		$db=Db::getConnect();
		$sql=$db->query('SELECT *
										FROM pedidos
										WHERE estado="cancelado" and fecha="2019-02-20"
										ORDER BY id_pedido DESC');
		foreach ($sql->fetchAll() as $pedido) {
			$listaPedidos[]= new Pedido($pedido['id_pedido'],$pedido['fecha_pedido'],$pedido['fecha_autoriza_cancela'],
			 							$pedido['hora'],$pedido['hora_autoriza_cancela'],$pedido['autoriza'],$pedido['solicita'],
										$pedido['estado'],$pedido['observaciones'],$pedido['unidad_medida'],
										$pedido['total_prod'],$pedido['costo_total']);
		}
		return $listaPedidos;
	}


		public static function allPedido(){

		$listaPedidos =[];
		$db=Db::getConnect();
		$sql=$db->query('SELECT * FROM pedidos ORDER BY id_pedido DESC');
		foreach ($sql->fetchAll() as $pedido) {
			$listaPedidos[]= new Pedido($pedido['id_pedido'],$pedido['fecha_pedido'],$pedido['fecha_autoriza_cancela'],
			 							$pedido['hora'],$pedido['hora_autoriza_cancela'],$pedido['autoriza'],$pedido['solicita'],
										$pedido['estado'],$pedido['observaciones'],$pedido['unidad_medida'],
										$pedido['total_prod'],$pedido['costo_total']);
		}
		return $listaPedidos;
	}


	//la función para registrar un usuario
	public static function save($pedido){

			$db=Db::getConnect();
			$insert=$db->prepare('INSERT INTO pedidos
								  VALUES(NULL,:fecha_pedido,:fecha_autoriza_cancela,:hora,:hora_autoriza_cancela,:autoriza,
											  :solicita,:estado,:observaciones,:unidad_medida,
											  :total_prod,:costo_total)');
			$insert->bindValue('fecha_pedido',$pedido->fecha_pedido);
			$insert->bindValue('fecha_autoriza_cancela',$pedido->fecha_autoriza_cancela);
			$insert->bindValue('hora',$pedido->hora);
			$insert->bindValue('hora_autoriza_cancela',$pedido->hora_autoriza_cancela);
			$insert->bindValue('autoriza',$pedido->autoriza);
			$insert->bindValue('solicita',$pedido->solicita);
			$insert->bindValue('estado',$pedido->estado);
			$insert->bindValue('observaciones',$pedido->observaciones);
			$insert->bindValue('unidad_medida',$pedido->unidad_medida);
			$insert->bindValue('total_prod',$pedido->total_prod);
			$insert->bindValue('costo_total',$pedido->costo_total);
			$insert->execute();
			$last_id=$db->lastInsertId();
			return $last_id;
		}

	//la función para actualizar
	public static function update($pedido){

		$db=Db::getConnect();
		$update=$db->prepare('UPDATE pedidos
							  SET fecha_pedido=:fecha_pedido, fecha_autoriza_cancela=:fecha_autoriza_cancela, hora=:hora,hora_autoriza_cancela=:hora_autoriza_cancela, autoriza=:autoriza,
								solicita=:solicita, estado=:estado, observaciones=:observaciones,
								unidad_medida=:unidad_medida, total_prod=:total_prod, costo_total=:costo_total
					 	      WHERE id_pedido=:id_pedido');
		$update->bindValue('id_pedido',$pedido->id_pedido);
		$update->bindValue('fecha_pedido',$pedido->fecha_pedido);
		$update->bindValue('fecha_autoriza_cancela',$pedido->fecha_autoriza_cancela);
		$update->bindValue('hora',$pedido->hora);
		$update->bindValue('hora_autoriza_cancela',$pedido->hora_autoriza_cancela);
		$update->bindValue('autoriza',$pedido->autoriza);
		$update->bindValue('solicita',$pedido->solicita);
		$update->bindValue('estado',$pedido->estado);
		$update->bindValue('observaciones',$pedido->observaciones);
		$update->bindValue('unidad_medida',$pedido->unidad_medida);
		$update->bindValue('total_prod',$pedido->total_prod);
		$update->bindValue('costo_total',$pedido->costo_total);
		$update->execute();
	}

	// la función para eliminar por el id
	public static function delete($id){

		$db=Db::getConnect();
		$delete=$db->prepare('DELETE FROM pedidos WHERE id_pedido=:id');
		$delete->bindValue('id',$id);
		$delete->execute();
	}

	//la función para obtener un usuario por el id
	public static function getById($id){

		$db=Db::getConnect();
		$select=$db->prepare('SELECT * FROM pedidos WHERE id_pedido=:id');
		$select->bindValue('id',$id);
		$select->execute();
		$pedidoDb=$select->fetch();
		$pedido= new Pedido($pedidoDb['id_pedido'],$pedidoDb['fecha_pedido'],$pedidoDb['fecha_autoriza_cancela'],$pedidoDb['hora'],$pedidoDb['hora_autoriza_cancela'],
		$pedidoDb['autoriza'],$pedidoDb['solicita'],$pedidoDb['estado'],$pedidoDb['observaciones']
		,$pedidoDb['unidad_medida'],$pedidoDb['total_prod'],$pedidoDb['costo_total']);

		return $pedido;
	}

	//Metodo que busca todos los productos correspodientes a un pedido
	public static function getOrderById($id){

		$db=Db::getConnect();
		$select=$db->prepare('SELECT pedidos.id_pedido, productos.codingre, pedidos.fecha_pedido, productos.descrip,
									 productos.inventa1,productos.stockmax,pedido_producto.num_prod, pedidos.costo_total,
									 productos.ultcosto
							FROM pedidos
							RIGHT OUTER JOIN pedido_producto ON pedidos.id_pedido = pedido_producto.id_pedido
							RIGHT OUTER JOIN productos ON pedido_producto.codingre = productos.codingre
							WHERE pedidos.id_pedido = :id');
		$select->bindValue('id',$id);
		$select->execute();
		return $select;
	  }

	  public static function pedidosProd($id){

		$db=Db::getConnect();
		$select=$db->prepare('SELECT pedidos.id_pedido,productos.codingre,pedidos.fecha_pedido, productos.descrip,
									 pedido_producto.num_prod
							FROM pedidos
							RIGHT OUTER JOIN pedido_producto ON pedidos.id_pedido = pedido_producto.id_pedido
							RIGHT OUTER JOIN productos ON pedido_producto.codingre = productos.codingre
							WHERE pedidos.id_pedido = :id');
		$select->bindValue('id',$id);
		$select->execute();

		return $select;
	  }

	  	//Busca pedidos por fecha y los muestra para el administrador
	public static function getOrderByDay($fecha){
		session_start();
		$listaPedidos=[];
		$db=Db::getConnect();
		//$select=$db->prepare('SELECT * FROM usuario WHERE ID=:id');
		$select=$db->prepare('SELECT *
							FROM pedidos
							WHERE fecha_pedido = :fecha ORDER BY id_pedido DESC' );
		$select->bindValue('fecha',$fecha);
		$select->execute();

			foreach ($select->fetchAll() as $pedido) {
				$listaPedidos[]= new Pedido($pedido['id_pedido'],$pedido['fecha_pedido'], $pedido['fecha_autoriza_cancela'],$pedido['hora'],$pedido['hora_autoriza_cancela'],
											$pedido['autoriza'],$pedido['solicita'],$pedido['estado'],
											$pedido['observaciones'],$pedido['unidad_medida'],$pedido['total_prod'],
											$pedido['costo_total']);
			}
			return $listaPedidos;
		}

			//Busca pedidos por mes para el administrador
		public static function getOrderByMonth($month){
			session_start();
			$listaPedidos=[];
			$db=Db::getConnect();
			//$select=$db->prepare('SELECT * FROM usuario WHERE ID=:id');
			$select=$db->prepare('SELECT *
								FROM pedidos
								WHERE MONTH(fecha_pedido) = :month ORDER BY id_pedido DESC');
			$select->bindValue('month',$month);
			$select->execute();

				foreach ($select->fetchAll() as $pedido) {
					$listaPedidos[]= new Pedido($pedido['id_pedido'],$pedido['fecha_pedido'],$pedido['fecha_autoriza_cancela'],
 												$pedido['hora'],$pedido['hora_autoriza_cancela'],$pedido['autoriza'],
												$pedido['solicita'],$pedido['estado'],$pedido['observaciones'],
												$pedido['unidad_medida'],$pedido['total_prod'],$pedido['costo_total']);
				}

			return $listaPedidos;
			}


			public static function getOrderByDayStatus($fecha_autoriza_cancela,$estado){
				session_start();
				$listaPedidos=[];
				$db=Db::getConnect();
				//$select=$db->prepare('SELECT * FROM usuario WHERE ID=:id');
				$select=$db->prepare('SELECT *
									FROM pedidos
									WHERE fecha_autoriza_cancela = :fecha_autoriza_cancela and estado = :estado and solicita = :solicita
									ORDER BY id_pedido DESC');
			  $select->bindValue('fecha_autoriza_cancela',$fecha_autoriza_cancela);
				$select->bindValue('estado',$estado);
				$select->bindValue('solicita',$_SESSION["nombre"]);
				$select->execute();

				foreach ($select->fetchAll() as $pedido) {
					$listaPedidos[]= new Pedido($pedido['id_pedido'],$pedido['fecha_pedido'],$pedido['fecha_autoriza_cancela'], $pedido['hora'],$pedido['hora_autoriza_cancela'],
												$pedido['autoriza'],$pedido['solicita'],$pedido['estado'],
												$pedido['observaciones'],$pedido['unidad_medida'],$pedido['total_prod'],
												$pedido['costo_total']);
				}

				return $listaPedidos;
				}

				public static function getOrderByMonthStatus($month,$estado){
					session_start();
					$listaPedidos=[];
					$solicita=$_SESSION["nombre"];
					$db=Db::getConnect();
					//$select=$db->prepare('SELECT * FROM usuario WHERE ID=:id');
					$select=$db->prepare('SELECT *
										FROM pedidos
										WHERE MONTH(fecha_autoriza_cancela) = :month and estado=:estado and solicita=:solicita
										ORDER BY id_pedido DESC');
					$select->bindValue('month',$month);
					$select->bindValue('estado',$estado);
					$select->bindValue('solicita',$solicita);
					$select->execute();

					foreach ($select->fetchAll() as $pedido) {
						$listaPedidos[]= new Pedido($pedido['id_pedido'],$pedido['fecha_pedido'],$pedido['fecha_autoriza_cancela'], $pedido['hora'],$pedido['hora_autoriza_cancela'],
													$pedido['autoriza'],$pedido['solicita'],$pedido['estado'],
													$pedido['observaciones'],$pedido['unidad_medida'],$pedido['total_prod'],
													$pedido['costo_total']);
					}

					return $listaPedidos;
					}

		public static function getOrderByDayStatus_all($fecha_autoriza_cancela,$estado){
			session_start();
			$listaPedidos=[];
			$autoriza=$_SESSION["nombre"];
			$db=Db::getConnect();
			//$select=$db->prepare('SELECT * FROM usuario WHERE ID=:id');
			$select=$db->prepare('SELECT *
								FROM pedidos
								WHERE fecha_autoriza_cancela = :fecha_autoriza_cancela and estado = :estado and autoriza = :autoriza
								ORDER BY id_pedido DESC');
		  $select->bindValue('fecha_autoriza_cancela',$fecha_autoriza_cancela);
			$select->bindValue('estado',$estado);
			$select->bindValue('autoriza',$autoriza);
			$select->execute();
			foreach ($select->fetchAll() as $pedido) {
				$listaPedidos[]= new Pedido($pedido['id_pedido'],$pedido['fecha_pedido'],$pedido['fecha_autoriza_cancela'], $pedido['hora'], $pedido['hora_autoriza_cancela'],
											$pedido['autoriza'],$pedido['solicita'],$pedido['estado'],
											$pedido['observaciones'],$pedido['unidad_medida'],$pedido['total_prod'],
											$pedido['costo_total']);
			}
			return $listaPedidos;
			}

			public static function getOrderByMonthStatus_all($month,$estado){
				session_start();
				$listaPedidos=[];
				$db=Db::getConnect();
				$autoriza=$_SESSION["nombre"];
				//$select=$db->prepare('SELECT * FROM usuario WHERE ID=:id');
				$select=$db->prepare('SELECT *
									FROM pedidos
									WHERE MONTH(fecha_autoriza_cancela) = :month and estado=:estado and autoriza=:autoriza
									ORDER BY id_pedido DESC');
				$select->bindValue('month',$month);
				$select->bindValue('estado',$estado);
				$select->bindValue('autoriza',$autoriza);
				$select->execute();

				foreach ($select->fetchAll() as $pedido) {
					$listaPedidos[]= new Pedido($pedido['id_pedido'],$pedido['fecha_pedido'],$pedido['fecha_autoriza_cancela'],$pedido['hora'],$pedido['hora_autoriza_cancela'],
												$pedido['autoriza'],$pedido['solicita'],$pedido['estado'],
												$pedido['observaciones'],$pedido['unidad_medida'],$pedido['total_prod'],
												$pedido['costo_total']);
				}

				return $listaPedidos;
				}
		public static function change_order_status($estado,$id_pedido){
			session_start();
			require_once("../Config/fecha.php");
			$autoriza=$_SESSION['nombre'];
			$fecha_autoriza_cancela = date("Y-m-d");
			$hora_autoriza_cancela = date("h:i:s");
			$db=Db::getConnect();
			$update=$db->prepare('UPDATE pedidos
								SET estado=:estado, autoriza=:autoriza, fecha_autoriza_cancela=:fecha_autoriza_cancela,
									hora_autoriza_cancela=:hora_autoriza_cancela
								WHERE id_pedido=:id_pedido');
			$update->bindValue('estado',$estado);
			$update->bindvalue('id_pedido',$id_pedido);
			$update->bindValue('autoriza',$autoriza);
			$update->bindValue('fecha_autoriza_cancela',$fecha_autoriza_cancela);
			$update->bindValue('hora_autoriza_cancela',$hora_autoriza_cancela);
			$update->execute();
		}


		public static function change_order_cost($id_pedido,$costo_total){
			$db=Db::getConnect();
			$update=$db->prepare('UPDATE pedidos
								SET costo_total=:costo_total
								WHERE id_pedido=:id_pedido');
			$update->bindValue('costo_total',$costo_total);
			$update->bindvalue('id_pedido',$id_pedido);
			$update->execute();
		}

		public static function get_id($conn){
		$conn->lastInsertId();
		}
}
?>
