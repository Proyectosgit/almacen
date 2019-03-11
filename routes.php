<?php
	//función que llama al controlador y su respectiva acción, que son pasados como parámetros
	function call($controller, $action){
		//importa el controlador desde la carpeta Controllers
		require_once('Controllers/' . $controller . '_controller.php');
		//crea el controlador
		switch($controller){
			case 'usuario':
				require_once('Models/usuario.php');
				$controller= new UsuarioController();
				break;
			case 'producto':
				require_once('Models/producto.php');
				$controller= new ProductoController();
				break;
			case 'familia':
				require_once('Models/familia.php');
				$controller= new FamiliaController();
				break;
			case 'pedido':
				require_once('Models/pedido.php');
				$controller= new PedidoController();
				break;
			case 'relacion':
				require_once('Models/relacion.php');
				$controller= new RelacionController();
				break;
		}
		//llama a la acción del controlador

		if(isset($_GET['argumento'])){
			$controller->{$action }($_GET['argumento']);
		}else{
			$controller->{$action }();
		}
	}

	//array con los controladores y sus respectivas acciones
	$controllers= array(
						'usuario'=>['index','register','error'],
						'producto'=>['index','register','search_prod','search_prod_fam','search_prod_bar','search_prod_barra','button_download_db'],
						'familia'=>['index','register'],
						'pedido'=>['index','register', 'recibir_pedidos','orderDate',"ver_autorizados","ver_pedido_autorizado","ver_pedido_cancelado",
												'ver_pedidos','ver_pedido_autorizado_todos','ver_pedido_cancelado_todos','error_order_db'],
						'relacion'=>['index','register']
						);

	//Paso de parametro $opcional
//	if(isset($_POST['argumento'])){
	//	$argumento=$_POST['argumento'];
//	}
	//verifica que el controlador enviado desde index.php esté dentro del arreglo controllers
	if (array_key_exists($controller, $controllers)) {
		//verifica que el arreglo controllers con la clave que es la variable controller del index exista la acción
		if (in_array($action, $controllers[$controller])) {
			//llama  la función call y le pasa el controlador a llamar y la acción (método) que está dentro del controlador
			call($controller, $action);
		}else{
			call('usuario', 'error');
		}
	}else{// le pasa el nombre del controlador y la pagina de error
		call('usuario', 'error');
	}
?>
