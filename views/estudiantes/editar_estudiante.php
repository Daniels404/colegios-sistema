<?php
if (session_status() === PHP_SESSION_NONE) session_start();
include 'views/layout/header.php';
?>

<div class="container mt-5">
    <h2><i class="bi bi-pencil-square me-2"></i>Editar Datos de Contacto del Estudiante</h2>

    <?php if (isset($_SESSION['mensaje'])): ?>
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            <?= $_SESSION['mensaje']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
        <?php unset($_SESSION['mensaje']); ?>
    <?php endif; ?>

    <form action="index.php?controller=estudiante&action=actualizar" method="POST" class="mt-4">
        <input type="hidden" name="id" value="<?= htmlspecialchars($estudiante['id']) ?>">

        <div class="mb-3">
            <label class="form-label">Nombre del Alumno</label>
            <input type="text" class="form-control" value="<?= htmlspecialchars($estudiante['nombre_alumno']) ?>" disabled>
        </div>

        <div class="mb-3">
            <label class="form-label">Documento</label>
            <input type="text" class="form-control" value="<?= htmlspecialchars($estudiante['documento_estudiante']) ?>" disabled>
        </div>

        <div class="mb-3">
            <label for="numero_contacto" class="form-label">Número de Contacto</label>
            <input type="text" class="form-control" id="numero_contacto" name="numero_contacto" value="<?= htmlspecialchars($estudiante['numero_contacto']) ?>">
        </div>

        <div class="mb-3">
            <label for="correo" class="form-label">Correo Electrónico</label>
            <input type="email" class="form-control" id="correo" name="correo" value="<?= htmlspecialchars($estudiante['correo']) ?>">
        </div>

        <div class="mb-3">
            <label for="direccion" class="form-label">Dirección</label>
            <input type="text" class="form-control" id="direccion" name="direccion" value="<?= htmlspecialchars($estudiante['direccion']) ?>">
        </div>

        <div class="mb-3">
            <label for="jornada" class="form-label">Jornada</label>
            <input type="text" class="form-control" id="jornada" name="jornada" value="<?= htmlspecialchars($estudiante['jornada']) ?>">
        </div>

        <div class="mb-3">
            <label for="observaciones" class="form-label">Observaciones</label>
            <textarea class="form-control" id="observaciones" name="observaciones"><?= htmlspecialchars($estudiante['observaciones']) ?></textarea>
        </div>

        <button type="submit" class="btn btn-primary">
            <i class="bi bi-save me-1"></i> Guardar Cambios
        </button>
        <a href="index.php?controller=estudiante&action=index" class="btn btn-secondary ms-2">
            <i class="bi bi-arrow-left-circle me-1"></i> Volver
        </a>
    </form>
</div>