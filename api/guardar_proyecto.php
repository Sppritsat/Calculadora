<?php
// Mostrar errores para depuración
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once 'conexion.php';

// Recibimos el JSON
$input = file_get_contents('php://input');
$datos = json_decode($input, true);

if (!$datos) {
    echo json_encode(['status' => 'error', 'message' => 'No llegaron datos JSON']);
    exit;
}

$id_proyecto = isset($datos['id_proyecto']) && !empty($datos['id_proyecto']) ? $datos['id_proyecto'] : null;

// Lista de campos de la tabla PROYECTOS (Tal cual como los definimos en el script SQL)
// Nota: En Oracle no usamos comillas invertidas ``
$campos = [
    'NOMBRE_PROYECTO', 'POBLACION_TOTAL', 'PCT_MUJERES', 'PCT_RANGO_EDAD', 
    'PCT_POBLACION_OCUPADA', 'PCT_CONCENTRACION_MERCADO', 'PARTICIPACION_MERCADO', 
    'INCREMENTO_POBLACION', 'INCREMENTO_PRODUCTO', 'PENETRACION_INICIAL', 
    'INCREMENTO_PENETRACION', 'PRECIO_UNITARIO_BASE', 'INCREMENTO_PRECIO', 
    'UNIDADES_VENTA_A1', 'UNIDADES_VENTA_A2', 'UNIDADES_VENTA_A3', 
    'UNIDADES_VENTA_A4', 'UNIDADES_VENTA_A5', 'DIAS_CREDITO_VENTAS', 
    'DIAS_CREDITO_COMPRAS', 'DESCUENTO_PRONTO_PAGO', 'INV_INICIAL_PROD', 
    'INV_FINAL_A1', 'INV_FINAL_A2', 'INV_FINAL_A3', 'INV_FINAL_A4', 'INV_FINAL_A5', 
    'INV_INICIAL_MP', 'INV_FINAL_MP_PCT', 'TIEMPO_UNIDAD_MO', 'COSTO_HORA_MO',
    'INVERSION_INICIAL', 'SALDO_INICIAL', 'PCT_COBRO_EFECTIVO', 'INFLACION_ANUAL',
    'INV_INICIAL_PT'
];
$tipos = 's' . str_repeat('d', 17) . 'ii' . str_repeat('d', 16);

// Mapeo de las claves del JSON (minúsculas) a las columnas de Oracle (Mayúsculas)
$valores = [];
foreach ($campos as $columna) {
    $clave_json = strtolower($columna); // Convertimos NOMBRE_PROYECTO -> nombre_proyecto
    $valores[$columna] = $datos[$clave_json] ?? null;
}

try {
    // NO hay "begin_transaction" en OCI8. Las transacciones son automáticas.
    // Solo hacemos commit al final.

    if (empty($id_proyecto)) {
        // --- INSERTAR NUEVO ---
        
        // Preparamos los placeholders :columna
        $cols = implode(', ', array_keys($valores));
        $binds = ':' . implode(', :', array_keys($valores));
        
        // TRUCO DE ORACLE: Usamos RETURNING para obtener el ID generado
        $sql = "INSERT INTO PROYECTOS ($cols) VALUES ($binds) RETURNING ID_PROYECTO INTO :id_nuevo";
        
        $stmt = oci_parse($conexion, $sql);
        
        // Asignamos (Bindeamos) los valores
        foreach ($valores as $col => $val) {
            // OCI_BIND_BY_NAME necesita una variable por referencia, no un valor directo
            // Por eso usamos $valores[$col]
            oci_bind_by_name($stmt, ":$col", $valores[$col]);
        }
        
        // Bindeamos la variable de salida para el ID
        $id_nuevo = 0;
        oci_bind_by_name($stmt, ":id_nuevo", $id_nuevo, -1, SQLT_INT);
        
        if (!oci_execute($stmt, OCI_NO_AUTO_COMMIT)) { throw new Exception(oci_error($stmt)['message']); }
        
        $id_proyecto = $id_nuevo; // Ya tenemos el ID
        oci_free_statement($stmt);

    } else {
        // --- ACTUALIZAR EXISTENTE ---
        
        $set_parts = [];
        foreach (array_keys($valores) as $col) {
            $set_parts[] = "$col = :$col";
        }
        $set_sql = implode(', ', $set_parts);
        
        $sql = "UPDATE PROYECTOS SET $set_sql WHERE ID_PROYECTO = :id_proy";
        $stmt = oci_parse($conexion, $sql);
        
        foreach ($valores as $col => $val) {
            oci_bind_by_name($stmt, ":$col", $valores[$col]);
        }
        oci_bind_by_name($stmt, ":id_proy", $id_proyecto);
        
        if (!oci_execute($stmt, OCI_NO_AUTO_COMMIT)) { throw new Exception(oci_error($stmt)['message']); }
        oci_free_statement($stmt);
        
        // Borrar hijos viejos para re-insertarlos (Manera fácil de actualizar detalles)
        $tablas_hijas = ['INVERSIONES', 'MATERIAS_PRIMAS', 'GASTOS_ADMINISTRATIVOS', 'GASTOS_VENTAS', 'GASTOS_INDIRECTOS_FIJOS', 'GASTOS_INDIRECTOS_VARIABLES'];
        foreach($tablas_hijas as $tabla) {
            $sql_del = "DELETE FROM $tabla WHERE FK_ID_PROYECTO = :id";
            $stmt_del = oci_parse($conexion, $sql_del);
            oci_bind_by_name($stmt_del, ":id", $id_proyecto);
            oci_execute($stmt_del, OCI_NO_AUTO_COMMIT);
            oci_free_statement($stmt_del);
        }
    }

    // --- INSERTAR DETALLES (Tablas Hijas) ---
    
    // 1. INVERSIONES
    if (!empty($datos['inversiones'])) {
        $sql = "INSERT INTO INVERSIONES (FK_ID_PROYECTO, NOMBRE_ACTIVO, MONTO, VIDA_UTIL_ANIOS, METODO_DEPRECIACION) VALUES (:id, :nom, :monto, :vida, :metodo)";
        $stmt = oci_parse($conexion, $sql);
        foreach ($datos['inversiones'] as $item) {
            oci_bind_by_name($stmt, ":id", $id_proyecto);
            oci_bind_by_name($stmt, ":nom", $item['nombre']);
            oci_bind_by_name($stmt, ":monto", $item['monto']);
            oci_bind_by_name($stmt, ":vida", $item['vida_util']);
            oci_bind_by_name($stmt, ":metodo", $item['tipo']);
            if (!oci_execute($stmt, OCI_NO_AUTO_COMMIT)) throw new Exception("Error inversiones: ".oci_error($stmt)['message']);
        }
        oci_free_statement($stmt);
    }

    // 2. MATERIAS PRIMAS
    if (!empty($datos['materias_primas'])) {
        $sql = "INSERT INTO MATERIAS_PRIMAS (FK_ID_PROYECTO, NOMBRE_MP, CANTIDAD_POR_UNIDAD_PROD, UNIDAD_MEDIDA, COSTO_UNITARIO) VALUES (:id, :nom, :cant, :uni, :costo)";
        $stmt = oci_parse($conexion, $sql);
        foreach ($datos['materias_primas'] as $item) {
            oci_bind_by_name($stmt, ":id", $id_proyecto);
            oci_bind_by_name($stmt, ":nom", $item['nombre']);
            oci_bind_by_name($stmt, ":cant", $item['cantidad']);
            oci_bind_by_name($stmt, ":uni", $item['unidad']);
            oci_bind_by_name($stmt, ":costo", $item['costo_unitario']);
            if (!oci_execute($stmt, OCI_NO_AUTO_COMMIT)) throw new Exception("Error MP: ".oci_error($stmt)['message']);
        }
        oci_free_statement($stmt);
    }

    // 3. GASTOS ADMIN
    if (!empty($datos['gastos_admin'])) {
        $sql = "INSERT INTO GASTOS_ADMINISTRATIVOS (FK_ID_PROYECTO, CONCEPTO, MONTO_MENSUAL) VALUES (:id, :con, :monto)";
        $stmt = oci_parse($conexion, $sql);
        foreach ($datos['gastos_admin'] as $item) {
            oci_bind_by_name($stmt, ":id", $id_proyecto);
            oci_bind_by_name($stmt, ":con", $item['concepto']);
            oci_bind_by_name($stmt, ":monto", $item['monto_mensual']);
            if (!oci_execute($stmt, OCI_NO_AUTO_COMMIT)) throw new Exception("Error Admin: ".oci_error($stmt)['message']);
        }
        oci_free_statement($stmt);
    }

    // 4. GASTOS VENTAS
    if (!empty($datos['gastos_ventas'])) {
        $sql = "INSERT INTO GASTOS_VENTAS (FK_ID_PROYECTO, CONCEPTO, PORCENTAJE_SOBRE_VENTAS) VALUES (:id, :con, :pct)";
        $stmt = oci_parse($conexion, $sql);
        foreach ($datos['gastos_ventas'] as $item) {
            oci_bind_by_name($stmt, ":id", $id_proyecto);
            oci_bind_by_name($stmt, ":con", $item['concepto']);
            oci_bind_by_name($stmt, ":pct", $item['porcentaje_sobre_ventas']);
            if (!oci_execute($stmt, OCI_NO_AUTO_COMMIT)) throw new Exception("Error Ventas: ".oci_error($stmt)['message']);
        }
        oci_free_statement($stmt);
    }
    
    // 5. GASTOS INDIRECTOS FIJOS
    if (!empty($datos['gastos_fijos'])) {
        $sql = "INSERT INTO GASTOS_INDIRECTOS_FIJOS (FK_ID_PROYECTO, CONCEPTO, MONTO_ANUAL) VALUES (:id, :con, :monto)";
        $stmt = oci_parse($conexion, $sql);
        foreach ($datos['gastos_fijos'] as $item) {
            oci_bind_by_name($stmt, ":id", $id_proyecto);
            oci_bind_by_name($stmt, ":con", $item['concepto']);
            oci_bind_by_name($stmt, ":monto", $item['monto_anual']);
            if (!oci_execute($stmt, OCI_NO_AUTO_COMMIT)) throw new Exception("Error GIF: ".oci_error($stmt)['message']);
        }
        oci_free_statement($stmt);
    }

    // 6. GASTOS INDIRECTOS VARIABLES
    if (!empty($datos['gastos_variables'])) {
        $sql = "INSERT INTO GASTOS_INDIRECTOS_VARIABLES (FK_ID_PROYECTO, CONCEPTO, POR_UNIDAD, UNIDAD) VALUES (:id, :con, :por, :uni)";
        $stmt = oci_parse($conexion, $sql);
        foreach ($datos['gastos_variables'] as $item) {
            oci_bind_by_name($stmt, ":id", $id_proyecto);
            oci_bind_by_name($stmt, ":con", $item['concepto']);
            oci_bind_by_name($stmt, ":por", $item['por_unidad']);
            oci_bind_by_name($stmt, ":uni", $item['unidad']);
            if (!oci_execute($stmt, OCI_NO_AUTO_COMMIT)) throw new Exception("Error GIV: ".oci_error($stmt)['message']);
        }
        oci_free_statement($stmt);
    }

    // --- CONFIRMAR TRANSACCIÓN ---
    oci_commit($conexion);
    
    echo json_encode([
        'status' => 'success', 
        'message' => 'Proyecto guardado correctamente en Oracle', 
        'id_proyecto' => $id_proyecto
    ]);

} catch (Exception $e) {
    // Si algo falla, deshacer todo
    oci_rollback($conexion);
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}

oci_close($conexion);
?>