<?php
// if(isset($_SESSION["id_sesion"])){
	 require_once('Config/connection.php');
	// la variable controller guarda el nombre del controlador y action guarda la acción por ejemplo registrar
	//si la variable controller y action son pasadas por la url desde layout.php entran en el if
	if (isset($_GET['controller'])&&isset($_GET['action'])) {
		$controller=$_GET['controller'];
		$action=$_GET['action'];
		if(isset($_GET['argumento'])){
			$argumento=$_GET['argumento'];
		}
	} else {
		$controller='usuario';
		$action='index';
	}
	//carga la vista layout.php
	require_once('Views/layout.php');
// }else{
	// header("Location: Public/formulario.php");
// }
?>
