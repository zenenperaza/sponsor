<?php
session_start();

class ControladorUsuarios{

	/*=============================================
	INGRESO DE USUARIO
	=============================================*/

    static public function ctrLoginUsuario(){
        try {
            // Verificar método POST y token CSRF
            if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
                throw new Exception('Solicitud inválida');
            }
    
            // Validar campos obligatorios
            $camposRequeridos = ['email', 'password'];
            foreach ($camposRequeridos as $campo) {
                if (empty($_POST[$campo])) {
                    throw new Exception('Por favor complete todos los campos');
                }
            }
    
            // Sanitizar y validar email
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new Exception('Formato de email inválido');
            }
    
            // Validar política de contraseña
            $password = $_POST['password'];
            if (strlen($password) < 6) {
                throw new Exception('La contraseña debe tener al menos 8 caracteres');
            }
    
            // Buscar usuario en la base de datos
            $usuario = ModeloUsuarios::MdlMostrarUsuarios('usuarios', 'email', $email);
    
            // Verificar existencia de usuario
            if (!$usuario || !isset($usuario['email'])) {
                error_log("Intento de login fallido para: $email");
                throw new Exception('Credenciales incorrectas');
            }
    
            // Verificar contraseña
            if (!password_verify(md5($password), $usuario['password'])) {
                // Registrar intento fallido
                $_SESSION['intentos_fallidos'] = ($_SESSION['intentos_fallidos'] ?? 0) + 1;
                
                // Bloquear después de 3 intentos
                if ($_SESSION['intentos_fallidos'] >= 3) {
                    sleep(5); // Retraso anti brute-force
                    throw new Exception('Demasiados intentos fallidos. Espere 5 segundos');
                }
                
                throw new Exception('Credenciales incorrectas');
            }
    
            // Verificar cuenta activa/verificada
            if ($usuario['verificacion'] != 1) {
                throw new Exception('Cuenta no verificada. Revise su email');
            }
    
            // Iniciar sesión segura
            session_regenerate_id(true);
            
            $_SESSION["user"] = [
                "id" => $usuario['id'],
                "nombre" => $usuario['nombre'],
                "apellido" => $usuario['apellido'],
                "email" => $usuario['email'],
                "perfil" => $usuario['perfil'],
                "last_login" => time()
            ];
    
            // Limpiar intentos fallidos
            unset($_SESSION['intentos_fallidos']);
    
            // Redirección segura
            header('Location: inicio');
            exit();
    
        } catch (Exception $e) {
            // Manejo centralizado de errores
            error_log("Error de login: " . $e->getMessage());
            $_SESSION['error_login'] = $e->getMessage();
            self::mostrarError( $_SESSION['error_login']);
            exit();
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
        $encriptarPassword = password_hash($_POST["password"], PASSWORD_DEFAULT);
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
	


