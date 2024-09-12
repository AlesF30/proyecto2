
<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include(ROOT_PATH.'config\database\functions\perfil.php');

$id_perfil = $_GET['id_perfil'];

desactivar_perfil($id_perfil);

header('location:listado_perfil.php');
?>
