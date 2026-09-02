<?php
// ==============================================================================
// CONEXIÓN A LA BASE DE DATOS (MySQL vía PDO)
// Reemplaza la conexión anterior a Oracle (OCI8).
// Expone la variable $pdo para que la usen los demás endpoints.
// ==============================================================================

$host    = 'db'; // Nombre del servicio en docker-compose.yml
$db      = 'analisis_financiero_db';
$user    = 'usuario_finanzas';
$pass    = 'admin1234';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Los errores lanzan excepciones, no warnings silenciosos
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,        // Filas como arreglos asociativos (minúsculas, como espera el frontend)
    PDO::ATTR_EMULATE_PREPARES   => false,                    // Usa prepared statements reales (más seguro)
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    http_response_code(500);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(['status' => 'error', 'message' => 'Error de conexión a la base de datos: ' . $e->getMessage()]);
    exit;
}