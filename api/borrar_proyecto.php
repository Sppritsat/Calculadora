<?php
// ==============================================================================
// API: ELIMINAR PROYECTO
// Solo borra si el proyecto pertenece al usuario en sesión (la condición
// fk_id_usuario en el WHERE es lo que evita que alguien borre proyectos ajenos).
// ==============================================================================

require_once 'auth_guard.php';
require_once 'conexion.php';

$input = json_decode(file_get_contents('php://input'), true);
$id_proyecto = $_GET['id'] ?? $_POST['id'] ?? ($input['id'] ?? null);

if (!$id_proyecto) {
    echo json_encode(['status' => 'error', 'message' => 'Falta el ID']);
    exit;
}

try {
    $stmt = $pdo->prepare("DELETE FROM proyectos WHERE id_proyecto = :id AND fk_id_usuario = :uid");
    $stmt->execute([':id' => $id_proyecto, ':uid' => $_SESSION['id_usuario']]);

    if ($stmt->rowCount() > 0) {
        echo json_encode(['status' => 'success', 'message' => 'Proyecto eliminado']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No se encontró el proyecto o no tienes permiso para eliminarlo']);
    }

} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => 'No se pudo eliminar: ' . $e->getMessage()]);
}