<?php

	class FamiliaController
	{
		public function __construct(){}

		public function index(){
			$familias=Familia::all();
			require_once('Views/Familia/index.php');
		}

		public function register(){
			require_once('Views/Familia/register.php');
		}

		public function save($familia){
			Familia::save($familia);
			header('Location: ../index.php?controller=familia&action=register');
		}

		public function update($familia){
			Familia::update($familia);
			header('Location: ../index.php?controller=familia&action=index');
		}

		public function delete($id){
			//se está de dentro del directorio Controllers y se debe salir con ../
			require_once('../Models/familia.php');
			Familia::delete($id);
			header('Location: ../index.php?controller=familia&action=index');
		}

		public function error(){
			require_once('Views/Familia/error.php');
		}
	}


	//obtiene los datos del usuario desde la vista y redirecciona a UsuarioController.php
	if (isset($_POST['action'])) {
		$familiaController= new FamiliaController();
		require_once('../Models/familia.php');
		require_once('../Config/connection.php');
		if ($_POST['action']=='register') {
			$familia= new Familia($_POST['cod_familia'],$_POST['descripcion']);
			$familiaController->save($familia);
		}elseif ($_POST['action']=='update') {
			$familia= new Familia($_POST['cod_familia'],$_POST['descripcion']);
			$familiaController->update($familia);
		}
	}

	//se verifica que action esté definida
	if (isset($_GET['action'])) {
		if ($_GET['action']!='register'&$_GET['action']!='index') {
			require_once('../Config/connection.php');
			$familiaController=new FamiliaController();
			//para eliminar
			if ($_GET['action']=='delete') {
				$familiaController->delete($_GET['cod_familia']);
			}elseif ($_GET['action']=='update') {//mostrar la vista update con los datos del registro actualizar
				require_once('../Models/familia.php');
				$familia=Familia::getById($_GET['cod_familia']);
				//var_dump($usuario);
				//$usuarioController->update();
				require_once('../Views/Familia/update.php');
			}
		}
	}
?>
