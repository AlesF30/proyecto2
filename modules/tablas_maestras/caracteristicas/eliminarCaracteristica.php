<?php

require_once('../../../config/database/functions/caracteristica.php');

$id_caracteristica=$_GET['id_caracteristica'];

baja_caracteristica($id_caracteristica);

header("location: formularioCaracteristica.php");