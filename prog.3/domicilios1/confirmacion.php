<?php
    require_once('bd_functions.php');

    $id_persona             = $_POST['id_persona'];
    $id_tipoDomicilio       = $_POST['tipoDomicilio'];
    $id_barrio              = $_POST['barrio'];
    $observaciones          = $_POST['observaciones'];

    $atributosSeleccionados = $_POST['atributosSeleccionados'];
    $valoresIngresados      = $_POST['valoresIngresados'];

    $resultado = grabarNuevoDomicilio($id_persona, $id_tipoDomicilio, $id_barrio, $observaciones, $atributosSeleccionados, $valoresIngresados);

    if ($resultado !== 0) {
        echo 'ok';
    } else {
        echo 'Error en la grabacion';
    }












?>