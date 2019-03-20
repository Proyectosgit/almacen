<?php
class Create_db{

    protected $pdo=NULL;

    public function __construct(){
        require_once('Config/config.php');
        $this->pdo=new PDO("mysql:host=".DB_HOST,DB_USER,DB_PASS);
        // $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if($this->pdo){
            echo "Exito: Conexion al servidor DB.<br>";
        }else{
            echo "Erro: No se conecto a la DB.<br>";
        }
    }

    public function create_dba($db_name){

        $sql=$this->pdo->prepare('CREATE SCHEMA IF NOT EXISTS '.$db_name.' COLLATE utf8_general_ci');
        $sql->execute();

        if($sql){
            echo "Exito: Base de datos ". $db_name .", creada. <br>";

            $use_db=$this->pdo->prepare('USE '.$db_name);
            $use_db->execute();

            if($use_db){
                echo "Exito: Base de datos seleccionada. <br>";

                $create_table_familia=$this->pdo->prepare('
                CREATE TABLE IF NOT EXISTS familia (
                   cod_familia  varchar(20) NOT NULL,
                   descripcion  varchar(50) NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
                ');
                $create_table_familia->execute();

                    if($create_table_familia){
                        echo "Exito: Tabla familia creada. <br>";
                    }else{
                        echo "Error: No se crea tabla familia. <br>";
                    }

                $create_table_pedidos=$this->pdo->prepare('
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
                $create_table_pedidos->execute();

                    if($create_table_pedidos){
                        echo "Exito: Tabla pedidos creada. <br>";
                    }else{
                        echo "Error: No se crea la tabla pedidos. <br>";
                    }

                $create_table_pedido_producto=$this->pdo->prepare('
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
                $create_table_pedido_producto->execute();

                    if($create_table_pedido_producto){
                        echo "Exito: Tabla pedido_producto creada. <br> ";
                    }else{
                        echo "Error: No se crea la tabla pedido_producto. <br>";
                    }

                $create_table_productos=$this->pdo->prepare('
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
                $create_table_productos->execute();

                    if($create_table_productos){
                        echo "Exito: Tabla productos creada. <br>";
                    }else{
                        echo "Error: No se crea la tabla productos. <br>";
                    }

                //Indice para tablas volcadas
                // Indices de la tabla `familia`

                if($create_table_familia){
                    $indice_familia=$this->pdo->prepare("
                        ALTER TABLE `familia`
                        ADD PRIMARY KEY (`cod_familia`),
                        ADD UNIQUE KEY `cod_familia` (`cod_familia`)"
                    );
                    $indice_familia->execute();

                        if($indice_familia){
                            echo "Exito: Llave primaria creada en familia. <br>";
                        }else{
                            echo "Erro: No se crea llave primaria de la tabla familia. <br>";
                        }
                }else{
                    echo "Erro: No se crea llave primaria de la tabla familia. <br>";
                }

                // Indices de la tabla `pedidos`

                if($create_table_pedidos){
                    $indice_pedidos=$this->pdo->prepare(
                        "ALTER TABLE `pedidos`
                        ADD PRIMARY KEY (`id_pedido`),
                        ADD UNIQUE KEY `id_pedido` (`id_pedido`);"
                    );
                    $indice_pedidos->execute();
                        if($indice_pedidos){
                            echo "Exito: Llave primaria creada en pedidos. <br>";
                        }else{
                            echo "Error: No se crea llave primaria de la tabla pedidos. <br>";
                            }
                }else{
                    echo "Error: No se crea llave primaria de la tabla pedidos. <br>";
                }

                //  Indices de la tabla `pedido_producto`

                if($create_table_pedido_producto){
                    $indice_pedido_producto=$this->pdo->prepare(
                        "ALTER TABLE `pedido_producto`
                        ADD KEY `id_pedido` (`id_pedido`),
                        ADD KEY `id_prod` (`codingre`);"
                    );
                    $indice_pedido_producto->execute();
                        if($indice_pedido_producto){
                            echo "Exito: Llave primaria creada en pedido_producto. <br>";
                        }else{
                            echo "Error: No se crea llave primaria de la tabla pedido_producto. <br>";
                        }
                }else{
                    echo "Error: No se crea llave primaria de la tabla pedido_producto. <br>";
                }

                // Indices de la tabla `productos`

                if($create_table_productos){
                    $indice_productos=$this->pdo->prepare(
                        "ALTER TABLE `productos`
                        ADD PRIMARY KEY (`codingre`);"
                    );
                    $indice_productos->execute();
                        if($indice_productos){
                            echo "Exito: Llave primaria creada en productos. <br>";
                        }else{
                            echo "Error: No se crea llave primaria de la tabla productos. <br>";
                        }
                }else{
                    echo "Error: No se crea llave primaria de la tabla productos. <br>";
                }

                //AUTO_INCREMENT de las tablas volcadas

                // AUTO_INCREMENT de la tabla `pedidos`

                if($create_table_pedidos){
                    $auto_increment_pedidos=$this->pdo->prepare(
                    "ALTER TABLE `pedidos`
                    MODIFY `id_pedido` int(10) NOT NULL AUTO_INCREMENT;"
                    );
                    $auto_increment_pedidos->execute();
                    echo "Exito: Se agrega AUTO_INCREMENT y NOT NULL a pedidos.<br>";
                }else{
                    echo "Error: No se crea AUTO_INCREMENT y NOT NULL en la tabla pedidos.<br>";
                }

                // Llaves foraneas para la tabla `pedido_producto`

                if($create_table_pedido_producto){
                    $indice_pedido_producto=$this->pdo->prepare(
                        "ALTER TABLE `pedido_producto`
                        ADD CONSTRAINT `pedido_producto_ibfk_1` FOREIGN KEY (`codingre`) REFERENCES `productos` (`codingre`),
                        ADD CONSTRAINT `pedido_producto_ibfk_2` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id_pedido`);
                        COMMIT;"
                    );
                    $indice_pedido_producto->execute();
                        if($indice_pedido_producto){
                            echo "Exito: se crean las llaves foraneas de la tabla pedido_producto.<br>";
                        }else{
                            echo "Error: no se crean llaves foraneas en la tabla pedido_producto. <br>";
                        }
                }else{
                    echo "Error: no se crean llaves foraneas en la tabla pedido_producto. <br>";
                }

            }else{//else de seleccion de la base de datos
                echo "Error: Base de datos no seleccionada. <br>";
            }
        }else{//else de creacion de la base de datos
            echo "Error: No se creo la base de datos. <br>";
        }

    }//End funcion create_dba
}//End clase



    if(isset($_GET['nombre_db']) && strlen(trim($_GET['nombre_db'])) ){

        $db_name=$_GET['nombre_db'];
        $conexion=new Create_db();
        $conexion->create_dba($db_name);
    }//else{
        //echo "<h1>Ingresa un nombre a la Base de Datos.</h1>";
    //}

?>


<?php if(!isset($_GET['nombre_db'])){?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8"/>
        <!-- <link rel="stylesheet" href="Public/bootstrap/css/boostrap.min.css"/> -->
        <meta name='viewport' content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"/>
        <link rel="stylesheet" href="Public/bootstrap/bootstrap_3.3.6/bootstrap.min.css">
        <link rel="stylesheet" href="Public/css/logos.css"/>
        <title>Crear Base de datos</title>
    </head>
    <body>
        <section>
            <h1 align="center">Pagina para creacion de Base de Datos</h1>

        <div align="center">
                <table>
                    <form method="get" action="<?php $_SERVER['PHP_SELF'] ?>">
                        <tr>
                            <td>
                                <input type="text" name="nombre_db" placeholder="Nombre de la Base de Datos" size="30" required
                                title="El nombre de la base debe esta formado por letras y numeros, sin espacios"/>
                            </td>
                        </tr>
                        <tr><td><br></td></tr>
                        <tr align="center">
                            <td>
                                <input class="btn btn-success" type="submit" value="Crear BD">
                            </td>
                        </tr>
                    </form>
                </table>
        </div>
        </section>

            <section>
                <div class="container">
                    <div class="row">
                        <div class="mx-auto">
                            <img class="logo_fondo" src="Public/imagenes/logo.jpg"/>
                        </div>
                    </div>
                </div>
            </section>
    </body>

    <script src="Public/jquery/jquery-3.3.1.min.js"></script>
    <!-- <script src="Public/bootstrap/js/boostrap.min.js"></script> -->
</html>
<?php } ?>
