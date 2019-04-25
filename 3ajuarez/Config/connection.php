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
			require_once("config.php");
			if (!isset(self::$instance)) {
				$pdo_options[PDO::ATTR_ERRMODE]=PDO::ERRMODE_EXCEPTION;
				self::$instance = new PDO('mysql:host='.DB_HOST_UNIDAD.';dbname='.DB_NAME_UNIDAD, DB_USER_UNIDAD, DB_PASS_UNIDAD, $pdo_options);
			}
			return self::$instance;
		}
	}
?>
