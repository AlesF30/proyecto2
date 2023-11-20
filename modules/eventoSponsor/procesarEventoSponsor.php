<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');

include(ROOT_PATH . 'config/database/functions/sponsor.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['sponsors']) && !empty($_POST['sponsors']) && isset($_POST['id_eventos'])) {

        global $connect;

        // Obtiene el ID del evento desde el formulario
        $id_eventos = $_POST['id_eventos'];

        // Obtiene los sponsors seleccionados del formulario
        $sponsorsSeleccionados = $_POST['sponsors'];

        // Guarda los sponsors seleccionados para el evento
        foreach ($sponsorsSeleccionados as $id_sponsor) {
            guardarSponsorParaEvento($id_eventos, $id_sponsor);
        }

        header("location:formularioEventoSponsor.php?id_eventos=$id_eventos&success=1");
        exit();
    } else {
        // Redirección con mensaje de error
        header("location:formularioEventoSponsor.php?id_eventos=$id_eventos&error=1");
        exit();
    }
} else {
    echo "Acceso no autorizado.";
}
?>