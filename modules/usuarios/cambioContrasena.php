<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include(ROOT_PATH . 'includes/header.php');
include(ROOT_PATH . 'includes/nav.php');
include(ROOT_PATH . 'config/db_functions.php');
include(ROOT_PATH . 'config/database/functions/usuarios.php');

$id_usuario = $_SESSION['id_usuario'];
echo $id_usuario;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $contrasena_actual = $_POST['contrasena_actual'];
    $contrasena_nueva = $_POST['contrasena_nueva'];
    $repetir_contrasena = $_POST['repetir_contrasena'];

    // Llama a la función para cambiar la contraseña
    $resultado = cambiarContrasena($id_usuario, $contrasena_actual, $contrasena_nueva, $repetir_contrasena);

    if ($resultado === true) {
        echo "Contraseña cambiada con éxito.";
    } else {
        echo $resultado;
    }
}
?>

<a href="../usuarios/misDatos.php" class="boton-volver">
    Volver
</a>

<div class="cont-indicador">
    <ul class="indicador">
        <li>
            <a href="<?php echo BASE_URL ?>modules/dashboard/dashboard.php">Inicio</a>
        </li>
        <li class="indicador-item">
            <a href="<?php echo BASE_URL ?>modules/usuarios/misDatos.php">Mi Usuario</a>
        </li>
        <li class="indicador-item">
            <a href="cambioContrasena.php" title="Cambiar Contrase&ntildea">Cambiar Contrase&ntildea</a>
        </li>
    </ul>
</div>

<section class="cont-formularioAlumno">
    <div class="formularioA">
        <form method="post" action="cambioContrasena.php">
            <label for="contrasena_actual">Contrase&ntildea Actual:</label>
            <input type="password" id="contrasena_actual" name="contrasena_actual" placeholder="Contraseña Actual" required>
            
            <br>

            <label for="contrasena_nueva">Contrase&ntildea Nueva:</label>
            <input type="password" id="contrasena_nueva" name="contrasena_nueva" placeholder="Nueva Contraseña" required>

            <br>

            <label for="repetir_contrasena">Repetir Contrase&ntildea:</label>
            <input type="password" id="repetir_contrasena" name="repetir_contrasena" placeholder="Repetir la Nueva Contraseña" required>

            <br>

            <input type="submit" name="Enviar" value="Cambiar Contraseña">
        </form>
    </div>
</section>
</body>
</html>
