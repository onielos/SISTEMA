<?php
// require_once "/models/FileModel.php";
require_once "vendor/autoload.php";

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class FileController {
    public static function handleFileUpload() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['excelFile'])) {
            $uploadDir = 'uploads/files/';
            if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

            $file = $_FILES['excelFile'];
            $fileName = 'processed_' . basename($file['name']);
            $filePath = $uploadDir . $fileName;

            if (move_uploaded_file($file['tmp_name'], $filePath)) {
                $user = $_SESSION["displayname_user"] ?? 'Desconocido';
                $date = date('Y-m-d H:i:s');

                if (FileModel::saveFileRecord($fileName, $date, $filePath, $user)) {
                    self::processExcelFile($filePath, $fileName);
                } else {
                    return "Error al guardar el archivo en la base de datos.";
                }
            } else {
                return "Error al subir el archivo.";
            }
        }
        return "No se recibió ningún archivo.";
    }

    private static function processExcelFile($filePath, $fileName) {
        $spreadsheet = IOFactory::load($filePath);
        $sheet = $spreadsheet->getActiveSheet();
        $highestRow = $sheet->getHighestRow();
        $ccBin = "496078";

        for ($row = 2; $row <= $highestRow; $row++) {
            $authorizationId = $sheet->getCell('F' . $row)->getValue();

            if (!empty($authorizationId)) {
                $result = FileModel::check3DSStatus($authorizationId, $ccBin);
                $sheet->setCellValue('J' . $row, $result ?? 'No cuenta');
            } else {
                $sheet->setCellValue('J' . $row, '');
            }
        }

        $writer = new Xlsx($spreadsheet);
        $updatedFileName = 'processed_' . $fileName;
        $updatedFilePath = 'uploads/files/' . $updatedFileName;
        $writer->save($updatedFilePath);

        require "views/pages/upload/upload_result.php";
    }

 
}
