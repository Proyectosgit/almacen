<?php
	header('Pragma: public');
	header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");                  // Date in the past
	header('Last-Modified: '.gmdate('D, d M Y H:i:s') . ' GMT');
	header('Cache-Control: no-store, no-cache, must-revalidate');     // HTTP/1.1
	header('Cache-Control: pre-check=0, post-check=0, max-age=0', false);    // HTTP/1.1
	header ("Pragma: no-cache");
	header("Expires: 0", false);

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
		$action='error';
	}
	//carga la vista layout.php
	require_once('Views/layout.php');
// }else{
	// header("Location: Public/formulario.php");
// }
?>
