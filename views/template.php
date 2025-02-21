<?php
session_start();
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

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISTEMA</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="/views/assets/plugins/adminlte/css/adminlte.min.css">
    <link rel="stylesheet" href="/views/assets/plugins/fontawesome/css/all.min.css">
      <!--favicon-->
      <link rel="shortcut icon" href="/views/assets/img/template/logo.svg" type="image/x-icon">
      <!-- DataTables -->
  <link rel="stylesheet" href="/views/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="/views/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="/views/assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

    <script src="/views/lib/ToastLib.js"></script>
    <script src="/views/assets/plugins/jquery/jquery.min.js"></script>

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<?php
if (isset($_SESSION["startSession"]) && $_SESSION["startSession"] == "ok") {
    include "modules/navbar.php";
    include "modules/sidebar.php";

    if (isset($_GET["ruta"])) {
        
        $ruta = filter_input(INPUT_GET, 'ruta', FILTER_SANITIZE_STRING);

        $validRoutes = ["home", "users", "upload","logout"];
        if (in_array($ruta, $validRoutes)) {
            $filePath = "pages/".$ruta."/".$ruta.".php";
            
                include $filePath;
           
        } else {
            include "pages/404/404.php"; 
        }
    } else {
        include "pages/home/home.php"; 
        // pages/home/home.php
    }

    include "modules/footer.php";
} else {
    include "pages/login/login.php"; 
}
?>
</body>

<script src="/views/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/views/assets/plugins/adminlte/js/adminlte.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="/views/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/views/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/views/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="/views/assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="/views/assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="/views/assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="/views/assets/plugins/jszip/jszip.min.js"></script>
<script src="/views/assets/plugins/pdfmake/pdfmake.min.js"></script>
<script src="/views/assets/plugins/pdfmake/vfs_fonts.js"></script>
<script src="/views/assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="/views/assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="/views/assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
</html>
