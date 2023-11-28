<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
require_once ('../../config/database/connect.php');
include(ROOT_PATH .'includes\header.php');
include(ROOT_PATH .'includes\nav.php');
include ('../../config/database/functions/perfil.php');
include ('../../config\database\functions\modulos.php');
include(ROOT_PATH . 'config/db_functions.php');




if (!isset($_GET['id_perfil'])) {
	echo "error, ingresaste por el lugar equivocado";
 	exit;
}

if (!isset($_GET['modulo'])) {
 	echo "error, enlace incorrecto";
 	exit;
}

$id_perfil = $_GET['id_perfil'];
$modulo = $_GET['modulo'];


if ($modulo == "administrador") {
	$linkVolver = "..\perfil\listado_perfil.php";
} else if ($modulo == "administrador") {
	$linkVolver = "..\perfil\listado_perfil.php";
}

$descripcion    =$_GET['descripcion'];
$records=selectall('Modulos');
$perfilModulo = consultarPerfilModulo($id_perfil);

?>

<body>
    
    <a href="..\perfil\listado_perfil.php" class="boton-volver">
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
				<a href="..\perfil\listado_perfil.php" title="Listado Perfil">Listado Perfil</a>
			</li>
		</ul>
	</div>

	<section class="container">
		<div class="formulario">
			<form method="POST" action="procesarAsignar.php">
                <h2>Asignar Modulo al Perfil <?php echo $descripcion ?></h2>
				<input type="hidden" name="id_perfil" value="<?php echo $id_perfil; ?>">

                <br>
                    <label for="modulo">Modulos: </label>
                    <select name="modulo" id="modulo">
                        <option value="0"> - Seleccione una modulo -</option>
                        <?php foreach ($records as $reg): ?>
                        <option value="<?php echo $reg['id_modulos'] ?>">
                        <?php echo $reg['descripcion'] ?>
                        </option>
                        <?php endforeach ?>
                    </select>


				<br><br>

				<input type="submit" value="Guardar">

			</form>

			<br><br>
			
		</div>
        <div class="Tabla_Alumnos">
        <table border=1 width="700">

            <tr>
                <th>Modulos</th>
                <th>Modificar</th>
                <th>Borrar</th>
            </tr>

            <?php foreach ($perfilModulo as $reg2): ?>

                <tr>
                    <td><?php echo $reg2['valor'] ?></td>
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
                </tr>

            <?php endforeach ?>

        </table>
    </div>

	</section>

</body>

<?php
	include(ROOT_PATH . 'includes\footer.php');
?>    

</html>