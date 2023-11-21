<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include(ROOT_PATH . 'includes\header.php');
include(ROOT_PATH . 'includes\nav.php');
include(ROOT_PATH . 'config/db_functions.php');

$records=selectall('duracion');

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
				<a>Gesti&oacute;n de Academia</a>
			</li>
			<li class="indicador-item">
				<a href="formularioDuracionCurso.php" title="Formulario Duracion Curso">Formulario Duraci&oacuten Curso</a>
			</li>
		</ul>
	</div>
	<div class="container">
				<form action="procesarDuracionCurso.php" method=post>
					<fieldset>
						<legend>NUEVA DURACI&OacuteN - CURSO</legend>
				
							<label for="duracion">Duracion:</label>
							<input type="text" name="nueva_duracionCurso">
					</fieldset>
					<button class= "boton">Guardar</button>
					<!-- <input type="submit" value="Guardar"> -->
				</form>
	</div>
	<div class="tablaMaestra">
			<table border=1 >
			<tr>
				<th>#</th>
				<th>Duracion Curso</th>
				<th>Borrar</th>
			</tr>
			<?php foreach ($records as $reg) : ?>
				<tr>
					<td><?php echo $reg['id_duracion'] ?></td>
					<td><?php echo $reg['descripcion_duracion'] ?></td>
					<td>
						<a href="eliminarDuracionCurso.php?id_duracion=<?php echo $reg['id_duracion'] ?>">
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