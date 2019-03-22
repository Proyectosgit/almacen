		<?php

	class UsuarioController
	{
		public function __construct(){}

		public function formulario(){
			require_once('Views/sesion/formulario.php');
		}

		public function index(){
			$usuarios=Usuario::all();
			require_once('Views/Usuario/index.php');
		}

		public function register(){
			require_once('Views/Usuario/register.php');
		}

		public function save($usuario){
			Usuario::save($usuario);
			header('Location: ../index.php?controller=usuario&action=index');
		}

		public function update($usuario){
			Usuario::update($usuario);
			header('Location: ../index.php');
		}

		public function delete($id){
			require_once('../Models/usuario.php');
			Usuario::delete($id);
			header('Location: ?controller=usuario&action=index');
		}

		public function error(){
			require_once('Views/Usuario/error.php');
		}

		public function error_cargo(){
			require_once('Views/Usuario/error_cargo.php');
		}

		public function cerrar(){
			require_once('Views/sesion/cerrar_sesion.php');
		}
	}



	if (isset($_POST['action'])) {
		$usuarioController= new UsuarioController();
		require_once('../Models/usuario.php');
		require_once('../Config/connection.php');

		if ($_POST['action']=='register') {
			$usuario= new Usuario(null,$_POST['username'],$_POST['password'],$_POST['cargo'],
								$_POST['nombre'],$_POST['email'],$_POST['id_almacen'],$_POST['ruta']);
			$usuarioController->save($usuario);

		}elseif ($_POST['action']=='update') {
			$usuario= new Usuario($_POST['id_user'],$_POST['username'],$_POST['password'],$_POST['cargo'],
								$_POST['nombre'],$_POST['email'],$_POST['id_almacen'],$_POST['ruta']);
			$usuarioController->update($usuario);

		}elseif($_POST['action']=='login'){
			$usuario=Usuario::login($_POST["usuario"]);
			if($usuario->email==$_POST["usuario"] && $usuario->password==$_POST["password"] && ($_POST["usuario"] != "") && ($_POST["password"]!="") ){

		  	session_start();
				$_SESSION["id_sesion"] = $usuario->cargo;
				$_SESSION["nombre"] = $usuario->nombre;
				$_SESSION["ruta"] = $usuario->ruta;
				$_SESSION["visible"] = "true";
				echo $_SESSION['id_sesion'];
				switch($_SESSION["id_sesion"]){
						case "almacenista":
						header("Location: ../".$usuario->ruta."?controller=pedido&action=recibir_pedido");
						break;
						case "cocina":
						header("Location: ../".$usuario->ruta."?controller=producto&action=search_prod");
						break;
						case "gerente":
						header("Location: ../".$usuario->ruta."?controller=pedido&action=ver_pedidos");
						break;
						case "administrador":
						header("Location: ../".$usuario->ruta."?controller=usuario&action=register");
						break;
						case "barra":
						header("Location: ../".$usuario->ruta."?controller=producto&action=search_prod_bar");
						break;
						case "root":
						header("Location: ../?controller=usuario&action=register");
						break;
						default:
						header("Location: ../?controller=usuario&action=error_cargo");
						break;
				}
			}else{
				header('Location: ../Views/sesion/no_sesion.php');
			}
		}//End elseif
	}

	//se verifica que action esté definida
	if (isset($_GET['action'])) {
		if ($_GET['action']!='register' & $_GET['action']!='index' & $_GET['action']!='error') {
			require_once('../Config/connection.php');
			$usuarioController=new UsuarioController();
			if ($_GET['action']=='delete') {
				$usuarioController->delete($_GET['id']);

			}elseif ($_GET['action']=='update') {
				require_once('../Models/usuario.php');
				$usuario=Usuario::getById($_GET['id']);
				require_once('../Views/Usuario/update.php');
			}
		}
	}
?>
