<?php
require_once 'models/Usuario.php';
require_once 'models/Rol.php';

$usuarioModel = new Usuario();
$usuariosPendientes = $usuarioModel->obtenerPendientes();

$rolModel = new Rol();
$roles = $rolModel->obtenerTodos();
?>

<div class="container mt-4">
    <h2 class="mb-4">👤 Usuarios Pendientes de Aprobación</h2>

    <?php if (count($usuariosPendientes) === 0): ?>
        <div class="alert alert-info">No hay usuarios pendientes.</div>
    <?php else: ?>
        <form method="POST" action="index.php?page=aprobarUsuarios">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Usuario</th>
                        <th>Rol a Asignar</th>
                        <th>Seleccionar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usuariosPendientes as $u): ?>
                        <tr>
                            <td><?= htmlspecialchars($u['usuario']) ?></td>
                            <td>
                                <select name="roles[<?= $u['id'] ?>]" class="form-select" required>
                                    <option value="">Seleccione rol</option>
                                    <?php foreach ($roles as $rol): ?>
                                        <option value="<?= $rol['id'] ?>"><?= $rol['nombre'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <td>
                                <input type="checkbox" name="usuarios_aprobar[]" value="<?= $u['id'] ?>">
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <button type="submit" class="btn btn-success">Aprobar seleccionados</button>
        </form>
    <?php endif; ?>
</div>
