<?php

class SystemController
{
    /*=============================================
    SHOW SYSTEM SETTINGS
    =============================================*/

    public static function ctrShowSystemSettings()
    {
        $table = "system_settings"; // Name of the table where the settings are stored

        // Call the model to fetch system settings
        $response = SystemModel::mdlShowSystemSettings($table);

        return $response;
    }

    /*=============================================
    UPDATE SYSTEM SETTINGS
    =============================================*/

    public static function ctrUpdateSystemSettings()
    {

        if (isset($_POST["ip"]) && isset($_POST["user"]) && isset($_POST["password"]) && isset($_POST["port"])) {
            // Sanitize and assign POST data
            $ip_address = htmlspecialchars($_POST["ip"], ENT_QUOTES, 'UTF-8');
            $username = htmlspecialchars($_POST["user"], ENT_QUOTES, 'UTF-8');
            $password = htmlspecialchars($_POST["password"], ENT_QUOTES, 'UTF-8');
            $port = (int)$_POST["port"];


            $data = array(
                "ip_address" => $ip_address,
                "username" => $username,
                "password" => $password,
                "port" => $port
            );

            // Call the model to update system settings
            $response = SystemModel::mdlUpdateSystemSettings("system_settings", $data);

            if ($response == "success") {
                echo "<script>
                    ToastLib.showToast('success', 'Datos actualizados con éxito!');
                    setTimeout(function() {
                        window.location.href = '/system';
                    }, 2000);
                </script>";
            } else {
                echo "<script>
                    ToastLib.showToast('error', 'Error updating system settings!');
                    setTimeout(function() {
                        window.location.href = '/system';
                    }, 2000);
                </script>";
            }

            return $response;
        }
    }
}

?>
