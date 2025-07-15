<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f7fa;
            font-family: Arial, sans-serif;
        }
        .form-container {
            max-width: 600px;
            margin: 50px auto;
        }
    </style>
</head>
<body>

<div class="container form-container">
    <div class="card shadow">
        <div class="card-header bg-primary text-white text-center">
            <h4>Registro de Usuario</h4>
        </div>
        <div class="card-body">
            <?php if (!empty($_SESSION['mensaje'])): ?>
                <div class="alert alert-success text-center">
                    <?= $_SESSION['mensaje']; unset($_SESSION['mensaje']); ?>
                </div>
            <?php endif; ?>
            <?php if (!empty($_SESSION['login_error'])): ?>
                <div class="alert alert-danger text-center">
                    <?= $_SESSION['login_error']; unset($_SESSION['login_error']); ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="index.php?page=guardar_usuario_publico" onsubmit="return validarFormulario();">

                <div class="mb-3">
                    <label>Nombre Completo</label>
                    <input type="text" name="nombre" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Correo electrónico</label>
                    <input type="email" name="correo" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Teléfono</label>
                    <input type="tel" name="telefono" class="form-control" pattern="[0-9]{7,}" title="Solo números" required>
                </div>

                <div class="mb-3">
                    <label>Rol</label>
                    <select name="rol_id" class="form-select" required>
                        <option value="">Seleccione un rol...</option>
                        <?php foreach ($roles as $rol): ?>
                            <option value="<?= $rol['id'] ?>"><?= htmlspecialchars($rol['nombre']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Contraseña</label>
                    <input type="password" name="clave" id="clave" class="form-control" required minlength="4">
                </div>

                <div class="mb-3">
                    <label>Confirmar Contraseña</label>
                    <input type="password" id="confirmar" class="form-control" required autocomplete="new-password">
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-success">Registrarme</button>
                </div>
            </form>

        </div>
        <div class="card-footer text-center">
            ¿Ya tienes cuenta? <a href="index.php?page=login">Inicia sesión</a>
        </div>
    </div>
</div>

<script>
    function validarFormulario() {
        const clave = document.getElementById('clave').value;
        const confirmar = document.getElementById('confirmar').value;

        if (clave !== confirmar) {
            alert("Las contraseñas no coinciden.");
            return false;
        }
        return true;
    }
</script>

</body>
</html>
