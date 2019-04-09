<?php
	session_start();
	if(isset($_SESSION["id_sesion"])){
		echo ('Sesion iniciada: '.$_SESSION["id_sesion"]);
?>

		<!DOCTYPE html>
		<html>
		<head>
			<title>A&B</title>
			<meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'/>
  			<link rel="stylesheet" href="Public/bootstrap/css/bootstrap.min.css"/>
			<link rel="stylesheet" href="Public/bootstrap/bootstrap_3.3.6/bootstrap.min.css">
			<link rel="stylesheet" href="Public/css/logos.css"/>
			<link href="Public/open-iconic-master/font/css/open-iconic.css" rel="stylesheet">
		</head>
		<body>
			<?php
			switch($_SESSION["id_sesion"]){
				// case "root":
				// 		require_once("Views/partials/header_admin.php");
				// 		break;
				case "gerente":
						header("Location: ".$_SESSION["ruta"]."?controller=pedido&action=ver_pedidos");
						break;
				case "almacenista":
					header("Location: ".$_SESSION["ruta"]."?controller=pedido&action=recibir_pedido");
						break;
				case "cocina":
					header("Location: ".$_SESSION["ruta"]."?controller=producto&action=search_prod");
						break;
				// case "gerente":
				// 	header("Location: ".$_SESSION["ruta"]."?controller=pedido&action=ver_pedidos");
				// 		break;
				case "administrador":
					header("Location: ".$_SESSION["ruta"]."?controller=usuario&action=register");
						break;
				case "barra":
					header("Location: ".$_SESSION["ruta"]."?controller=producto&action=search_prod_bar");
						break;
				case "root":
					header("Location: ../?controller=usuario&action=register");
						break;
				default:
					header("Location: ?controller=usuario&action=error_cargo");
						break;
			}
			?>

	 	<?php require_once('routes.php');?>
			<script src='Public/jquery/jquery-3.3.1.min.js'></script>
			<!-- <script src='Public/bootstrap-3.3.6/dist/js/bootstrap.min.js'></script> -->
			</body>
			</html>
<?php
	}else{
		//Inclur una pagina para redireccionar a index
		require_once('Views/sesion/formulario.php');
	}
	?>
