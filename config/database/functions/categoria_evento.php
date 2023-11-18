<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
require_once(ROOT_PATH . 'config/database/connect.php');


function alta_categoria_eventos($valor, $precio){
    global $connect;

    $sql="INSERT INTO `sistbook`.`categoria_eventos` (`categoria_descripcion`,`precio`) VALUES ('$valor', $precio);";

    $s=$connect->prepare($sql);

    $s->execute();

    $s->close();

}

function baja_categoria_eventos($id_categoria){
    global $connect;

    $sql="DELETE FROM categoria_eventos WHERE id_categoria = $id_categoria";

    $s=$connect->prepare($sql);

    $s->execute();

    $s->close();

}


//CATEGORIA EVENTO
function obtenerCategoriaEventos($id_categoria){
    global $connect;

	$sql="SELECT * FROM sistbook.categoria_eventos where id_categoria = $id_categoria;";

	$s = $connect->prepare($sql);

    $s->execute();

    $records = $s->get_result()->fetch_all(MYSQLI_ASSOC);

    $s->close();

	return $records;
}



function modificar_categoria_eventos($id_categoria, $categoria_descripcion, $precio){
    global $connect;

    $sql="UPDATE `sistbook`.`categoria_eventos` SET `categoria_descripcion` = '$categoria_descripcion', `precio` = '$precio' WHERE (`id_categoria` = '$id_categoria');";


    $s=$connect->prepare($sql);

    $s->execute();

    $s->close();

}
