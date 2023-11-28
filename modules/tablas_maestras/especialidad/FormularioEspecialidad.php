<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include(ROOT_PATH . 'includes\header.php');
include(ROOT_PATH . 'includes\nav.php');
include(ROOT_PATH . 'config/db_functions.php');

$records=selectall('especialidad');

?>
<section>
	<div class="cont-indicador">
		<ul class="indicador">
			<li>
				<a href="<?php echo BASE_URL?>modules/dashboard/dashboard.php">Inicio</a>
			</li>
		
			<li class="indicador-item">
				<a>Gesti&oacute;n de Sistema</a>
			</li>
			<li class="indicador-item">
				<a>Gesti&oacute;n de Agencia</a>
			</li>
			<li class="indicador-item">
				<a href="formularioEspecialidad.php" title="Formulario Especialidad">Formulario Especialidad</a>
			</li>
		</ul>
	</div>
	<div class="container">
				<form action="procesarEspecialidad.php" method=post>
					<fieldset>
						<legend>NUEVA ESPECIALIDAD - PROFESIONALES </legend>
				
							<label for="especialidad">Especialidad:</label>
							<input type="text" name="nueva_especialidad">
					</fieldset>
					<button class= "boton">Guardar</button>
					<!-- <input type="submit" value="Guardar"> -->
				</form>
	</div>
	<div class="tablaMaestra">
			<table border=1 >
			<tr>
				<th>Duracion</th>
				<th>Borrar</th>
			</tr>
			<?php foreach ($records as $reg) : ?>
				<tr>
					<td><?php echo $reg['especialidad_descripcion'] ?></td>
					<td>
						<a href="eliminarespecialidad.php?id_especialidad=<?php echo $reg['id_especialidad'] ?>">
							<button class="Boton_eliminar">
								<img src="<?php echo BASE_URL?>assets/icons/basura.png" alt="">
								
							</button>
						</a>
					</td>
				</tr>
			<?php endforeach ?>
			</table>
                </div>
</section>















<?php
	include(ROOT_PATH . 'includes\footer.php');
?>