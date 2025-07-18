<!-- filepath: /Applications/XAMPP/xamppfiles/htdocs/colegios-sistema/views/estudiantes/crear_estudiante.php -->

<h2>Registrar Estudiante</h2>
<form method="post" action="index.php?page=guardar">
    <input type="text" name="nombre" placeholder="Nombre del representante" required>
    <input type="text" name="ficha" placeholder="Ficha" required>
    <input type="text" name="nombre_alumno" placeholder="Nombre del alumno" required>
    <input type="text" name="documento_estudiante" placeholder="Documento" required>
    <input type="text" name="grado" placeholder="Grado" required>
    <input type="text" name="colegio_id" placeholder="Colegio ID" required>
    <button type="submit">Registrar</button>
</form>