
<?php if (session_status() === PHP_SESSION_NONE) session_start();
include 'views/layout/header.php';
?>


<h2 class="mb-4"><i class="bi bi-building-add me-1"></i> Listado de Colegios Registrados</h2>

<?php if (isset($_SESSION['mensaje'])): ?>
    <div class="alert alert-success text-center">
        <?= $_SESSION['mensaje']; unset($_SESSION['mensaje']); ?>
    </div>
<?php endif; ?>

<?php if (!empty($colegios)): ?>
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Tipo</th>
                    <th>Dirección</th>
                    <th>Contacto</th>
                    <th>Rector</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($colegios as $colegio): ?>
                    <tr>
                        <td><?= $colegio['id'] ?></td>
                        <td><?= htmlspecialchars($colegio['nombre']) ?></td>
                        <td><?= htmlspecialchars($colegio['tipo']) ?></td>
                        <td><?= htmlspecialchars($colegio['direccion']) ?></td>
                        <td><?= htmlspecialchars($colegio['contacto']) ?></td>
                        <td><?= htmlspecialchars($colegio['rector']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <div class="alert alert-warning">No hay colegios registrados aún.</div>
<?php endif; ?>
