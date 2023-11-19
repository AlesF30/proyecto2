<?php

require_once('../../config/path.php');
include(ROOT_PATH . 'config/database/functions/modulos.php');

$descripcion    =$_POST['descripcion'];
$id_perfil= $_POST['id_perfil'];
$id_modulo = $_POST['modulo'];
$modulo = $_POST['modulo'];


asignarModulos($id_perfil, $id_modulo);

header("location: AsignarModuloPerfil.php?id_perfil=$id_perfil&id_modulos=$id_modulo&descripcion=$descripcion&modulo=$modulo");


?>