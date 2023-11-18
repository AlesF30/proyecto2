<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');


require_once (ROOT_PATH.'config/database/connect.php');


//PERSONA FISICO
function obtenerPersonaFisico($id_persona_fisico){
    global $connect;

	$sql="SELECT * FROM sistbook.persona_fisico where id_persona_fisico = $id_persona_fisico;";

	$s = $connect->prepare($sql);

    $s->execute();

    $records = $s->get_result()->fetch_all(MYSQLI_ASSOC);

    $s->close();

	return $records;
}

//MODIFICAR FISICO

function modificar_personaFisico($id_persona_fisico, $valor){
    global $connect;
    
    $sql="UPDATE `sistbook`.`persona_fisico` SET `valor` = '$valor'
    WHERE (`id_persona_fisico` = '$id_persona_fisico');";


	$s = $connect->prepare($sql);

    $s->execute();

    $s->close();
}
