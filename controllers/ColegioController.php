<?php
require_once 'models/Colegio.php';

class ColegioController {
    public function mostrarFormulario() {
        require 'views/preregistro.php';
    }

    public function guardar() {
        $colegio = new Colegio();
        $data = [
            'nombre' => $_POST['nombre'],
            'tipo' => $_POST['tipo'],
            'direccion' => $_POST['direccion'],
            'contacto' => $_POST['contacto'],
            'rector' => $_POST['rector']
        ];

       $colegio->registrar($data);

        header("Location: index.php?page=registro");
        exit;
    }

    public function contarColegios() {
    $modelo = new Colegio();
    return $modelo->contarTodos(); // O como hayas llamado al método en el modelo
}




}
