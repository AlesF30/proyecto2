<?php

$error_nombre   = false;
$error_apellido = false;
$error_dni      = false;
$validacion_ok  = false;

$error_nombre_mensaje   = "";
$error_apellido_mensaje = "";
$error_dni_mensaje      = "";


function validar($nombre, $apellido, $dni) {
    if (empty($nombre)) {
        $error_nombre = true;
        $error_nombre_mensaje = 'Ingrese el nombre';
    } else {
        if (strlen($nombre) < 3) {
            $error_nombre = true;
            $error_nombre_mensaje = 'El nombre debe tener más de 3 caracteres.';
        }
    }

    if (empty($apellido)) {
        $error_apellido = true;
        $error_apellido_mensaje = 'Ingrese el apellido';
    }

    if (empty($dni)) {
        $error_dni = true;
        $error_dni_mensaje = 'Ingrese el dni';
    } else {
        if (!is_numeric($dni)) {
            $error_dni = true;
            $error_dni_mensaje = 'Debe ingresar números';
        }
    }
}

function alta($nombre, $apellido, $dni) {
    //exito e insercion en la bd





}