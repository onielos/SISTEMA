<?php

require_once "../controllers/users.controller.php";
require_once "../models/user.models.php";

class TablaUsuarios {

    /*=============================================
    MOSTRAR LA TABLA DE USUARIOS
    =============================================*/ 
    public function mostrarTablaUsuarios() {

        $item = null;
        $valor = null;

        // Llamamos al controlador para obtener los usuarios
        $usuarios = UserController::ctrShowUsers($item, $valor);

        if (count($usuarios) == 0) {
            echo json_encode(['data' => []]);
            return;
        }

        $usuariosArray = [];

        foreach ($usuarios as $i => $usuario) {

            // Generamos el HTML de los botones de acción
            $botones = "<div class='btn-group'>
                            <button class='btn btn-success rounded-circle mr-2 btnEditarUsuario' idUsuario='".$usuario["id_user"]."'>
                                <i class='fas fa-pen'></i>
                            </button>
                            <button class='btn btn-danger rounded-circle mr-2 btnEliminarUsuario' idUsuario='".$usuario["id_user"]."'>
                                <i class='fas fa-trash'></i>
                            </button>
                        </div>";

            $imagen = "<img src='" . $usuario['picture_user'] . "' class='img-thumbnail' alt='User Image' style='width: 50px; height: 50px;'>";

            
            // Agregamos los datos del usuario al array
            $usuariosArray[] = [
                ($i + 1),
                $imagen,
                $usuario["displayname_user"],
                $usuario["username_user"],
                $usuario["last_login_user"],
                $usuario["rol_user"],
                $usuario["status_user"] == 1 ? 'Activo' : 'Inactivo',
                $botones
            ];
        }

        // Convertimos el array a JSON y lo mostramos
        echo json_encode(['data' => $usuariosArray]);
    }
}

/*=============================================
ACTIVAR TABLA DE USUARIOS
=============================================*/ 
$activarUsuarios = new TablaUsuarios();
$activarUsuarios->mostrarTablaUsuarios();

?>
