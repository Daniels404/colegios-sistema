<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pre-registro de Institución</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f4f7fc;
        }
        .container {
            max-width: 700px;
            margin-top: 40px;
        }
        .form-control, .form-select {
            border-radius: 0.375rem;
        }
        h2 {
            color: #003366;
        }
    </style>
</head>
<body>

<div class="container bg-white shadow p-5 rounded">
    <h2 class="mb-4"><i class="bi bi-building"></i> Pre-registro de Institución</h2>

    <form method="POST" action="index.php?page=guardar_colegio">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre del Colegio</label>
            <input type="text" name="nombre" id="nombre" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo de Institución</label>
            <select name="tipo" id="tipo" class="form-select" required>
                <option value="">Seleccione...</option>
                <option value="Pública">Pública</option>
                <option value="Privada">Privada</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="direccion" class="form-label">Dirección</label>
            <input type="text" name="direccion" id="direccion" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="contacto" class="form-label">Número de Contacto</label>
            <input type="text" name="contacto" id="contacto" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="rector" class="form-label">Nombre del Rector</label>
            <input type="text" name="rector" id="rector" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">
            <i class="bi bi-save2"></i> Registrar Institución
        </button>
    </form>

    <hr class="mt-4">
    <p class="text-muted small">
        Sistema de información Tecno Academia (Colegio vs SENA) <br>
        <strong>Centro Industrial y de Desarrollo Empresarial de Soacha - CIDE SENA</strong>
    </p>
</div>

</body>
</html>
