<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include(ROOT_PATH . 'includes\header.php');
include(ROOT_PATH . 'includes\nav.php');
include(ROOT_PATH . 'config/db_functions.php');


$id_usuario=$_SESSION['id_usuario'];
echo $id_usuario;

?>
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