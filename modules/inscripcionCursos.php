<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include(ROOT_PATH . 'includes\header.php');
include(ROOT_PATH . 'includes\nav.php');

?>

<section>
    <div class="container">
        <form action="/submit" method="post">
            <h1>FORMULARIO DE INSCRIPCION</h1>
            <label for="alumno">Selecciona al alumno:</label>
            <select id="alumno" name="alumno">
                <!-- Aquí se cargarían los nombres de los alumnos disponibles -->
                <option value="alumno1">Alumno 1</option>
                <option value="alumno2">Alumno 2</option>
                <!-- Otros alumnos -->
            </select><br><br>

            <label for="curso">Selecciona el curso:</label>
            <select id="curso" name="curso">
                <!-- Aquí se cargarían los cursos disponibles -->
                <option value="curso1">Curso 1</option>
                <option value="curso2">Curso 2</option>
                <!-- Otros cursos -->
            </select><br><br>

            <label for="grupo">Selecciona el grupo:</label>
            <select id="grupo" name="grupo">
                <!-- Aquí se cargarían los grupos disponibles -->
                <option value="grupo1">Grupo 1</option>
                <option value="grupo2">Grupo 2</option>
                <!-- Otros grupos -->
            </select><br><br>

            <label for="fecha">Fecha de inscripción:</label>
            <input type="date" id="fecha" name="fecha" value="<?php echo date('Y-m-d'); ?>" readonly><br><br>

            <input type="submit" value="Enviar">
        </form>