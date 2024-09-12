<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
require_once(ROOT_PATH . 'config/database/connect.php');
include(ROOT_PATH .'includes/header.php');
include(ROOT_PATH .'includes/nav.php');
require_once(ROOT_PATH . 'config/database/functions/alumnos.php');
require_once(ROOT_PATH . 'config/database/functions/cursos.php');

// Verificar si se ha proporcionado un ID de curso en la URL
if (isset($_GET['id_cursos'])) {
    $id_cursos = $_GET['id_cursos'];
} else {
    die("No se ha proporcionado un ID de curso.");
}

// Obtener los alumnos del curso y el nombre del curso
$alumnos = obtenerAlumnosPorCurso($id_cursos);
$nombre_curso = obtenerNombreCurso($id_cursos);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumnos del Curso</title>
</head>
<body>

<div class="cont-indicador">
    <ul class="indicador">
        <li><a href="<?php echo BASE_URL?>modules/dashboard/dashboard.php">Inicio</a></li>
        <li class="indicador-item"><a>Academia</a></li>
        <li class="indicador-item"><a>Cursos</a></li>
        <li class="indicador-item"><a href="listadoCursos.php" title="Listado Cursos">Listado Cursos</a></li>
        <li class="indicador-item"><a>Listado Alumnos por Curso</a></li>
    </ul>
</div>

<div class="conteiner">
    <div class="Tabla_Alumnos">
        <h1>Alumnos del Curso: <?php echo $nombre_curso; ?></h1>

        <?php if (!empty($alumnos)): ?>
            <table border="1">
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Documento</th>
                </tr>
                <?php foreach ($alumnos as $alumno): ?>
                    <tr>
                        <td><?php echo $alumno['nombre']; ?></td>
                        <td><?php echo $alumno['apellido']; ?></td>
                        <td>
                            <?php echo $alumno['descripcion']; ?>
                        
                            <?php echo $alumno['valor']; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p>No hay alumnos inscritos en este curso.</p>
        <?php endif; ?>
    </div>
</div>

<?php include(ROOT_PATH . 'includes/footer.php'); ?>

</body>
</html>
