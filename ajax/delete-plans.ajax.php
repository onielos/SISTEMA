<?php
require_once "../controllers/plans.controller.php";
require_once "../models/plans.models.php";
header('Content-Type: application/json');

if (isset($_POST['id_plan'])) {
    $idPlan = $_POST['id_plan'];

    // Llamamos al controlador para manejar la eliminación del plan
    $response = PlansController::ctrDeletePlan($idPlan);

    // Verificar la respuesta del controlador
    if ($response['success']) {
        echo json_encode(['success' => true, 'message' => $response['message']]);
    } else {
        echo json_encode(['success' => false, 'message' => $response['message']]);
    }

} else {
    echo json_encode(['success' => false, 'message' => 'ID del plan faltante.']);
}
?>
