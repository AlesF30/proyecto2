<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');


require_once (ROOT_PATH.'config/database/connect.php');


function consultarTipoSexo($id_tipo_sexo){
    global $connect;

	$sql="SELECT * FROM `sistbook`.`tipo_sexo` where `id_tipo_sexo`=$id_tipo_sexo;";

	$s = $connect->prepare($sql);

    $s->execute();

    $records = $s->get_result()->fetch_all(MYSQLI_ASSOC);

    $s->close();

	return $records;
}



function modificar_tipoSexo($id_tipo_sexo, $descripcion){
    global $connect;
    
	$sql="UPDATE `sistbook`.`tipo_sexo` SET `descripcion` = '$descripcion' WHERE (`id_tipo_sexo` = '$id_tipo_sexo');";


	$s = $connect->prepare($sql);

    $s->execute();

    $s->close();
}


function alta_tipo_sexo($valor){
    global $connect;

    $sql="INSERT INTO `sistbook`.`tipo_sexo` (`descripcion`) VALUES ('$valor');";

    $s=$connect->prepare($sql);

    $s->execute();

    $s->close();

}

function baja_tipo_sexo($id_tipo_sexo){
    global $connect;

    $sql="DELETE FROM tipo_sexo WHERE id_tipo_sexo = $id_tipo_sexo";

    $s=$connect->prepare($sql);

    $s->execute();

    $s->close();

}