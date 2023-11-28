<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
require_once ('../../config/database/connect.php');
include(ROOT_PATH .'includes\header.php');
include(ROOT_PATH .'includes\nav.php');
include ('../../config/database/functions/personas.php');


if (!isset($_GET['id_docentes'])) {
	echo "error, ingresaste por el lugar equivocado";
 	exit;
}

if (!isset($_GET['modulo'])) {
 	echo "error, enlace incorrecto";
 	exit;
}

$id_docentes = $_GET['id_docentes'];
$modulo = $_GET['modulo'];

if ($modulo == "alumnos") {
	$linkVolver = "../alumnos/opcionesAlumno.php";
} else if ($modulo == "clientes") {
	$linkVolver = "../clientes/listadoClientes.php";
} else if ($modulo == "profesionales") {
	$linkVolver = "../profesionales/listadoProfesionales.php";
} else if ($modulo == "docentes") {
	$linkVolver = "..\docentes\listadoDocente.php";
}


$datoprofesion = obtenerProfesion();
$datoTituloDocente = obtenerProfesionPorIdDocente($id_docentes);


?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Alta del Registro del Titulo del Docente</title>
</head>

<body>
	<a href="<?php echo $linkVolver ?>" class="boton-volver">
        Volver
    </a>
        
	<section class="container">
		<div class="formulario">
			<form method="POST" action="procesarAltaTituloDocente.php">

				<input type="hidden" name="id_docentes" value="<?php echo $id_docentes; ?>">
				<input type="hidden" name="modulo" value="<?php echo $modulo; ?>">

				<h2>TITUTO DEL PROFESIONAL:</h2>
				<select name="selectTipoSexo">

                    <option value="0"> - Seleccione una Opcion -</option>

					<?php while($registro = $datoprofesion->fetch_assoc()): ?>

						<option value="<?php echo $registro['id_profesion'] ?>">
							<?php echo $registro['descripcion_titulo'] ?>
						</option>

					<?php endwhile ?>

				</select>

				<br><br>

				<input type="submit" value="Guardar">

			</form>

			<br><br><br>

			<table border=1 width="450">
				
				<tr>
					<th>Nombre</th>
					<th>Apellido</th>
					<th>Titulo</th>
                    <th>Fecha del Titulo</th>
					<th>Acciones</th>
				</tr>

				<?php while($registro = $datoTituloDocente->fetch_assoc()): ?>

					<tr>
						<td><?php echo $registro['nombre']; ?></td>
						<td><?php echo $registro['apellido']; ?></td>
						<td><?php echo $registro['descripcion_titulo']; ?></td>
                        <td><?php echo $registro['fecha_titulo']; ?></td>
						<td>
						<a href="eliminarTitutloDocente.php?id_titulo_docente=<?php echo $registro['id_titulo_docente']?>&id_docentes=<?php echo $id_docentes ?>&modulo=<?php echo $modulo ?>">
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