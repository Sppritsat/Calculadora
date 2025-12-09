<?php
// ==============================================================================
// API PARA ELIMINAR PROYECTOS
// Este archivo recibe un ID y lo elimina de la base de datos Oracle.
// ==============================================================================

// 1. CONFIGURACIÓN DE ERRORES
// Activamos la visualización de errores para poder depurar si algo falla.
// (En un entorno de producción real, esto debería estar desactivado por seguridad).
ini_set('display_errors', 1);
error_reporting(E_ALL);
// 2. CONEXIÓN A LA BASE DE DATOS
// Importamos el archivo 'conexion.php' que contiene la variable $conexion (el enlace a Oracle).
require_once 'conexion.php';

// 3. RECEPCIÓN DEL ID
// Buscamos el ID del proyecto a borrar.
// El operador '??' (Null Coalescing) intenta leerlo por URL (GET) o por formulario (POST).
// Si no llega por ningún lado, la variable se queda como 'null'.
$id_proyecto = $_GET['id'] ?? $_POST['id'] ?? null;
// 4. VALIDACIÓN Y LÓGICA
if ($id_proyecto) {
    // A. DEFINICIÓN DE LA CONSULTA SQL
    // Escribimos la orden para Oracle.
    // IMPORTANTE: Usamos ":id" como un marcador de posición (Placeholder).
    // No pegamos la variable directamente ("... ID = $id") para evitar ataques de Inyección SQL.
    $sql = "DELETE FROM PROYECTOS WHERE ID_PROYECTO = :id";
    
    // B. PREPARACIÓN DE LA SENTENCIA (Parsing)
    // La función oci_parse analiza la consulta SQL y prepara a Oracle para ejecutarla.
    // Devuelve un recurso ($stmt) que usaremos para manejar esta operación específica.
    $stmt = oci_parse($conexion, $sql);
    // Verificamos si hubo un error de sintaxis en la consulta antes de seguir.
    if (!$stmt) {
        $e = oci_error($conexion);
        echo json_encode(['status' => 'error', 'message' => 'Error al preparar consulta: ' . $e['message']]);
        exit;
    }

    // C. VINCULACIÓN DE VARIABLES (Binding)
    // Aquí conectamos nuestra variable de PHP ($id_proyecto) con el marcador de Oracle (:id).
    // Esto le dice a Oracle: "Donde veas :id, usa este valor de forma segura".
    oci_bind_by_name($stmt, ":id", $id_proyecto);
    
    // D. EJECUCIÓN Y COMMIT
    // Ejecutamos la sentencia preparada.
    // Usamos la constante OCI_COMMIT_ON_SUCCESS para que, si el borrado funciona,
    // guarde los cambios permanentemente de inmediato (haga un COMMIT automático).
    if (oci_execute($stmt, OCI_COMMIT_ON_SUCCESS)) {
       // Si todo salió bien, respondemos al Frontend con un JSON de éxito.
        echo json_encode(['status' => 'success', 'message' => 'Proyecto eliminado']);
    } else {
        // Si algo falló (ej: bloqueo de tabla, error de permisos), capturamos el error y lo enviamos.
        $e = oci_error($stmt);
        echo json_encode(['status' => 'error', 'message' => 'No se pudo eliminar: ' . $e['message']]);
    }
    
    // E. LIMPIEZA DE MEMORIA
    // Liberamos los recursos usados por esta sentencia específica.
    oci_free_statement($stmt);

} else {
    // Si no se recibió ningún ID al principio, avisamos del error.
    echo json_encode(['status' => 'error', 'message' => 'Falta el ID']);
}
// 5. CIERRE DE CONEXIÓN
// Cerramos la "llamada" con la base de datos para no saturar el servidor.
oci_close($conexion);
?>