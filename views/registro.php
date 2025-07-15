<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Carga de modelos
require_once 'models/Colegio.php';
require_once 'models/Grado.php';
require_once 'models/TipoDocumento.php';
require_once 'models/RH.php';

// Instancias de modelos
$colegioModel = new Colegio();
$gradosModel = new Grado();
$tipoDocumentoModel = new TipoDocumento();
$rhModel = new RH();

// Consultas a BD
$colegios = $colegioModel->obtenerTodos();
$grados = $gradosModel->obtenerTodos();
$tiposDocumento = $tipoDocumentoModel->obtenerTodos();
$tiposRh = $rhModel->obtenerTodos();

// Encabezado HTML del layout
include 'views/layout/header.php';
?>

<h2 class="mb-4 text-center"><i class="bi bi-person-plus-fill me-1"></i> Registro de Estudiante</h2>


    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger"><?= $_SESSION['error'] ?></div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <form method="POST" action="index.php?page=guardar" class="bg-white p-4 rounded shadow">
        <!-- Colegio relacionado -->
        <div class="mb-3">
            <label class="form-label">Colegio</label>
            <select name="colegio_id" class="form-select" required>
                <option value="">Seleccione una institución...</option>
                <?php foreach ($colegios as $c): ?>
                    <option value="<?= $c['id'] ?>"><?= $c['nombre'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Nombre, ficha, grado -->
        <div class="row mb-3">
            <div class="col-md-4">
                <label for="nombre_alumno" class="form-label">Nombre completo del estudiante</label>
                <input type="text" id="nombre_alumno" name="nombre_alumno" class="form-control" required>
            </div>
            <div class="col-md-4">
                <label for="ficha" class="form-label">Ficha</label>
                <input type="text" id="ficha" name="ficha" class="form-control" required>
            </div>
            <div class="col-md-4">
                <label for="grado" class="form-label">Grado</label>
                <select id="grado" name="grado" class="form-select" required>
                    <option value="">Seleccione...</option>
                    <?php if (!empty($grados)): ?>
                        <?php foreach ($grados as $g): ?>
                            <option value="<?= htmlspecialchars($g['nombre']) ?>">
                                <?= htmlspecialchars($g['nombre']) ?>
                            </option>
                    </option>
                <?php endforeach; ?>
            <?php else: ?>
                <option disabled>No hay grados registrados</option>
            <?php endif; ?>
        </select>
    </div>
</div>


    <!-- Documento -->
<div class="row mb-3">
    <div class="col-md-6">
        <label>Tipo de documento</label>
        <select name="tipo_documento" class="form-select" required> 
            <option value="">Seleccione...</option>
            <?php foreach ($tiposDocumento as $doc): ?>
                <option value="<?= htmlspecialchars($doc['codigo']) ?>">
                    <?= htmlspecialchars($doc['descripcion']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="col-md-6">
        <label>Número de documento</label>
        <input type="text" name="documento_estudiante" class="form-control" required>
    </div>
</div>


        <!-- Dirección y correo institucional -->
        <div class="row mb-3">
            <div class="col-md-6">
                <label>Dirección</label>
                <input type="text" name="direccion" class="form-control">
            </div>
            <div class="col-md-6">
                <label>Correo institucional</label>
                <input type="email" name="correo_inst" class="form-control">
            </div>
        </div>

    <!-- RH, jornada, días -->
<div class="row mb-3">
    <!-- RH desde la base de datos -->
    <div class="col-md-4">
        <label>RH</label>
        <select name="rh" class="form-select" required>
            <option value="">Seleccione...</option>
            <?php foreach ($tiposRh as $rh): ?>
                <option value="<?= htmlspecialchars($rh['tipo']) ?>">
                    <?= htmlspecialchars($rh['tipo']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <!-- Jornada (puedes también moverla a BD si deseas) -->
    <div class="col-md-4">
        <label>Jornada</label>
        <select name="jornada" class="form-select">
            <option value="">Seleccione...</option>
            <option value="Mañana">Mañana</option>
            <option value="Tarde">Tarde</option>
        </select>
    </div>



        <!-- Rector y nombre de colegio adicional -->
        <div class="row mb-3">
            <div class="col-md-6">
                <label>Nombre del rector</label>
                <input type="text" name="rector" class="form-control">
            </div>
            <div class="col-md-6">
                <label>Nombre del colegio (texto)</label>
                <input type="text" name="colegio" class="form-control">
            </div>
        </div>

        <!-- Contacto estudiante -->
        <div class="row mb-3">
            <div class="col-md-6">
                <label>Correo personal</label>
                <input type="email" name="correo" class="form-control">
            </div>
            <div class="col-md-6">
                <label>Número de contacto</label>
                <input type="text" name="numero_contacto" class="form-control">
            </div>
        </div>

        <!-- Acudiente -->
        <div class="row mb-3">
            <div class="col-md-6">
                <label>Nombre del acudiente</label>
                <input type="text" name="nombre" class="form-control">
            </div>
            <div class="col-md-6">
                <label>Teléfono del acudiente</label>
                <input type="text" name="contacto" class="form-control">
            </div>
        </div>

        <!-- Observaciones -->
        <div class="mb-3">
            <label>Observaciones</label>
            <textarea name="observaciones" class="form-control"></textarea>
        </div>

        <!-- Botón -->
        <button type="submit" class="btn btn-success">
            <i class="bi bi-check-circle-fill me-1"></i> Registrar
        </button>
    </form>
</div>


