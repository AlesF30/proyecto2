<?php

require_once('../../../config/database/functions/pais.php');

$id_pais=$_GET['id_pais'];

baja_pais($id_pais);

header("location: formulario_pais.php");