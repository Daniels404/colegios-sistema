<?php
require_once 'models/Colegio.php';
$colegioModel = new Colegio();
$colegios = $colegioModel->obtenerTodos();
?>



<?php //session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión - Sistema Colegio</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="https://cdn.jsdelivr.net/npm/animate.css@4.1.1/animate.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            background-color: #f2f6fc;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.3s, color 0.3s;
        }

        .login-container {
            max-width: 420px;
            background-color: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 0 25px rgba(0,0,0,0.1);
        }

        .login-title {
            color: #003366;
            font-weight: 700;
        }

        .btn-login {
            background-color: #003366;
            color: white;
            font-weight: bold;
        }

        .btn-login:hover {
            background-color: #002244;
        }

        .footer-login {
            font-size: 0.85rem;
            color: #777;
            text-align: center;
            margin-top: 30px;
        }

        /* 🌙 Modo Oscuro */
        body.dark-mode {
            background-color: #1a1a1a;
            color: #f8f9fa;
        }

        body.dark-mode .login-container {
            background-color: #2c2c2c;
            box-shadow: 0 0 20px rgba(255, 255, 255, 0.1);
        }

        body.dark-mode .btn-login {
            background-color: #0d6efd;
        }

        body.dark-mode .footer-login {
            color: #aaa;
        }

        .toggle-dark {
            cursor: pointer;
        }

        .form-check-label {
            cursor: pointer;
        }

        .logo-text {
            font-size: 1.5rem;
            color: #003366;
            font-weight: bold;
        }

        .dark-mode .logo-text {
            color: #0d6efd;
        }
    </style>
</head>
<body class="animate__animated animate__fadeIn">

<div class="login-container">

    <!-- ✅ Logo / Encabezado -->
    <div class="text-center mb-3">
        <div class="logo-text"><i class="bi bi-mortarboard-fill me-1"></i> Colegio SENA</div>
    </div>

    <!-- ✅ Toggle Modo Oscuro -->
    <div class="d-flex justify-content-end mb-3">
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="darkSwitch">
            <label class="form-check-label toggle-dark" for="darkSwitch"><i class="bi bi-moon-fill"></i></label>
        </div>
    </div>

    <h4 class="text-center login-title mb-4"><i class="bi bi-shield-lock-fill me-2"></i>Iniciar Sesión</h4>

    <!-- ✅ Mensaje de error -->
    <?php if (isset($_SESSION['login_error'])): ?>
        <div class="alert alert-danger">
            <?= $_SESSION['login_error'] ?>
        </div>
        <?php unset($_SESSION['login_error']); ?>
    <?php endif; ?>

    <form method="POST" action="index.php?page=procesar_login">

        <div class="mb-3">
            <label for="usuario" class="form-label">Usuario</label>
            <input type="text" name="usuario" id="usuario" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="clave" class="form-label">Contraseña</label>
            <div class="input-group">
                <input type="password" name="clave" id="clave" class="form-control" required>
                <button type="button" class="btn btn-outline-secondary" id="togglePassword" tabindex="-1">
                    <i class="bi bi-eye-slash" id="iconToggle"></i>
                </button>
            </div>
        </div>

        <!-- ✅ Recordar sesión -->
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="recordar">
            <label class="form-check-label" for="recordar">Recordar sesión</label>
        </div>

        <button type="submit" class="btn btn-login w-100">
            <i class="bi bi-box-arrow-in-right me-2"></i>Entrar al Sistema
        </button>
    </form>

    <!-- ✅ Footer institucional -->
    <div class="footer-login">
        © <?= date('Y') ?> Sistema Colegio - Desarrollado por Daniel Stiven Zapata
    </div>
</div>

<!-- ✅ Scripts -->
<script>
    // Mostrar / ocultar contraseña
    document.getElementById("togglePassword").addEventListener("click", function () {
        const input = document.getElementById("clave");
        const icon = document.getElementById("iconToggle");
        if (input.type === "password") {
            input.type = "text";
            icon.classList.replace("bi-eye-slash", "bi-eye");
        } else {
            input.type = "password";
            icon.classList.replace("bi-eye", "bi-eye-slash");
        }
    });

    // Modo oscuro toggle
    document.getElementById("darkSwitch").addEventListener("change", function () {
        document.body.classList.toggle("dark-mode");
    });
</script>

</body>
</html>
