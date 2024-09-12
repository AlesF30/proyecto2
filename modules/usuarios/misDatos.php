<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include(ROOT_PATH . 'includes\header.php');
include(ROOT_PATH . 'includes\nav.php');
include(ROOT_PATH . 'config/db_functions.php');


$id_usuario=$_SESSION['id_usuario'];
// echo $id_usuario;


?>

    <a href="..\dashboard\dashboard.php" class="boton-volver">
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
        </ul>
    </div>

    <section class="cont-formularioAlumno">
            <div class="formularioA">
            <h2>Actualizar Mis Datos</h2>
            
                <label for="usuarioLabel">Cambiar Usuario:</label>

                <a href="..\usuarios\cambioUsuario.php">
                <button type="button" id="cambiarUsuarioButton">Cambiar usuario</button>

                <br><br>

                <label for="contrasenaLabel">Cambiar Contrase&ntildea:</label>

                <a href="..\usuarios\cambioContrasena.php">
                <button type="button" id="cambiarContrasenaButton">Cambiar Contrase&ntildea</button>
                
    </section>
</body>
</html>