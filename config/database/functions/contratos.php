<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
require_once(ROOT_PATH . 'config/database/connect.php');


function obtenerListadoContrato(){
    global $connect;

    $sql="SELECT * FROM sistbook.contratos
    INNER JOIN contratos_duracion on contratos_duracion.rela_contrato=contratos.id_contrato
    INNER JOIN duracion_dias on contratos_duracion.rela_duracion_dias=duracion_dias.id_duracion_dias
    INNER JOIN estado_contrato on estado_contrato.id_estado_contrato=contratos.rela_estado_contrato
    INNER JOIN eventos on eventos.id_eventos=contratos.rela_eventos
    INNER JOIN clientes on clientes.id_clientes=contratos.rela_clientes
    left join evento_estado on evento_estado.id_evento_estado=eventos.rela_evento_estado
    left join categoria_eventos on eventos.rela_categoria=categoria_eventos.id_categoria
    left join tipo_evento on eventos.rela_tipo=tipo_evento.id_tipo
    left join personas on personas.id_persona=clientes.rela_personas;";

    $datos = $connect->query($sql);

    return $datos;

}

function obtenerDatoContrato(){
    global $connect;

	$sql="SELECT * FROM clientes JOIN personas ON clientes.rela_personas=personas.id_persona;";

	$s = $connect->prepare($sql);

    $s->execute();

    $records = $s->get_result()->fetch_all(MYSQLI_ASSOC);

    $s->close();

	return $records;
}


function alta_contratos($id_clientes, $id_eventos, $contrato_fecha_alta, $contrato_dias, $contrato_precio, $contrato_estado){
    global $connect;

    $sql="INSERT INTO `sistbook`.`contratos` (`rela_clientes`, `rela_eventos`, `contrato_fecha_alta`, `contratos_dias`, `contrato_precio`, `contrato_estado`) VALUES ('$id_clientes', '$id_eventos', '$contrato_fecha_alta', '$contrato_dias', '$contrato_precio', '$contrato_estado');";

    $s=$connect->prepare($sql);

    $s->execute();

    $s->close();

}

// Evento

function alta_eventos($id_tipo, $id_categoria, $evento_estado){
    global $connect;

    $sql="INSERT INTO `sistbook`.`eventos` (`rela_tipo`, `rela_categoria`, `evento_estado`) VALUES ('$id_tipo', '$id_categoria', '$evento_estado');";

    $s=$connect->prepare($sql);

    $s->execute();

    $s->close();

}

function obtenerEventos($id_eventos){
    global $connect;

    $sql="SELECT * FROM sistbook.eventos where id_eventos = $id_eventos;";

    $s = $connect->prepare($sql);

    $s->execute();

    $records = $s->get_result()->fetch_all(MYSQLI_ASSOC);

    $s->close();

    return $records;
}

//CONTRATO

function obtenerContrato($id_contrato){
    global $connect;

    $sql="SELECT * FROM sistbook.contratos where id_contrato = $id_contrato;";

    $s = $connect->prepare($sql);

    $s->execute();

    $records = $s->get_result()->fetch_all(MYSQLI_ASSOC);

    $s->close();

    return $records;
}


function modificar_contrato($id_contrato, $contrato_estado){
    global $connect;

    $sql="UPDATE `sistbook`.`contratos` SET `contrato_estado` = '$contrato_estado' WHERE (`id_contrato` = '$id_contrato');";


    $s=$connect->prepare($sql);

    $s->execute();

    $s->close();

}
