		<?php
	/**
	* Conexión a la base de datos
	*/
	class Db
	{
		private static $instance=NULL;

		private function __construct(){}

		private function __clone(){}

		public static function getConnect(){
			try{
					if (!isset(self::$instance)) {
						$pdo_options=array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
						//$pdo_options[PDO::ATTR_ERRMODE]=PDO::ERRMODE_EXCEPTION;
						self::$instance= new PDO('mysql:host=localhost;dbname=almacen','root','',$pdo_options);
					}
					return self::$instance;
			}catch(PDOException $e){
					echo "ERROR: " . $e->getMessage();
			}
		}
	}
?>
