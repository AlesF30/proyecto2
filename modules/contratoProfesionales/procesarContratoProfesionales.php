<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');

include(ROOT_PATH . 'config/database/functions/personas.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['profesionales']) && !empty($_POST['profesionales']) && isset($_POST['id_contrato'])) {

        global $connect;

        // Obtiene el ID del contrato desde el formulario
        $id_contrato = $_POST['id_contrato'];

        // Obtiene los sponsors seleccionados del formulario
        $profesionalesSeleccionados = $_POST['profesionales'];

        // Guarda los profesionales seleccionados para el contrato
        foreach ($profesionalesSeleccionados as $id_profesionales) {
            guardarProfesionalesParaContrato($id_contrato, $id_profesionales);
        }

        header("location:formularioContratoProfesionales.php?id_contrato=$id_contrato&success=1");
        exit();
    } else {
        // Redirección con mensaje de error
        header("location:formularioContratoProfesionales.php?id_contrato=$id_contrato&error=1");
        exit();
    }
} else {
    echo "Acceso no autorizado.";
}
?>