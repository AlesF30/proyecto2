<?php
require_once('../../../config/database/functions/duracion_dias.php');

$id_duracion_dias = $_GET['id_duracion_dias'];

// Llamas a la función que realiza la eliminación
baja_duracionDias($id_duracion_dias);

// Rediriges de vuelta a formularioDuracionDias.php con un parámetro de éxito
header("location: formularioDuracionDias.php?eliminacion=exitosa");
?>
