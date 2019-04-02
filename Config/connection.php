<?php
	/**
	* Conexión a la base de datos
	*/
	class Db1
	{
		private static $instance=NULL;

		private function __construct(){}
		private function __clone(){}
		public static function getConnect(){
			require_once("config.php");
			if (!isset(self::$instance)) {
				$pdo_options[PDO::ATTR_ERRMODE]=PDO::ERRMODE_EXCEPTION;
				self::$instance= new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS, $pdo_options);
			}
			return self::$instance;
		}
	}
?>
