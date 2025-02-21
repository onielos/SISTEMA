<?php
// Datos de conexión a la base de datos
$host = 'localhost'; // Cambia según tu servidor de base de datos
$dbname = 'vapor'; // Nombre de la base de datos
$userDB = 'root'; // Usuario de la base de datos
$passDB = ''; // Contraseña del usuario

// DSN para la conexión PDO
$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";

// Establecer la conexión con la base de datos
try {
    $pdo = new PDO($dsn, $userDB, $passDB);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
    exit();
}
?>
