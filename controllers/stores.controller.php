<?php

class StoresController
{
    /*=============================================
    SHOW STORES
    =============================================*/

    public static function ctrShowStores($item, $valor)
    {
        $table = "stores";

        $response = StoresModel::mdlShowStores($table, $item, $valor);

        return $response;
    }

    /*=============================================
    CREATE STORE
    =============================================*/

    public static function ctrCreateStore()
    {
        if (isset($_POST["nombre_local"])) {
            // Sanitize and assign POST data
            $name_store = htmlspecialchars($_POST["nombre_local"], ENT_QUOTES, 'UTF-8');
            $location_store = htmlspecialchars($_POST["ubicacion"], ENT_QUOTES, 'UTF-8');
            $phone_number_store = htmlspecialchars($_POST["telefono"], ENT_QUOTES, 'UTF-8');
            $manager_store = htmlspecialchars($_POST["encargado"], ENT_QUOTES, 'UTF-8');

            $data = array(
                "name_store" => $name_store,
                "location_store" => $location_store,
                "phone_number_store" => $phone_number_store,
                "manager_store" => $manager_store
            );

            // Call the model to create the store
            $response = StoresModel::mdlCreateStore("stores", $data);

            if ($response == "success") {
                echo "<script>
                ToastLib.showToast('success', '¡Tienda agregada con éxito!');
                setTimeout(function() {
                    window.location.href = '/sellers';
                }, 2000);
            </script>";
            } else {
                echo "<script>
                ToastLib.showToast('error', '¡Error al agregar la tienda!');
                setTimeout(function() {
                    window.location.href = '/sellers';
                }, 2000);
            </script>";
            }

            return $response;
        }
    }

    /*=============================================
    UPDATE STORE
    =============================================*/

    public static function ctrUpdateStore()
    {
        if (isset($_POST["id_store"])) {
            // Sanitize and assign POST data
            $id_store = htmlspecialchars($_POST["id_store"], ENT_QUOTES, 'UTF-8');
            $name_store = htmlspecialchars($_POST["nombre_local"], ENT_QUOTES, 'UTF-8');
            $location_store = htmlspecialchars($_POST["ubicacion"], ENT_QUOTES, 'UTF-8');
            $phone_number_store = htmlspecialchars($_POST["telefono"], ENT_QUOTES, 'UTF-8');
            $manager_store = htmlspecialchars($_POST["encargado"], ENT_QUOTES, 'UTF-8');

            $data = array(
                "id_store" => $id_store,
                "name_store" => $name_store,
                "location_store" => $location_store,
                "phone_number_store" => $phone_number_store,
                "manager_store" => $manager_store
            );

            // Call the model to update the store
            $response = StoresModel::mdlUpdateStore("stores", $data);

            return $response;
        }
    }

    /*=============================================
    DELETE STORE
    =============================================*/

    public static function ctrDeleteStore($idStore)
    {
        $table = "stores";

        // Verify that the ID is valid
        if (empty($idStore)) {
            return ['success' => false, 'message' => 'The store ID is invalid.'];
        }

        // Delete the store from the database
        $result = StoresModel::mdlDeleteStore($table, $idStore);

        if ($result) {
            return ['success' => true, 'message' => 'Tienda eliminada con éxito.'];
        } else {
            return ['success' => false, 'message' => 'Could not delete the store.'];
        }
    }
}
?>
