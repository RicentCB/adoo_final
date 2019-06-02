<header class="main-header">
    <!-- ============================ -->
    <!-- L O G O T I P O  -->
    <!-- ============================ -->
    <a href="home" class="logo">
        <!-- Logo Mini -->
        <span class="logo-mini">
            <img src="view/img/plantilla/icono-blanco.png" class="img-responsive" style="padding:10px">
        </span>
        <!-- Logo Normal -->
        <span class="logo-lg">
            <img src="view/img/plantilla/logo-blanco-lineal.png" class="img-responsive" style="padding:7px 0">
        </span>
    </a>

    <!-- ============================ -->
    <!-- S I D E B A R  -->
    <!-- ============================ -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Nav Button -->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle Nav</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>

        <!-- User Profile -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <?php
                            $foto = "view/img/usuarios/default/anonymous.png";
                            if($_SESSION["user"]["foto"] != NULL){  //Existe foto
                                $foto = $_SESSION["user"]["foto"];
                            }
                        ?>

                        <img src="<?php echo $foto; ?>" class="user-image">
                        <span class="hidden-xs"><?php echo $_SESSION["user"]["nombre"]; ?></span>
                    </a>
                    <!-- Dropdown Toggle -->
                    <ul class="dropdown-menu">
                        <li class="user-body">
                            <div class="pull-right"><a href="logOut" class="btn btn-default btn-flat">Salir</a></div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>

        
    </nav>
</header>