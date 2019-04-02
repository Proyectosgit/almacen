<?php
	class ProductoController
	{
		public $cod_fam_class;
		public function __construct(){}

		public function index(){
			//echo 'index desde UsuarioController';
			$productos=Producto::all();
			require_once('Views/Producto/index.php');
		}

		public function realizar_pedido($cod_fam,$modificados,$costo_total){
			require_once('../Models/pedido.php');
			require_once('../Models/relacion.php');
			require_once('../Config/fecha.php');

			$fecha = date("Y-m-d");
			$hora = date("h:i:s");
			$autoriza=NULL;
			$solicita='ivan';
			$estado='no surtido';
			$observaciones=NULL;
			$unidad_medida='pieza';//Cambiar por costo_total
			$total_prod=$_POST['total_prod'];
			$costo_total=$_POST['costo_total'];
			//Crea Objeto pedido y lo pasa a el metodo save
			$pedido= new Pedido(NULL,$fecha,$hora,$autoriza,$solicita,$estado,$observaciones,$unidad_medida,$total_prod,$costo_total);

			//Variables para la relacion entre producto y pedido
			$id_pedido=Pedido::save($pedido);
			$fecha_pedido=$pedido->fecha;
			$hora_pedido=$pedido->hora;
			$estado_prod='no surtido';
			//Objeto con los productos por familia
			$productos=Producto::getByFam($cod_fam);

			if(isset($_POST['modificados'])){
			    if(!empty($_POST['modificados'])){
			      $lista_productos=[];
			      $lista_cantidad=[];
			      $datos_modificados = explode(" ",$_POST['modificados']);
			          for($i=0; $i< count($datos_modificados)-1; $i++){
			            $id_and_cantidad=explode(':',$datos_modificados[$i]);
			            $lista_productos[]=$id_and_cantidad[0];
			            $lista_cantidad[]=$id_and_cantidad[1];
			          }

								//Guarda la relacion entre producto y pedido
					 		 foreach ($productos as $producto) {
								 $id_prod=$producto->id_prod;
								 if(in_array($id_prod,$lista_productos)){
									 $indice=array_search($id_prod,$lista_productos);
 									 //$num_prod=$producto->stock_max-$producto->existencia;
									 $num_prod=$lista_cantidad[$indice];
 									 $relacion=new Relacion($id_pedido,$id_prod,$fecha_pedido,$hora_pedido,$num_prod,$estado_prod);
 									 Relacion::save($relacion);
								 }
								 continue;
//									$id_prod=$producto->id_prod;
									 $num_prod=$producto->stock_max-$producto->existencia;
									 $relacion=new Relacion($id_pedido,$id_prod,$fecha_pedido,$hora_pedido,$num_prod,$estado_prod);
									 Relacion::save($relacion);
								}


			          print_r($lista_productos);
			          print_r($lista_cantidad);
			    }else{
								//Si la variable $_POST['modificados'] esta vacia se ejecuta esto
								echo "alert('post modificados esta vacia')";
								foreach ($productos as $producto) {
									$id_prod=$producto->id_prod;
									$num_prod=$producto->stock_max-$producto->existencia;
									$relacion=new Relacion($id_pedido,$id_prod,$fecha_pedido,$hora_pedido,$num_prod,$estado_prod);
									Relacion::save($relacion);
								}
			    }
			}
			header('Location: ../index.php?controller=pedido&action=index');
		}

		//public function search_prod_fam($cod_fam){
		public function search_prod_fam($cod_fam){
			$productos=Producto::getByFam($cod_fam);
      require_once('Views/Producto/search_prod_fam.php');
		}

		public function search_prod(){
			require_once('Views/Producto/search_prod.php');
			}

		public function register(){
			require_once('Views/Producto/register.php');
		}

			//guardar
		public function save($producto){
			Producto::save($producto);
			header('Location: ../index.php');
		}

		public function update($producto){
			Producto::update($producto);
			header('Location: ../index.php?controller=producto&action=index');
		}

		public function delete($id){
			//se está de dentro del directorio Controllers y se debe salir con ../
			require_once('../Models/producto.php');
			Producto::delete($id);
			//ProductoController::index();
			header('Location: ../Views/Producto/index.php');
		}

		public function error(){
			require_once('Views/Producto/error.php');
		}
	}


	//obtiene los datos del usuario desde la vista y redirecciona a ProductoController.php
	if (isset($_POST['action'])) {
		$productoController= new ProductoController();
		//se añade el archivo producto.php
		require_once('../Models/producto.php');

		//se añade el archivo para la conexion
		require_once('../connection.php');

		if ($_POST['action']=='register') {
			$producto= new Producto(null,$_POST['descripcion'],$_POST['cod_fam'],$_POST['existencia'],$_POST['precio_unitario'],$_POST['stock_min'],$_POST['stock_max'],$_POST['unidad_medida']);
			$productoController->save($producto);
			header('Location: ../index.php?controller=producto&action=index');
		}elseif ($_POST['action']=='update') {
			$producto= new Producto($_POST['id_prod'],$_POST['descripcion'],$_POST['cod_fam'],$_POST['existencia'],$_POST['precio_unitario'],$_POST['stock_min'],$_POST['stock_max'],$_POST['unidad_medida']);
			$productoController->update($producto);
		}elseif ($_POST['action']=='search_prod'){
			//$productos=Producto::getByFam($cod_fam);
			//$productoController->search_prod_fam($cod_fam);
			//$productoController->cod_fam_class=$_POST['cod_fam'];
			header('Location: ../index.php?controller=producto&action=search_prod_fam');
		}elseif($_POST['action']=='pedido'){
			$productoController->realizar_pedido($_POST['cod_fam'],$_POST['modificados'],$_POST['costo_total']);
			//$_POST['modificados'];
			//$_POST['costo_total'];
			//require_once('../Views/Producto/pruebas.php.');

		}
	}

	//se verifica que action esté definida
	if (isset($_GET['action'])) {
		if ($_GET['action']!='register'&$_GET['action']!='index'&$_GET['action']!='search_prod'&$_GET['action']!='search_prod_fam') {
			require_once('../connection.php');
			$productoController=new ProductoController();
			//para eliminar
			if ($_GET['action']=='delete') {
				$productoController->delete($_GET['id']);
				header('Location: ../index.php?controller=producto&action=index');
			}elseif ($_GET['action']=='update') {//mostrar la vista update con los datos del registro actualizar
				require_once('../Models/producto.php');
				$producto=Producto::getById($_GET['id']);
				//var_dump($usuario);
				//$usuarioController->update();
				require_once('../Views/Producto/update.php');
			}/*elseif($_GET['action']=='search_prod'){
				require_once('../connection.php');
				require_once('../Models/producto.php');
				$productoController=new ProductoController();
				$producto=Producto::getById($_GET['id']);
			}*/
		}
	}
?>
