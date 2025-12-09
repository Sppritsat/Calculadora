<?php
// Datos de conexión para Oracle en Docker
$username = 'usuario_finanzas';
$password = 'admin1234';
$database = '//db:1521/XEPDB1'; // 'db' es el nombre del servicio en docker-compose

// Conectar usando OCI8
$conexion = @oci_connect($username, $password, $database, 'AL32UTF8');

if (!$conexion) {
    $m = oci_error();
    // Respondemos con JSON para que el Frontend no se rompa feo
    echo json_encode(['error' => 'Error de conexión: ' . $m['message']]);
    exit;
}
?>