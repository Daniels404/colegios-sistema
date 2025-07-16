<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<?php include 'views/layout/header.php'; ?>

<div class="container my-5">
    <h2 class="mb-4 text-center"><i class="bi bi-journal-plus me-2"></i> Registrar Materia</h2>

    <?php if (isset($_SESSION['mensaje'])): ?>
        <div class="alert alert-success text-center"><?= $_SESSION['mensaje']; unset($_SESSION['mensaje']); ?></div>
    <?php endif; ?>

    <form action="index.php?page=guardar_materia" method="POST" class="card shadow p-4">
        <div class="mb-3">
            <label>Nombre de la materia:</label>
            <input type="text" name="nombre" class="form-control" required placeholder="Ej: Robótica, Química...">
        </div>

        <div class="mb-3">
            <label>Profesor asignado:</label>
            <select name="profesor_id" class="form-select" required>
                <option value="">-- Selecciona un profesor --</option>
                <?php foreach ($profesores as $p): ?>
                    <option value="<?= $p['id'] ?>"><?= htmlspecialchars($p['nombre']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i> Registrar</button>
            <a href="index.php?page=dashboard" class="btn btn-secondary ms-2">Cancelar</a>
        </div>
    </form>
</div>

<?php include 'views/layout/footer.php'; ?>
