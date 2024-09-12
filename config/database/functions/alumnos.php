<?php


require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
require_once(ROOT_PATH . 'config/database/connect.php');


function obtenerAlumnosPorCurso($id_cursos) {
    global $connect;

    $sql = "SELECT *
            FROM inscripcion i
            INNER JOIN alumnos a ON i.rela_alumnos = a.id_alumnos
            INNER JOIN cursos c ON i.rela_cursos = c.id_cursos
            INNER JOIN personas p ON a.rela_personas = p.id_persona
            INNER JOIN persona_documento pd ON p.id_persona = pd.rela_persona
            INNER JOIN tipo_documento td ON pd.rela_tipo_documento = td.id_tipo_documento
            WHERE i.rela_cursos = $id_cursos AND activo = 1";
 
    $resultado = $connect->query($sql);

    return $resultado;

}

?>