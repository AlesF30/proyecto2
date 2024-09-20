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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<a href="../alumnos/listadoal.php" class="boton-volver">Volver</a>

<section class="cont-formularioAlumno">
    <div class="formularioA">
        <form id="formularioAlumno" action="procesar_alumno.php" method="POST" onsubmit="return validarFormulario()">
            <fieldset>
                <legend>Datos personales del Alumno/a</legend>

                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required><br>

                <label for="apellido">Apellido:</label>
                <input type="text" id="apellido" name="apellido" required><br>

                <label for="FechaNac">Fecha de Nacimiento:</label>
                <input type="date" id="FechaNac" name="FechaNac" required><br>

                <label for="tipodoc">Tipo documento:</label>
                <select name="tipodoc" id="tipodoc" required>
                    <option value="0">- Elegir un Tipo -</option>
                    <?php foreach ($records as $reg): ?>
                        <option value="<?php echo $reg['id_tipo_documento'] ?>">
                            <?php echo $reg['descripcion'] ?>
                        </option>
                    <?php endforeach; ?>
                </select><br><br>

                <label for="documento">Documento:</label>
                <input type="text" id="documento" name="documento" required><br>

                <input type="submit" value="Enviar">
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
    var nombre = document.getElementById("nombre").value.trim();
    var apellido = document.getElementById("apellido").value.trim();
    var fechaNac = document.getElementById("FechaNac").value;
    var tipoDoc = document.getElementById("tipodoc").value;
    var documento = document.getElementById("documento").value.trim();
    var fechaActual = new Date();
    var fechaNacimiento = new Date(fechaNac);
    var edad = fechaActual.getFullYear() - fechaNacimiento.getFullYear();
    var mes = fechaActual.getMonth() - fechaNacimiento.getMonth();

    // Validar que solo contenga letras, incluyendo ñ, Ñ, acentos y espacios
    var regexLetras = /^[A-Za-zÑñÁáÉéÍíÓóÚúÜü\s]+$/;
    if (!regexLetras.test(nombre) || !regexLetras.test(apellido)) {
        mostrarAlerta('El nombre y el apellido solo deben contener letras.');
        return false;
    }

    // Validar que el documento solo contenga números
    var regexNumeros = /^[0-9]+$/;
    if (!regexNumeros.test(documento)) {
        mostrarAlerta('El documento solo debe contener números.');
        return false;
    }
    

    // Validar que el usuario sea mayor de edad y no una fecha futura
    if (mes < 0 || (mes === 0 && fechaActual.getDate() < fechaNacimiento.getDate())) {
        edad--;
    }
    if (edad < 18 || fechaNacimiento > fechaActual) {
        mostrarAlerta('Debes ser mayor de edad y la fecha de nacimiento no puede ser futura.');
        return false;
    }

    // Validacion para verificar que todos los campos estan completos
    if (nombre === "" || apellido === "" || fechaNac === "" || tipoDoc === "0" || documento === "") {
        mostrarAlerta('Por favor, complete todos los campos.');
        return false;
    }

    mostrarModalRegistro();
    return true;
}

function mostrarAlerta(mensaje) {
    var alerta = document.createElement('div');
    alerta.classList.add('alert');
    alerta.textContent = mensaje;
    document.body.appendChild(alerta);
    alerta.style.display = 'block';
    setTimeout(function() {
        alerta.style.display = 'none';
    }, 3000);
}

function mostrarModalRegistro() {
    var modal = document.getElementById('modalRegistroExitoso');
    modal.style.display = 'block';
    setTimeout(function() {
        modal.style.display = 'none';
    }, 3000);
}
</script>

</body>
</html>

