<?php
session_start();

class ControladorUsuarios{

	/*=============================================
	INGRESO DE USUARIO
	=============================================*/

    static public function ctrLoginUsuario(){

        if(isset($_POST["btnLoginUsuario"])){

            if(preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["email"])){
                
                $encriptarPassword = crypt($_POST["password"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
    
                $tabla = "usuarios";
    
                $item = "email";
                $valor = $_POST["email"];

                // var_dump($_POST);
                // return;
    
                $respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla, $item, $valor);

                
                // var_dump($encriptarPassword);
                // return;
    
                if($respuesta["email"] == $_POST["email"] && $respuesta["password"] == $encriptarPassword){     
        
    
                        $_SESSION["iniciarSesion"] = "ok";
                        $_SESSION["id"] = $respuesta["id_usuario"];
                        $_SESSION["nombre"] = $respuesta["nombre"];
                        $_SESSION["apellido"] = $respuesta["apellido"];
                        $_SESSION["email"] = $respuesta["email"];
                        $_SESSION["foto"] = $respuesta["foto"];
                        $_SESSION["perfil"] = $respuesta["perfil"];
    
                        
                            echo '<script>
    
                                window.location = "inicio";
    
                            </script>';
    
                        }		else{
    
                    echo '<br><div class="alert alert-danger">Error al ingresar, Datos incorrectos, vuelve a intentarlo</div>';
    
                    }
    
                }
    
            }	   
    
        }
    
    
/*=============================================
Registro de usuarios
=============================================*/
static public function ctrRegistroUsuario(){

    if(isset($_POST["btnRegistrarUsuario"])){   

        // Validación de campos obligatorios
        $camposRequeridos = ["nombre", "apellido", "email", "email2", "password", "password2", "id_usuario"];
        foreach($camposRequeridos as $campo) {
            if(empty($_POST[$campo])) {
                self::mostrarError('Por favor completa todos los campos obligatorios');
                return;
            }
        }

        // Validación de coincidencia de emails
        if($_POST["email"] != $_POST["email2"]){
            self::mostrarError('Los correos electrónicos no coinciden');
            return;
        }

        // Validación de formato de email
        if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
            self::mostrarError('Formato de correo electrónico inválido');
            return;
        }

        // Validación de contraseñas
        if($_POST["password"] != $_POST["password2"]){
            self::mostrarError('Las contraseñas no coinciden');
            return;
        }

        if(strlen($_POST["password"]) < 6){
            self::mostrarError('La contraseña debe tener al menos 6 caracteres');
            return;
        }

        // Verificar email único
        $tabla = "usuarios";
        $item = "email";
        $valor = $_POST["email"];
        
        $respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla, $item, $valor);
        
        if(isset($respuesta["email"]) && $respuesta["email"] == $_POST["email"]){
            self::mostrarError('El correo ya está registrado');
            return;
        }

        // Encriptar credenciales
        $encriptarPassword = crypt($_POST["password"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
        $encriptarEmail = md5($_POST["email"]);

        // Preparar datos para registro
        $datos = array(
            "nombre" => $_POST["nombre"],
            "apellido" => $_POST["apellido"],
            "email" => $_POST["email"],
            "password" => $encriptarPassword,
            "telefono" => $_POST["telefono"] ?? null,
            "pais" => $_POST["pais"] ?? null,
            "ciudad" => $_POST["ciudad"] ?? null,
            "id_patrocinador" => $_POST["id_patrocinador"] ?? null,
            "id_usuario" => $_POST["id_usuario"] ?? null,
            "verificacion" => 0,
            "email_encriptado" => $encriptarEmail
        );

        // Registrar usuario
        $respuesta = ModeloUsuarios::mdlRegistroUsuario($tabla, $datos);

        if($respuesta == "ok"){
            echo '<script>
                    Swal.fire({
                        html: `<div class="mt-3">
                            <div class="avatar-lg mx-auto">
                                <div class="avatar-title bg-light text-success display-5 rounded-circle">
                                    <i class="ri-mail-send-fill"></i>
                                </div>
                            </div>
                            <div class="mt-4 pt-2 fs-15">
                                <h4 class="fs-20 fw-semibold">¡Registro exitoso!</h4>
                                <p class="text-muted mb-0 mt-3 fs-13">
                                    Te hemos enviado un correo de verificación a 
                                    <span class="fw-medium text-dark">'.$_POST["email"].'</span>
                                </p>
                            </div>
                        </div>`,
                        showConfirmButton: true
                    }).then(function(result){
                        if(result.value){

                                window.location = "ingreso";

                        }
            });
            </script>';
        }
    }
}

// Función auxiliar para mostrar errores
private static function mostrarError($mensaje){
    echo '<script>
        Swal.fire({
            icon: "error",
            title: "Error de validación",
            text: "'.$mensaje.'",
            showConfirmButton: true
        });
    </script>';
}
    
    /*=============================================
	MOSTRAR USUARIO
	=============================================*/

	static public function ctrMostrarUsuarios($item, $valor){

		$tabla = "usuarios";

		$respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla, $item, $valor);

		return $respuesta;
	}

/*=============================================
	EDITAR USUARIO
	=============================================*/

	static public function ctrEditarUsuario(){

		if(isset($_POST["btnEditarUsuario"])){				

				$tabla = "usuarios";			                

				$datos = array("id_usuario" => $_POST["idUsuario"],
                       "cedula" => $_POST["cedula"],
                       "nombre" => $_POST["nombre"],
                       "apellido" => $_POST["apellido"],
                       "fecha_nacimiento" => $_POST["fechaNacimiento"],
                       "sexo" => $_POST["sexo"],
                       "nacionalidad" => $_POST["nacionalidad"],
                       "telefono_movil" => $_POST["telefonoMovil"],
                       "telefono_fijo" => $_POST["telefonoLocal"],
                       "email" => $_POST["email"],
                       "estado" => $_POST["estado"],
                       "municipio" => $_POST["municipio"],
                       "direccion" => $_POST["direccion"]);
//       var_dump($datos);
//       return;
 
				$respuesta = ModeloUsuarios::mdlEditarUsuario($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

				 swal({
                    title: "¡Usuario editado!",
                    text: "EL Usuarios fue editado satisfactoriamente!",
                    type: "success",
                    icon: "success"
                }).then(function() {
                    window.location = "usuarios";
                });   

					</script>';

			}      
		}    
	}
    /*=============================================
	BORRAR USUARIO
	=============================================*/

	static public function ctrBorrarUsuario(){

		if(isset($_GET["idUsuario"])){

			$tabla ="usuarios";
			$datos = $_GET["idUsuario"];

			if($_GET["foto"] != "" && $_GET["foto"] != "vistas/img/usuarios/default/anonymous.png"){

				unlink($_GET["foto"]);
				rmdir('vistas/img/usuarios/'.$_GET["email"]);

			}

			$respuesta = ModeloUsuarios::mdlBorrarUsuario($tabla, $datos);

			if($respuesta == "ok"){

				echo '<script>  
                
                swal({
                    title: "¡Usuario eliminado!",
                    text: "EL Usuarios fue borrado satisfactoriamente!",
                    type: "success",
                    icon: "success"
                }).then(function() {
                    window.location = "usuarios";
                });               
                  
              </script>';
        

			}   

		}
	}


	
	
static public function generarCodigoPatrocinador($longitud = 6) {
    $caracteres = 'ABCDEFGHIJKLMNPQRSTUVWXYZ23456789'; // Excluye 0, O, 1 para evitar confusiones
    $max = strlen($caracteres) - 1;
    $codigo = '';
    
    for ($i = 0; $i < $longitud; $i++) {
        $codigo .= $caracteres[random_int(0, $max)]; // Usamos random_int para mejor seguridad
    }
    
    return $codigo;
}

static public function codigoPatrocinadorUnico() {
    try {
        $conexion = (new Conexion())->conectar();
        $intentos = 0;
        $max_intentos = 10;

        while ($intentos < $max_intentos) {
            $codigo = ControladorUsuarios::generarCodigoPatrocinador();

		
            
            $stmt = $conexion->prepare("SELECT COUNT(id) FROM usuarios WHERE id_patrocinador = :codigo");
            $stmt->bindParam(':codigo', $codigo, PDO::PARAM_STR);
            $stmt->execute();
            
            if ($stmt->fetchColumn() == 0) {
                return $codigo;
            }
            
            $intentos++;
        }
        
        return false;
        
    } catch (Exception $e) {
        error_log("Error generando código: " . $e->getMessage());
        return false;
    }
}

// Uso del código


}
	


