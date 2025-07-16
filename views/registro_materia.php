<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<?php include 'views/layout/header.php'; ?>

<div class="container my-5">
    <h2 class="mb-4 text-center"><i class="bi bi-book-half me-2"></i> Asignar Materia a Profesor</h2>

    <form action="index.php?page=guardar_materia" method="POST" class="card shadow p-4 mx-auto" style="max-width: 600px;">
        <div class="mb-3">
            <label for="materia_id" class="form-label">Materia</label>
            <select name="materia_id" class="form-select" required>
                <option value="">Seleccione una materia</option>
                <?php foreach ($materias as $m): ?>
                    <option value="<?= $m['id'] ?>"><?= htmlspecialchars($m['nombre']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="profesor_id" class="form-label">Profesor</label>
            <select name="profesor_id" class="form-select" required>
                <option value="">Seleccione un profesor</option>
                <?php foreach ($profesores as $p): ?>
                    <option value="<?= $p['id'] ?>"><?= htmlspecialchars($p['nombre']) ?> - <?= $p['documento'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-success">
                <i class="bi bi-check-circle me-1"></i> Asignar
            </button>
            <a href="index.php?page=dashboard" class="btn btn-secondary ms-2">
                <i class="bi bi-arrow-left-circle me-1"></i> Volver
            </a>
        </div>
    </form>
</div>

<?php include 'views/layout/footer.php'; ?>
