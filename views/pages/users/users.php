<div class="container-fluid">
    <!-- Contenido principal -->
    <div class="content-wrapper">
        
        <!-- Encabezado de contenido -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row align-items-center mb-3">
                    
                    <!-- Título de la página -->
                    <div class="col-md-6">
                        <h1 class="display-4">Usuarios</h1>
                    </div>

                    <!-- Ruta de navegación (Breadcrumbs) -->
                    <div class="col-md-6">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb float-sm-right">
                                <?php
                                // Verifica si hay una ruta específica en la URL
                                if (isset($routesArray[2])) {
                                    // Si la ruta es "nuevo" o "editar", muestra el breadcrumb con enlace a Planes
                                    if ($routesArray[2] == "new" || $routesArray[2] == "edit") {
                                        echo '<li class="breadcrumb-item"><a href="/users">Usuarios</a></li>';
                                        echo '<li class="breadcrumb-item active" aria-current="page">' . ucfirst($routesArray[2]) . '</li>';
                                    }
                                } else {
                                    // Ruta de navegación por defecto
                                    echo '<li class="breadcrumb-item"><a href="/home">Inicio</a></li>';
                                    echo '<li class="breadcrumb-item active" aria-current="page">Usuarios</li>';
                                }
                                ?>
                            </ol>
                        </nav>
                    </div>
                    
                </div>
            </div>
        </section>

        <!-- Carga dinámica de contenido -->
        <section class="content">
            <div class="container-fluid">
                <?php
                // Cargar páginas específicas según la ruta
                if (isset($routesArray[2])) {
                    if ($routesArray[2] == "new" || $routesArray[2] == "edit") {
                        include "actions/" . $routesArray[2] . ".php";
                    } else {
                        echo '<div class="alert alert-danger">La página que buscas no fue encontrada</div>';
                    }
                } else {
                    include "actions/list.php";
                }
                ?>
            </div>
        </section>
        
    </div>
    <!-- /.content-wrapper -->
</div>
<!-- /.container-fluid -->
