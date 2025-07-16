<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<?php include 'views/layout/header.php'; ?>

<div class="container my-5">
    <h2 class="mb-4 text-center"><i class="bi bi-person-plus me-2"></i> Registrar Profesor</h2>

    <form action="index.php?page=guardar_profesor" method="POST" class="card shadow p-4 needs-validation" novalidate>
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Nombre:</label>
                <input type="text" name="nombre" class="form-control" required>
                <div class="invalid-feedback">Este campo es obligatorio.</div>
            </div>
            <div class="col-md-6">
                <label class="form-label">Documento:</label>
                <input type="text" name="documento" class="form-control" required>
                <div class="invalid-feedback">Este campo es obligatorio.</div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Número de Contacto:</label>
                <input type="text" name="contacto" class="form-control">
            </div>
            <div class="col-md-6">
                <label class="form-label">Correo:</label>
                <input type="email" name="correo" class="form-control">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <label class="form-label">RH:</label>
                <input type="text" name="rh" class="form-control">
            </div>
            <div class="col-md-4">
                <label class="form-label">Número de Estudiantes:</label>
                <input type="number" name="numero_estudiantes" class="form-control">
            </div>
            <div class="col-md-4">
                <label class="form-label">Jornada:</label>
                <input type="text" name="jornada" class="form-control">
            </div>
        </div>

        <div class="mb-4">
            <label class="form-label">Materia Asignada:</label>
            <select name="materia_id" class="form-select" required>
                <option value="">Seleccione una materia</option>
                <?php foreach ($materias as $m): ?>
                    <option value="<?= $m['id'] ?>"><?= htmlspecialchars($m['nombre']) ?></option>
                <?php endforeach; ?>
            </select>
            <div class="invalid-feedback">Seleccione una materia válida.</div>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-success"><i class="bi bi-save me-1"></i> Guardar</button>
            <a href="index.php?page=lista_profesores" class="btn btn-secondary ms-2"><i class="bi bi-arrow-left-circle me-1"></i> Ver Profesores</a>
        </div>
    </form>
</div>

<!-- Script para validación Bootstrap -->
<script>
    (() => {
        'use strict';
        const forms = document.querySelectorAll('.needs-validation');
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    })();
</script>

<?php include 'views/layout/footer.php'; ?>
