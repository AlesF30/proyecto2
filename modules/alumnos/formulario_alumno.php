<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include(ROOT_PATH . 'includes/header.php');
include(ROOT_PATH . 'includes/nav.php');
include(ROOT_PATH . 'config/database/functions/personas.php');
include(ROOT_PATH . 'config/db_functions.php');

$records = selectall('tipo_documento');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario de Alumno/a</title>
    <style>
        .alert {
            padding: 15px;
            background-color: #f44336; /* Color de fondo rojo */
            color: white; /* Color del texto blanco */
            font-size: 18px;
            border-radius: 4px;
            margin-bottom: 15px;
            display: none; /* Ocultamos el mensaje de alerta inicialmente */
        }

        .alert.success {
            background-color: #4CAF50; /* Color de fondo verde para mensaje de éxito */
        }

        .modal {
            display: none; /* Ocultar modal inicialmente */
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            text-align: center;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<a href="../alumnos/listadoal.php" class="boton-volver">Volver</a>

<section class="cont-formularioAlumno">
    <div class="formularioA">
        <form id="formularioAlumno" action="procesar_alumno.php" method="POST" onsubmit="return validarFormulario()">
            <fieldset>
                <legend>Datos personales del Alumno/a</legend>

                <br>

                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" required><br>

                <br>

                <label for="apellido">Apellido:</label>
                <input type="text" name="apellido" required><br>

                <br>

                <label for="fecha de nacimiento">Fecha de Nacimiento:</label>
                <input type="date" name="FechaNac" required><br>

                <br>

                <label for="tipodoc">Tipo documento:</label>
                <select name="tipodoc" id="tipodoc" required>
                    <option value="0"> - Elegir un Tipo -</option>
                    <?php foreach ($records as $reg): ?>
                        <option value="<?php echo $reg['id_tipo_documento'] ?>">
                            <?php echo $reg['descripcion'] ?>
                        </option>
                    <?php endforeach ?>
                </select>

                <br><br>

                <label for="documento">Documento:</label>
                <input type="text" name="documento" required><br>

                <br>

                <input type="submit" name="Enviar">

            </fieldset>
        </form>
    </div>
</section>

<!-- Modal de registro exitoso -->
<div id="modalRegistroExitoso" class="modal">
    <div class="modal-content">
        <p>¡Registro exitoso!</p>
    </div>
</div>

<script>
function validarFormulario() {
    var nombre = document.forms["formularioAlumno"]["nombre"].value.trim();
    var apellido = document.forms["formularioAlumno"]["apellido"].value.trim();
    var fechaNac = document.forms["formularioAlumno"]["FechaNac"].value;
    var tipoDoc = document.forms["formularioAlumno"]["tipodoc"].value;
    var documento = document.forms["formularioAlumno"]["documento"].value.trim();

    if (nombre === "" || apellido === "" || fechaNac === "" || tipoDoc === "0" || documento === "") {
        mostrarAlerta();
        return false;
    }

    // Aquí podrías agregar más validaciones según tus requerimientos

    // Mostrar el modal de registro exitoso
    mostrarModalRegistro();

    return true;
}

function mostrarAlerta() {
    var alerta = document.createElement('div');
    alerta.classList.add('alert');
    alerta.classList.add('alert-danger'); // Puedes definir estilos para alerta de error si deseas
    alerta.textContent = 'Por favor, complete todos los campos.';
    document.body.appendChild(alerta);
    setTimeout(function() {
        alerta.style.display = 'none'; // Ocultar la alerta después de 3 segundos
    }, 3000); // 3000 milisegundos = 3 segundos
}

function mostrarModalRegistro() {
    var modal = document.getElementById('modalRegistroExitoso');
    modal.style.display = 'block'; // Mostrar el modal de registro exitoso

    setTimeout(function() {
        modal.style.display = 'none'; // Ocultar el modal después de 3 segundos
    }, 3000); // 3000 milisegundos = 3 segundos
}
</script>

</body>
</html>
