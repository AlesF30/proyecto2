<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include(ROOT_PATH . 'config/database/functions/personas.php');
include(ROOT_PATH . 'includes/header.php');
include(ROOT_PATH . 'includes/nav.php');

// Validar si el id_persona es válido
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
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/estilo.css">
    
    <script>
        // Para validar el formulario antes de enviar
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

        // Oculta el mensaje flotante después de 5 segundos
        setTimeout(function() {
            var mensaje = document.querySelector('.mensaje-flotante');
            if (mensaje) {
                mensaje.style.opacity = '0';
                setTimeout(function() {
                    mensaje.style.display = 'none';
                }, 500); // Tiempo adicional para la transición
            }
        }, 5000); // 5000 milisegundos = 5 segundos
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
                    <input type="text" name="nombre" value="<?php echo ($datosAlumnos['nombre']); ?>" required/><br /><br>
                    
                    <label for="apellido">Apellido:</label>
                    <input type="text" name="apellido" value="<?php echo ($datosAlumnos['apellido']); ?>" required/><br /><br>
                    
                    <label for="FechaNac">Fecha de Nacimiento:</label>
                    <input type="date" name="FechaNac" value="<?php echo ($datosAlumnos['fecha_nacimiento']); ?>" required/><br><br>
                    
                    <input type="submit" name="Enviar" value="Guardar">
                </fieldset>
            </form>
        </div>
    </section>

    <?php
    if (isset($_GET['mensaje'])): ?>
        <div class="mensaje-flotante <?php echo $_GET['tipo_mensaje'] === 'success' ? 'success' : 'error'; ?>">
            <?php echo ($_GET['mensaje']); ?>
        </div>
    <?php endif; ?>

<?php
endforeach;
?>
</body>
<br>

<?php
include(ROOT_PATH . 'includes/footer.php');
?>
</html>
