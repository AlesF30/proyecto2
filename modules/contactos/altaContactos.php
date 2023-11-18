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
} elseif ($modulo == "clientes") {
	$linkVolver = "../clientes/listadoClientes.php";
} else if ($modulo == "profesionales") {
	$linkVolver = "../profesionales/listadoProfesionales.php";
}

$datosTiposContactos = obtenerTiposContactos();
$datosContactos = obtenerContactosPorIdPersona($id_persona);

?>

<body>

	<a href="<?php echo $linkVolver ?>" class="boton-volver">
		Volver
	</a>

	<section class="container">
		<div class="formulario">

			<form method="POST" action="procesarAlta_contacto.php">

				<input type="hidden" name="id_persona" value="<?php echo $id_persona; ?>">
				<input type="hidden" name="modulo" value="<?php echo $modulo; ?>">
				
				Tipo de contactos:
				<select name="selectTipoContactos">

					<?php while($registro = $datosTiposContactos->fetch_assoc()): ?>

						<option value="<?php echo $registro['id_tipo_contacto'] ?>">
							<?php echo $registro['descripcion'] ?>
						</option>

					<?php endwhile ?>

				</select>

				<br><br>

				Contacto: <input type="text" name="valor">
				<br><br>

				<input type="submit" value="Guardar">
				

			</form>

			<br><br><br>
			
			<table border=1 width="450">
		
				<tr>
					<th>Tipo Contacto</th>
					<th>Valor</th>
					<th>Acciones</th>
				</tr>

				<?php while($registro = $datosContactos->fetch_assoc()): ?>

					<tr>
						<td><?php echo $registro['tipo_contacto']; ?></td>
						<td><?php echo $registro['valor']; ?></td>
						<td>
							<a href="eliminarContacto.php?id_persona_contacto=<?php echo $registro['id_persona_contacto']?>&id_persona=<?php echo $id_persona ?>&modulo=<?php echo $modulo ?>">
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
	
<?php
	include(ROOT_PATH . 'includes\footer.php');
?>
	
</body>
</html>

