<?php
// ==============================================================================
// API: INICIO DE SESIÓN
// Recibe { email, password } por JSON, valida y crea la sesión.
// ==============================================================================

session_start();
header('Content-Type: application/json; charset=utf-8');
require_once 'conexion.php';

$input = json_decode(file_get_contents('php://input'), true);

$email    = trim(strtolower($input['email'] ?? ''));
$password = $input['password'] ?? '';

if ($email === '' || $password === '') {
    echo json_encode(['status' => 'error', 'message' => 'Faltan datos']);
    exit;
}

try {
    $stmt = $pdo->prepare("SELECT id_usuario, nombre, email, password_hash FROM usuarios WHERE email = :email");
    $stmt->execute([':email' => $email]);
    $usuario = $stmt->fetch();

    // Mismo mensaje de error para correo inexistente o contraseña incorrecta
    // (no revelamos cuál de los dos falló, por seguridad)
    if (!$usuario || !password_verify($password, $usuario['password_hash'])) {
        echo json_encode(['status' => 'error', 'message' => 'Correo o contraseña incorrectos']);
        exit;
    }

    session_regenerate_id(true);
    $_SESSION['id_usuario'] = $usuario['id_usuario'];
    $_SESSION['nombre']     = $usuario['nombre'];
    $_SESSION['email']      = $usuario['email'];

    echo json_encode([
        'status'  => 'success',
        'usuario' => [
            'id_usuario' => $usuario['id_usuario'],
            'nombre'     => $usuario['nombre'],
            'email'      => $usuario['email'],
        ],
    ]);

} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => 'Error al iniciar sesión: ' . $e->getMessage()]);
}