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

                $create_table_almacen=$this->pdo->prepare('
                    CREATE TABLE  almacen  (
                            id_almacen  int(3) NOT NULL,
                            nom_almacen  varchar(60) NOT NULL,
                            estado  varchar(25) NOT NULL,
                            gerente  varchar(30) NOT NULL,
                            direccion  varchar(300) NOT NULL,
                            tel  varchar(10) NOT NULL
                        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;'
                    );
                    $create_table_almacen->execute();

                    if($create_table_almacen){
                        echo "Exito: Tabla almacen creada. <br>";
                    }else{
                        echo "Error: No se crea tabla almacen. <br>";
                    }

                $create_table_usuario=$this->pdo->prepare('
                    CREATE TABLE  usuario  (
                            id_user  int(10) NOT NULL,
                            username  varchar(30) NOT NULL,
                            password  varchar(25) NOT NULL,
                            cargo  varchar(30) NOT NULL,
                            nombre  varchar(30) NOT NULL,
                            email  varchar(50) NOT NULL,
                            id_almacen  int(11) NOT NULL,
                            ruta  varchar(100) NOT NULL
                        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
                    ');
                    $create_table_usuario->execute();

                    if($create_table_usuario){
                        echo "Exito: Tabla usuario creada. <br>";
                    }else{
                        echo "Error: No se crea la tabla usuario. <br>";
                    }

                //Indice para tablas volcadas
                // Indices de la tabla  familia

                if($create_table_almacen){

                    $indice_almacen=$this->pdo->prepare("
                        ALTER TABLE  almacen
                        ADD PRIMARY KEY ( id_almacen );"
                    );
                    $indice_almacen->execute();

                    //Auto incremento
                    $indice_almacen=$this->pdo->prepare("
                        ALTER TABLE  almacen
                        MODIFY  id_almacen  int(3) NOT NULL AUTO_INCREMENT;"
                    );
                    $indice_almacen->execute();
                    //Fin autoincremento

                    if($indice_almacen){
                        echo "Exito: Llave primaria creada en almacen. <br>";
                    }else{
                        echo "Erro: No se crea llave primaria de la tabla almacen. <br>";
                    }

                }else{
                    echo "Erro: No se crea llave primaria de la tabla almacen. <br>";
                }

                // Indices de la tabla  pedidos

                if($create_table_usuario){
                    $indice_usuario=$this->pdo->prepare(
                        "ALTER TABLE usuario
                        ADD PRIMARY KEY (id_user),
                        ADD UNIQUE KEY user_id (id_user);"
                    );
                    $indice_usuario->execute();

                    //Auto incremento usuario.
                    $indice_usuario=$this->pdo->prepare(
                        "ALTER TABLE  usuario
                          MODIFY  id_user  int(10) NOT NULL AUTO_INCREMENT;"
                    );
                    $indice_usuario->execute();
                    //Fin autoincremento Usuario.

                    if($indice_usuario){
                        echo "Exito: Llave primaria creada en usuario. <br>";
                    }else{
                        echo "Error: No se crea llave primaria de la tabla usuario. <br>";
                        }

                }else{
                    echo "Error: No se crea llave primaria de la tabla usuario. <br>";
                }

            }else{//else de seleccion de la base de datos
                echo "Error: Base de datos no seleccionada. <br>";
            }

        }else{//else de creacion de la base de datos
            echo "Error: No se creo la base de datos. <br>";
        }

    }//End funcion create_dba
}//End clase



    if(isset($_GET['nombre_db']) && strlen(trim($_GET['nombre_db'])) != 0 ){

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
            <h1 align="center">Pagina para creacion de Base de Datos de Usuarios</h1>

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
