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
    left join personas on personas.id_persona=clientes.rela_personas ORDER BY contrato_fecha_alta;;";

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


function alta_contratos($id_clientes, $id_eventos, $estado_contrato, $contrato_fecha_alta, $contrato_precio) {
    global $connect;

    // Consulta preparada para la inserción
    $sql = "INSERT INTO contratos (rela_clientes, rela_eventos, rela_estado_contrato, contrato_fecha_alta, contrato_precio) VALUES (?, ?, ?, ?, ?)";
    
    $stmt = $connect->prepare($sql);

    // Verificar si la preparación tuvo éxito
    if ($stmt === false) {
        die("Error al preparar la consulta: " . $connect->error);
    }

    // Enlazar parámetros y ejecutar la consulta
    $stmt->bind_param("iiiss", $id_clientes, $id_eventos, $estado_contrato, $contrato_fecha_alta, $contrato_precio);
    $result = $stmt->execute();

    // Verificar si la ejecución tuvo éxito
    if ($result === false) {
        die("Error al ejecutar la consulta: " . $stmt->error);
    }

    // Cerrar la consulta preparada
    $stmt->close();
}


// Evento

function alta_eventos($idEvento_estado, $id_tipo, $id_categoria){
    global $connect;

    $sql="INSERT INTO `sistbook`.`eventos` (`rela_evento_estado`, `rela_tipo`, `rela_categoria`) VALUES ('$idEvento_estado', '$id_tipo', '$id_categoria');";

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

// DURACION DIAS DEL CONTRATO
function altaContrato_duracion($id_duracion_dias, $id_contrato, $valor){
    global $connect;

    $sql="INSERT INTO `sistbook`.`contratos_duracion` (`rela_duracion_dias`, `rela_contrato`, `valor`) VALUES ('$id_duracion_dias', '$id_contrato', '$valor');";

    $s=$connect->prepare($sql);

    $s->execute();

    $s->close();

}