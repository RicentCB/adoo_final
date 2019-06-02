<?php
    session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sistema Inventario</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Favicon -->
    <link rel="shortcut icon" href="view/img/plantilla/icono-negro.png" type="image/x-icon">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="view/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="view/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="view/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="view/dist/css/AdminLTE.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="view/dist/css/skins/_all-skins.min.css">

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

     <!-- DataTables -->
    <link rel="stylesheet" href="view/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="view/bower_components/datatables.net-bs/css/responsive.bootstrap.min.css">


    <!--====================================================-->
    <!-- PLUGIN JavaScript -->
    <!--====================================================-->

    <!-- jQuery 3 -->
    <script src="view/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="view/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    
    <!-- FastClick -->
    <script src="view/bower_components/fastclick/lib/fastclick.js"></script>

    <!-- AdminLTE App -->
    <script src="view/dist/js/adminlte.min.js"></script>

    
    <!-- DataTables -->
    <script src="view/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="view/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="view/bower_components/datatables.net-bs/js/dataTables.responsive.min.js"></script>
    <script src="view/bower_components/datatables.net-bs/js/responsive.bootstrap.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="view/plugins/sweetalert2/sweetalert2.all.js"></script>


</head>
<body class="hold-transition skin-blue sidebar-mini sidebar-collapse login-page">

    <!-- Site wrapper -->

        <!-- =============================== -->
        <!-- =========== MODULES =========== -->
        <!-- =============================== -->
        <?php
            if(isset($_SESSION["login"]) && $_SESSION["login"]){//Sesion Iniciada
                echo '<div class="wrapper">';

                //HEAD
                include "modules/head.php";
                //SIDEBAR MENU
                include "modules/menu.php";
                //CONTENT
                if(isset($_GET["ruta"])){
                    switch ($_GET["ruta"]) {
                        case "home": 
                        case "users": 
                        case "category": 
                        case "product": 
                        case "clients": 
                        case "sales": 
                        case "create-sale": 
                        case "logOut": 
                        case "report": include "modules/".$_GET["ruta"].".php"; break;

                        default: include "modules/404.php"; break;
                    }
                }else{
                    include "modules/home.php";
                }
                //FOOTER
                include "modules/footer.php";

                echo '</div>'; //<!-- ./wrapper -->

            }else{//Sesion No Iniciada 
                include "modules/login.php";
            }
        ?>


    <!-- SCRIPTS -->
    <script src="view/js/template.js"></script>
    <script src="view/js/users.js"></script>
    <script src="view/js/categorias.js"></script>
    <!-- /SCRIPTS -->
</body>
</html>
