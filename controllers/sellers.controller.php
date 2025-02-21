<?php

class SellersController
{
    /*=============================================
    SHOW SELLERS
    =============================================*/

    public static function ctrShowSellers($item, $valor)
    {
        $tabla = "sellers";

        $respuesta = SellersModel::mdlShowSellers($tabla, $item, $valor);

        return $respuesta;
    }

    /*=============================================
    CREATE SELLER
    =============================================*/

    public static function ctrCreateSeller()
    {
        if (isset($_POST["nombre_vendedor"])) {
            // Sanitize and assign POST data
            $name_seller = htmlspecialchars($_POST["nombre_vendedor"], ENT_QUOTES, 'UTF-8');
            $store_name_seller = htmlspecialchars($_POST["tienda"], ENT_QUOTES, 'UTF-8');
            $phone_number_seller = htmlspecialchars($_POST["telefono"], ENT_QUOTES, 'UTF-8');
            $password_seller = password_hash($_POST["contraseña"], PASSWORD_BCRYPT);

            $data = array(
                "name_seller" => $name_seller,
                "store_name_seller" => $store_name_seller,
                "phone_number_seller" => $phone_number_seller,
                "password_seller" => $password_seller
            );

            // Call the model to create the seller
            $respuesta = SellersModel::mdlCreateSeller("sellers", $data);
            
            if ($respuesta == "success") {
                echo "<script>
                ToastLib.showToast('success', '¡Vendedor agregado con éxito!');
                setTimeout(function() {
                    window.location.href = '/sellers';
                }, 2000);
            </script>";
            } else {
                echo "<script>
                ToastLib.showToast('error', '¡Error al agregar el vendedor!');
                setTimeout(function() {
                    window.location.href = '/sellers';
                }, 2000);
            </script>";
            }

            return $respuesta;
        }
    }

    /*=============================================
    UPDATE SELLER
    =============================================*/

    public static function ctrUpdateSeller()
    {
        if (isset($_POST["id_seller"])) {
            // Sanitize and assign POST data
            $id_seller = htmlspecialchars($_POST["id_seller"], ENT_QUOTES, 'UTF-8');
            $name_seller = htmlspecialchars($_POST["nombre_vendedor"], ENT_QUOTES, 'UTF-8');
            $store_name_seller = htmlspecialchars($_POST["tienda"], ENT_QUOTES, 'UTF-8');
            $phone_number_seller = htmlspecialchars($_POST["telefono"], ENT_QUOTES, 'UTF-8');
            $password_seller = !empty($_POST["contraseña"]) ? password_hash($_POST["contraseña"], PASSWORD_BCRYPT) : null;

            $data = array(
                "id_seller" => $id_seller,
                "name_seller" => $name_seller,
                "store_name_seller" => $store_name_seller,
                "phone_number_seller" => $phone_number_seller,
                "password_seller" => $password_seller
            );

            // Call the model to update the seller
            $respuesta = SellersModel::mdlUpdateSeller("sellers", $data);

            return $respuesta;
        }
    }

    /*=============================================
    DELETE SELLER
    =============================================*/

    public static function ctrDeleteSeller($idVendedor) {
        $tabla = "sellers";
        // Verificar que el ID es válido
        if (empty($idVendedor)) {
            return ['success' => false, 'message' => 'El ID del vendedor es inválido.'];
        }
    
        // Realizar la eliminación en la base de datos
        $result = SellersModel::mdlDeleteSeller($tabla, $idVendedor);
    
        if ($result) {
            return ['success' => true, 'message' => 'Vendedor eliminado correctamente'];
        } else {
            return ['success' => false, 'message' => 'No se pudo eliminar el vendedor.'];
        }
    }
    
}
?>
