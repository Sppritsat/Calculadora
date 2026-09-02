<?php
// ==============================================================================
// API: CARGAR LISTA DE PROYECTOS DEL USUARIO
// Solo devuelve los proyectos que pertenecen al usuario en sesión.
// ==============================================================================

require_once 'auth_guard.php';
require_once 'conexion.php';

try {
    $stmt = $pdo->prepare(
        "SELECT id_proyecto, nombre_proyecto, fecha_creacion
         FROM proyectos
         WHERE fk_id_usuario = :id
         ORDER BY id_proyecto DESC"
    );
    $stmt->execute([':id' => $_SESSION['id_usuario']]);
    $proyectos = $stmt->fetchAll();

    echo json_encode($proyectos);

} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => 'Error al cargar proyectos: ' . $e->getMessage()]);
}