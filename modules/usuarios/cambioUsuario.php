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
                <label for="usuarioLabel">Nuevo usuario:</label>
                <input type="text" id="usuarioLabel" name="usuario" placeholder="Nuevo usuario">

                <br>

                <label for="contrasenaLabel">Contrase&ntildea Actual:</label>
                <input type="password" id="contrasenaLabel" name="contrasena" placeholder="Nueva Contraseña">

                <br>

                <input type="submit" name="Enviar">

            </form>
    </section>
</body>
</html>