<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include(ROOT_PATH . 'includes\header.php');
include(ROOT_PATH . 'includes\nav.php');
include(ROOT_PATH . 'config/db_functions.php');


$id_usuario=$_SESSION['id_usuario'];


?>
    <section class="cont-formularioAlumno">
            <div class="formularioA">
            <form action="procesarCambioUsuario.php" method="POST">

                <input type="hidden" name="id_usuario" value="<?php echo $id_usuario ?>">
                <label for="usuario">Nuevo usuario:</label>
                    <input type="text" id="usuario" name="usuario" placeholder="Nuevo usuario">

                <br>

                <label for="contrasena">Contrase&ntildea Actual:</label>
                <input type="password" id="contrasena" name="contrasena" placeholder="Nueva Contraseña">

                <br>
                

                <input type="submit" name="Enviar">

            </form>
    </section>
</body>
</html>