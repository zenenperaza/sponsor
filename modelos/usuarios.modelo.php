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

	static public function mdlRegistroUsuario($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla 
			(nombre, apellido, email, perfil, password, telefono, pais, ciudad, 
			 id_patrocinador, id_usuario, verificacion, email_encriptado) 
			VALUES 
			(:nombre, :apellido, :email, :perfil, :password, :telefono, :pais, :ciudad, 
			 :id_patrocinador, :id_usuario, :verificacion, :email_encriptado)");
	
		// Bind de parámetros
		
		$stmt->bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":apellido", $datos["apellido"], PDO::PARAM_STR);
		$stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
		$stmt->bindParam(":perfil", $datos["perfil"], PDO::PARAM_STR);
		$stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		$stmt->bindParam(":pais", $datos["pais"], PDO::PARAM_STR);
		$stmt->bindParam(":ciudad", $datos["ciudad"], PDO::PARAM_STR);
		$stmt->bindParam(":id_patrocinador", $datos["id_patrocinador"], PDO::PARAM_STR);
		$stmt->bindParam(":verificacion", $datos["verificacion"], PDO::PARAM_INT);
		$stmt->bindParam(":email_encriptado", $datos["email_encriptado"], PDO::PARAM_STR);
	
		try {
			if($stmt->execute()){
				return "ok";    
			} else {
				error_log("Error en ejecución SQL: " . implode(" ", $stmt->errorInfo()));
				return "error";
			}
		} catch(PDOException $e) {
			error_log("Error PDO: " . $e->getMessage());
			return "error";
		} finally {
			$stmt = null;
		}
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