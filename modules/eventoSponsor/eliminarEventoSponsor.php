<?php
include('../../config/database/functions/sponsor.php');



if (isset($_GET['id_evento_sponsor'])) {

    $id_evento_sponsor = $_GET['id_evento_sponsor'];
    
    global $connect;


    if ($connect->connect_error) {
        die("Error en la conexión: " . $connect->connect_error);
    }

    $sql = "DELETE FROM `evento_sponsor` WHERE `id_evento_sponsor` = '$id_evento_sponsor'";


    if ($connect->query($sql) === TRUE) {
        header("location: ../eventos/formularioEventos.php");
        
    } else {
        echo "Error al eliminar la relación: " . $connect->error;
    }

    $connect->close();
} else {
    echo "ID de relación no proporcionado para eliminar.";
}

?>
