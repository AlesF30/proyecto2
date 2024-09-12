<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
require_once(ROOT_PATH . 'config/database/connect.php');

function obtenerTodosCursos(){
    global $connect;

    $sql="SELECT * FROM sistbook.cursos;";

    $s = $connect->prepare($sql);

    $s->execute();

    $records = $s->get_result()->fetch_all(MYSQLI_ASSOC);

    $s->close();

    return $records;
}

// Cambiar por la tabla que se tiene que 
// crear ahora que se llamara alumnos_grupos
// donde guardara el dato para saber que alumno
// esta asignado en que grupo

function obtenerGrupos(){
    global $connect;

    $sql="SELECT * FROM grupo;";

    $s = $connect->prepare($sql);

    $s->execute();

    $records = $s->get_result()->fetch_all(MYSQLI_ASSOC);

    $s->close();

    return $records;

}


function obtenerDatoAlumnoInscripciones(){
    global $connect;

	$sql="SELECT 
    *
FROM
    alumnos a
        INNER JOIN
    personas p ON a.rela_personas = p.id_persona
        LEFT JOIN
    inscripcion i ON a.id_alumnos = i.rela_alumnos
WHERE
    i.id_inscripcion IS NULL AND activo = 1;";

	$s = $connect->prepare($sql);

    $s->execute();

    $records = $s->get_result()->fetch_all(MYSQLI_ASSOC);

    $s->close();

	return $records;
}

?>