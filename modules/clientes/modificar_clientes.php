<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include(ROOT_PATH . 'config/database/functions/personas.php');
include(ROOT_PATH . 'includes/header.php');
include(ROOT_PATH . 'includes/nav.php');

if (!isset($_GET['id_persona']) || !is_numeric($_GET['id_persona'])) {
    header('Location: listadoal.php?mensaje=ID de alumno inválido&tipo_mensaje=error');
    exit();
}

$id_persona = $_GET['id_persona'];
$datosAlumnos = obtenerDatoAlumno($id_persona);

if (empty($datosAlumnos)) {
    header('Location: listadoal.php?mensaje=Alumno no encontrado&tipo_mensaje=error');
    exit();
}

foreach ($datosAlumnos as $datosAlumnos):
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Alumno</title>
    <script>
        function validarFormulario() {
            var nombre = document.forms["modificarAlumno"]["nombre"].value;
            var apellido = document.forms["modificarAlumno"]["apellido"].value;
            var FechaNac = document.forms["modificarAlumno"]["FechaNac"].value;

            if (nombre === "" || apellido === "" || FechaNac === "") {
                alert("Todos los campos son obligatorios.");
                return false;
            }

            var fecha = new Date(FechaNac);
            var hoy = new Date();
            if (fecha > hoy) {
                alert("La fecha de nacimiento no puede ser futura.");
                return false;
            }

            return true;
        }
    </script>
</head>
<body>
    <a href="listadoal.php" class="boton-volver">Volver</a>
    <section class="cont-formularioAlumno">
        <div class="formularioA">
            <form name="modificarAlumno" action="procesarModificar.php" method="POST" onsubmit="return validarFormulario()">
                <fieldset>
                    <legend>Editar datos del alumno/a</legend>
                    <input type="hidden" name="id_persona" value="<?php echo ($id_persona); ?>"/>
                    <label for="nombre">Nombre:</label>
                    <input type="text" name="nombre" value="<?php echo ($datosAlumnos['nombre']); ?>"/><br /><br>
                    <label for="apellido">Apellido:</label>
                    <input type="text" name="apellido" value="<?php echo ($datosAlumnos['apellido']); ?>" /><br /><br>
                    <label for="fecha de nacimiento">Fecha de Nacimiento:</label>
                    <input type="date" name="FechaNac" value="<?php echo ($datosAlumnos['fecha_nacimiento']); ?>" /><br><br>
                    <input type="submit" name="Enviar" value="Guardar">
                </fieldset>
            </form>
        </div>
    </section>
</body>
<?php endforeach; ?>
</html>
