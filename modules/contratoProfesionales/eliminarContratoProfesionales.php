<?php
include('../../config/database/functions/personas.php');



if (isset($_GET['id_profesionales_contratos'])) {

    $id_profesionales_contratos = $_GET['id_profesionales_contratos'];
    
    global $connect;


    if ($connect->connect_error) {
        die("Error en la conexión: " . $connect->connect_error);
    }

    $sql = "DELETE FROM `profesionales_contratos` WHERE `id_profesionales_contratos` = '$id_profesionales_contratos'";


    if ($connect->query($sql) === TRUE) {
        header("location: ../contratoProfesionales\formularioContratoProfesionales.php");
        
    } else {
        echo "Error al eliminar la relación: " . $connect->error;
    }

    $connect->close();
} else {
    echo "ID de relación no proporcionado para eliminar.";
}

?>
