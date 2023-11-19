<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include(ROOT_PATH .'includes\header.php');
include(ROOT_PATH .'includes\nav.php');
include(ROOT_PATH .'config\database\functions\perfil.php');
include(ROOT_PATH . 'config\db_functions.php');


$records=selectall('perfil');

?>

<body>

    <a href="../dashboard/dashboard.php" class="boton-volver">
            Volver
    </a>

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
				<a href="listado_perfil.php" title="Listado Perfil">Listado Perfil</a>
			</li>
		</ul>
	</div>
<div class="container">
    <form action="procesarPerfil.php" method=post>
        <fieldset>
            <legend>NUEVO PERFIL</legend>
    
                <label for="perfil">Perfil:</label>
                <input type="text" name="nuevo_perfil">
        </fieldset>
        <button class= "boton">Guardar</button>
        <!-- <input type="submit" value="Guardar"> -->
    </form>
	</div>

    <div class="Tabla_Alumnos">
        <table border=1 width="700">

            <tr>
                <th>Id Perfil</th>
                <th>Perfil</th>
                <th>Modificar</th>
                <th>Borrar</th>
                <th>Asignar Modulos</th>
            </tr>

            <?php foreach ($records as $reg): ?>

                <tr>
                    <td><?php echo $reg['id_perfil'] ?></td>
                    <td><?php echo $reg['descripcion'] ?></td>
                    <td>
                        <a href="<?php echo BASE_URL?>modules\perfil\modificarPerfil.php?id_perfil=<?php echo $reg['id_perfil'] ?>">
                            <button class="BotonModificar">
                                <img src="<?php echo BASE_URL?>assets/icons/editar.png" alt="">        
                            </button>
                        </a>
                    </td>
                    <td>
                        <a href="<?php echo BASE_URL?>modules\perfil\bajaPerfil.php?id_perfil=<?php echo $reg['id_perfil'] ?>">
                            <button class="BotonEliminar">
                                <img src="<?php echo BASE_URL?>assets/icons/basura.png" alt="">        
                            </button>
                        </a>
                    </td>
                    <td>
                        <a href="..\modulosPerfiles\AsignarModuloPerfil.php?id_perfil=<?php echo $reg['id_perfil'] ?>&modulo=administrador&descripcion=<?php echo $reg['descripcion'] ?>">
                            <button class="BotonVer">
                                <img src="<?php echo BASE_URL?>assets/icons/ojo.png" alt="">        
                            </button>
                        </a>
				    </td>
                </tr>

            <?php endforeach ?>

        </table>
    </div>
</div>

<?php
	include(ROOT_PATH . 'includes\footer.php');
?>    

</body>
</html>