<?php

require_once "../controllers/plans.controller.php";
require_once "../models/plans.models.php";

class TablaPlanes {

    /*=============================================
    MOSTRAR LA TABLA DE PLANES
    =============================================*/ 
    public function mostrarTablaPlanes() {

        $item = null;
        $valor = null;

        // Llamamos al controlador para obtener los planes
        $planes = PlansController::ctrShowPlans($item, $valor);

        if (count($planes) == 0) {
            echo json_encode(['data' => []]);
            return;
        }

        $planesArray = [];

        foreach ($planes as $i => $plan) {

            // Generamos el HTML de los botones de acción
            $botones = "<div class='btn-group'>
                            <button class='btn btn-success rounded-circle mr-2 btnEditarPlan' idPlan='".$plan["id_plan"]."'>
                                <i class='fas fa-pen'></i>
                            </button>
                            <button class='btn btn-danger rounded-circle mr-2 btnEliminarPlan' idPlan='".$plan["id_plan"]."'>
                                <i class='fas fa-trash'></i>
                            </button>
                        </div>";

            // Agregamos los datos del plan al array
            $planesArray[] = [
                ($i + 1),
                $plan["name_plan"],
                $plan["prefix_plan"],
                $plan["duration_days_plan"] . "d " . $plan["duration_hours_plan"] . "h " . $plan["duration_seconds_plan"] . "s",
                $plan["validity_days_plan"] . "d " . $plan["validity_hours_plan"] . "h " . $plan["validity_seconds_plan"] . "s",
                $plan["upload_speed_plan"],
                $plan["download_speed_plan"],
                $plan["user_type_plan"],
                $plan["password_type_plan"],
                $botones
            ];
        }

        // Convertimos el array a JSON y lo mostramos
        echo json_encode(['data' => $planesArray]);
    }
}

/*=============================================
ACTIVAR TABLA DE PLANES
=============================================*/ 
$activarPlanes = new TablaPlanes();
$activarPlanes->mostrarTablaPlanes();

?>
