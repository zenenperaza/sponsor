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
<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">

<head>

    <base href="vistas">
    <meta charset="utf-8" />
    <title>Dashboard | HV Investment Group!</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="vistas/images/sistema/logo.png">

    <!-- jsvectormap css -->
    <link href="vistas/assets/libs/jsvectormap/css/jsvectormap.min.css" rel="stylesheet" type="text/css" />

    <!--Swiper slider css-->
    <link href="vistas/assets/libs/swiper/swiper-bundle.min.css" rel="stylesheet" type="text/css" />

    <!-- Bootstrap Css -->
    <link href="vistas/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="vistas/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="vistas/assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="vistas/assets/css/custom.min.css" rel="stylesheet" type="text/css" />

    
    <link href="vistas/assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />

</head>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">

    
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
         $routesArray[2] == "usuarios" ||
         $routesArray[2] == "admin" ||
         $routesArray[2] == "genealogia" ||
         $routesArray[2] == "perfil" ||
         $routesArray[2] == "logout"){  
        
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

    <!-- password-addon init -->
    <script src="vistas/assets/js/pages/password-addon.init.js"></script>
        <!-- Sweet Alerts js -->
    <script src="vistas/assets/libs/sweetalert2/sweetalert2.min.js"></script>

    <!-- Sweet alert init js-->
    <script src="vistas/assets/js/pages/sweetalerts.init.js"></script>

</body>

</html>


    <!-- apexcharts -->
    <script src="vistas/assets/libs/apexcharts/apexcharts.min.js"></script>

    <!-- Vector map-->
    <script src="vistas/assets/libs/jsvectormap/js/jsvectormap.min.js"></script>
    <script src="vistas/assets/libs/jsvectormap/maps/world-merc.js"></script>

    <!--Swiper slider js-->
    <script src="vistas/assets/libs/swiper/swiper-bundle.min.js"></script>

    <!-- Dashboard init -->
    <script src="vistas/assets/js/pages/dashboard-ecommerce.init.js"></script>

    <!-- App js -->
    <script src="vistas/assets/js/app.js"></script>
</body>

</html>