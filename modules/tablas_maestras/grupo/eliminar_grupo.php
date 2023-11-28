<?php

require_once('../../../config/database/functions/grupo.php');

$id_grupo=$_GET['id_grupo'];

baja_grupo($id_grupo);

header("location: formularioGrupo.php");