<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-navy navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Usuario -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fa fa-user"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <div class="card card-widget widget-user shadow">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-navy">
                        <h3 class="widget-user-username"><?php echo $_SESSION["displayname_user"]; ?></h3>
                        <h5 class="widget-user-desc">Administrador</h5>
                    </div>
                    <div class="widget-user-image">
                        <?php

                        if ($_SESSION["picture_user"] != "") {

                            echo '<img src="' . $_SESSION["picture_user"] . '" class="img-circle elevation-2" alt="User Image">';

                        }

                        ?>
                    </div>
                    <div class="card-footer">
                    <a href="/logout" class="dropdown-footer btn btn-danger">Cerrar Sesión</a>
                    </div>
                </div>
               
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>

    </ul>
</nav>
<!-- /.navbar -->