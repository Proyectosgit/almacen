<?php

	class PedidoController{
		public function __construct(){}

		public function index(){
			$pedidos=Pedido::all();
			require_once('Views/Pedido/index.php');
		}

		public function ver_pedidos(){
			//require_once('Config/config.php');
			$pedidos=Pedido::ver_pedidos();
			require_once('Views/Pedido/ver_pedido.php');
		}

		// public function ver_autorizados(){
			// $pedidos=Pedido::autorizados();
			// require_once('Views/Pedido/index.php');
		// }

		public function ver_pedido_autorizado(){
			require_once('Config/config.php');
			require_once('Views/Pedido/search_order_date_kitchen_authorized.php');
		}

		public function ver_pedido_cancelado(){
			require_once('Config/config.php');
			require_once('Views/Pedido/search_order_date_kitchen_cancel.php');
		}

		public function ver_pedido_autorizado_todos(){
			require_once('Config/config.php');
			require_once('Views/Pedido/search_order_date_kitchen_authorized_all.php');
		}

		public function ver_pedido_cancelado_todos(){
			require_once('Config/config.php');
			require_once('Views/Pedido/search_order_date_kitchen_cancel_all.php');
		}

		public function recibir_pedidos($id){
			$select=Pedido::pedidosProd($id);
			require_once('Views/Almacenista/index.php');
		}

		public function orderDate(){
			require_once('Views/Pedido/search_order_date.php');
		}

		public function register(){
			require_once('Views/Pedido/register.php');
		}

		public function save($pedido){
			Pedido::save($pedido);
			header('Location: ../index.php?controller=pedido&action=register');
		}

		public function update($pedido){
			Pedido::update($pedido);
			header('Location: ../index.php?controller=pedido&action=index');
		}

		public function delete($id){
			require_once('../Models/pedido.php');
			Pedido::delete($id);
			header('Location: ../index.php?controller=pedido&action=index');
		}

		public function error(){
			require_once('Views/Pedido/error.php');
		}

		public function error_order_db(){
			require_once('Views/Pedido/error_order.php');
		}
	}

	//obtiene los datos del pedido desde la vista y redirecciona a PedidoController.php
	if (isset($_POST['action'])) {
		$pedidoController= new PedidoController();
		//se añade el archivo usuario.php
		require_once('../Models/pedido.php');

		//se añade el archivo para la conexion
		require_once('../Config/connection.php');

		if ($_POST['action']=='register') {
			$pedido= new Pedido(NULL,$_POST['fecha'],$_POST['hora'],$_POST['autoriza'],
															 $_POST['solicita'],$_POST['estado'],$_POST['observaciones'],
															 $_POST['unidad_medida'],$_POST['total_prod'],$_POST['costo_total']);
			$pedidoController->save($pedido);
		}elseif ($_POST['action']=='update') {
			$pedido= new Pedido($_POST['id_pedido'],$_POST['fecha'],$_POST['hora'],
													$_POST['autoriza'],$_POST['solicita'],$_POST['estado'],
													$_POST['observaciones'],$_POST['unidad_medida'],$_POST['total_prod'],
													$_POST['costo_total']);
			$pedidoController->update($pedido);
		}
	}

	//se verifica que action esté definida
	if (isset($_GET['action'])) {
		if ($_GET['action'] != 'register'&$_GET['action'] != 'index'&$_GET['action'] != 'recibir_pedidos'&$_GET['action'] != 'orderDate'
				&$_GET['action'] != 'ver_pedido'&$_GET['action'] != 'ver_pedido_autorizado'&$_GET['action'] != 'ver_pedido_cancelado' &$_GET['action'] != 'ver_pedidos'
				&$_GET['action'] != 'ver_pedido_autorizado_todos'&$_GET['action'] != 'ver_pedido_cancelado_todos'&$_GET['action'] != 'error_order_db'){

				require_once('../Config/connection.php');
				$pedidoController=new PedidoController();

			if ($_GET['action']=='delete') {
				$pedidoController->delete($_GET['id_pedido']);
				//mostrar la vista update con los datos del registro actualizar
			}elseif($_GET['action']=='update') {
				require_once('../Models/pedido.php');
				$pedido=Pedido::getById($_GET['id_pedido']);
				require_once('../Views/Pedido/update.php');
		//Obtiene los detalles del pedido
			}elseif($_GET['action']=='order'){
				require_once('../Models/pedido.php');
				$select=Pedido::getOrderById($_GET['id_pedido']);
				require_once('../Views/Pedido/order_prod.php');
			}elseif($_GET['action']=='register_order'){
				require_once('../Models/pedido.php');
				$select=Pedido::registerOrderById($_GET['fecha']);
				require_once('../Views/Pedido/register_prod.php');
			}elseif($_GET['action']=="change"){

				require_once("../Models/pedido.php");
				require_once("../Models/producto.php");
				require_once("../Models/pedido_prod.php");

				Pedido::change_order_status($_GET['estado'],$_GET['id_pedido']);

				$productos=Pedido::pedidosProd($_GET["id_pedido"]);
				Producto::ingresa_pedido_autorizado_cancelado($productos,$_GET['estado']);

				PedidoProducto::change_order_status_relation($_GET['id_pedido'],$_GET['estado']);
				//Genera el archivo csv y lo descarga
				$productos=Producto::all();
				Producto::create_csv_automatic($productos,NAME_CSV);

				if($_SESSION['id_sesion']=="administrador"){
					header("Location: ../?controller=pedido&action=index");
				}elseif($_SESSION['id_sesion']=="gerente"){
					header("Location: ../?controller=pedido&action=ver_pedidos");
				}

			}elseif($_GET['action']=="search_order_date"){
				require_once("../Models/pedido.php");
				if($_GET["tipo"]=="dia"){
					$select=Pedido::getOrderByDay($_GET['date']);
				}elseif($_GET["tipo"]=="mes"){
					$mes=explode("-",$_GET["date"]);
					$select=Pedido::getOrderByMonth($mes[1]);
				}
				require_once('../Views/pedido/show_order_date.php');
		//Obtiene los detalles del pedido del almacen
			}elseif($_GET['action']=="search_order_date_kitchen_authorized"){
				require_once("../Models/pedido.php");
				// require_once("../Config/config.php");
				if($_GET["tipo"]=="dia"){
					$select=Pedido::getOrderByDayStatus($_GET["date"],"autorizado");
				}elseif($_GET["tipo"]=="mes"){
					$mes=explode("-",$_GET["date"]);
					$select=Pedido::getOrderByMonthStatus($mes[1],"autorizado");
				}
				require_once('../Views/pedido/show_order_date.php');

			}elseif($_GET['action']=="search_order_date_kitchen_cancel"){
					require_once("../Models/pedido.php");
				if($_GET["tipo"]=="dia"){
					$select=Pedido::getOrderByDayStatus($_GET['date'],"cancelado");
				}elseif($_GET["tipo"]=="mes"){
					$mes=explode("-",$_GET["date"]);
					$select=Pedido::getOrderByMonthStatus($mes[1],"cancelado");
				}
				require_once('../Views/pedido/show_order_date.php');

			}elseif($_GET['action']=="search_order_date_kitchen_authorized_all"){
					require_once("../Models/pedido.php");
					if($_GET["tipo"]=="dia"){
						$select=Pedido::getOrderByDayStatus_all($_GET['date'],"autorizado");
					}elseif($_GET["tipo"]=="mes"){
						$mes=explode("-",$_GET["date"]);
						$select=Pedido::getOrderByMonthStatus_all($mes[1],"autorizado");
					}
					require_once('../Views/Pedido/show_order_date.php');

			}elseif($_GET['action']=="search_order_date_kitchen_cancel_all"){
					require_once("../Models/pedido.php");
					if($_GET["tipo"]=="dia"){
						$select=Pedido::getOrderByDayStatus_all($_GET['date'],"cancelado");
					}elseif($_GET["tipo"]=="mes"){
						$mes=explode("-",$_GET["date"]);
						$select=Pedido::getOrderByMonthStatus_all($mes[1],"cancelado");
				}
				require_once('../Views/Pedido/show_order_date.php');
		//Obtiene los detalles del pedido del almacen
			}elseif($_GET['action']=='order_almacen'){
				require_once('../Models/pedido.php');
				$select=Pedido::pedidosProd($_GET['id_pedido']);
				require_once('../Views/Pedido/order_prod_almacen.php');
			}
		}
	}
?>
