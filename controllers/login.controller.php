<?php

class LoginController{
    static public function ctrLoginUser(){
        if(isset($_POST["ingUsuario"])){
            $ingUsuario = trim($_POST["ingUsuario"]);
            $ingContra = $_POST["ingContra"];
            
            // Validación básica
            if(preg_match('/^[a-zA-Z0-9]+$/', $ingUsuario) && preg_match('/^[a-zA-Z0-9]+$/', $ingContra)){

                // Preparar la consulta para evitar inyección SQL
                $tabla = "users";
                $item = "username_user";
                $valor = $ingUsuario;
                
                // Consultar al usuario en la base de datos
                $respuesta = UserModel::MdlShowUsers($tabla, $item, $valor);
                
                if($respuesta){
                    // Verificar la contraseña usando password_verify
                    if(password_verify($ingContra, $respuesta["password_user"])){
                        
                        // Verificar si el usuario está activo
                        if($respuesta["status_user"] == 1){
                            $_SESSION["startSession"] = "ok";
                            $_SESSION["id_user"] = $respuesta["id_user"];
                            $_SESSION["displayname_user"] = $respuesta["displayname_user"];
                            $_SESSION["username_user"] = $respuesta["username_user"];
                            $_SESSION["picture_user"] = $respuesta["picture_user"];
                           
                            // Registro de último login
                            date_default_timezone_set('America/Tegucigalpa');
                            $fechaActual = date('Y-m-d H:i:s');
                            
                            $item1 = "last_login_user";
                            $valor1 = $fechaActual;
                            $item2 = "id_user";
                            $valor2 = $respuesta["id_user"];
                            
                            $lastLogin = UserModel::mdlUpdateUser($tabla, $item1, $valor1, $item2, $valor2);
                            
                            if($lastLogin == "ok"){
                           
                                echo "
                                    <script>
                                        ToastLib.showToast('success', 'Bienvenido.');
                                        setTimeout(function() {
                                            window.location.href = '/home'; 
                                        }, 1000); 
                                    </script>
                                ";


                            }
                        } else {
                            echo "<script>
                                ToastLib.showToast('error', 'El usuario no esta Activado.');
                            </script>";
                        }
                    } else {
                        
                        echo "<script>
                                ToastLib.showToast('error', 'Los datos ingresados son incorrectos.');
                            </script>";;
                    }
                } else {
                    echo "<script>
                                ToastLib.showToast('error', 'El usuario no existe');
                            </script>";
                }
            }
        }
    }
}
?>
