<?php
// Solo incluir el header, no abrir otro <div class="container"> porque el header ya lo hace
if (session_status() === PHP_SESSION_NONE) session_start();
include 'views/layout/header.php';
?>

<div class="text-center mb-4">
    <h2 class="fw-bold">
        <i class="bi bi-people-fill me-2"></i> Gestión de Usuarios
    </h2>
    <p class="text-muted">Aquí puedes gestionar los roles y eliminar usuarios del sistema.</p>
</div>

<?php if (isset($_SESSION['mensaje'])): ?>
    <div class="alert alert-success text-center">
        <?= $_SESSION['mensaje']; unset($_SESSION['mensaje']); ?>
    </div>
<?php endif; ?>

<div class="card shadow-sm mb-4">
    <div class="card-header bg-dark text-white fw-semibold">
        <i class="bi bi-list-ul me-2"></i> Lista de usuarios registrados
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered align-middle text-center mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Rol actual</th>
                        <th>Cambiar rol</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usuarios as $u): ?>
                        <tr>
                            <td><?= $u['id'] ?></td>
                            <td><?= htmlspecialchars($u['usuario']) ?></td>
                            <td>
                                <span class="badge bg-info text-dark px-3 py-2">
                                    <?php
                                    // Si no hay rol, mostrar el rol_id como fallback
                                    echo htmlspecialchars($u['rol'] ?? ($u['rol_id'] ?? 'Sin rol'));
                                    ?>
                                </span>
                            </td>
                            <td>
                                <form action="index.php?page=cambiar_rol" method="POST" class="d-flex justify-content-center align-items-center gap-2">
                                    <input type="hidden" name="id" value="<?= $u['id'] ?>">
                                    <select name="rol_id" class="form-select form-select-sm w-auto" required>
                                        <?php foreach ($roles as $r): ?>
                                            <option value="<?= $r['id'] ?>" <?= ($r['nombre'] === $u['rol']) ? 'selected' : '' ?>>
                                                <?= htmlspecialchars($r['nombre']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <button type="submit" class="btn btn-sm btn-outline-primary" title="Actualizar rol">
                                        <i class="bi bi-arrow-repeat"></i>
                                    </button>
                                </form>
                            </td>
                            <td>
                                <form action="index.php?page=eliminar_usuario" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este usuario?');">
                                    <input type="hidden" name="id" value="<?= $u['id'] ?>">
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Eliminar usuario">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <?php if (empty($usuarios)): ?>
                        <tr>
                            <td colspan="5" class="text-muted">No hay usuarios registrados.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="text-center mt-4">
    <a href="index.php?page=dashboard" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left-circle me-1"></i> Volver al dashboard
    </a>
</div>

<?php include 'views/layout/footer.php'; ?>
