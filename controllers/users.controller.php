<?php

class UserController
{
    /*=============================================
    SHOW USERS
    =============================================*/

    public static function ctrShowUsers($item, $valor)
    {
        $tabla = "users";

        $respuesta = UserModel::MdlShowUsers($tabla, $item, $valor);

        return $respuesta;
    }

    /*=============================================
    CREATE USER
    =============================================*/

    public static function ctrCreateUser()
{
    if (isset($_POST["username"])) {
        // Sanitize and assign POST data
        $encriptar = crypt($_POST["password"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
        $displayname_user = htmlspecialchars($_POST["displayname"], ENT_QUOTES, 'UTF-8');
        $username_user = htmlspecialchars($_POST["username"], ENT_QUOTES, 'UTF-8');
        $rol_user = htmlspecialchars($_POST["role"], ENT_QUOTES, 'UTF-8');
        $password_user = $encriptar;
        $status_user = 1;
        $last_login_user = date("Y-m-d H:i:s");

        // Initialize image path variable
        $ruta = "";

        // Validate image upload
        if ($_FILES["picture"]["tmp_name"] != "") {
            list($ancho, $alto) = getimagesize($_FILES["picture"]["tmp_name"]);

            $nuevoAncho = 500;
            $nuevoAlto = 500;

            // Create the directory to store the user's picture
            $directorio = "uploads/users/" . $_POST["username"];
            if (!is_dir($directorio)) {
                mkdir($directorio, 0755, true);
            }

            // Check image type and handle accordingly
            if ($_FILES["picture"]["type"] == "image/jpeg") {
                $aleatorio = mt_rand(100, 999);
                $ruta = "uploads/users/" . $_POST["username"] . "/" . $aleatorio . ".jpg";
                $origen = imagecreatefromjpeg($_FILES["picture"]["tmp_name"]);
                $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                imagejpeg($destino, $ruta);
            }

            if ($_FILES["picture"]["type"] == "image/png") {
                $aleatorio = mt_rand(100, 999);
                $ruta = "uploads/users/" . $_POST["username"] . "/" . $aleatorio . ".png";
                $origen = imagecreatefrompng($_FILES["picture"]["tmp_name"]);
                $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                imagepng($destino, $ruta);
            }
        } else {
            // If no image is uploaded, use a default picture
            $ruta = "uploads/users/user-default.png";
        }

        $data = array(
            "displayname_user" => $displayname_user,
            "username_user" => $username_user,
            "password_user" => $password_user,
            "picture_user" => $ruta,
            "rol_user" => $rol_user,
            "status_user" => $status_user,
            "last_login_user" => $last_login_user
        );

        // Call the model to create the user
        $respuesta = UserModel::mdlCreateUser("users", $data);

        if ($respuesta == "success") {
            echo "<script>
            ToastLib.showToast('success', '¡Usuario agregado con éxito!');
            setTimeout(function() {
                window.location.href = '/users';
            }, 2000);
        </script>";
        } else {
            echo "<script>
            ToastLib.showToast('error', '¡Error al agregar el usuario!');
            setTimeout(function() {
                window.location.href = '/users';
            }, 2000);
        </script>";
        }

        return $respuesta;
    }
}

    

    /*=============================================
    UPDATE USER
    =============================================*/

    public static function ctrUpdateUser()
    {
        if (isset($_POST["id_user"])) {
            // Sanitize and assign POST data
            $id_user = htmlspecialchars($_POST["id_user"], ENT_QUOTES, 'UTF-8');
            $displayname_user = htmlspecialchars($_POST["displayname"], ENT_QUOTES, 'UTF-8');
            $username_user = htmlspecialchars($_POST["username"], ENT_QUOTES, 'UTF-8');
            $password_user = !empty($_POST["password"]) ? password_hash($_POST["password"], PASSWORD_BCRYPT) : null;
            $picture_user = isset($_POST["picture"]) ? htmlspecialchars($_POST["picture"], ENT_QUOTES, 'UTF-8') : null;
            $status_user = htmlspecialchars($_POST["status"], ENT_QUOTES, 'UTF-8');
            $last_login_user = date("Y-m-d H:i:s");

            $data = array(
                "id_user" => $id_user,
                "displayname_user" => $displayname_user,
                "username_user" => $username_user,
                "password_user" => $password_user,
                "picture_user" => $picture_user,
                "status_user" => $status_user,
                "last_login_user" => $last_login_user
            );

            // Call the model to update the user
            $respuesta = UserModel::mdlUpdateUser("users", $data);

            return $respuesta;
        }
    }

    /*=============================================
    DELETE USER
    =============================================*/

    public static function ctrDeleteUser($idUser)
    {
        $tabla = "users";
        
        // Check if the ID is valid
        if (empty($idUser)) {
            return ['success' => false, 'message' => 'The user ID is invalid.'];
        }

        // Perform the deletion in the database
        $result = UserModel::mdlDeleteUser($tabla, $idUser);

        if ($result == "success") {
            return ['success' => true, 'message' => 'User deleted successfully'];
        } else {
            return ['success' => false, 'message' => 'Failed to delete the user.'];
        }
    }
}
?>
