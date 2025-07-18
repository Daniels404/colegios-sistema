<?php include 'views/layout/header.php'; ?>

<h2>Editar Estudiante</h2>

<form method="POST" action="index.php?page=actualizar">
    <input type="hidden" name="id" value="<?= $estudiante['id'] ?>">

    <label>Nombre:</label>
    <input type="text" name="nombre" value="<?= $estudiante['nombre'] ?>"><br>

    <label>Correo:</label>
    <input type="email" name="correo" value="<?= $estudiante['correo'] ?>"><br>

    <!-- Puedes seguir con los demás campos aquí -->

    <button type="submit">Actualizar</button>
</form>
