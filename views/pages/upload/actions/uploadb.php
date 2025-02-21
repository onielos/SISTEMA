<?php
session_start();
date_default_timezone_set('America/Tegucigalpa'); // Ajusta la zona horaria si es necesario

$uploadDir = 'uploads/';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['excelFile'])) {
    $file = $_FILES['excelFile'];
    $fileName = basename($file['name']);
    $fileTmp = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    $allowedExtensions = ['xls', 'xlsx'];
    if (!in_array($fileExt, $allowedExtensions)) {
        die(json_encode(['status' => 'error', 'message' => 'Solo se permiten archivos Excel (.xls, .xlsx)']));
    }

    $newFileName = time() . "_" . $fileName;
    $filePath = $uploadDir . $newFileName;

    if (move_uploaded_file($fileTmp, $filePath)) {
        $user = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : 'Desconocido';
        $dateTime = date('Y-m-d H:i:s');

        // Guardar en base de datos (Asegúrate de tener conexión a tu DB)
        $conn = new mysqli("localhost", "usuario", "contraseña", "base_de_datos");

        if ($conn->connect_error) {
            die(json_encode(['status' => 'error', 'message' => 'Error de conexión a la base de datos']));
        }

        $stmt = $conn->prepare("INSERT INTO archivos (nombre, ruta, usuario, fecha_subida) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $fileName, $filePath, $user, $dateTime);
        $stmt->execute();
        $stmt->close();
        $conn->close();

        echo json_encode(['status' => 'success', 'message' => 'Archivo subido exitosamente', 'file' => $newFileName]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error al subir el archivo']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'No se recibió un archivo válido']);
}
?>
