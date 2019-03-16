<?php
class Create_db{
    protected $pdo=NULL;

    public function __construct(){
        require_once('Config/config.php');
        $this->pdo=new PDO("mysql:host=".DB_HOST,DB_USER,DB_PASS);
        // $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if($this->pdo){
            echo "Exito: Conexion al servidor DB\n <br>";
        }else{
            echo "Erro: No se conecto a la DB\n <br>";
        }
    }

    public function create_dba($db_name){
        $sql=$this->pdo->prepare('CREATE SCHEMA IF NOT EXISTS '.$db_name.' COLLATE utf8_general_ci');
        $sql->execute();
        if($sql){
            echo "Exito: Base de datos ". $db_name .", creada <br>";
        }else{
            echo "Error: No se creo la base de datos <br>";
        }
        if($sql){
            $use_db=$this->pdo->prepare('USE '.$db_name);
            $use_db->execute();
        }else{
            echo "No se selecciona la base de datos";
        }

        if($use_db){
            $create_table=$this->pdo->prepare('
            CREATE TABLE IF NOT EXISTS familia (
               cod_familia  varchar(20) NOT NULL,
               descripcion  varchar(50) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
            ');

            $create_table->execute();
        }else{
            echo "Error: No se crea tabla familia";
        }

        if($use_db){
            $create_table=$this->pdo->prepare('
            CREATE TABLE IF NOT EXISTS  pedidos  (
               id_pedido  int(10) NOT NULL,
               fecha_pedido  date NOT NULL,
               fecha_autoriza_cancela  date DEFAULT NULL,
               hora  time NOT NULL,
               hora_autoriza_cancela  time DEFAULT NULL,
               autoriza  varchar(30) DEFAULT NULL,
               solicita  varchar(30) NOT NULL,
               estado  varchar(20) NOT NULL,
               observaciones  varchar(150) DEFAULT NULL,
               unidad_medida  varchar(10) NOT NULL,
               total_prod  float NOT NULL,
               costo_total  float NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
            ');
            $create_table->execute();
        }else{
            echo "Error: No se crea la tabla pedidos";
        }

        if($use_db){
            $create_table=$this->pdo->prepare('
            CREATE TABLE IF NOT EXISTS `pedido_producto` (
              `id_pedido` int(10) NOT NULL,
              `codingre` varchar(10) NOT NULL,
              `fecha_pedido` date NOT NULL,
              `hora_pedido` time NOT NULL,
              `num_prod` float NOT NULL,
              `estado_prod` varchar(20) DEFAULT NULL,
              `observacion` varchar(150) DEFAULT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
            ');
            $create_table->execute();
        }else{
            echo "Error: No se crea la tabla pedido_producto";
        }

        if($use_db){
            $create_table=$this->pdo->prepare('
            CREATE TABLE `productos` (
              `codingre` varchar(10) NOT NULL,
              `descrip` varchar(35) NOT NULL,
              `familia` varchar(10) NOT NULL,
              `unidad` varchar(10) NOT NULL,
              `empaque` varchar(15) NOT NULL,
              `equivale` float NOT NULL,
              `inventa1` float NOT NULL,
              `stockmax` float NOT NULL,
              `stockmin` float NOT NULL,
              `ultcosto` float NOT NULL,
              `costoprome` float NOT NULL,
              `impuesto` float NOT NULL,
              `pedido` float NOT NULL,
              `status` varchar(20) DEFAULT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
            ');
            $create_table->execute();
        }else{
            echo "Error: No se crea la tabla productos";
        }

    }
}

$db_name="piacevole";
$conexion=new Create_db();
$conexion->create_dba($db_name);

?>
