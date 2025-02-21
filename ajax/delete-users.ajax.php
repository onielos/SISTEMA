<?php
require_once "../controllers/users.controller.php";
require_once "../models/user.models.php";
header('Content-Type: application/json');

if (isset($_POST['id_user'])) {
    $idUser = $_POST['id_user'];

    // Llamamos al controlador para manejar la eliminación del usuario
    $response = UserController::ctrDeleteUser($idUser);

    // Verificar la respuesta del controlador
    if ($response['success']) {
        echo json_encode(['success' => true, 'message' => $response['message']]);
    } else {
        echo json_encode(['success' => false, 'message' => $response['message']]);
    }
    
} else {
    echo json_encode(['success' => false, 'message' => 'ID del usuario faltante.']);
}
?>
