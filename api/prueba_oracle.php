<?php
require 'conexion.php';

echo "<h1>¡Éxito Total! 🚀</h1>";
echo "<p>PHP se ha conectado correctamente a Oracle Database.</p>";
echo "<p>Versión del servidor: " . oci_server_version($conn) . "</p>";
?>