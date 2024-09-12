<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
require_once ('../../config/database/connect.php');
include(ROOT_PATH .'includes\header.php');
include(ROOT_PATH .'includes\nav.php');
include ('../../config/database/functions/perfil.php');
include ('../../config/database/functions/modulos.php');
include(ROOT_PATH . 'config/db_functions.php');

if (!isset($_GET['id_perfil'])) {
    echo "error, ingresaste por el lugar equivocado";
    exit;
}

if (!isset($_GET['modulo'])) {
    echo "error, enlace incorrecto";
    exit;
}

$id_perfil = $_GET['id_perfil'];
$modulo = $_GET['modulo'];

if ($modulo == "administrador") {
    $linkVolver = "..\perfil\listado_perfil.php";
} else if ($modulo == "administrador") {
    $linkVolver = "..\perfil\listado_perfil.php";
}

$descripcion = $_GET['descripcion'];

// Obtener todos los módulos y los módulos asignados al perfil
$modulos = obtenerTodosLosModulos();
$perfilModulo = consultarPerfilModulo($id_perfil);

$success_msg = '';
$error_msg = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['modulos'])) {
        foreach ($_POST['modulos'] as $id_modulo) {
            if (!in_array($id_modulo, array_column($perfilModulo, 'id_modulos'))) {
                if (asignarModulos($id_perfil, $id_modulo)) {
                    $success_msg = "Módulos asignados con éxito al perfil.";
                } else {
                    $error_msg = "Error al asignar los módulos al perfil.";
                }
            }
        }
    } else {
        $error_msg = "Por favor, seleccione al menos un módulo.";
    }
}

?>

<body>
    
    <a href="..\perfil\listado_perfil.php" class="boton-volver">
        Volver
    </a>

    <!-- Mensajes de éxito o error -->
    <?php if ($success_msg): ?>
        <div class="successmsj">
            <img src="<?php echo BASE_URL; ?>assets/icons/check.png" alt="Éxito"> <?php echo $success_msg; ?>
        </div>
    <?php endif; ?>

    <?php if ($error_msg): ?>
        <div class="errormsj">
            <img src="<?php echo BASE_URL; ?>assets/icons/alerta.png" alt="Error"> <?php echo $error_msg; ?>
        </div>
    <?php endif; ?>

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
                <a href="..\perfil\listado_perfil.php" title="Listado Perfil">Listado Perfil</a>
            </li>
        </ul>
    </div>

    <section class="container">
        <div class="formulario">
            <form method="POST" action="">
                <h2>Asignar Modulo al Perfil <?php echo $descripcion ?></h2>
                <input type="hidden" name="id_perfil" value="<?php echo $id_perfil; ?>">

                <br>
                <label for="modulos">Modulos: </label>
                <select name="modulos[]" id="modulos" multiple>
                    <?php foreach ($modulos as $modulo): ?>
                        <option value="<?php echo $modulo['id_modulos'] ?>"
                            <?php echo in_array($modulo['id_modulos'], array_column($perfilModulo, 'id_modulos')) ? 'selected' : ''; ?>>
                            <?php echo $modulo['descripcion'] ?> 
                            <?php echo in_array($modulo['id_modulos'], array_column($perfilModulo, 'id_modulos')) ? '✔️' : ''; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <br><br>
                <input type="submit" value="Guardar">
            </form>
            <br><br>
        </div>
    </section>

</body>

<?php
    include(ROOT_PATH . 'includes\footer.php');
?>    

</html>