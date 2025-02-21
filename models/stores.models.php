<?php

require_once "connection.php";

class StoresModel
{
    /*=============================================
    SHOW STORES
    =============================================*/

    static public function mdlShowStores($table, $item, $value)
    {
        if ($item != null) {
            // If a specific item is provided, fetch the store by the specified column
            $stmt = Connection::connect()->prepare("SELECT * FROM $table WHERE $item = :$item");
            $stmt->bindParam(":" . $item, $value, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
        } else {
            // If no item is specified, fetch all stores
            $stmt = Connection::connect()->prepare("SELECT * FROM $table");
            $stmt->execute();
            return $stmt->fetchAll();
        }

        $stmt->close();
        $stmt = null;
    }

    /*=============================================
    CREATE STORE
    =============================================*/

    public static function mdlCreateStore($table, $data)
    {
        $stmt = Connection::connect()->prepare("INSERT INTO $table (name_store, location_store, phone_number_store, manager_store) 
                                                VALUES (:name_store, :location_store, :phone_number_store, :manager_store)");

        $stmt->bindParam(":name_store", $data["name_store"], PDO::PARAM_STR);
        $stmt->bindParam(":location_store", $data["location_store"], PDO::PARAM_STR);
        $stmt->bindParam(":phone_number_store", $data["phone_number_store"], PDO::PARAM_STR);
        $stmt->bindParam(":manager_store", $data["manager_store"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "success";
        } else {
            return "error";
        }

        $stmt->close();
        $stmt = null;
    }

    /*=============================================
    UPDATE STORE
    =============================================*/

    public static function mdlUpdateStore($table, $data)
    {
        $stmt = Connection::connect()->prepare("UPDATE $table 
                                                SET name_store = :name_store, 
                                                    location_store = :location_store, 
                                                    phone_number_store = :phone_number_store, 
                                                    manager_store = :manager_store, 
                                                    date_update_store = NOW() 
                                                WHERE id_store = :id_store");

        $stmt->bindParam(":name_store", $data["name_store"], PDO::PARAM_STR);
        $stmt->bindParam(":location_store", $data["location_store"], PDO::PARAM_STR);
        $stmt->bindParam(":phone_number_store", $data["phone_number_store"], PDO::PARAM_STR);
        $stmt->bindParam(":manager_store", $data["manager_store"], PDO::PARAM_STR);
        $stmt->bindParam(":id_store", $data["id_store"], PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "success";
        } else {
            return "error";
        }

        $stmt->close();
        $stmt = null;
    }

    /*=============================================
    DELETE STORE
    =============================================*/

    public static function mdlDeleteStore($table, $id)
    {
        $stmt = Connection::connect()->prepare("DELETE FROM $table WHERE id_store = :id_store");
        $stmt->bindParam(":id_store", $id, PDO::PARAM_INT);

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
