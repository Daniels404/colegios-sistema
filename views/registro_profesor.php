<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<?php include 'views/layout/header.php'; ?>

<div class="container my-5">
    <h2 class="mb-4 text-center"><i class="bi bi-person-vcard me-2"></i> Registrar Profesor</h2>

    <?php if (isset($_SESSION['mensaje'])): ?>
        <div class="alert alert-success text-center"><?= $_SESSION['mensaje']; unset($_SESSION['mensaje']); ?></div>
    <?php endif; ?>

    <form action="index.php?page=guardar_profesor" method="POST" class="card shadow p-4">
        <div class="row g-3">
            <div class="col-md-6">
                <label>Nombre completo:</label>
                <input type="text" name="nombre" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label>Documento:</label>
                <input type="text" name="documento" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label>Contacto:</label>
                <input type="text" name="contacto" class="form-control">
            </div>
            <div class="col-md-6">
                <label>Correo:</label>
                <input type="email" name="correo" class="form-control">
            </div>
            <div class="col-md-3">
                <label>RH:</label>
                <input type="text" name="rh" class="form-control">
            </div>
            <div class="col-md-3">
                <label>Estudiantes asignados:</label>
                <input type="number" name="numero_estudiantes" class="form-control">
            </div>
            <div class="col-md-6">
                <label>Jornada:</label>
                <select name="jornada" class="form-select">
                    <option value="Mañana">Mañana</option>
                    <option value="Tarde">Tarde</option>
                    <option value="Noche">Noche</option>
                </select>
            </div>
        </div>

        <div class="text-center mt-4">
            <button type="submit" class="btn btn-success"><i class="bi bi-save me-1"></i> Registrar</button>
            <a href="index.php?page=dashboard" class="btn btn-secondary ms-2">Cancelar</a>
        </div>
    </form>
</div>

<?php include 'views/layout/footer.php'; ?>
