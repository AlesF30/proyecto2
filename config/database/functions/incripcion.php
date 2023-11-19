<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
require_once(ROOT_PATH . 'config/database/connect.php');



//LISTADO


function obtenerDatoEvento(){
    global $connect;

	$sql="SELECT * FROM sistbook.eventos
    inner join evento_estado on eventos.rela_evento_estado=evento_estado.id_evento_estado
    inner join tipo_evento on eventos.rela_tipo=tipo_evento.id_tipo
    inner join categoria_eventos on eventos.rela_categoria=categoria_eventos.id_categoria
        WHERE id_eventos=id_eventos;";

	$s = $connect->prepare($sql);

    $s->execute();

    $records = $s->get_result()->fetch_all(MYSQLI_ASSOC);

    $s->close();

	return $records;
}


function alta_eventos($idEvento_estado, $id_tipo, $id_categoria){
    global $connect;

    $sql="INSERT INTO `sistbook`.`eventos` (`rela_evento_estado`, `rela_tipo`, `rela_categoria`)
    VALUES ('$idEvento_estado', '$id_tipo', '$id_categoria');";

    $s=$connect->prepare($sql);

    $s->execute();

    $s->close();

}

function baja_eventos($id_eventos){
    global $connect;

    $sql="DELETE FROM eventos WHERE id_eventos = $id_eventos";

    $s=$connect->prepare($sql);

    $s->execute();

    $s->close();

}


//EVENTOS

function obtenerEventos($id_eventos){
    global $connect;

    $sql="SELECT * FROM sistbook.eventos where id_eventos = $id_eventos;";

    $s = $connect->prepare($sql);

    $s->execute();

    $records = $s->get_result()->fetch_all(MYSQLI_ASSOC);

    $s->close();

    return $records;
}



function modificar_eventos($id_eventos, $idEvento_estado){
    global $connect;

    $sql="UPDATE `sistbook`.`eventos` SET `rela_evento_estado` = '$idEvento_estado'
        WHERE (`id_eventos` = '$id_eventos');";


    $s=$connect->prepare($sql);

    $s->execute();

    $s->close();

}
