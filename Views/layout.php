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
	<!-- <link rel="stylesheet" href="Public/bootstrap-3.3.6/dist/css/bootstrap.min.css"/> -->
  <link rel="stylesheet" href="Public/bootstrap/css/bootstrap.min.css"/>
	<link rel="stylesheet" href="Public/bootstrap/bootstrap_3.3.6/bootstrap.min.css">
  <link rel="stylesheet" href="..Public/css/style.css">
	<link href="Public/open-iconic-master/font/css/open-iconic.css" rel="stylesheet">
</head>
<body>
			<?php
			switch($_SESSION["id_sesion"]){
			case "almacenista":
				 require_once("Views/partials/header_recibe_pedido.php");
					break;
			case "cocina":
				 require_once("Views/partials/header_realiza_pedido.php");
					break;
			case "gerente":
					require_once("Views/partials/header_autoriza_pedido.php");
					break;
			case "administrador":
					require_once("Views/partials/header_admin.php");
					break;
			case "barra":
					require_once("Views/partials/header_realiza_pedido_barra.php");
					break;
			}
			?>

	<?php require_once('routes.php');
	}else{
		//Inclur una pagina para redireccionar a index
	header('Location: Views/sesion/formulario.php');
	}
	?>
		<script src='Public/jquery/jquery-3.3.1.min.js'></script>
		<script src='Public/bootstrap-3.3.6/dist/js/bootstrap.min.js'></script>
</body>
</html>
