<?php
session_start(); // Para obtener el usuario logueado
require '../../../vendor/autoload.php'; // PhpSpreadsheet
require 'conexion.php'; // Archivo con conexión a la BD

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['excelFile'])) {
    $uploadDir = 'uploads/';
    if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
    
    $file = $_FILES['excelFile'];
    $fileName = time() . '_' . basename($file['name']);
    $filePath = $uploadDir . $fileName;
    
    if (move_uploaded_file($file['tmp_name'], $filePath)) {
        $user = $_SESSION['user'] ?? 'Desconocido';
        $date = date('Y-m-d H:i:s');
        
        try {
            // Conexión a la base de datos
            $pdo = new PDO($dsn, $userDB, $passDB, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);

            // Registrar la subida del archivo
            $stmt = $pdo->prepare("INSERT INTO uploads (file_name, upload_date, user) VALUES (?, ?, ?)");
            $stmt->execute([$fileName, $date, $user]);

            // Leer el archivo Excel
            $spreadsheet = IOFactory::load($filePath);
            $sheet = $spreadsheet->getActiveSheet();

            // Procesar las filas del archivo
            $highestRow = $sheet->getHighestRow(); // Número de la última fila con datos

            for ($row = 2; $row <= $highestRow; $row++) {
                // Obtener valores de las celdas
                $authorizationId = $sheet->getCell('F' . $row)->getValue(); // Columna F: "Autorización"
                $ccBin = "496078"; // Código bin fijo

                if (!empty($authorizationId)) {
                    // Consulta para verificar el estado 3DS
                    $query = "SELECT CASE 
                                WHEN JSON_UNQUOTE(a.response) LIKE '%3D-Secure%' 
                                THEN 'Cuenta con 3DS' 
                                ELSE 'No cuenta' 
                              END AS three_ds_status 
                              FROM vapor.payments p 
                              INNER JOIN vapor.attempts a ON a.payment_id = p.id 
                              INNER JOIN vapor.companies c ON c.id = p.company_id 
                              WHERE a.authorization_id = ? 
                                AND p.company_id = 1302 
                                AND a.cc_bin = ?";
                    
                    $stmt = $pdo->prepare($query);
                    $stmt->execute([$authorizationId, $ccBin]);
                    $result = $stmt->fetchColumn();

                    // Actualizar columna "Sello 3DS" (columna H según el archivo proporcionado)
                    $sheet->setCellValue('J' . $row, $result ?? 'No cuenta');
                } else {
                    // Si no hay ID de autorización, asignar "No cuenta"
                    $sheet->setCellValue('J' . $row, '');
                }
            }

            // Guardar el archivo procesado manteniendo el formato original
            $writer = new Xlsx($spreadsheet);
            $updatedFileName = 'processed_' . $fileName;
            $updatedFilePath = $uploadDir . $updatedFileName;
            $writer->save($updatedFilePath);

            // Mostrar enlace para descargar el archivo procesado
            echo "<a href='$updatedFilePath'>Descargar archivo actualizado</a>";

        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Error al subir el archivo";
    }
} else {
    echo "No se recibió ningún archivo";
}
?>
