<?php
// Mostrar errores para depurar (opcional, quítalo en producción)
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once 'conexion.php';

// 1. Consulta SQL (Sin comillas invertidas ` ` porque a Oracle no le gustan)
$sql = "SELECT ID_PROYECTO, NOMBRE_PROYECTO FROM PROYECTOS ORDER BY ID_PROYECTO DESC";

// 2. Preparar la sentencia (En lugar de $conexion->query)
$stmt = oci_parse($conexion, $sql);

if (!$stmt) {
    $e = oci_error($conexion);
    echo json_encode(['error' => 'Error al preparar consulta: ' . $e['message']]);
    exit;
}

// 3. Ejecutar
$r = oci_execute($stmt);

if (!$r) {
    $e = oci_error($stmt);
    echo json_encode(['error' => 'Error al ejecutar: ' . $e['message']]);
    exit;
}

$proyectos = [];

// 4. Obtener los datos
while ($fila = oci_fetch_assoc($stmt)) {
    // IMPORTANTE: Oracle devuelve los nombres de columna en MAYÚSCULAS (ID_PROYECTO).
    // Tu JavaScript espera minúsculas (id_proyecto).
    // Esta función convierte todo a minúsculas para que no se rompa tu frontend.
    $fila_minusculas = array_change_key_case($fila, CASE_LOWER);
    
    $proyectos[] = $fila_minusculas;
}

// 5. Limpiar y cerrar
oci_free_statement($stmt);
oci_close($conexion);

// 6. Enviar JSON
header('Content-Type: application/json; charset=utf-8');
echo json_encode($proyectos);
?>