<?php

require_once "connection.php";

class UserModel{

    // Mostrar Usuario
    static public function MdlShowUsers($tabla, $item, $valor){

        if($item != null){

            $stmt = Connection::connect()->prepare("SELECT * FROM  $tabla WHERE $item = :$item");

            $stmt -> bindParam(":".$item,$valor,PDO::PARAM_STR);

            $stmt -> execute();

            return $stmt -> fetch();

        }else{

            $stmt = Connection::connect()->prepare("SELECT * FROM  $tabla");

            $stmt -> execute();

            return $stmt -> fetchAll();  

        }

        $stmt -> close();

        $stmt = null;
    }

    // Actualizar Usuario
    static public function mdlUpdateUser($tabla, $item1, $valor1, $item2, $valor2){

        $stmt = Connection::connect()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

        $stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
        $stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);

        if($stmt -> execute()){

            return "ok";
        
        }else{

            return "error";  

        }

        $stmt -> close();

        $stmt = null;

    }
	// Actualizar Usuario
static public function mdlUpdateUserd($tabla, $datos){

    $stmt = Connection::connect()->prepare("UPDATE $tabla 
                                            SET displayname_user = :displayname_user,
                                                username_user = :username_user,
                                                password_user = :password_user,
                                                picture_user = :picture_user,
                                                status_user = :status_user,
                                                last_login_user = :last_login_user,
                                                date_updated_user = NOW()
                                            WHERE id_user = :id_user");

    // Vincula los parámetros con los datos que vienen del formulario o array
    $stmt->bindParam(":displayname_user", $datos["displayname_user"], PDO::PARAM_STR);
    $stmt->bindParam(":username_user", $datos["username_user"], PDO::PARAM_STR);
    $stmt->bindParam(":password_user", $datos["password_user"], PDO::PARAM_STR);
    $stmt->bindParam(":picture_user", $datos["picture_user"], PDO::PARAM_STR);
    $stmt->bindParam(":status_user", $datos["status_user"], PDO::PARAM_STR);
    $stmt->bindParam(":last_login_user", $datos["last_login_user"], PDO::PARAM_STR);
    $stmt->bindParam(":id_user", $datos["id_user"], PDO::PARAM_INT);

    // Ejecuta la consulta
    if($stmt->execute()){
        return "success";
    }else{
        return "error";
    }

    $stmt->close();
    $stmt = null;
}


    // Crear Usuario
    static public function mdlCreateUser($tabla, $datos){

        $stmt = Connection::connect()->prepare("INSERT INTO $tabla (displayname_user, username_user, password_user, picture_user, rol_user, status_user, last_login_user) 
                                                VALUES (:displayname_user, :username_user, :password_user, :picture_user, :rol_user, :status_user, :last_login_user)");

        $stmt -> bindParam(":displayname_user", $datos["displayname_user"], PDO::PARAM_STR);
        $stmt -> bindParam(":username_user", $datos["username_user"], PDO::PARAM_STR);
        $stmt -> bindParam(":password_user", $datos["password_user"], PDO::PARAM_STR);
        $stmt -> bindParam(":picture_user", $datos["picture_user"], PDO::PARAM_STR);
        $stmt -> bindParam(":rol_user", $datos["rol_user"], PDO::PARAM_STR);
        $stmt -> bindParam(":status_user", $datos["status_user"], PDO::PARAM_STR);
        $stmt -> bindParam(":last_login_user", $datos["last_login_user"], PDO::PARAM_STR);
      
        if($stmt -> execute()){

            return "success";
			
        
        }else{

            return "error";  

        }

        $stmt -> close();

        $stmt = null;

    }

	

    // Eliminar Usuario
    static public function mdlDeleteUser($tabla, $id){

        $stmt = Connection::connect()->prepare("DELETE FROM $tabla WHERE id_user = :id_user");
        $stmt -> bindParam(":id_user", $id, PDO::PARAM_INT);

        if($stmt -> execute()){

            return "success";
        
        }else{

            return "error";  

        }

        $stmt -> close();

        $stmt = null;

    }

}
?>
