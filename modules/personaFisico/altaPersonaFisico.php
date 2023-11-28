<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
require_once ('../../config/database/connect.php');
include(ROOT_PATH .'includes\header.php');
include(ROOT_PATH .'includes\nav.php');
include ('../../config/database/functions/personas.php');



if (!isset($_GET['id_persona'])) {
	echo "error, ingresaste por el lugar equivocado";
 	exit;
}

if (!isset($_GET['modulo'])) {
 	echo "error, enlace incorrecto";
 	exit;
}

$id_persona = $_GET['id_persona'];
$modulo = $_GET['modulo'];

if ($modulo == "alumnos") {
	$linkVolver = "../alumnos/opcionesAlumno.php";
} else if ($modulo == "profesionales") {
	$linkVolver = "../profesionales/opcionesProfesionales.php";
}

$datoCaracteristica = obtenerCaracteristica();
$datoFisico = obtenerFisicoPorIdPersona($id_persona);


?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Alta de Medidas</title>
</head>

<body>
	<a href="<?php echo $linkVolver ?>" class="boton-volver">
        Volver
    </a>
        
	<section class="container">
		<div class="formulario">
			<form method="POST" action="procesarPersonaFisico.php">

				<input type="hidden" name="id_persona" value="<?php echo $id_persona; ?>">
				<input type="hidden" name="modulo" value="<?php echo $modulo; ?>">

				Caracteristica:
				<select name="caracteristica">

                    <option value="0"> - Seleccione una Opcion -</option>

					<?php while($registro = $datoCaracteristica->fetch_assoc()): ?>

						<option value="<?php echo $registro['id_caracteristica'] ?>">
							<?php echo $registro['descripcion'] ?>
						</option>

					<?php endwhile ?>

				</select>

                <br><br>

				Medidas: <input type="text" name="valor">


				<br><br>

				<input type="submit" value="Guardar">

			</form>

			<br><br><br>

			<table border=1 width="450">
				
				<tr>
					<th>Nombre</th>
					<th>Apellido</th>
					<th>Tipo Medida</th>
					<th>Medida</th>
                    <th>Modificar</th>
                    <th>Borrar</th>
				</tr>

				<?php while($registro = $datoFisico->fetch_assoc()): ?>

					<tr>
						<td><?php echo $registro['nombre']; ?></td>
						<td><?php echo $registro['apellido']; ?></td>
                        <td><?php echo $registro['descripcion']; ?></td>
						<td><?php echo $registro['valor']; ?></td>
                        <td>
						<a href="modificarPersonaFisico.php?id_persona_fisico=<?php echo $registro['id_persona_fisico']?>&id_persona=<?php echo $id_persona ?>&modulo=<?php echo $modulo ?>">
							<button class="BotonModificar">
                                <img src="<?php echo BASE_URL?>assets/icons/editar.png" alt="">        
                            </button>
						</a>
						</td>
                        <td>
						<a href="eliminarPersonaFisico.php?id_persona_fisico=<?php echo $registro['id_persona_fisico']?>&id_persona=<?php echo $id_persona ?>&modulo=<?php echo $modulo ?>">
							<button class="BotonEliminar">
                                <img src="<?php echo BASE_URL?>assets/icons/basura.png" alt="">        
                            </button>
						</a>
						</td>
					</tr>

				<?php endwhile ?>

			</table>

			<br><br>
			
		</div>
	</section>

</body>

<?php
	include(ROOT_PATH . 'includes\footer.php');
?>    

</html>