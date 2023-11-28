<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
require_once(ROOT_PATH . 'config/database/connect.php');

//PROFESIONALES

function alta_especialidad($especialidad_descripcion){
    global $connect;

    $sql="INSERT INTO `sistbook`.`especialidad` (`especialidad_descripcion`) VALUES ('$especialidad_descripcion');";

    $s=$connect->prepare($sql);

    $s->execute();

    $s->close();

}

function baja_especialidad($id_especialidad){
    global $connect;

    $sql="DELETE FROM especialidad WHERE id_especialidad = $id_especialidad";

    $s=$connect->prepare($sql);

    $s->execute();

    $s->close();

}



function obtenerEspecialidad() {
	global $connect;

	$sql = "SELECT * FROM especialidad";
	
	$datoEspecialidad = $connect->query($sql);

	return $datoEspecialidad;

}


function obtenerProfesionalPorIdEspecialidad($id_profesionales) {
	global $connect;
	
	$sql = "SELECT *
        FROM profesional_especialidad
        INNER JOIN especialidad ON especialidad.id_especialidad = profesional_especialidad.rela_especialidad
        INNER JOIN profesionales ON profesionales.id_profesionales = profesional_especialidad.rela_profecionales
        WHERE profesional_especialidad.rela_profecionales = $id_profesionales;";

	$datoProfesionalEspecialidad = $connect->query($sql);

	return $datoProfesionalEspecialidad;
}


// función

function guardarEspecialidadParaProfesionales($id_profesionales, $id_especialidad) {
       
	global $connect;

    $sql = "INSERT INTO profesional_especialidad (rela_profecionales, rela_especialidad) VALUES (?, ?)";

    $stmt = $connect->prepare($sql);


    $stmt->bind_param("ii", $id_profesionales, $id_especialidad);
    $stmt->execute();


    if ($stmt->affected_rows > 0) {
        echo "Sponsor guardado para el evento correctamente.";
    } else {
        echo "Hubo un error al guardar el sponsor para el evento.";
    }


    $stmt->close();
    $connect->close();

}



function obteneEspecialidadesPorProfesionales($id_profesionales) {

	global $connect;

    $sql = "SELECT 
            e.especialidad_descripcion,
            pers.nombre,
            pers.apellido
        FROM
            profesional_especialidad pe
                INNER JOIN
            especialidad e ON pe.rela_especialidad = e.id_especialidad
                INNER JOIN
            profesionales p ON pe.rela_profecionales = p.id_profesionales
                LEFT JOIN
            personas pers ON p.rela_personas = pers.id_persona
        WHERE
            pe.rela_profecionales = ?;";


    $stmt = $connect->prepare($sql);


    $stmt->bind_param("i", $id_profesionales);
    $stmt->execute();


    $result = $stmt->get_result();


    $especialidades = array();

    
    while ($row = $result->fetch_assoc()) {
        $especialidades[] = $row;
    }

    
    $stmt->close();
    $connect->close();

    return $especialidades;

}


?>
