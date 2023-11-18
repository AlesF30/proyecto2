<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
require_once(ROOT_PATH . 'config/database/connect.php');


function obtenerListadoCursos(){
    global $connect;

    $sql="SELECT 
            id_cursos,
            cursos_fecha_inicio,
            cursos_fecha_fin,
            cursos_nombre,
            cursos_precio,
            ec.estado_descripcion,
            dc.valor,
            d.descripcion_duracion,
            rela_modalidad,
            rela_niveles,
            rela_periodos,
            niveles.descripcion AS nivel,
            modalidad.descripcion AS modalidad,
            periodos.descripcion AS periodo
        FROM
            cursos c
                INNER JOIN
            niveles ON c.rela_niveles = niveles.id_niveles
                INNER JOIN
            modalidad ON modalidad.id_modalidad = c.rela_modalidad
                INNER JOIN
            periodos ON periodos.id_periodos = c.rela_periodos
                INNER JOIN
            estado_curso ec ON ec.id_estado_curso = c.rela_estado_curso
                INNER JOIN
            duracion_cursos dc ON dc.rela_cursos = c.id_cursos
                INNER JOIN
            duracion d ON d.id_duracion = dc.rela_duracion;";

    $datos = $connect->query($sql);

    return $datos;

}

function alta_cursos($id_niveles, $id_modalidad, $id_periodos, $cursos_fecha_inicio, $cursos_fecha_fin, $cursos_nombre, $cursos_estado, $cursos_precio, $duracion){
    global $connect;

    $sql="INSERT INTO `sistbook`.`cursos` (`rela_niveles`, `rela_modalidad`, `rela_periodos`, `rela_estado_curso`, `cursos_fecha_inicio`, `cursos_fecha_fin`, `cursos_nombre`, `cursos_precio`) VALUES ('$id_niveles', '$id_modalidad', '$id_periodos', '$id_estado_curso', $cursos_fecha_inicio', '$cursos_fecha_fin', '$cursos_nombre','$cursos_precio');";

    $s=$connect->prepare($sql);

    $s->execute();

    $s->close();

}

function obtenerDatoCursos(){
    global $connect;

	$sql="SELECT * FROM cursos JOIN niveles ON cursos.rela_niveles=niveles.id_niveles
    JOIN modalidad ON cursos.rela_modalidad=modalidad.id_modalidad
    JOIN periodos ON cursos.rela_periodos=periodos.id_periodos;";

	$s = $connect->prepare($sql);

    $s->execute();

    $records = $s->get_result()->fetch_all(MYSQLI_ASSOC);

    $s->close();

	return $records;
}



//REPORTE


function reporteCursos(){
    global $connect;

	$sql="SELECT 
            c.cursos_nombre,
            c.cursos_fecha_inicio,
            c.cursos_fecha_fin,
            ec.estado_descripcion,
            c.cursos_precio,
            dc.valor,
            d.descripcion_duracion,
            c.rela_niveles,
            c.rela_periodos,
            c.rela_modalidad,
            niveles.descripcion AS nivel,
            modalidad.descripcion AS modalidad,
            periodos.descripcion AS periodo,
            COUNT(i.id_inscripcion) AS CantidadInscripciones
        FROM
            cursos c
                INNER JOIN
            niveles ON c.rela_niveles = niveles.id_niveles
                INNER JOIN
            modalidad ON modalidad.id_modalidad = c.rela_modalidad
                INNER JOIN
            periodos ON periodos.id_periodos = c.rela_periodos
                INNER JOIN
            grupo ON c.id_cursos = grupo.rela_cursos
                INNER JOIN
            estado_curso ec ON ec.id_estado_curso = c.rela_estado_curso
                INNER JOIN
            duracion_cursos dc ON dc.rela_cursos = c.id_cursos
                INNER JOIN
            duracion d ON d.id_duracion = dc.rela_duracion
                LEFT JOIN
            inscripcion i ON grupo.id_grupo = i.rela_grupo
        GROUP BY c.id_cursos
        ORDER BY CantidadInscripciones DESC;";

	$s = $connect->prepare($sql);

    $s->execute();

    $records = $s->get_result()->fetch_all(MYSQLI_ASSOC);

    $s->close();

	return $records;
}


function criterioCursos(){
    global $connect;

	$sql="SELECT 
            CURDATE() AS FechaActual,
            COUNT(i.id_inscripcion) AS CantidadInscripciones
        FROM
            grupo
                INNER JOIN
            inscripcion i ON grupo.id_grupo = i.rela_grupo
        GROUP BY FechaActual
        ORDER BY CantidadInscripciones DESC;";

	$s = $connect->prepare($sql);

    $s->execute();

    $records = $s->get_result()->fetch_all(MYSQLI_ASSOC);

    $s->close();

	return $records;
}