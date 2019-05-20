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
			header('Location: ../?controller=usuario&action=index');
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
				//Actualiza datos ocompra
				require_once("../".$usuario->ruta."/Config/config.php");
				require_once("../".$usuario->ruta."/Config/connection.php");
				require_once("../".$usuario->ruta."/Models/producto.php");
				require_once("../".$usuario->ruta."/Models/actualiza.php");


				switch($_SESSION["id_sesion"]){
						case "almacenista":
							$actualizar = Actualiza::insert_actualizacion_metodo(PATH_CARGA_CSV_OCOMPRA);
							// exec('C:\psexec\PsExec.exe -d C:\xampp\php\php.exe -f C:\xampp\htdocs\almacen\Insertar_datos\cargar_db.php');
							header("Location: ../".$usuario->ruta."?controller=pedido&action=recibir_pedido");
						break;
						case "cocina":
							$actualizar = Actualiza::insert_actualizacion_metodo(PATH_CARGA_CSV_OCOMPRA);
							$_SESSION["fecha"] = $actualizar["fecha"];
							$_SESSION["hora"] = $actualizar["hora"];
							if($actualizar['actualiza']=='true'){
								exec('C:\psexec\PsExec.exe -d C:\xampp\php\php.exe -f C:\xampp\htdocs\almacen\\' . $usuario->ruta . '\Insertar_datos\cargar_db.php');
							}
							header("Location: ../".$usuario->ruta."?controller=producto&action=search_prod");
							// exec('C:\psexec\PsExec.exe -d C:\xampp\php\php.exe -f C:\xampp\htdocs\almacen\Insertar_datos\cargar_db.php');
						break;
						case "bodega":
							$actualizar = Actualiza::insert_actualizacion_metodo(PATH_CARGA_CSV_OCOMPRA);
							$_SESSION["fecha"] = $actualizar["fecha"];
							$_SESSION["hora"] = $actualizar["hora"];
							if($actualizar['actualiza']=='true'){
								exec('C:\psexec\PsExec.exe -d C:\xampp\php\php.exe -f C:\xampp\htdocs\almacen\\' . $usuario->ruta . '\Insertar_datos\cargar_db.php');
							}
							header("Location: ../".$usuario->ruta."?controller=producto&action=search_prod_bodega_menu");
							// exec('C:\psexec\PsExec.exe -d C:\xampp\php\php.exe -f C:\xampp\htdocs\almacen\Insertar_datos\cargar_db.php');
						break;
						case "gerente":
							$actualizar = Actualiza::insert_actualizacion_metodo(PATH_CARGA_CSV_OCOMPRA);
							$_SESSION["fecha"] = $actualizar["fecha"];
							$_SESSION["hora"] = $actualizar["hora"];
							if($actualizar['actualiza']=='true'){
								exec('C:\psexec\PsExec.exe -d C:\xampp\php\php.exe -f C:\xampp\htdocs\almacen\\' . $usuario->ruta . '\Insertar_datos\cargar_db.php');
							}
							header("Location: ../".$usuario->ruta."?controller=pedido&action=ver_pedidos");
							// exec('C:\psexec\PsExec.exe -d C:\xampp\php\php.exe -f C:\xampp\htdocs\almacen\Insertar_datos\cargar_db.php');
						break;
						case "administrador":
							$actualizar = Actualiza::insert_actualizacion_metodo(PATH_CARGA_CSV_OCOMPRA);
							$_SESSION["fecha"] = $actualizar["fecha"];
							$_SESSION["hora"] = $actualizar["hora"];
							if($actualizar['actualiza']=='true'){
								// exec('C:\psexec\PsExec.exe -d C:\xampp\php\php.exe -f C:\xampp\htdocs\almacen\3ra_ronda_angelopolis\Insertar_datos\cargar_db.php');
								exec('C:\psexec\PsExec.exe -d C:\xampp\php\php.exe -f C:\xampp\htdocs\almacen\\' . $usuario->ruta . '\Insertar_datos\cargar_db.php');
							}
							header("Location: ../".$usuario->ruta."?controller=usuario&action=register");
						break;
						case "barra":
							$actualizar = Actualiza::insert_actualizacion_metodo(PATH_CARGA_CSV_OCOMPRA);
							$_SESSION["fecha"] = $actualizar["fecha"];
							$_SESSION["hora"] = $actualizar["hora"];
							if($actualizar['actualiza']=='true'){
								exec('C:\psexec\PsExec.exe -d C:\xampp\php\php.exe -f C:\xampp\htdocs\almacen\\' . $usuario->ruta . '\Insertar_datos\cargar_db.php');
							}
							header("Location: ../".$usuario->ruta."?controller=producto&action=search_prod_bar");
							// exec('C:\psexec\PsExec.exe -d C:\xampp\php\php.exe -f C:\xampp\htdocs\almacen\Insertar_datos\cargar_db.php');
						break;
						case "root":
							header("Location: ../?controller=usuario&action=register");
						break;
						default:
							// header("Location: ?controller=usuario&action=error_cargo");
							header("Location: ../".$usuario->ruta."?controller=producto&action=search_prod_bar");
						break;
				}
				// Producto::carga_db();

			}else{
				header('Location: ../Views/sesion/no_sesion.php');
			}
		}//End elseif
	}

	//se verifica que action esté definida
	if (isset($_GET['action'])) {
		if ($_GET['action']!='register' & $_GET['action']!='index' & $_GET['action']!='error' & $_GET['action']!='cerrar') {
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
