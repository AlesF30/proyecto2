<?php

require_once('../../../config/database/functions/profesion.php');

$id_profesion=$_GET['id_profesion'];

baja_profesion($id_profesion);

header("location: formulario_profesion.php");