<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include(ROOT_PATH . 'config/database/functions/personas.php');

if (isset($_GET['id_persona'])) {
    $id_persona = $_GET['id_persona'];

    if (is_numeric($id_persona)) {
        baja_alumno($id_persona);
        header('Location: listadoal.php?mensaje=Alumno eliminado con éxito&tipo_mensaje=success');
    } else {
        header('Location: listadoal.php?mensaje=ID de alumno inválido&tipo_mensaje=error');
    }
} else {
    header('Location: listadoal.php?mensaje=No se proporcionó un ID de alumno&tipo_mensaje=error');
}
?>
