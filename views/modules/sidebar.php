<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-navy elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link navbar-navy">
        <img src="/views/assets/img/template/logo.svg" alt="LOGO" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-dark text-light">SISTEMA</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="/<?php echo $_SESSION["picture_user"]; ?>" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?php echo $_SESSION["displayname_user"]; ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <a href="/home"
                        class="nav-link <?php if (empty($_GET["ruta"]) || $_GET["ruta"] == "home"): ?>active<?php endif; ?>">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Home</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/users"
                        class="nav-link <?php if (isset($_GET["ruta"]) && $_GET["ruta"] == "users"): ?>active<?php endif; ?>">
                        <i class="nav-icon fas fa-user"></i>
                        <p>Usuarios</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/upload"
                        class="nav-link <?php if (isset($_GET["ruta"]) && $_GET["ruta"] == "upload"): ?>active<?php endif; ?>">
                        <i class="nav-icon fas fa-file"></i>
                        <p>Archivos</p>
                    </a>
                </li>
                <!-- <li class="nav-item">
                    <a href="/history"
                        class="nav-link <?php if (isset($_GET["ruta"]) && $_GET["ruta"] == "history"): ?>active<?php endif; ?>">
                        <i class="nav-icon fas fa-history"></i>
                        <p>Historial</p>
                    </a>
                </li> -->



            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>