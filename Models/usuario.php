<?php

class Usuario
{

	public $id_user;
	public $username;
	public $password;
	public $cargo;
	public $nombre;
	public $email;
	public $id_almacen;
	public $ruta;

	function __construct($id_user, $username, $password, $cargo, $nombre, $email,$id_almacen,$ruta){
		$this->id_user=$id_user;
		$this->username=$username;
		$this->password=$password;
		$this->cargo=$cargo;
		$this->nombre=$nombre;
		$this->email=$email;
		$this->id_almacen=$id_almacen;
		$this->ruta=$ruta;
	}

	public static function all(){
		$listaUsuarios =[];
		$db=Db1::getConnect();
		$sql=$db->query('SELECT * FROM usuario');
		foreach ($sql->fetchAll() as $usuario) {
			$listaUsuarios[]= new Usuario($usuario['id_user'],$usuario['username'], $usuario['password'],
										$usuario['cargo'],$usuario['nombre'],$usuario['email'],$usuario['id_almacen'],$usuario['ruta']);
		}
		return $listaUsuarios;
	}


	public static function save($usuario){
			$db=Db::getConnect();
			$insert=$db->prepare('INSERT INTO usuario VALUES(NULL,:username,:password,:cargo,:nombre,:email,:id_almacen,:ruta)');
			$insert->bindValue('username',$usuario->username);
			$insert->bindValue('password',$usuario->password);
			$insert->bindValue('cargo',$usuario->cargo);
			$insert->bindValue('nombre',$usuario->nombre);
			$insert->bindValue('email',$usuario->email);
			$insert->bindValue('id_almacen',$usuario->id_almacen);
			$insert->bindValue('ruta',$usuario->ruta);
			$insert->execute();
		}

	//la función para actualizar
	public static function update($usuario){
		$db=Db1::getConnect();
		$update=$db->prepare('UPDATE usuario
							SET username=:username, password=:password, cargo=:cargo,
							 	nombre=:nombre, email=:email, id_almacen=:id_almacen, ruta=:ruta
							WHERE id_user=:id_user');
		$update->bindValue('id_user',$usuario->id_user);
		$update->bindValue('username',$usuario->username);
		$update->bindValue('password',$usuario->password);
		$update->bindValue('cargo',$usuario->cargo);
		$update->bindValue('nombre',$usuario->nombre);
		$update->bindValue('email',$usuario->email);
		$update->bindValue('id_almacen',$usuario->id_almacen);
		$update->bindValue('ruta',$usuario->ruta);
		$update->execute();
	}

	// la función para eliminar por el id
	public static function delete($id){
		$db=Db1::getConnect();
		$delete=$db->prepare('DELETE FROM usuario WHERE id_user=:id');
		$delete->bindValue('id',$id);
		$delete->execute();
	}

	//la función para obtener un usuario por el id
	public static function getById($id){
		//buscar
		$db=Db1::getConnect();
		$select=$db->prepare('SELECT * FROM usuario WHERE id_user=:id');
		$select->bindValue('id',$id);
		$select->execute();
		$usuarioDb=$select->fetch();
		$usuario= new Usuario($usuarioDb['id_user'],$usuarioDb['username'],$usuarioDb['password'],
							$usuarioDb['cargo'],$usuarioDb['nombre'],$usuarioDb['email'],$usuarioDb['id_almacen'],$usuarioDb['ruta']);
		return $usuario;
	}

	public static function login($usuario){

		$db=Db1::getConnect();
		$validate=$db->prepare('SELECT * FROM usuario WHERE email=:usuario');
		$validate->bindValue('usuario',$usuario);
		$validate->execute();
		//asignarlo al objeto usuario
		$usuarioDb=$validate->fetch();
		$usuario= new Usuario($usuarioDb['id_user'],$usuarioDb['username'],$usuarioDb['password'],
							$usuarioDb['cargo'],$usuarioDb['nombre'],$usuarioDb['email'],$usuarioDb['id_almacen'],$usuarioDb['ruta']);
		return $usuario;
	}
}
?>
