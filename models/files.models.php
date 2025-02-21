<?php
require_once "connection.php";

class FileModel {
    public static function saveFileRecord($fileName, $date, $filePath, $user) {
        $stmt = Connection::connect()->prepare("INSERT INTO uploads (file_name, upload_date, file_path, user) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$fileName, $date, $filePath, $user]);
    }

    public static function check3DSStatus($authorizationId, $ccBin) {
        $stmt = Connection::connect()->prepare("
            SELECT CASE 
                WHEN JSON_UNQUOTE(a.response) LIKE '%3D-Secure%' 
                THEN 'Cuenta con 3DS' 
                ELSE 'No cuenta' 
            END AS three_ds_status 
            FROM vapor.payments p 
            INNER JOIN vapor.attempts a ON a.payment_id = p.id 
            WHERE a.authorization_id = ? 
            AND p.company_id = 1302 
            AND a.cc_bin = ?
        ");
        $stmt->execute([$authorizationId, $ccBin]);
        return $stmt->fetchColumn();
    }

    /*=============================================
    MOSTRAR ARCHIVOS
    =============================================*/
    public static function mdlShowFiles($table, $item, $valor) {
        try {
            $db = Connection::connect(); // Conexión a la base de datos

            if ($item != null) {
                $stmt = $db->prepare("SELECT * FROM $table WHERE $item = :valor ORDER BY id ASC");
                $stmt->bindParam(":valor", $valor, PDO::PARAM_STR);
                $stmt->execute();
                return $stmt->fetch(PDO::FETCH_ASSOC); // Retorna un solo archivo
            } else {
                $stmt = $db->prepare("SELECT * FROM $table");
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retorna todos los archivos
            }

        } catch (PDOException $e) {
            return [];
        } finally {
            $stmt = null;
            $db = null;
        }
    }
}
