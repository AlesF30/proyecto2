<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include (ROOT_PATH .'config/database/functions/usuarios.php');
include (ROOT_PATH .'config\db_functions.php');
include(ROOT_PATH .'includes\header.php');
include(ROOT_PATH .'includes\nav.php');

$id_usuario=$_GET['id_usuario'];

$datosUsuarios=obtenerUsuario($id_usuario);

$records=selectall('perfil');

foreach ($datosUsuarios as $datos):
?>
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
				<a href="listadoUsuario.php" title="Listado de Usuario">Listado de Usuario</a>
			</li>
		</ul>
	</div>
    
    <section class="cont-formularioAlumno">
        <div class="formularioA">
            <form action="procesarModificarUsuario.php" method="POST">
                <fieldset>
                    <legend>Editar datos del Usuario</legend>
                    
                    <br>
                        <input type="hidden" name="id_usuario" value="<?php echo $id_usuario ?>"/>
                        <label for="usuario">Usuario:</label>
                        <input type="text" name="usuario" value="<?php echo $datos['usuario'] ?>"/><br />
                    
                    <br>
                        
                        <label for="perfil">Perfil</label>
                        <select name="perfil" id="perfil">
                            <?php foreach ($records as $reg): ?>
                            <option value="<?php echo $reg['id_perfil'] ?>">
                            <?php echo $reg['descripcion'] ?>
                            </option>
                            <?php endforeach ?>
                        </select>
                    </br>

                      <br>      
                        <input type="submit" name="Enviar">

            </form>
        </div>
</body>

<?php
endforeach;
?>


