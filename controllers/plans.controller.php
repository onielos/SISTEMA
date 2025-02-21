<?php

class PlansController
{
    /*=============================================
    SHOW PLANS
    =============================================*/
    public static function ctrShowPlans($item, $value)
    {
        $table = "plans";

        $response = PlansModel::mdlShowPlans($table, $item, $value);

        return $response;
    }

    /*=============================================
    CREATE PLAN
    =============================================*/
    public static function ctrCreatePlan()
    {
        if (isset($_POST["nombre_plan"])) {
            // Sanitize and assign POST data
            $name_plan = htmlspecialchars($_POST["nombre_plan"], ENT_QUOTES, 'UTF-8');
            $prefix_plan = htmlspecialchars($_POST["prefijo"], ENT_QUOTES, 'UTF-8');
            $duration_days_plan = intval($_POST["duracion_dias"]);
            $duration_hours_plan = intval($_POST["duracion_horas"]);
            $duration_seconds_plan = intval($_POST["duracion_segundos"]);
            $validity_days_plan = intval($_POST["vigencia_dias"]);
            $validity_hours_plan = intval($_POST["vigencia_horas"]);
            $validity_seconds_plan = intval($_POST["vigencia_segundos"]);
            $upload_speed_plan = htmlspecialchars($_POST["velocidad_subida"], ENT_QUOTES, 'UTF-8');
            $download_speed_plan = htmlspecialchars($_POST["velocidad_bajada"], ENT_QUOTES, 'UTF-8');
            $user_type_plan = htmlspecialchars($_POST["tipo_usuario"], ENT_QUOTES, 'UTF-8');
            $password_type_plan = htmlspecialchars($_POST["tipo_contraseña"], ENT_QUOTES, 'UTF-8');
            $password_length_plan = intval($_POST["longitud_contraseña"]);

            $data = array(
                "name_plan" => $name_plan,
                "prefix_plan" => $prefix_plan,
                "duration_days_plan" => $duration_days_plan,
                "duration_hours_plan" => $duration_hours_plan,
                "duration_seconds_plan" => $duration_seconds_plan,
                "validity_days_plan" => $validity_days_plan,
                "validity_hours_plan" => $validity_hours_plan,
                "validity_seconds_plan" => $validity_seconds_plan,
                "upload_speed_plan" => $upload_speed_plan,
                "download_speed_plan" => $download_speed_plan,
                "user_type_plan" => $user_type_plan,
                "password_type_plan" => $password_type_plan,
                "password_length_plan" => $password_length_plan,
            );

          
            $response = PlansModel::mdlCreatePlan("plans", $data);

            
            if ($response == "success") {
                echo "<script>
                ToastLib.showToast('success', '¡Plan agregado con éxito!');
                setTimeout(function() {
                    window.location.href = '/plans';
                }, 2000);
            </script>";
            } else {
                echo "<script>
                ToastLib.showToast('error', '¡Error al agregar el plan!');
                setTimeout(function() {
                    window.location.href = '/plans';
                }, 2000);
            </script>";
            }

            return $response; 
        }
    }

    /*=============================================
    UPDATE PLAN
    =============================================*/
    public static function ctrUpdatePlan()
    {
        if (isset($_POST["id_plan"])) {
            // Sanitize and assign POST data
            $id_plan = intval($_POST["id_plan"]);
            $name_plan = htmlspecialchars($_POST["nombre_plan"], ENT_QUOTES, 'UTF-8');
            $prefix_plan = htmlspecialchars($_POST["prefijo"], ENT_QUOTES, 'UTF-8');
            $duration_days_plan = intval($_POST["duracion_dias"]);
            $duration_hours_plan = intval($_POST["duracion_horas"]);
            $duration_seconds_plan = intval($_POST["duracion_segundos"]);
            $validity_days_plan = intval($_POST["vigencia_dias"]);
            $validity_hours_plan = intval($_POST["vigencia_horas"]);
            $validity_seconds_plan = intval($_POST["vigencia_segundos"]);
            $upload_speed_plan = htmlspecialchars($_POST["velocidad_subida"], ENT_QUOTES, 'UTF-8');
            $download_speed_plan = htmlspecialchars($_POST["velocidad_bajada"], ENT_QUOTES, 'UTF-8');
            $user_type_plan = htmlspecialchars($_POST["tipo_usuario"], ENT_QUOTES, 'UTF-8');
            $password_type_plan = htmlspecialchars($_POST["tipo_contraseña"], ENT_QUOTES, 'UTF-8');
            $password_length_plan = intval($_POST["longitud_contraseña"]);

            $data = array(
                "id_plan" => $id_plan,
                "name_plan" => $name_plan,
                "prefix_plan" => $prefix_plan,
                "duration_days_plan" => $duration_days_plan,
                "duration_hours_plan" => $duration_hours_plan,
                "duration_seconds_plan" => $duration_seconds_plan,
                "validity_days_plan" => $validity_days_plan,
                "validity_hours_plan" => $validity_hours_plan,
                "validity_seconds_plan" => $validity_seconds_plan,
                "upload_speed_plan" => $upload_speed_plan,
                "download_speed_plan" => $download_speed_plan,
                "user_type_plan" => $user_type_plan,
                "password_type_plan" => $password_type_plan,
                "password_length_plan" => $password_length_plan,
            );

            // Call the model to update the plan
            $response = PlansModel::mdlUpdatePlan("plans", $data);

            return $response;
        }
    }

    /*=============================================
    DELETE PLAN
    =============================================*/
    public static function ctrDeletePlan($idPlan)
    {
        $table = "plans";

        if (empty($idPlan)) {
            return ['success' => false, 'message' => 'Invalid plan ID.'];
        }

        // Perform deletion in the database
        $result = PlansModel::mdlDeletePlan($table, $idPlan);

        if ($result) {
            return ['success' => true, 'message' => 'Plan eliminado con éxito.'];
        } else {
            return ['success' => false, 'message' => 'Failed to delete the plan.'];
        }
    }
}
