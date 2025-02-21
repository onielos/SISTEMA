<?php

require_once "../models/files.models.php";

class TablaArchivos {

    /*=============================================
    MOSTRAR LA TABLA DE ARCHIVOS DIRECTAMENTE DESDE EL MODELO
    =============================================*/ 
    public function mostrarTablaArchivos() {
        $item = null;
        $valor = null;

        // Llamamos directamente al modelo sin pasar por el controlador
        $archivos = FileModel::mdlShowFiles("uploads", $item, $valor);

        if (count($archivos) == 0) {
            echo json_encode(['data' => []]);
            return;
        }

        $archivosArray = [];

        foreach ($archivos as $i => $archivo) {
            // Botón de descarga
            $botonDescargar = "<a href='".$archivo["file_path"]."' class='btn btn-primary' download>
                                <i class='fas fa-download'></i> Descargar
                               </a>";

            // Agregamos los datos del archivo al array
            $archivosArray[] = [
                ($i + 1),
                $archivo["file_name"],
                $archivo["user"],
                $archivo["upload_date"],
                $botonDescargar
            ];
        }

        // Convertimos el array a JSON y lo mostramos
        echo json_encode(['data' => $archivosArray]);
    }
}

/*=============================================
ACTIVAR TABLA DE ARCHIVOS
=============================================*/ 
$activarArchivos = new TablaArchivos();
$activarArchivos->mostrarTablaArchivos();

?>
