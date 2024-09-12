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
                LEFT JOIN
            duracion d ON d.id_duracion = dc.rela_duracion;";

    $datos = $connect->query($sql);

    return $datos;

}

function alta_cursos($id_niveles, $id_modalidad, $id_periodos, $estado_curso, $cursos_fecha_inicio, $cursos_fecha_fin, $cursos_nombre, $cursos_precio){
    global $connect;

    $sql="INSERT INTO sistbook.cursos (rela_niveles, rela_modalidad, rela_periodos, rela_estado_curso, cursos_fecha_inicio, cursos_fecha_fin, cursos_nombre, cursos_precio) VALUES ($id_niveles, $id_modalidad, $id_periodos, '$estado_curso', '$cursos_fecha_inicio', '$cursos_fecha_fin', '$cursos_nombre', $cursos_precio);";
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

// DURACION DIAS DEL CURSOS TABLA INTERMEDIA

function altaCurso_duracion($id_cursos, $idDuracion, $valor){
    global $connect;

    $sql = "INSERT INTO `sistbook`.`duracion_cursos` (`rela_cursos`, `rela_duracion`, `valor`) VALUES (?, ?, ?)";

    // Intentar preparar la consulta
    $s = $connect->prepare($sql);

    if (!$s) {
        die('Error al preparar la consulta: ' . $connect->error);
    }

    // Vincular parámetros y ejecutar la consulta
    $s->bind_param("iii", $id_cursos, $idDuracion, $valor);
    $result = $s->execute();

    if (!$result) {
        die('Error al ejecutar la consulta: ' . $s->error);
    }

    $s->close();
}



function obtenerDuracion() {
	global $connect;

	$sql = "SELECT * FROM duracion";
	$datoDuracion = $connect->query($sql);
	return $datoDuracion;
}


function obtenerDuracionPorIdCurso($id_cursos) {
	global $connect;
	
	$sql = "SELECT duracion_cursos.valor, duracion.descripcion_duracion, duracion_cursos.id_duracion_cursos
    FROM duracion_cursos
    INNER JOIN duracion ON duracion.id_duracion = duracion_cursos.rela_duracion
    INNER JOIN cursos ON cursos.id_cursos = duracion_cursos.rela_cursos
    WHERE duracion_cursos.rela_cursos = $id_cursos;";

	$datoDuracionCurso = $connect->query($sql);

	return $datoDuracionCurso;
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
                LEFT JOIN
            duracion d ON d.id_duracion = dc.rela_duracion
                INNER JOIN
            inscripcion i ON c.id_cursos = i.rela_cursos
        GROUP BY c.id_cursos
        ORDER BY CantidadInscripciones DESC;";

        $s = $connect->prepare($sql);

        if ($s === false) {
            // Manejar el error en la preparación de la consulta
            die('Error en la preparación de la consulta: ' . $connect->error);
        }

        if (!$s->execute()) {
            // Manejar el error en la ejecución de la consulta
            die('Error al ejecutar la consulta: ' . $s->error);
        }

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
            cursos
                INNER JOIN
            inscripcion i ON cursos.id_cursos = i.rela_cursos
        GROUP BY FechaActual
        ORDER BY CantidadInscripciones DESC;";

	$s = $connect->prepare($sql);

    $s->execute();

    $records = $s->get_result()->fetch_all(MYSQLI_ASSOC);

    $s->close();

	return $records;
}

function obtenerNiveles() {
    global $connect;

    $niveles = array();

    try {
        $sql = "SELECT id_niveles, descripcion FROM niveles";
        $result = $connect->query($sql);

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $niveles[] = $row;
            }
        }

        return $niveles;
    } catch (Exception $e) {
        // Manejo de errores
        // Puedes registrar el error, lanzar una excepción, o manejarlo según tu lógica
        echo "Error: " . $e->getMessage();
        return [];
    }
}


function obtenerCursosPorNivel($nivelSeleccionado) {
    global $connect;

    $cursos = array();

    try {
        $sql = "SELECT 
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
                    inscripcion i ON c.id_cursos = i.rela_cursos
                WHERE
                    c.rela_niveles = ?
                GROUP BY c.id_cursos
                ORDER BY CantidadInscripciones DESC";

        $stmt = $connect->prepare($sql);

        if (!$stmt) {
            throw new Exception("Error en la preparación de la consulta: " . $connect->error);
        }

        $stmt->bind_param("i", $nivelSeleccionado); // Cambiado a "i" si el id es un entero
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $cursos[] = $row;
            }
        }

        return $cursos;
    } catch (Exception $e) {
        // Manejo de errores
        echo "Error: " . $e->getMessage();
        return [];
    }
}

function obtenerCursos($id_cursos){
    global $connect;

    $sql="SELECT * FROM sistbook.cursos where id_cursos = $id_cursos;";

    $s = $connect->prepare($sql);

    $s->execute();

    $records = $s->get_result()->fetch_all(MYSQLI_ASSOC);

    $s->close();

    return $records;
}

function modificar_cursos($id_cursos, $id_niveles, $id_modalidad, $id_periodos, $estado_curso, $cursos_fecha_inicio, $cursos_fecha_fin, $cursos_nombre, $cursos_precio){
    global $connect;

    $sql="UPDATE `sistbook`.`cursos` SET `rela_niveles` = '$id_niveles', `rela_modalidad` = '$id_modalidad', `rela_periodos` = '$id_periodos', `cursos_fecha_inicio` = '$cursos_fecha_inicio', `cursos_fecha_fin` = '$cursos_fecha_fin', `cursos_nombre` = '$cursos_nombre', `cursos_precio` = '$cursos_precio' WHERE (`id_cursos` = '$id_cursos');";


    $s=$connect->prepare($sql);

    $s->execute();

    $s->close();

}

function obtenerNombreCurso($id_cursos) {
    global $connect;

    $sql = "SELECT cursos_nombre FROM cursos WHERE id_cursos = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("i", $id_cursos);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['cursos_nombre'];
    } else {
        return "Curso no encontrado";
    }
}
