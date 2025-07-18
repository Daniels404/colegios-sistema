
<?php
if (session_status() === PHP_SESSION_NONE) session_start();
include 'views/layout/header.php';
?>

<?php if (isset($_SESSION['mensaje'])): ?>
    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
        <?= $_SESSION['mensaje']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
    </div>
    <?php unset($_SESSION['mensaje']); ?>
<?php endif; ?>


<?php if (isset($mensaje) && $mensaje === 'registro_ok'): ?>
    <div style="background-color: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 10px;">
        ✅ ¡Estudiante registrado exitosamente!
    </div>
<?php endif; ?>


<h2 class="mb-4"><i class="bi bi-card-list me-1"></i> Listado de Estudiantes</h2>

<?php if (!empty($estudiantes)): ?>
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>Nombre</th>
                    <th>Ficha</th>
                    <th>Nombre del Alumno</th>
                    <th>Grado</th>
                    <th>Colegio</th>
                    <th>Jornada</th>
                    <th>Correo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($estudiantes as $est): ?>
                    <tr>
                        <td><?= htmlspecialchars($est['nombre']) ?></td>
                        <td><?= htmlspecialchars($est['ficha']) ?></td>
                        <td><?= htmlspecialchars($est['nombre_alumno']) ?></td>
                        <td><?= htmlspecialchars($est['grado']) ?></td>
                        <td><?= htmlspecialchars($est['colegio']) ?></td>
                        <td><?= htmlspecialchars($est['jornada']) ?></td>
                        <td><?= htmlspecialchars($est['correo']) ?></td>
                        <td>
                            <a href="index.php?page=ver&id=<?= $est['id'] ?>" class="btn btn-sm btn-info" title="Ver detalles">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="index.php?page=editar&id=<?= $est['id'] ?>" class="btn btn-sm btn-warning" title="Editar">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <a href="index.php?page=eliminar&id=<?= $est['id'] ?>" class="btn btn-sm btn-danger" title="Eliminar" onclick="return confirm('¿Estás seguro de eliminar este estudiante?');">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <div class="alert alert-warning">No hay estudiantes registrados aún.</div>
<?php endif; ?>