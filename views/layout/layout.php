<?php
require_once 'includes/header.php';
echo $contenido ?? '';
require_once 'includes/footer.php';



session_start();
require_once 'router.php';
?>

<!-- Mostrar mensaje si existe -->
<?php if (isset($_SESSION['mensaje'])): ?>
    <div id="mensaje-alerta" class="alert alert-success alert-dismissible fade show mt-3 animate__animated animate__fadeInDown" role="alert">
        <?= $_SESSION['mensaje']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
    </div>
    <?php unset($_SESSION['mensaje']); ?>
<?php endif; ?>

<h1 class="text-center">Listado de Estudiantes</h1>
<!-- Aquí va la tabla -->

<!-- Animate.css CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<!-- Auto cerrar el mensaje después de 3 segundos -->
<script>
    setTimeout(function () {
        const alerta = document.getElementById('mensaje-alerta');
        if (alerta) {
            alerta.classList.remove('animate__fadeInDown');
            alerta.classList.add('animate__fadeOutUp');
            setTimeout(() => alerta.remove(), 1000); // Quita del DOM tras la animación
        }
    }, 3000);
</script>
