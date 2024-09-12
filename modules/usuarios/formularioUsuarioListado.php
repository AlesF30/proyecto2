<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include(ROOT_PATH . 'includes/header.php');
include(ROOT_PATH . 'includes/nav.php');
include(ROOT_PATH . 'config/database/functions/usuarios.php');
include(ROOT_PATH . 'config/db_functions.php');

$recordsDato = obtenerDatoPersonaUsuario();
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

        .alert.info {
            background-color: #2196F3; /* Color de fondo azul para mensaje de información */
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

    <div class="cont-indicador">
        <ul class="indicador">
            <li>
                <a href="<?php echo BASE_URL?>modules/dashboard/dashboard.php">Inicio</a>
            </li>
        
            <li class="indicador-item">
                <a>Gesti&oacute;n de Sistema</a>
            </li>
            <li class="indicador-item">
                <a>Usuarios</a>
            </li>
            <li class="indicador-item">
                <a href="listadoUsuario.php" title="listado de usuarios">Listado de Usuarios</a>
            </li>
            <li class="indicador-item">
                <a href="formularioUsuarioListado.php" title="nuevo usuario">Nuevo Usuario</a>
            </li>
        </ul>
    </div>

<section class="cont-formularioAlumno">
    <div class="formularioA">
        <form action="procesarUsuario.php" method="POST" onsubmit="return validarFormulario()">
            <fieldset>
                <legend>Datos del Usuario</legend>

                <label for="persona">Persona:</label>
                <select name="persona" id="persona" required>
                    <option value="0"> - Seleccione una persona -</option>
                    <?php foreach ($recordsDato as $reg): ?>
                        <option value="<?php echo $reg['id_persona'] ?>">
                            <?php echo $reg['nombre'] . ' ' . $reg['apellido'] ?>
                        </option>
                    <?php endforeach ?>
                </select>

                <br><br>

                <label for="perfil">Perfil:</label>
                <select name="perfil" id="perfil" required>
                    <?php foreach ($records as $reg): ?>
                        <option value="<?php echo $reg['id_perfil'] ?>">
                            <?php echo $reg['descripcion'] ?>
                        </option>
                    <?php endforeach ?>
                </select>

                <br><br>

                <label for="usuario">Usuario:</label>
                <input type="text" name="usuario" id="usuario" required minlength="4">

                <br><br>

                <input type="submit" name="Enviar" value="Enviar">
            </fieldset>
        </form>

        <!-- Mensaje de alerta -->
        <div id="mensajeAlerta" class="alert">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            <strong>¡Alerta!</strong> Por favor, complete todos los campos correctamente.
        </div>
    </div>
</section>

<script>
function validarFormulario() {
    var persona = document.getElementById('persona').value;
    var perfil = document.getElementById('perfil').value;
    var usuario = document.getElementById('usuario').value.trim();

    if (persona == 0 || usuario.length < 4) {
        mostrarAlerta();
        return false;
    }

    return true;
}

function mostrarAlerta() {
    var alerta = document.getElementById('mensajeAlerta');
    alerta.style.display = 'block'; // Mostrar el mensaje de alerta
    setTimeout(function() {
        alerta.style.display = 'none'; // Ocultar el mensaje después de 3 segundos
    }, 3000); // 3000 milisegundos = 3 segundos
}
</script>

</body>
</html>
