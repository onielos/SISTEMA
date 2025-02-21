<?php

require_once "../controllers/stores.controller.php";
require_once "../models/stores.models.php";

class TablaTiendas {

    /*=============================================
    MOSTRAR LA TABLA DE TIENDAS
    =============================================*/ 
    public function mostrarTablaTiendas() {

        $item = null;
        $valor = null;

        // Llamamos al controlador para obtener las tiendas
        $tiendas = StoresController::ctrShowStores($item, $valor);

        if (count($tiendas) == 0) {
            echo json_encode(['data' => []]);
            return;
        }

        $tiendasArray = [];

        foreach ($tiendas as $i => $tienda) {

            // Generamos el HTML de los botones de acción
            $botones = "<div class='btn-group'>
                            <button class='btn btn-success rounded-circle mr-2 btnEditarTienda' idTienda='".$tienda["id_store"]."'>
                                <i class='fas fa-pen'></i>
                            </button>
                            <button class='btn btn-danger rounded-circle mr-2 btnEliminarTienda' idTienda='".$tienda["id_store"]."'>
                                <i class='fas fa-trash'></i>
                            </button>
                        </div>";

            // Agregamos los datos de la tienda al array
            $tiendasArray[] = [
                ($i + 1),
                $tienda["name_store"],
                $tienda["location_store"],
                $tienda["phone_number_store"],
                $tienda["date_created_store"],
                $botones
            ];
        }

        // Convertimos el array a JSON y lo mostramos
        echo json_encode(['data' => $tiendasArray]);
    }
}

/*=============================================
ACTIVAR TABLA DE TIENDAS
=============================================*/ 
$activarTiendas = new TablaTiendas();
$activarTiendas->mostrarTablaTiendas();

?>
