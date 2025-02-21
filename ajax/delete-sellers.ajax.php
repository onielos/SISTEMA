<?php
require_once "../controllers/sellers.controller.php";
require_once "../models/sellers.models.php";
header('Content-Type: application/json');

if (isset($_POST['id_vendedor'])) {
    $idVendedor = $_POST['id_vendedor'];

    // Llamamos al controlador para manejar la eliminación del vendedor
    $response = SellersController::ctrDeleteSeller($idVendedor);

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
