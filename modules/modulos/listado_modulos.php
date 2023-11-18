<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include(ROOT_PATH .'includes\header.php');
include(ROOT_PATH .'includes\nav.php');
include(ROOT_PATH .'config\database\functions\Modulos.php');
include(ROOT_PATH . 'config\db_functions.php');


$records=selectall('Modulos');

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
				<a>Modulos</a>
			</li>
			<li class="indicador-item">
				<a href="listado_modulos.php" title="Listado Modulos">Listado Modulos</a>
			</li>
		</ul>
	</div>
<div class="container">
    <form action="procesarModulos.php" method=post>
        <fieldset>
            <legend>NUEVO MODULO</legend>
    
                <label for="modulos">Modulos:</label>
                <input type="text" name="nuevo_modulo">
        </fieldset>
        <button class= "boton">Guardar</button>
        <!-- <input type="submit" value="Guardar"> -->
    </form>
	</div>

    <div class="Tabla_Alumnos">
        <table border=1 width="700">

            <tr>
                <th>Id Modulos</th>
                <th>Modulos</th>
                <th>Modificar</th>
                <th>Borrar</th>
            </tr>

            <?php foreach ($records as $reg): ?>

                <tr>
                    <td><?php echo $reg['id_modulos'] ?></td>
                    <td><?php echo $reg['descripcion'] ?></td>
                    <td>
                        <a href="<?php echo BASE_URL?>modules\modulos\modificar_modulos.php?id_modulos=<?php echo $reg['id_modulos'] ?>">
                            <button class="BotonModificar">
                                <img src="<?php echo BASE_URL?>assets/icons/editar.png" alt="">        
                            </button>
                        </a>
                    </td>
                    <td>
                        <a href="<?php echo BASE_URL?>modules\modulos\bajaModulos.php?id_modulos=<?php echo $reg['id_modulos'] ?>">
                            <button class="BotonEliminar">
                                <img src="<?php echo BASE_URL?>assets/icons/basura.png" alt="">        
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