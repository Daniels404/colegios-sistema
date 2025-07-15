<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="mb-4"><i class="bi bi-person-plus"></i> Registrar Nuevo Usuario</h2>

    <?php if (isset($_SESSION['mensaje'])): ?>
        <div class="alert alert-success">
            <?= $_SESSION['mensaje']; unset($_SESSION['mensaje']); ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="index.php?page=guardar_usuario" class="bg-white p-4 shadow rounded">

        <!-- Usuario -->
        <div class="mb-3">
            <label for="usuario" class="form-label">Nombre de usuario</label>
            <input type="text" name="usuario" id="usuario" class="form-control" required>
        </div>

        <!-- Clave -->
        <div class="mb-3">
            <label for="clave" class="form-label">Contraseña</label>
            <input type="password" name="clave" id="clave" class="form-control" required>
        </div>

        <!-- Rol -->
        <div class="mb-3">
            <label for="rol_id" class="form-label">Rol</label>
            <select name="rol_id" id="rol_id" class="form-select" required>
                <option value="">Seleccione un rol...</option>
                <?php foreach ($roles as $rol): ?>
                    <option value="<?= $rol['id'] ?>"><?= htmlspecialchars($rol['nombre']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" class="btn btn-success">
            <i class="bi bi-check-circle-fill me-1"></i> Registrar Usuario
        </button>

        <a href="index.php?page=usuarios" class="btn btn-secondary ms-2">
            <i class="bi bi-arrow-left-circle me-1"></i> Volver
        </a>
    </form>
</div>

</body>
</html>
