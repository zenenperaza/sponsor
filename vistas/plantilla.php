<?php
if (!isset($_SESSION)) session_start();
/*=============================================
Capturar las rutas de la URL
=============================================*/

$routesArray = explode("/", $_SERVER['REQUEST_URI']);
$routesArray = array_filter($routesArray);
/*=============================================
Limpiar la Url de variables GET
=============================================*/
foreach ($routesArray as $key => $value) {

  $value = explode("?", $value)[0];
  $routesArray[$key] = $value;
  
  
}

$ruta = ControladorRuta::ctrRuta();
?>
<!DOCTYPE html>
<html lang="es">
<head>


  <base href="<?php echo $ruta?>">
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Sistema de Sponsors</title>
  <link rel="icon" href="vistas/images/sistema/icon.png">

  <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
  <meta content="Themesbrand" name="author" />
    <!-- jsvectormap css -->
    <link href="vistas/assets/libs/jsvectormap/css/jsvectormap.min.css" rel="stylesheet" type="text/css" />

    <!--Swiper slider css-->
    <link href="vistas/assets/libs/swiper/swiper-bundle.min.css" rel="stylesheet" type="text/css" />

    <!-- Layout config Js -->
    
    <!-- Bootstrap Css -->
    <link href="vistas/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="vistas/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="vistas/assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="vistas/assets/css/custom.min.css" rel="stylesheet" type="text/css" />

</head>

<body style="background: linear-gradient(-45deg, #405189 50%, #0ab39c);">

<?php
  
  if(!isset($_SESSION["iniciarSesion"])){

    if(empty($routesArray[2]) || $routesArray[1] == ""){

      include "paginas/ingreso/ingreso.php"; 

    } elseif(!empty($routesArray[2])){

      if( $routesArray[2] == "" ){  
        
        include "ingreso.php"; 

      } elseif( $routesArray[2] == "ingreso" ||
         $routesArray[2] == "registro" ||
         $routesArray[2] == "usuarios" ||
         $routesArray[2] == "login"){  
        
         include "paginas/ingreso/".$routesArray[2].".php";           

        } else {          
          
          include "paginas/ingreso/404.php";
        }

      } 

  



   echo '</body></head>';

   return;

  }


    
  /*=============================================
Páginas del sitio <?php if (isset($_SESSION["admin"])): ?>
=============================================*/
  
if(isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok"){
     
    include "paginas/modulos/header.php";
    include "paginas/modulos/menu.php";

if(!empty($routesArray[2])){
      
      if( $routesArray[2] == "inicio" ||
         $routesArray[2] == "casos" ||
         $routesArray[2] == "usuarios" ||
         $routesArray[2] == "admin" ||
         $routesArray[2] == "consejeros" ||
         $routesArray[2] == "template" ||
          $routesArray[2] == "salir"){  
        
        include "paginas/".$routesArray[2]."/".$routesArray[2].".php";       
        

      }else {          
          
          include "paginas/404/404.php";
        }

      } else {

       include "paginas/inicio/inicio.php";
                  
      }
     include "paginas/modulos/footer.php";
   
    }

?>

<!-- JAVASCRIPT -->
    <script src="vistas/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vistas/assets/libs/simplebar/simplebar.min.js"></script>
    <script src="vistas/assets/libs/node-waves/waves.min.js"></script>
    <script src="vistas/assets/libs/feather-icons/feather.min.js"></script>
    <script src="vistas/assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="vistas/assets/js/plugins.js"></script>

    <!-- particles js -->
    <script src="vistas/assets/libs/particles.js/particles.js"></script>
    <!-- particles app js -->
    <script src="vistas/assets/js/pages/particles.app.js"></script>
    <!-- password-addon init -->
    <script src="vistas/assets/js/pages/password-addon.init.js"></script>
</body>

</html>