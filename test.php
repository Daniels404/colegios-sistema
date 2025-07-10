<?php
require_once 'Confi/Database.php'; // Ajusta el nombre si es necesario

try {
    $conn = Database::getConnection();
    echo "✅ Conexión exitosa a la base de datos.";
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage();
}
