<?php 
	require_once('conexion.php');
	require_once('usuario.php');
	class CrudUsuario{

		public function __construct(){}

		//inserta los datos del usuario
		public function insertar($usuario){
			$db=DB::conectar();
			$insert=$db->prepare('INSERT INTO USUARIOS VALUES(NULL,:nombre, :clave)');
			$insert->bindValue('nombre',$usuario->getNombre());
			//encripta la clave
			$pass=password_hash($usuario->getClave(),PASSWORD_DEFAULT);
			$insert->bindValue('clave',$pass);
			$insert->execute();
		}

		//obtiene el usuario para el login
		public function obtenerUsuario($nombre,$clave){

		//echo "<BR>**Nombre;".$nombre." Clave:".$clave." Tipo:".$tipo;
			
				$db=Db::conectar();
				$select=$db->prepare('SELECT * FROM usuarios WHERE usuario=:nombre ');//AND clave=:clave
				$select->bindValue('nombre',$nombre);			
				$select->execute();
				$registro=$select->fetch();
				$usuario=new Usuario();

				//verifica si la clave es correcta
				if (password_verify($clave, $registro['clave'])) {				
					//si es correcta, asigna los valores que trae desde la base de datos
					$usuario->setId($registro['usuario']);
					$usuario->setNombre($registro['nombre']." ".$registro['apellidos']);
					$usuario->setClave($registro['clave']);
					$usuario->setTipo($registro['tipo']);
				}
				else{
					echo "<br>Clave incorrecta<br>";
					return null;
				}	

			return $usuario;
		}

		//busca el nombre del usuario si existe
		public function buscarUsuario($nombre){
			$db=Db::conectar();
			$select=$db->prepare('SELECT * FROM usuarios WHERE usuario=:nombre');
			$select->bindValue('nombre',$nombre);
			$select->execute();
			$registro=$select->fetch();
			if($registro['Id']!=NULL){
				$usado=False;
			}else{
				$usado=True;
			}	
			return $usado;
		}
	}
?>s