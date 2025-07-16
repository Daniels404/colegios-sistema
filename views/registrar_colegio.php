<?php

if (session_status() === PHP_SESSION_NONE) session_start();
include 'views/layout/header.php';
?>

<h2 class="mb-4 text-center"><i class="bi bi-building-add me-1"></i> Colegios Registrados</h2>

<?php
$modelo = new Colegio();
$colegios = $modelo->obtenerTodos();
?>

<?php if (isset($_SESSION['mensaje'])): ?>
    <div class="alert alert-success text-center">
        <?= $_SESSION['mensaje']; unset($_SESSION['mensaje']); ?>
    </div>
<?php endif; ?>

<?php if (!empty($colegios)): ?>
    <div class="table-responsive mb-4">
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

<!-- Botón para mostrar/ocultar el formulario -->
<div class="text-center mb-4">
    <button class="btn btn-primary" type="button" id="mostrarFormulario">
        <i class="bi bi-plus-circle me-1"></i>Registrar nuevo colegio
    </button>
</div>

<!-- Formulario SIEMPRE oculto hasta que se presione el botón -->
<div id="formularioColegio" style="display:none;">
    <form method="POST" action="index.php?page=guardar_colegio" class="bg-white p-4 rounded shadow mx-auto" style="max-width: 600px;">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre del colegio</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo</label>
            <select class="form-select" id="tipo" name="tipo" required>
                <option value="">Seleccione...</option>
                <option value="Pública">Pública</option>
                <option value="Privada">Privada</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="direccion" class="form-label">Dirección</label>
            <input type="text" class="form-control" id="direccion" name="direccion" required>
        </div>
        <div class="mb-3">
            <label for="contacto" class="form-label">Contacto</label>
            <input type="text" class="form-control" id="contacto" name="contacto" required>
        </div>
        <div class="mb-3">
            <label for="rector" class="form-label">Rector</label>
            <input type="text" class="form-control" id="rector" name="rector" required>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary"><i class="bi bi-plus-circle me-1"></i>Registrar Colegio</button>
        </div>
    </form>
</div>

<script>
    document.getElementById('mostrarFormulario').onclick = function() {
        var form = document.getElementById('formularioColegio');
        form.style.display = (form.style.display === 'none') ? 'block' : 'none';
    };
</script>

<?php include 'views/layout/footer.php'; ?>