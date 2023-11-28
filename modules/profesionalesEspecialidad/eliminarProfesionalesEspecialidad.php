<?php
include('../../config/database/functions/especialidad.php');


if (isset($_GET['id_profesional_especialidad'])) {
    $id_profesional_especialidad = $_GET['id_profesional_especialidad'];

    global $connect;


    if ($connect->connect_error) {
        die("Error en la conexión: " . $connect->connect_error);
    }

    $sql = "DELETE FROM `profesional_especialidad` WHERE `id_profesional_especialidad` = '$id_profesional_especialidad'";

    if ($connect->query($sql) === TRUE) {
        header("location: ../profesionales/listadoProfesionales.php");
        
    } else {
        echo "Error al eliminar la relación: " . $connect->error;
    }

    $connect->close();
} else {
    echo "ID de relación no proporcionado para eliminar.";
}

?>
