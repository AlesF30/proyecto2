<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include(ROOT_PATH . 'includes\header.php');
include(ROOT_PATH . 'includes\nav.php');
include(ROOT_PATH . 'config/db_functions.php');


$id_usuario=$_SESSION['id_usuario'];
//echo $id_usuario;

?>

    <a href="..\usuarios\misDatos.php" class="boton-volver">
		Volver
	</a>

    <div class="cont-indicador">
        <ul class="indicador">
            <li>
                <a href="<?php echo BASE_URL?>modules/dashboard/dashboard.php">Inicio</a>
            </li>
        
            <li class="indicador-item">
                <a href="<?php echo BASE_URL?>modules\usuarios\misDatos.php">Mi Usuario</a>
            </li>
            <li class="indicador-item">
                <a href="cambioUsuario.php" title="Cambiar Usuario">Cambiar Usuario</a>
            </li>
        </ul>
    </div>

    <section class="cont-formularioAlumno">
        <div class="formularioA">
            <form action="procesarCambioUsuario.php" method="POST">

                <label for="NuevoUsuario">Nuevo Usuario:</label>
                <input type="text" id="NuevoUsuario" name="NuevoUsuario" required><br><br>

                <label for="passwordActual">Contraseña Actual:</label>
                <input type="password" id="passwordActual" name="passwordActual" required><br><br>

                <input type="submit" value="Guardar">
            </form>
    </section>
</body>
</html>