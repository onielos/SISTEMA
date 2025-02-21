<?php

require_once "../controllers/sellers.controller.php";
require_once "../models/sellers.models.php";

class TablaVendedores {

    /*=============================================
    MOSTRAR LA TABLA DE VENDEDORES
    =============================================*/ 
    public function mostrarTablaVendedores() {

        $item = null;
        $valor = null;

        // Llamamos al controlador para obtener los vendedores
        $vendedores = SellersController::ctrShowSellers($item, $valor);

        if (count($vendedores) == 0) {
            echo json_encode(['data' => []]);
            return;
        }

        $vendedoresArray = [];

        foreach ($vendedores as $i => $vendedor) {

            // Generamos el HTML de los botones de acción
            $botones = "<div class='btn-group'>
                            <button class='btn btn-success rounded-circle mr-2 btnEditarVendedor' idVendedor='".$vendedor["id_seller"]."'>
                                <i class='fas fa-pen'></i>
                            </button>
                            <button class='btn btn-danger rounded-circle mr-2 btnEliminarVendedor' idVendedor='".$vendedor["id_seller"]."'>
                                <i class='fas fa-trash'></i>
                            </button>
                        </div>";

            // Agregamos los datos del vendedor al array
            $vendedoresArray[] = [
                ($i + 1),
                $vendedor["name_seller"],
                $vendedor["store_name_seller"],
                $vendedor["phone_number_seller"],
                $vendedor["date_created_seller"],
                $botones
            ];
        }

        // Convertimos el array a JSON y lo mostramos
        echo json_encode(['data' => $vendedoresArray]);
    }
}

/*=============================================
ACTIVAR TABLA DE VENDEDORES
=============================================*/ 
$activarVendedores = new TablaVendedores();
$activarVendedores->mostrarTablaVendedores();

?>
