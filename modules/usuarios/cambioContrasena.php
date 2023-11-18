<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include(ROOT_PATH . 'includes\header.php');
include(ROOT_PATH . 'includes\nav.php');
include(ROOT_PATH . 'config/db_functions.php');




?>
    <section class="cont-formularioAlumno">
            <div class="formularioA">
            <form>
                <label for="contrasenaLabel">Contrase&ntildea Actual:</label>
                <input type="password" id="contrasenaLabel" name="contrasena" placeholder="Nueva contraseña">
                
                <br>

                <label for="contrasenaLabel">Contrase&ntildea Nueva:</label>
                <input type="password" id="contrasenaLabel" name="contrasena" placeholder="Nueva contraseña">

                <br>

                <br>

                <label for="contrasenaLabel">Repetir Contrase&ntildea:</label>
                <input type="password" id="contrasenaLabel" name="contrasena" placeholder="Nueva contraseña">

                <br>

                <input type="submit" name="Enviar">

            </form>
    </section>
</body>
</html>