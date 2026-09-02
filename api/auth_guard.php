<?php
// ==============================================================================
// GUARDIA DE SESIÓN
// Incluir este archivo al inicio de cualquier endpoint que requiera un usuario
// autenticado. Si no hay sesión activa, corta la ejecución con un 401.
// ==============================================================================

session_start();
header('Content-Type: application/json; charset=utf-8');

if (!isset($_SESSION['id_usuario'])) {
    http_response_code(401);
    echo json_encode(['status' => 'error', 'message' => 'No has iniciado sesión']);
    exit;
}