<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include(ROOT_PATH . 'includes/header.php');
include(ROOT_PATH . 'includes/nav.php');
include(ROOT_PATH . 'config/database/functions/usuarios.php');
include(ROOT_PATH . 'config/db_functions.php');

// Desde el listado de usuarios
$id_persona = $_GET['id_persona'];
$records = selectall('perfil');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario de Usuario</title>
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

        .closebtn {
            margin-left: 15px;
            color: white;
            font-weight: bold;
            float: right;
            font-size: 22px;
            line-height: 20px;
            cursor: pointer;
            transition: 0.3s;
        }

        .closebtn:hover {
            color: black;
        }
    </style>
</head>
<body>

<section class="cont-formularioAlumno">
    <div class="formularioA">
        <form id="formularioUsuario" action="procesar_usuario.php" method="POST" onsubmit="return validarFormulario()">
            <fieldset>
                <legend>Datos del Usuario</legend>

                <br>
                
                <label for="usuario">Usuario:</label>
                <input type="text" name="usuario" required>

                <br><br>

                <label for="password">Contraseña:</label>
                <!-- Campo de contraseña, visible pero deshabilitado -->
                <input type="password" name="password" value="123" disabled>

                <br><br>

                <input type="hidden" name="id_persona" value="<?php echo $id_persona ?>">

                <input type="submit" name="Enviar" value="Enviar">
            </fieldset>
        </form>
    </div>
</section>

<!-- Modal de registro exitoso -->
<div id="modalRegistroExitoso" class="alert success">
    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
    <strong>¡Registro exitoso!</strong> El usuario ha sido registrado correctamente.
</div>

<script>
function validarFormulario() {
    var usuario = document.forms["formularioUsuario"]["usuario"].value.trim();

    if (usuario === "") {
        mostrarAlerta('Por favor, ingrese un nombre de usuario válido.');
        return false;
    }

    // Aquí podrías agregar más validaciones según tus requerimientos

    // Mostrar el modal de registro exitoso
    mostrarModalRegistro();

    return true;
}

function mostrarAlerta(mensaje) {
    var alerta = document.createElement('div');
    alerta.classList.add('alert');
    alerta.classList.add('alert-danger'); // Puedes definir estilos para alerta de error si deseas
    alerta.textContent = mensaje;
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

