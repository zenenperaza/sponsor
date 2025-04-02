<?php
/*=============================================
Mostrar errores
=============================================*/

ini_set('display_errors', 1);
ini_set("log_errors", 1);
ini_set("error_log",  "error.log");


header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: POST');

require_once "controladores/plantilla.controlador.php";
require_once "controladores/ruta.controlador.php";


require_once "controladores/usuarios.controlador.php";
require_once "modelos/usuarios.modelo.php";


$plantilla = new ControladorPlantilla();
$plantilla -> ctrPlantilla();