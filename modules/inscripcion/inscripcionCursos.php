<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include(ROOT_PATH . 'includes\header.php');
include(ROOT_PATH . 'includes\nav.php');
include(ROOT_PATH . 'config/database/functions/inscripcion.php');
include(ROOT_PATH . 'config/db_functions.php');

$recordsDato = obtenerDatoAlumnoInscripciones();
$records = obtenerTodosCursos();
$recordsGrupos = obtenerGrupos();

?>

<section>
    <div class="container">
        <form action="/submit" method="post">
            <h1>FORMULARIO DE INSCRIPCION</h1>

            <label for="persona">Alumno:</label>
                <select name="persona" id="persona" required>
                    <option value="0"> - Seleccione un alumno -</option>
                    <?php foreach ($recordsDato as $reg): ?>
                        <option value="<?php echo $reg['id_persona'] ?>">
                            <?php echo $reg['nombre'] . ' ' . $reg['apellido'] ?>
                        </option>
                    <?php endforeach ?>
                </select><br><br>

            <label for="curso">Curso:</label>
                <select name="curso" id="curso" required>
                        <option value="0"> - Seleccione un curso -</option>
                        <?php foreach ($records as $reg): ?>
                            <option value="<?php echo $reg['id_cursos'] ?>">
                                <?php echo $reg['cursos_nombre'] ?>
                            </option>
                        <?php endforeach ?>
                    </select><br><br>
                    
            <label for="grupo">Grupo:</label>
                <select name="grupo" id="grupo" required>
                    <option value="0"> - Seleccione un grupo -</option>
                    <?php foreach ($recordsGrupos as $reg): ?>
                        <option value="<?php echo $reg['id_grupo'] ?>">
                            <?php echo $reg['descripcion'] ?>
                        </option>
                    <?php endforeach ?>
                </select><br><br>

            <label for="fecha">Fecha de inscripción:</label>
            <input type="date" id="fecha" name="fecha" value="<?php echo date('Y-m-d'); ?>" readonly><br><br>

            <input type="submit" value="Enviar">
        </form>