<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');

include(ROOT_PATH . 'config/database/functions/especialidad.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['especialidades']) && !empty($_POST['especialidades']) && isset($_POST['id_profesionales'])) {

        global $connect;

        // Obtiene el ID del evento desde el formulario
        $id_profesionales = $_POST['id_profesionales'];

        // Obtiene los sponsors seleccionados del formulario
        $EspecialidadesSeleccionadas = $_POST['especialidades'];

        // Guarda los sponsors seleccionados para el evento
        foreach ($EspecialidadesSeleccionadas as $id_especialidad) {
            guardarEspecialidadParaProfesionales($id_profesionales, $id_especialidad);
        }

        header("location:formularioProfesionalesEspecialidad.php?id_profesionales=$id_profesionales&success=1");
        exit();
    } else {
        // Redirección con mensaje de error
        header("location:formularioProfesionalesEspecialidad.php?id_profesionales=$id_profesionales&error=1");
        exit();
    }
} else {
    echo "Acceso no autorizado.";
}
?>