<?php

require_once "connection.php";

class PlansModel
{
    /*=============================================
    SHOW PLANS
    =============================================*/

    static public function mdlShowPlans($tabla, $item, $valor)
    {
        if ($item != null) {
            // If a specific item is provided, fetch the plan by the specified column
            $stmt = Connection::connect()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
        } else {
            // If no item is specified, fetch all plans
            $stmt = Connection::connect()->prepare("SELECT * FROM $tabla");
            $stmt->execute();
            return $stmt->fetchAll();
        }

        $stmt->close();
        $stmt = null;
    }

    /*=============================================
    CREATE PLAN
    =============================================*/

    public static function mdlCreatePlan($tabla, $data)
    {
        $stmt = Connection::connect()->prepare("INSERT INTO $tabla 
                                                (name_plan, prefix_plan, duration_days_plan, duration_hours_plan, 
                                                 duration_seconds_plan, validity_days_plan, validity_hours_plan, 
                                                 validity_seconds_plan, upload_speed_plan, download_speed_plan, 
                                                 user_type_plan, password_type_plan, password_length_plan) 
                                                VALUES 
                                                (:name_plan, :prefix_plan, :duration_days_plan, :duration_hours_plan, 
                                                 :duration_seconds_plan, :validity_days_plan, :validity_hours_plan, 
                                                 :validity_seconds_plan, :upload_speed_plan, :download_speed_plan, 
                                                 :user_type_plan, :password_type_plan, :password_length_plan)");

        $stmt->bindParam(":name_plan", $data["name_plan"], PDO::PARAM_STR);
        $stmt->bindParam(":prefix_plan", $data["prefix_plan"], PDO::PARAM_STR);
        $stmt->bindParam(":duration_days_plan", $data["duration_days_plan"], PDO::PARAM_INT);
        $stmt->bindParam(":duration_hours_plan", $data["duration_hours_plan"], PDO::PARAM_INT);
        $stmt->bindParam(":duration_seconds_plan", $data["duration_seconds_plan"], PDO::PARAM_INT);
        $stmt->bindParam(":validity_days_plan", $data["validity_days_plan"], PDO::PARAM_INT);
        $stmt->bindParam(":validity_hours_plan", $data["validity_hours_plan"], PDO::PARAM_INT);
        $stmt->bindParam(":validity_seconds_plan", $data["validity_seconds_plan"], PDO::PARAM_INT);
        $stmt->bindParam(":upload_speed_plan", $data["upload_speed_plan"], PDO::PARAM_STR);
        $stmt->bindParam(":download_speed_plan", $data["download_speed_plan"], PDO::PARAM_STR);
        $stmt->bindParam(":user_type_plan", $data["user_type_plan"], PDO::PARAM_STR);
        $stmt->bindParam(":password_type_plan", $data["password_type_plan"], PDO::PARAM_STR);
        $stmt->bindParam(":password_length_plan", $data["password_length_plan"], PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "success";
        } else {
            return "error";
        }

        $stmt->close();
        $stmt = null;
    }

    /*=============================================
    UPDATE PLAN
    =============================================*/

    public static function mdlUpdatePlan($tabla, $data)
    {
        $stmt = Connection::connect()->prepare("UPDATE $tabla 
                                                SET name_plan = :name_plan, 
                                                    prefix_plan = :prefix_plan, 
                                                    duration_days_plan = :duration_days_plan, 
                                                    duration_hours_plan = :duration_hours_plan, 
                                                    duration_seconds_plan = :duration_seconds_plan, 
                                                    validity_days_plan = :validity_days_plan, 
                                                    validity_hours_plan = :validity_hours_plan, 
                                                    validity_seconds_plan = :validity_seconds_plan, 
                                                    upload_speed_plan = :upload_speed_plan, 
                                                    download_speed_plan = :download_speed_plan, 
                                                    user_type_plan = :user_type_plan, 
                                                    password_type_plan = :password_type_plan, 
                                                    password_length_plan = :password_length_plan, 
                                                    date_update_plan = NOW() 
                                                WHERE id_plan = :id_plan");

        $stmt->bindParam(":name_plan", $data["name_plan"], PDO::PARAM_STR);
        $stmt->bindParam(":prefix_plan", $data["prefix_plan"], PDO::PARAM_STR);
        $stmt->bindParam(":duration_days_plan", $data["duration_days_plan"], PDO::PARAM_INT);
        $stmt->bindParam(":duration_hours_plan", $data["duration_hours_plan"], PDO::PARAM_INT);
        $stmt->bindParam(":duration_seconds_plan", $data["duration_seconds_plan"], PDO::PARAM_INT);
        $stmt->bindParam(":validity_days_plan", $data["validity_days_plan"], PDO::PARAM_INT);
        $stmt->bindParam(":validity_hours_plan", $data["validity_hours_plan"], PDO::PARAM_INT);
        $stmt->bindParam(":validity_seconds_plan", $data["validity_seconds_plan"], PDO::PARAM_INT);
        $stmt->bindParam(":upload_speed_plan", $data["upload_speed_plan"], PDO::PARAM_STR);
        $stmt->bindParam(":download_speed_plan", $data["download_speed_plan"], PDO::PARAM_STR);
        $stmt->bindParam(":user_type_plan", $data["user_type_plan"], PDO::PARAM_STR);
        $stmt->bindParam(":password_type_plan", $data["password_type_plan"], PDO::PARAM_STR);
        $stmt->bindParam(":password_length_plan", $data["password_length_plan"], PDO::PARAM_INT);
        $stmt->bindParam(":id_plan", $data["id_plan"], PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "success";
        } else {
            return "error";
        }

        $stmt->close();
        $stmt = null;
    }

    /*=============================================
    DELETE PLAN
    =============================================*/

    public static function mdlDeletePlan($tabla, $id)
    {
        $stmt = Connection::connect()->prepare("DELETE FROM $tabla WHERE id_plan = :id_plan");
        $stmt->bindParam(":id_plan", $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "success";
        } else {
            return "error";
        }

        $stmt->close();
        $stmt = null;
    }
}
?>
