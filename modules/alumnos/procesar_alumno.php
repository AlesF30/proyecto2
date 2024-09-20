<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include(ROOT_PATH . 'config/database/functions/personas.php');

// Validacion para los datos del formulario
if (isset($_POST['nombre'], $_POST['apellido'], $_POST['FechaNac'], $_POST['documento'], $_POST['tipodoc'])) {
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $FechaNac = trim($_POST['FechaNac']);
    $documento = trim($_POST['documento']);
    $tipodoc = trim($_POST['tipodoc']);

    
    if (empty($nombre) || empty($apellido) || empty($FechaNac) || empty($documento) || empty($tipodoc)) {
        header('Location: formulario_alumno.php?mensaje=Todos los campos son obligatorios&tipo_mensaje=error');
        exit();
    }

    // Validaciones para que el nombre solo contengan letrasy que acepte las palabras con Ñ, ñ, acentos y espacios
    if (!preg_match("/^[A-Za-zÑñÁáÉéÍíÓóÚúÜü\s]+$/", $nombre) || !preg_match("/^[A-Za-zÑñÁáÉéÍíÓóÚúÜü\s]+$/", $apellido)) {
        header('Location: formulario_alumno.php?mensaje=El nombre y el apellido solo deben contener letras y espacios&tipo_mensaje=error');
        exit();
    }    

    // Validaciones para que solo contenga números el documento
    if (!preg_match("/^[0-9]+$/", $documento)) {
        header('Location: formulario_alumno.php?mensaje=El documento solo debe contener números&tipo_mensaje=error');
        exit();
    }

    // Validar fecha de nacimiento que sea mayor de edad y no contenga una fecha futura
    $fechaNacimiento = DateTime::createFromFormat('Y-m-d', $FechaNac);
    if (!$fechaNacimiento) {
        header('Location: formulario_alumno.php?mensaje=Fecha de nacimiento inválida&tipo_mensaje=error');
        exit();
    }
    $fechaActual = new DateTime();
    $edad = $fechaActual->diff($fechaNacimiento)->y;
    if ($edad < 18 || $fechaNacimiento > $fechaActual) {
        header('Location: formulario_alumno.php?mensaje=Debes ser mayor de edad y la fecha no puede ser futura&tipo_mensaje=error');
        exit();
    }

    // Nuevo alumno
    $id_persona = crear_persona($nombre, $apellido, $FechaNac);
    alta_documento($tipodoc, $documento, $id_persona);
    crear_alumnos($id_persona);

    // Mensaje de exito
    header('Location: listadoal.php?mensaje=Alumno creado con éxito&tipo_mensaje=success');
} else {
    header('Location: formulario_alumno.php?mensaje=Datos del formulario incompletos&tipo_mensaje=error');
}

?>
