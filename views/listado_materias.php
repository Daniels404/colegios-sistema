<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<?php include 'views/layout/header.php'; ?>

<div class="container my-5">
    <h2 class="mb-4 text-center"><i class="bi bi-journals me-2"></i> Lista de Materias Registradas</h2>

    <?php if (isset($_SESSION['mensaje'])): ?>
        <div class="alert alert-success text-center">
            <?= $_SESSION['mensaje']; unset($_SESSION['mensaje']); ?>
        </div>
    <?php endif; ?>

    <table class="table table-bordered table-hover text-center align-middle shadow">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Materia</th>
                <th>Profesor Asignado</th>
                <th>Documento</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($materias)): ?>
                <?php foreach ($materias as $m): ?>
                    <tr>
                        <td><?= $m['id'] ?></td>
                        <td><?= htmlspecialchars($m['materia']) ?></td>
                        <td><?= htmlspecialchars($m['profesor'] ?? 'No asignado') ?></td>
                        <td><?= htmlspecialchars($m['documento'] ?? '-') ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" class="text-center text-muted">No hay materias registradas.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="text-center mt-4">
        <a href="index.php?page=registro_materia" class="btn btn-success">
            <i class="bi bi-plus-circle me-1"></i> Nueva Materia
        </a>
        <a href="index.php?page=dashboard" class="btn btn-secondary ms-2">
            <i class="bi bi-arrow-left-circle me-1"></i> Volver
        </a>
    </div>
</div>

<?php include 'views/layout/footer.php'; ?>
