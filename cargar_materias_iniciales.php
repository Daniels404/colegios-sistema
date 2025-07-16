<?php
require_once 'confi/Database.php';

session_start();

// Validar que solo un usuario admin pueda ejecutar esto (opcional pero recomendable)
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    die("Acceso denegado.");
}

try {
    $db = Database::getConnection();

    // Verificar si ya existen más de 2 materias
    $stmtCheck = $db->query("SELECT COUNT(*) as total FROM materias");
    $total = $stmtCheck->fetch(PDO::FETCH_ASSOC)['total'];

    if ($total > 2) {
        echo "<h3>Ya existen materias registradas. No se insertó nada nuevo.</h3>";
        exit;
    }

    // Lista de materias por defecto
    $materias = [
        'Robótica',
        'Matemáticas',
        'Desarrollo',
        'Diseño',
        '3D y Diseño Industrial',
        'Nano Tecnología',
        'Química'
    ];

    $stmtInsert = $db->prepare("INSERT INTO materias (nombre) VALUES (:nombre)");

    foreach ($materias as $materia) {
        $stmtInsert->execute([':nombre' => $materia]);
    }

    echo "<h3>Materias iniciales cargadas correctamente.</h3>";
    echo "<a href='index.php?page=dashboard'>Ir al dashboard</a>";

} catch (PDOException $e) {
    echo "Error al insertar materias: " . $e->getMessage();
}
?>
