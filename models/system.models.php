<?php

require_once "connection.php";

class SystemModel
{
    /*=============================================
    SHOW SYSTEM SETTINGS
    =============================================*/

    static public function mdlShowSystemSettings($table)
    {
        // Fetch the current system settings from the table
        $stmt = Connection::connect()->prepare("SELECT * FROM $table LIMIT 1");
        $stmt->execute();
        return $stmt->fetch(); // Assuming only one row of settings exists

        $stmt->close();
        $stmt = null;
    }

    /*=============================================
    UPDATE SYSTEM SETTINGS
    =============================================*/

    public static function mdlUpdateSystemSettings($table, $data)
    {
        // Update the system settings in the database
        $stmt = Connection::connect()->prepare("UPDATE $table 
                                                SET ip_address_system = :ip_address, 
                                                    username_system = :username, 
                                                    password_system = :password, 
                                                    port_system = :port
                                                WHERE id_system = 1");  

        $stmt->bindParam(":ip_address", $data["ip_address"], PDO::PARAM_STR);
        $stmt->bindParam(":username", $data["username"], PDO::PARAM_STR);
        $stmt->bindParam(":password", $data["password"], PDO::PARAM_STR);
        $stmt->bindParam(":port", $data["port"], PDO::PARAM_INT);

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
