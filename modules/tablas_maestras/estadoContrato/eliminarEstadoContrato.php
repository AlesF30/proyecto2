<?php

require_once('../../../config/database/functions/estadoContrato.php');

$id_estado_contrato=$_GET['id_estado_contrato'];

baja_estadoContrato($id_estado_contrato);

header("location: formularioEstadoContrato.php");