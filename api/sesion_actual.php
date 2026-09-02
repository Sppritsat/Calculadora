<?php
// ==============================================================================
// API: ¿HAY SESIÓN ACTIVA?
// El frontend llama esto al cargar la página para decidir si muestra el login
// o la calculadora directamente.
// ==============================================================================

session_start();
header('Content-Type: application/json; charset=utf-8');

if (isset($_SESSION['id_usuario'])) {
    echo json_encode([
        'status'    => 'success',
        'logueado'  => true,
        'usuario'   => [
            'id_usuario' => $_SESSION['id_usuario'],
            'nombre'     => $_SESSION['nombre'],
            'email'      => $_SESSION['email'],
        ],
    ]);
} else {
    echo json_encode(['status' => 'success', 'logueado' => false]);
}