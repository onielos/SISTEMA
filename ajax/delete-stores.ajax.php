<?php
require_once "../controllers/stores.controller.php";
require_once "../models/stores.models.php";
header('Content-Type: application/json');

if (isset($_POST['id_store'])) {
    $idStore = $_POST['id_store'];

    // Llamamos al controlador para manejar la eliminación del negocio
    $response = StoresController::ctrDeleteStore($idStore);

    // Verificar la respuesta del controlador
    if ($response['success']) {
        echo json_encode(['success' => true, 'message' => $response['message']]);
    } else {
        echo json_encode(['success' => false, 'message' => $response['message']]);
    }
    
} else {
    echo json_encode(['success' => false, 'message' => 'ID del vendedor faltante.']);
}
?>
