<?php
	class ProductoController
	{
		public $codingre_class;

		public function __construct(){}

		public function index(){
			$productos=Producto::all();
			require_once('Views/Producto/index.php');
		}

		public function realizar_pedido($cod_fam,$modificados,$costo_total,$observacion){

			set_time_limit(600);
			session_start();
			require_once('../Models/pedido.php');
			require_once('../Models/producto.php');
			require_once('../Models/relacion.php');
			require_once('../Config/fecha.php');

			$fecha_pedido = date("Y-m-d");
			$fecha_autoriza = NULL;
			$hora = date("h:i:s");
			$hora_autoriza_cancela = NULL;
			$autoriza = NULL;
			$solicita = $_SESSION["nombre"];
			$estado = 'pedido';
			$observaciones = NULL;
			$unidad_medida = '';//Cambiar por costo_total
			$total_prod = $_POST['total_prod'];
			$costo_total = $_POST['costo_total'];
			$familia = $cod_fam;
			//Crea Objeto pedido y lo pasa a el metodo save
			$pedidoObj= new Pedido(NULL,$fecha_pedido,$fecha_autoriza,$hora,$hora_autoriza_cancela,
								$autoriza,$solicita,$estado,$observaciones,$unidad_medida,$total_prod,
								$costo_total,$familia);
			print_r($pedidoObj);
			//Variables para la relacion entre producto y pedido
			$id_pedido = Pedido::save($pedidoObj);
			$fecha_pedido_relacion = $pedidoObj->fecha_pedido;
			$hora_pedido = $pedidoObj->hora;
			$estado_prod = 'pedido';
			//Objeto con los productos por familia
			$productos = Producto::getByFam($cod_fam);
			// print_r($productos);

			if(isset($_POST['modificados'])){
			    if(!empty($_POST['modificados'])){
					echo "entro0";
			      $lista_productos = [];
			      $lista_cantidad  = [];
			      $datos_modificados = explode(" ",$_POST['modificados']);
			          for($i=0; $i< count($datos_modificados)-1; $i++){
			            $id_and_cantidad=explode(':',$datos_modificados[$i]);
			            $lista_productos[]=$id_and_cantidad[0];
			            $lista_cantidad[]=$id_and_cantidad[1];
			          }
					  echo "paso a lista";
						//Guarda la relacion entre producto y pedido1
					 	foreach ($productos as $producto) {
							$codingre=$producto->codingre;
							// if($producto->inventa1 >=0 && $producto->inventa1 < $producto->stockmax){
							    if(in_array($codingre,$lista_productos)){
									$indice=array_search($codingre,$lista_productos);
									$pedido1=$lista_cantidad[$indice];
 									$relacion = new Relacion($id_pedido,$codingre,$fecha_pedido_relacion,$hora_pedido,$pedido1,$estado_prod,$observacion);
 									Relacion::save($relacion);
									Producto::change_order_status_db($estado_prod,$codingre);//Agrega estado a bd productos
									echo "entro para guardar modificados";
								}else{
										$pedido1=$producto->stockma1-$producto->inventa1;
											if($producto->redondeo == 1){
												$pedido1=ceil($pedido1);
											}elseif($producto->redondeo == 0){
												$pedido1=$pedido1;
											}

											if($pedido1>0 && $producto->inventa1>=0){
												$relacion=new Relacion($id_pedido,$codingre,$fecha_pedido_relacion,$hora_pedido,$pedido1,$estado_prod,$observacion);
												Relacion::save($relacion);
												Producto::change_order_status_db($estado_prod,$codingre);//Agrega estado a db productos
												echo "Entro1";
											}elseif ($producto->inventa1 < 0){
												$pedido1=$producto->stockma1 - 0;

												if($producto->redondeo == 1){
													$pedido1=ceil($pedido1);
												}elseif($producto->redondeo == 0){
													$pedido1=$pedido1;
												}
												if($pedido1>0){//Si el pedido es mayor a 0 lo guarda
													$relacion=new Relacion($id_pedido,$codingre,$fecha_pedido_relacion,$hora_pedido,$pedido1,$estado_prod,$observacion);
													Relacion::save($relacion);
													Producto::change_order_status_db($estado_prod,$codingre);//Agrega estado a db productos
													echo "Entro2";
												}
											}//Se agrega para validar existencias negativas

								  	}
								// }//End If filtro
						}//End for each
				}else{//Else si no esta vacia la variable modificados
					foreach ($productos as $producto) {
						// if($producto->inventa1 >=0 && $producto->inventa1 < $producto->stockmax){
							$codingre=$producto->codingre;
							$pedido1=$producto->stockma1-$producto->inventa1;

							if($producto->redondeo == 1){
								$pedido1=ceil($pedido1);
							}elseif($producto->redondeo == 0){
								$pedido1=$pedido1;
							}

						if($pedido1>0 && $producto->inventa1>=0){
							$relacion=new Relacion($id_pedido,$codingre,$fecha_pedido_relacion,$hora_pedido,$pedido1,$estado_prod,$observacion);
							Relacion::save($relacion);
							Producto::change_order_status_db($estado_prod,$codingre);//Agrega estado a db productos
							echo "Entro3";

						}elseif($producto->inventa1 < 0){

							$pedido1=$producto->stockma1 - 0;

							if($producto->redondeo == 1){
								$pedido1=ceil($pedido1);
							}elseif($producto->redondeo == 0){
								$pedido1=$pedido1;
							}
							if($pedido1>0){//Si el pedido es mayor a 0 lo guarda
								$relacion=new Relacion($id_pedido,$codingre,$fecha_pedido_relacion,$hora_pedido,$pedido1,$estado_prod,$observacion);
								Relacion::save($relacion);
								Producto::change_order_status_db($estado_prod,$codingre);//Agrega estado a db productos
								echo "Entro4";
							}
						}//Se agrega para validar existencias negativas
						// }
					}
				}

			return 0;
			}
			// if($_SESSION['id_sesion']=="barra"){
			// 	header('Location: ../index.php?controller=producto&action=search_prod_bar');
			// }else if($_SESSION['id_sesion']=="cocina"){
			// 	header('Location: ../index.php?controller=producto&action=search_prod');
			// }else if($_SESSION['id_sesion']=='gerente'){
			// 	header('Location: ../index.php?controller=pedido&action=ver_pedidos');
			// }
		}

		public function registra_pedido($modificados){
			session_start();
			require_once('../Models/pedido.php');
			require_once('../Models/relacion.php');
			require_once('../Config/fecha.php');

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
								 $codingre=$producto->codingre;
								 if(in_array($codingre,$lista_productos)){
									 $indice=array_search($codingre,$lista_productos);
									 //$num_prod=$producto->stock_max-$producto->existencia;
									 $num_prod=$lista_cantidad[$indice];
									 $relacion=new Relacion($id_pedido,$codingre,$fecha_pedido_relacion,$hora_pedido,$num_prod,$estado_prod,$observacion);
									 Relacion::save($relacion);
								 }else{
									 $num_prod=$producto->stockma1-$producto->inventa1;
									 $relacion=new Relacion($id_pedido,$codingre,$fecha_pedido_relacion,$hora_pedido,$num_prod,$estado_prod,$observacion);
									 Relacion::save($relacion);
								}
							}
					}else{
								//Si la variable $_POST['modificados'] esta vacia se ejecuta esto
								echo "alert('post modificados esta vacia')";
								foreach ($productos as $producto) {
									$codingre=$producto->codingre;
									$num_prod=$producto->stockma1-$producto->inventa1;
									$relacion=new Relacion($id_pedido,$codingre,$fecha_pedido_relacion,$hora_pedido,$num_prod,$estado_prod,$observacion);
									Relacion::save($relacion);
								}
					}
			}

				header('Location: ../index.php?controller=pedido&action=index');
		}

		public function redireccionar_cocina(){
			session_start();
			header('Location: ../index.php?controller=producto&action=search_prod');
		}

		public function redireccionar_barra(){
			session_start();
			header('Location: ../index.php?controller=producto&action=search_prod_bar');
		}

		//public function search_prod_fam($cod_fam){
		public function search_prod_fam($familia){
			$productos=Producto::getByFam($familia);
			require_once('Views/Producto/search_prod_fam.php');
		}

		public function search_prod_barra($familia){
			$productos=Producto::getByFam($familia);
			require_once('Views/Producto/search_prod_barra.php');
		}

		public function search_prod_bodega_resul($familia){
			$productos=Producto::getByFam($familia);
			require_once('Views/Producto/search_prod_bodega_resul.php');
		}

		public function search_prod(){
			require_once('Config/config.php');
			require_once('Models/familia.php');
			$listaFamilias = Familia::get_fam_tipo("cocina");
			require_once('Views/Producto/search_prod.php');
		}

		public function search_prod_bar(){
			require_once('Config/config.php');
			require_once('Models/familia.php');
			$listaFamilias = Familia::get_fam_tipo("barra");
			require_once('Views/Producto/search_prod_bar.php');
		}

		public function search_prod_bodega_menu(){
			require_once('Config/config.php');
			require_once('Models/familia.php');
			$listaFamilias = Familia::all();
			require_once('Views/Producto/search_prod_bodega_menu.php');
		}


		public function register(){
			require_once('Views/Producto/register.php');
		}

		public function save($producto){
			Producto::save($producto);
			header('Location: ../index.php');
		}

		public function update($producto){
			Producto::update($producto);
			header('Location: ../index.php?controller=producto&action=index');
		}

		public function delete($id){
			require_once('../Models/producto.php');
			Producto::delete($id);
			header('Location: ../Views/Producto/index.php');
		}

		public function error(){
			require_once('Views/Producto/error.php');
		}

		public function button_download_db(){
			require_once('Views/Producto/button_download_db.php');
		}

		public function download_db($name_file){
			$productos=Producto::all();
			Producto::create_csv($productos,$name_file);
			//require_once('Views/Producto/download.php');
		}

		public function carga_db_productos(){
			require_once('Config/config.php');
			require_once("Models/producto.php");
			Producto::carga_db();
		}
	}


	//obtiene los datos del usuario desde la vista y redirecciona a ProductoController.php
	if (isset($_POST['action'])) {
		$productoController= new ProductoController();
		require_once('../Models/producto.php');
		require_once('../Config/connection.php');

		if ($_POST['action']=='register') {
			$producto= new Producto(		$_POST['codingre'],$_POST['descrip'],$_POST['familia'],
											$_POST['unidad'],$_POST['empaque'],$_POST['equivale'],
											$_POST['inventa1'],$_POST['stockmax'],$_POST['stockmin'],
											$_POST['ultcosto'],$_POST['costoprome'],$_POST['impuesto'],
											$_POST['pedido'],$_POST['status']);
			$productoController->save($producto);
			header('Location: ../index.php?controller=producto&action=index');

		}elseif ($_POST['action']=='update') {
			$producto= new Producto($_POST['codingre'],$_POST['descrip'],$_POST['familia'],
															 $_POST['unidad'],$_POST['empaque'],$_POST['equivale'],
															 $_POST['inventa1'],$_POST['stockmax'],$_POST['stockmin'],
															 $_POST['ultcosto'],$_POST['costoprome'],$_POST['impuesto'],
															 $_POST['pedido'],$_POST['status']);
			$productoController->update($producto);

		}elseif($_POST['action']=='search_prod'){
			header('Location: ../index.php?controller=producto&action=search_prod_fam');

		}elseif($_POST['action']=='pedido'){
			// echo "<center><h1>Se esta realizando tu pedido</h1></center>";
			$resultado=$productoController->realizar_pedido($_POST['familia'],$_POST['modificados'],$_POST['costo_total'],$_POST['observacion']);
			if($resultado==0){
				// echo "<script>alert('Se realizo el pedido de forma exitosa!!!');</script>";
				if($_SESSION['id_sesion']=="barra"){
					header('Location: ../index.php?controller=producto&action=search_prod_bar');

				}else if($_SESSION['id_sesion']=="cocina"){
					header('Location: ../index.php?controller=producto&action=search_prod');

				}else if($_SESSION['id_sesion']=='gerente'){
					header('Location: ../index.php?controller=pedido&action=ver_pedidos');

				}else if($_SESSION['id_sesion']=='administrador'){
					header('Location: ../index.php?controller=pedido&action=ver_pedidos');

				}
			}else{
				// echo "<script>alert('Error: No se realizo el pedido, intenta nuevamente o ponte en contacto con el administrador');</script>";
				header('Location: ../index.php?controller=pedido&action=error_order_db');
			}

		}elseif($_POST['action']=='cancelado'){
			if($_POST["perfil"]=="cocina"){
				$productoController->redireccionar_cocina();
			}else if($_POST["perfil"]=="barra"){
				$productoController->redireccionar_barra();
			}
		}elseif($_POST['action']=='registra_pedido'){
				$productoController->realizar_pedido($_POST['familia'],$_POST['modificados'],$_POST['costo_total']);
		}
	}


	//se verifica que action esté definida
	if (isset($_GET['action'])) {
		if (	$_GET['action']!='register' && $_GET['action']!='index' && $_GET['action']!='search_prod' && $_GET['action']!='search_prod_fam' &&
				$_GET['action']!='search_prod_bar' && $_GET['action']!='search_prod_barra' && $_GET['action']!='button_download_db' && $_GET['action']!='carga_db_productos') {
			require_once('../Config/connection.php');
			$productoController=new ProductoController();

			if ($_GET['action']=='delete') {
				$productoController->delete($_GET['codingre']);
				header('Location: ../index.php?controller=producto&action=index');

			}elseif ($_GET['action']=='update') {//mostrar la vista update con los datos del registro actualizar
				require_once('../Models/producto.php');
				$producto=Producto::getById($_GET['codingre']);
				require_once('../Views/Producto/update.php');
			}elseif ($_GET['action']=='download') {//mostrar la vista update con los datos del registro actualizar
				require_once('../Models/producto.php');
				$productoController->download_db($_GET["name_file"]);
				header('Location: index.php/?controller=producto&action=button_download_db');
			}
		}
	}
?>
