<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include(ROOT_PATH.'config\database\functions\personas.php');

$id_persona = $_GET['id_persona'];


baja_profesionales($id_persona);

header('location:listadoProfesionales.php');

?>