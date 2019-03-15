<?php

	class RelacionController
	{
		public function __construct(){}

		public function index(){
			$relaciones=Relacion::all();
			require_once('Views/Relacion/index.php');
		}

		public function register(){
			require_once('Views/Relacion/register.php');
		}

		public function save($relacion){
			Relacion::save($relacion);
			header('Location: ../index.php');
		}

		public function update($relacion){
			Relacion::update($relacion);
			header('Location: ../index.php');
		}

		public function delete($id){
			require_once('../Models/relacion.php');
			Relacion::delete($id);
			header('Location: ../index.php');
		}

		public function error(){
			require_once('Views/Relacion/error.php');
		}
	}


	if (isset($_POST['action'])) {
		$relacionController= new RelacionController();
		require_once('../Models/relacion.php');
		require_once('../Config/connection.php');

		if ($_POST['action']=='register') {
			$relacion= new Relacion($_POST['id_pedido'],$_POST['codingre'],$_POST['fecha_pedido'],$_POST['hora_pedido'],$_POST['num_prod'],$_POST['estado_prod'],$_POST['Observacion']);
			$relacionController->save($relacion);

		}elseif ($_POST['action']=='update') {
			$relacion= new Relacion($_POST['id_pedido'],$_POST['codingre'],$_POST['fecha_pedido'],$_POST['hora_pedido'],$_POST['num_prod'],$_POST['estado_prod']);
			$relacionController->update($relacion);

		}elseif($_POST['action']=='updateRelation'){
			require_once('../Models/relacion.php');
			Relacion::updateProductsOrder($_POST['id_pedido'],$_POST['modificados']);
			require_once('../Models/pedido.php');
			Pedido::change_order_cost($_POST['id_pedido'],$_POST['costo_total']);
			header('Location: ../index.php?controller=pedido&action=ver_pedidos');
		}
	}

	//se verifica que action esté definida
	if (isset($_GET['action'])) {
		if ($_GET['action']!='register'&$_GET['action']!='index') {
			require_once('../Config/connection.php');
			$relacionController=new RelacionController();

			if ($_GET['action']=='delete') {
				$relacionController->delete($_GET['id']);
			//mostrar la vista update con los datos del registro actualizar
			}elseif ($_GET['action']=='update') {
				require_once('../Models/relacion.php');
				$relacion=Relacion::getById($_GET['id']);
				require_once('../Views/Relacion/update.php');
			}
		}
	}
?>
