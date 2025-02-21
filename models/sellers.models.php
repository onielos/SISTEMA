<?php

require_once "connection.php";

class SellersModel
{
    /*=============================================
    SHOW SELLERS
    =============================================*/

    static public function mdlShowSellers($tabla, $item, $valor)
    {
        if ($item != null) {
            // If a specific item is provided, fetch the seller by the specified column
            $stmt = Connection::connect()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
        } else {
            // If no item is specified, fetch all sellers
            $stmt = Connection::connect()->prepare("SELECT * FROM $tabla");
            $stmt->execute();
            return $stmt->fetchAll();
        }

        $stmt->close();
        $stmt = null;
    }

    /*=============================================
    CREATE SELLER
    =============================================*/

    public static function mdlCreateSeller($tabla, $data)
    {
        $stmt = Connection::connect()->prepare("INSERT INTO $tabla (name_seller, store_name_seller, phone_number_seller, password_seller) 
                                                VALUES (:name_seller, :store_name_seller, :phone_number_seller, :password_seller)");

        $stmt->bindParam(":name_seller", $data["name_seller"], PDO::PARAM_STR);
        $stmt->bindParam(":store_name_seller", $data["store_name_seller"], PDO::PARAM_STR);
        $stmt->bindParam(":phone_number_seller", $data["phone_number_seller"], PDO::PARAM_STR);
        $stmt->bindParam(":password_seller", $data["password_seller"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "success";
        } else {
            return "error";
        }

        $stmt->close();
        $stmt = null;
    }

    /*=============================================
    UPDATE SELLER
    =============================================*/

    public static function mdlUpdateSeller($tabla, $data)
    {
        $stmt = Connection::connect()->prepare("UPDATE $tabla 
                                                SET name_seller = :name_seller, 
                                                    store_name_seller = :store_name_seller, 
                                                    phone_number_seller = :phone_number_seller, 
                                                    password_seller = :password_seller, 
                                                    date_update_seller = NOW() 
                                                WHERE id_seller = :id_seller");

        $stmt->bindParam(":name_seller", $data["name_seller"], PDO::PARAM_STR);
        $stmt->bindParam(":store_name_seller", $data["store_name_seller"], PDO::PARAM_STR);
        $stmt->bindParam(":phone_number_seller", $data["phone_number_seller"], PDO::PARAM_STR);
        $stmt->bindParam(":password_seller", $data["password_seller"], PDO::PARAM_STR);
        $stmt->bindParam(":id_seller", $data["id_seller"], PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "success";
        } else {
            return "error";
        }

        $stmt->close();
        $stmt = null;
    }

    /*=============================================
    DELETE SELLER
    =============================================*/

    public static function mdlDeleteSeller($tabla, $id)
    {
        $stmt = Connection::connect()->prepare("DELETE FROM $tabla WHERE id_seller = :id_seller");
        $stmt->bindParam(":id_seller", $id, PDO::PARAM_INT);

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
