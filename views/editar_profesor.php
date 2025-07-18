<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Profesor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2 class="mb-4">✏️ Editar Profesor</h2>

    <form action="index.php?page=actualizar_profesor" method="POST" class="border p-4 bg-white shadow-sm rounded">
        <input type="hidden" name="id" value="<?= $profesor['id'] ?>">

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="<?= $profesor['nombre'] ?>" required>
        </div>

        <div class="mb-3">
            <label for="documento" class="form-label">Documento:</label>
            <input type="text" class="form-control" id="documento" name="documento" value="<?= $profesor['documento'] ?>" required>
        </div>

        <div class="mb-3">
            <label for="contacto" class="form-label">Contacto:</label>
            <input type="text" class="form-control" id="contacto" name="contacto" value="<?= $profesor['contacto'] ?>" required>
        </div>

        <div class="mb-3">
            <label for="correo" class="form-label">Correo:</label>
            <input type="email" class="form-control" id="correo" name="correo" value="<?= $profesor['correo'] ?>" required>
        </div>

        <div class="mb-3">
            <label for="rh" class="form-label">RH:</label>
            <input type="text" class="form-control" id="rh" name="rh" value="<?= $profesor['rh'] ?>" required>
        </div>

        <div class="mb-3">
            <label for="numero_estudiantes" class="form-label">Número de estudiantes:</label>
            <input type="number" class="form-control" id="numero_estudiantes" name="numero_estudiantes" value="<?= $profesor['numero_estudiantes'] ?>" required>
        </div>

        <div class="mb-3">
            <label for="jornada" class="form-label">Jornada:</label>
            <select class="form-select" name="jornada" id="jornada" required>
                <option value="Mañana" <?= $profesor['jornada'] == 'Mañana' ? 'selected' : '' ?>>Mañana</option>
                <option value="Tarde" <?= $profesor['jornada'] == 'Tarde' ? 'selected' : '' ?>>Tarde</option>
                <option value="Noche" <?= $profesor['jornada'] == 'Noche' ? 'selected' : '' ?>>Noche</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="materia_id" class="form-label">Materia:</label>
            <select class="form-select" name="materia_id" id="materia_id" required>
                <option value="">Seleccione una materia</option>
                <?php foreach ($materias as $materia): ?>
                    <option value="<?= $materia['id'] ?>" <?= $profesor['materia_id'] == $materia['id'] ? 'selected' : '' ?>>
                        <?= $materia['nombre'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary w-100">💾 Guardar Cambios</button>
    </form>

    <a href="index.php?page=listado_profesores" class="btn btn-secondary mt-3">← Volver al listado</a>
</div>

</body>
</html>
