<?php

require_once "conexion.php";

class ModeloUsuarios{

	/*=============================================
	MOSTRAR USUARIOS
	=============================================*/

	static public function mdlMostrarUsuarios($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	REGISTRO DE USUARIO
	=============================================*/

	static public function mdlIngresarUsuario($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla 
    (cedula, nombre, apellido, fecha_nacimiento, sexo, nacionalidad, estado, municipio, direccion) VALUES 
    (:cedula, :nombre, :apellido, :fecha_nacimiento, :sexo, :nacionalidad, :estado, :municipio, :direccion)");

		$stmt->bindParam(":cedula", $datos["cedula"], PDO::PARAM_STR);
    $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
    $stmt->bindParam(":apellido", $datos["apellido"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_nacimiento", $datos["fecha_nacimiento"], PDO::PARAM_STR);
		$stmt->bindParam(":sexo", $datos["sexo"], PDO::PARAM_STR);
		$stmt->bindParam(":nacionalidad", $datos["nacionalidad"], PDO::PARAM_STR);
		$stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
		$stmt->bindParam(":municipio", $datos["municipio"], PDO::PARAM_STR);
		$stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";	

		}else{

			return "error";
		
		}

		$stmt->close();
		
		$stmt = null;

	}

	/*=============================================
	EDITAR USUARIO
	=============================================*/

	static public function mdlEditarUsuario($tabla, $datos){
    
//         var_dump(errorInfo());
//       return;
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET 
        cedula = :cedula,
        nombre = :nombre,  
        apellido = :apellido, 
        fecha_nacimiento = :fecha_nacimiento, 
        sexo = :sexo, 
        nacionalidad = :nacionalidad, 
        telefono_movil = :telefono_movil, 
        telefono_fijo = :telefono_fijo, 
        email = :email, 
        estado = :estado, 
        municipio = :municipio,
        direccion = :direccion
          WHERE id_usuario = :id_usuario");

		$stmt -> bindParam(":cedula", $datos["cedula"], PDO::PARAM_STR);
		$stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
    $stmt -> bindParam(":apellido", $datos["apellido"], PDO::PARAM_STR);
		$stmt -> bindParam(":fecha_nacimiento", $datos["fecha_nacimiento"], PDO::PARAM_STR);
		$stmt -> bindParam(":sexo", $datos["sexo"], PDO::PARAM_STR);
		$stmt -> bindParam(":nacionalidad", $datos["nacionalidad"], PDO::PARAM_STR);
		$stmt -> bindParam(":telefono_movil", $datos["telefono_movil"], PDO::PARAM_STR);    
		$stmt -> bindParam(":telefono_fijo", $datos["telefono_fijo"], PDO::PARAM_STR );  
		$stmt -> bindParam(":email", $datos["email"], PDO::PARAM_STR );  
		$stmt -> bindParam(":municipio", $datos["municipio"], PDO::PARAM_STR); 
		$stmt -> bindParam(":estado", $datos["estado"], PDO::PARAM_STR);   
		$stmt -> bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);                 
		$stmt -> bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

      $error= $stmt->errorInfo();
      var_dump($error);

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	ACTUALIZAR USUARIO
	=============================================*/

	static public function mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	BORRAR USUARIO
	=============================================*/

	static public function mdlBorrarUsuario($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_usuario = :id_usuario");

		$stmt -> bindParam(":id_usuario", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;


	}

}