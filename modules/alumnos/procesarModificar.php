<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include(ROOT_PATH . 'config/database/functions/personas.php');

// Validacion para que los datos del formulario no sean vacios
if (isset($_POST['id_persona'], $_POST['nombre'], $_POST['apellido'], $_POST['FechaNac'])) {
    $id_persona = trim($_POST['id_persona']);
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $FechaNac = trim($_POST['FechaNac']);

    // Validaciones simples
    if (empty($id_persona) || empty($nombre) || empty($apellido) || empty($FechaNac)) {
        header('Location: modificar_alumno.php?id_persona=' . urlencode($id_persona) . '&mensaje=Todos los campos son obligatorios&tipo_mensaje=error');
        exit();
    }

    // Validacion para la fecha de nacimiento
    if (!DateTime::createFromFormat('Y-m-d', $FechaNac)) {
        header('Location: modificar_alumno.php?id_persona=' . urlencode($id_persona) . '&mensaje=Fecha de nacimiento inválida&tipo_mensaje=error');
        exit();
    }

    // Validacion para que la fecha no sea futura
    $fechaNacimiento = new DateTime($FechaNac);
    $hoy = new DateTime();
    if ($fechaNacimiento > $hoy) {
        header('Location: modificar_alumno.php?id_persona=' . urlencode($id_persona) . '&mensaje=La fecha de nacimiento no puede ser futura&tipo_mensaje=error');
        exit();
    }

    modificar_alumno($id_persona, $nombre, $apellido, $FechaNac);

    header('Location: listadoal.php?mensaje=Alumno modificado con éxito&tipo_mensaje=success');
} else {
    header('Location: listadoal.php?mensaje=Datos del formulario incompletos&tipo_mensaje=error');
}
?>
