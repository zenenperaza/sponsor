<?php

class ControladorUsuarios{

    /*=============================================
/*=============================================
Registro de usuarios
=============================================*/

static public function ctrRegistroUsuario(){

    if(isset($_POST["btnRegistrarUsuario"])){   

        // Validación de campos vacíos
        if(empty($_POST["email"]) || empty($_POST["email2"]) || empty($_POST["password"]) || empty($_POST["password2"])){
            echo '<script>
               Swal.fire({
                html: \'<div class="mt-3"><lord-icon src="https://cdn.lordicon.com/tdrtiskw.json" trigger="loop" colors="primary:#f06548,secondary:#f7b84b" style="width:120px;height:120px"></lord-icon><div class="mt-4 pt-2 fs-15">
                <h4>Oops...! Something went Wrong !</h4>
                <p class="text-muted mx-4 mb-0">Your email Address is invalid</p></div></div>\',
                showCancelButton: !0,
                showConfirmButton: !1,
                cancelButtonClass: "btn btn-primary w-xs mb-1",
                cancelButtonText: "Dismiss",
                buttonsStyling: !1,
                showCloseButton: !0
            });
            </script>';
            return;
        }

        // Validación de coincidencia de emails
        if($_POST["email"] != $_POST["email2"]){
            echo '<script>
               Swal.fire({
                html: \'<div class="mt-3"><lord-icon src="https://cdn.lordicon.com/tdrtiskw.json" trigger="loop" colors="primary:#f06548,secondary:#f7b84b" style="width:120px;height:120px"></lord-icon><div class="mt-4 pt-2 fs-15">
                <h4>Oops...! Something went Wrong !</h4>
                <p class="text-muted mx-4 mb-0">Your email Address is invalid</p></div></div>\',
                showCancelButton: !0,
                showConfirmButton: !1,
                cancelButtonClass: "btn btn-primary w-xs mb-1",
                cancelButtonText: "Dismiss",
                buttonsStyling: !1,
                showCloseButton: !0
            });
            </script>';
            return;
        }

        // Validación de coincidencia de contraseñas
        if($_POST["password"] != $_POST["password2"]){
            echo '<script>
               Swal.fire({
                html: \'<div class="mt-3"><lord-icon src="https://cdn.lordicon.com/tdrtiskw.json" trigger="loop" colors="primary:#f06548,secondary:#f7b84b" style="width:120px;height:120px"></lord-icon><div class="mt-4 pt-2 fs-15">
                <h4>Oops...! Something went Wrong !</h4>
                <p class="text-muted mx-4 mb-0">Your password  is invalid</p></div></div>\',
                showCancelButton: !0,
                showConfirmButton: !1,
                cancelButtonClass: "btn btn-primary w-xs mb-1",
                cancelButtonText: "Dismiss",
                buttonsStyling: !1,
                showCloseButton: !0
            });
            </script>';
            return;
        }

        // Validación de longitud mínima de contraseña
        if(strlen($_POST["password"]) < 6){
            echo '<script>
               Swal.fire({
                html: \'<div class="mt-3"><lord-icon src="https://cdn.lordicon.com/tdrtiskw.json" trigger="loop" colors="primary:#f06548,secondary:#f7b84b" style="width:120px;height:120px"></lord-icon><div class="mt-4 pt-2 fs-15">
                <h4>Oops...! Something went Wrong !</h4>
                <p class="text-muted mx-4 mb-0">Passwor dmenos de 6 caracteres</p></div></div>\',
                showCancelButton: !0,
                showConfirmButton: !1,
                cancelButtonClass: "btn btn-primary w-xs mb-1",
                cancelButtonText: "Dismiss",
                buttonsStyling: !1,
                showCloseButton: !0
            });
            </script>';
            return;
        }

        // Validación de formato de email
        if(!preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["email"])){
            echo '<script>
               Swal.fire({
                html: \'<div class="mt-3"><lord-icon src="https://cdn.lordicon.com/tdrtiskw.json" trigger="loop" colors="primary:#f06548,secondary:#f7b84b" style="width:120px;height:120px"></lord-icon><div class="mt-4 pt-2 fs-15">
                <h4>Oops...! Something went Wrong !</h4>
                <p class="text-muted mx-4 mb-0">formato de correo invalido</p></div></div>\',
                showCancelButton: !0,
                showConfirmButton: !1,
                cancelButtonClass: "btn btn-primary w-xs mb-1",
                cancelButtonText: "Dismiss",
                buttonsStyling: !1,
                showCloseButton: !0
            });
            </script>';
            return;
        }

        // Verificar si el email ya está registrado
        $tabla = "usuarios";
        $item = "email";
        $valor = $_POST["email"];
        
        $respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla, $item, $valor);
        
        if($respuesta["email"] == $_POST["email"]){
            echo '<script>
               Swal.fire({
                html: \'<div class="mt-3"><lord-icon src="https://cdn.lordicon.com/tdrtiskw.json" trigger="loop" colors="primary:#f06548,secondary:#f7b84b" style="width:120px;height:120px"></lord-icon><div class="mt-4 pt-2 fs-15"><h4>Oops...! Something went Wrong !</h4><p class="text-muted mx-4 mb-0">El correo ya se encuentra registrado</p></div></div>\',
                showCancelButton: !0,
                showConfirmButton: !1,
                cancelButtonClass: "btn btn-primary w-xs mb-1",
                cancelButtonText: "Dismiss",
                buttonsStyling: !1,
                showCloseButton: !0
            });
            </script>';
            return;
        }

        // Encriptar contraseña y email
        $encriptar = crypt($_POST["password"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
        $encriptarEmail = md5($_POST["email"]);
        $emailStrong = $_POST["email"];
        
        // Obtener nombre si está definido
        $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : "";

        // Preparar datos para registro
        $tabla = "usuarios";
        $datos = array(
            "perfil" => $_POST["perfil"],
            "email_preregistro" => $_POST["email"],
            "nombre" => $nombre,
            "ip" => $_POST["detalle_ip"],
            "password" => $encriptar,
            "verificacion" => 0,
            "email_encriptado" => $encriptarEmail
        );

        // Registrar usuario
        $respuesta = ModeloUsuarios::mdlRegistroUsuario($tabla, $datos);

        if($respuesta == "ok"){

            
		echo '<script>
		Swal.fire({
			html: \'<div class="mt-3"><div class="avatar-lg mx-auto"><div class="avatar-title bg-light text-success display-5 rounded-circle"><i class="ri-mail-send-fill"></i></div></div><div class="mt-4 pt-2 fs-15"><h4 class="fs-20 fw-semibold">Verifica tu correo electrónico</h4><p class="text-muted mb-0 mt-3 fs-13">Te hemos enviado un correo de verificación a <span class="fw-medium text-dark">ejemplo@abc.com</span>, <br/> Por favor revísalo.</p></div></div>\',
			showCancelButton: !1,
			confirmButtonClass: "btn btn-primary mb-1",
			confirmButtonText: "Verificar Email",
			buttonsStyling: !1,
			footer: "<p class=\'fs-14 text-muted mb-0\'>¿No recibiste el correo? <a href=\'#\' class=\'fw-semibold text-decoration-underline\'>Reenviar</a></p>",
			showCloseButton: !0
		});

	</script>';

          
        }
    }
}
  


static public function ctrLoginUsuario(){

    if(isset($_POST["email"])){

        if(preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["email"])){
            
            $encriptar = crypt($_POST["password"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

            $tabla = "usuarios";

            $item = "email";
            $valor = $_POST["email"];

            $respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla, $item, $valor);

            if($respuesta["email"] == $_POST["email"] && $respuesta["password"] == $encriptar){               
    

                    $_SESSION["iniciarSesion"] = "ok";
                    $_SESSION["id"] = $respuesta["id"];
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





}