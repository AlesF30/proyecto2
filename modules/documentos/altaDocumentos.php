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
} else if ($modulo == "clientes") {
	$linkVolver = "../clientes/listadoClientes.php";
} else if ($modulo == "profesionales") {
	$linkVolver = "../profesionales/listadoProfesionales.php";
}

$datosTiposDocumentos = obtenerTiposDocumento();
$datosDocumentos = obtenerDocumentoPorIdPersona($id_persona);

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Alta de Documento</title>
</head>

<body>
	<a href="<?php echo $linkVolver ?>" class="boton-volver">
        Volver
    </a>
        
	<section class="container">
		<div class="formulario">
			<form method="POST" action="procesarAlta_documento.php">

				<input type="hidden" name="id_persona" value="<?php echo $id_persona; ?>">
				<input type="hidden" name="modulo" value="<?php echo $modulo; ?>">

				Tipo de documento:
				<select name="selectTipoDocumento">

					<?php while($registro = $datosTiposDocumentos->fetch_assoc()): ?>

						<option value="<?php echo $registro['id_tipo_documento'] ?>">
							<?php echo $registro['descripcion'] ?>
						</option>

					<?php endwhile ?>

				</select>

				<br><br>

				Documento: <input type="text" name="valor">
				
				<br><br>

				<input type="submit" value="Guardar">

			</form>

			<br><br><br>

			<table border=1 width="450">
				
				<tr>
					<th>Tipo Documento</th>
					<th>Valor</th>
					<th>Acciones</th>
				</tr>

				<?php while($registro = $datosDocumentos->fetch_assoc()): ?>

					<tr>
						<td><?php echo $registro['tipo_documento']; ?></td>
						<td><?php echo $registro['valor']; ?></td>
						<td> 
							<a href="eliminarDocumento.php?id_persona_documento=<?php echo $registro['id_persona_documento']?>&id_persona=<?php echo $id_persona ?>&modulo=<?php echo $modulo ?>">
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