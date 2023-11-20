<?php

require_once('../../../config/database/functions/sponsor.php');

$id_sponsor=$_GET['id_sponsor'];

baja_sponsor($id_sponsor);

header("location: formularioSponsor.php");