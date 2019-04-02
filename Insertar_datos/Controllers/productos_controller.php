<?php
	class ProductosController
	{
		public $codingre_class;
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
			$productos=Productos::getByFam($cod_fam);

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
		public function search_prod_fam($familia){
			$productos=Productos::getByFam($familia);
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
			Productos::save($producto);
			header('Location: ../index.php');
		}

		public function update($producto){
			Productos::update($producto);
			header('Location: ../index.php?controller=producto&action=index');
		}

		public function delete($id){
			//se está de dentro del directorio Controllers y se debe salir con ../
			require_once('../Models/productos.php');
			Productos::delete($id);
			//ProductoController::index();
			header('Location: ../Views/Producto/index.php');
		}

		public function error(){
			require_once('Views/Producto/error.php');
		}
	}


	//obtiene los datos del usuario desde la vista y redirecciona a ProductoController.php
	if (isset($_POST['action'])) {
		$productoController= new ProductosController();
		//se añade el archivo producto.php
		require_once('../Models/productos.php');

		//se añade el archivo para la conexion
		require_once('../connection.php');

		if ($_POST['action']=='register') {
			$producto= new Productos($_POST['codingre'],$_POST['descrip'],$_POST['familia'],
															$_POST['unidad'],$_POST['empaque'],$_POST['equivale'],
															$_POST['inventa1'],$_POST['stockmax'],$_POST['ultcosto'],
														  $_POST['costoprome'],$_POST['impuesto'],$_POST['pedido'],
														  $_POST['estatus']);
			$productoController->save($producto);
			header('Location: ../index.php?controller=producto&action=index');
		}elseif ($_POST['action']=='update') {
			$producto= new Productos($_POST['codingre'],$_POST['descrip'],$_POST['familia'],
															 $_POST['unidad'],$_POST['empaque'],$_POST['equivale'],
															 $_POST['inventa1'],$_POST['stockmax'],$_POST['ultcosto'],
														   $_POST['costoprome'],$_POST['impuesto'],$_POST['pedido'],
														   $_POST['estatus']);
			$productoController->update($producto);
		}elseif ($_POST['action']=='search_prod'){
			header('Location: ../index.php?controller=producto&action=search_prod_fam');
		}elseif($_POST['action']=='pedido'){
			$productoController->realizar_pedido($_POST['familia'],$_POST['modificados'],$_POST['costo_total']);
		}
	}

	//se verifica que action esté definida
	if (isset($_GET['action'])) {
		if ($_GET['action']!='register'&$_GET['action']!='index'&$_GET['action']!='search_prod'&$_GET['action']!='search_prod_fam') {
			require_once('../connection.php');
			$productoController=new ProductosController();
			//para eliminar
			if ($_GET['action']=='delete') {
				$productoController->delete($_GET['codingre']);
				header('Location: ../index.php?controller=producto&action=index');
			}elseif ($_GET['action']=='update') {//mostrar la vista update con los datos del registro actualizar
				require_once('../Models/producto.php');
				$producto=Productos::getById($_GET['codingre']);
				require_once('../Views/Producto/update.php');
			}
		}
	}
?>
