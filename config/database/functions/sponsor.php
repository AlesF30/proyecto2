<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
require_once(ROOT_PATH . 'config/database/connect.php');


function alta_sponsor($nombreSponsor){
    global $connect;

    $sql = "INSERT INTO `sistbook`.`sponsor` (`sponsor_fecha_alta`, `sponsor_nombre`) VALUES (CURDATE(), ?)";

    $s = $connect->prepare($sql);
    $s->bind_param("s", $nombreSponsor); // Enlaza el parámetro con el nombre del sponsor

    $s->execute();

    $s->close();
}


function baja_sponsor($id_sponsor){
    global $connect;

    $sql="DELETE FROM sponsor WHERE id_sponsor = $id_sponsor";

    $s=$connect->prepare($sql);

    $s->execute();

    $s->close();

}

function obtenerSponsor() {
	global $connect;

	$sql = "SELECT * FROM sponsor";
	
	$datoSponsor = $connect->query($sql);

	return $datoSponsor;
}


function obtenerEventoPorSponsorPorIdSponsor($id_eventos) {
	global $connect;
	
	$sql = "SELECT *
	FROM evento_sponsor
	INNER JOIN sponsor ON sponsor.id_sponsor = evento_sponsor.rela_sponsor
	INNER JOIN eventos ON eventos.id_eventos = evento_sponsor.rela_eventos
    left join categoria_eventos on eventos.rela_categoria=categoria_eventos.id_categoria
	left join tipo_evento on eventos.rela_tipo=tipo_evento.id_tipo
	WHERE evento_sponsor.rela_eventos = $id_eventos;";

	$datoEventoSponsor = $connect->query($sql);

	return $datoEventoSponsor;
}


// función

function guardarSponsorParaEvento($id_eventos, $id_sponsor) {
       
	global $connect;

    $sql = "INSERT INTO evento_sponsor (rela_eventos, rela_sponsor) VALUES (?, ?)";

    $stmt = $connect->prepare($sql);


    $stmt->bind_param("ii", $id_eventos, $id_sponsor);
    $stmt->execute();


    if ($stmt->affected_rows > 0) {
        echo "Sponsor guardado para el evento correctamente.";
    } else {
        echo "Hubo un error al guardar el sponsor para el evento.";
    }


    $stmt->close();
    $connect->close();

}



function obtenerSponsorsPorEvento($id_eventos) {

	global $connect;

    $sql = "SELECT 
    s.sponsor_nombre,
    s.sponsor_fecha_alta,
    c.categoria_descripcion,
    t.tipo_descripcion
FROM
    evento_sponsor es
        INNER JOIN
    sponsor s ON es.rela_sponsor = s.id_sponsor
        INNER JOIN
    eventos e ON es.rela_eventos = e.id_eventos
        LEFT JOIN
    categoria_eventos c ON e.rela_categoria = c.id_categoria
        LEFT JOIN
    tipo_evento t ON e.rela_tipo = t.id_tipo
WHERE
    es.rela_eventos = ?;";


    $stmt = $connect->prepare($sql);


    $stmt->bind_param("i", $id_eventos);
    $stmt->execute();


    $result = $stmt->get_result();


    $sponsors = array();

    
    while ($row = $result->fetch_assoc()) {
        $sponsors[] = $row;
    }

    
    $stmt->close();
    $connect->close();

    return $sponsors;

}


?>
