<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include(ROOT_PATH . 'includes\header.php');
include(ROOT_PATH . 'includes\nav.php');
include(ROOT_PATH . 'config/db_functions.php');

$records=selectall('estado_curso');

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
				<a href="formularioEstadoCurso.php" title="Formulario Estado del Curso">Formulario Estado del Curso</a>
			</li>
		</ul>
	</div>
	<div class="container">
				<form action="procesarEstadoCurso.php" method=post>
					<fieldset>
						<legend>NUEVO ESTADO - CURSO </legend>
				
							<label for="estado_curso">Duracion:</label>
							<input type="text" name="nuevo_curso_estado">
					</fieldset>
					<button class= "boton">Guardar</button>
					<!-- <input type="submit" value="Guardar"> -->
				</form>
	</div>
	<div class="tablaMaestra">
			<table border=1 >
			<tr>
				<th>Estado</th>
				<th>Borrar</th>
			</tr>
			<?php foreach ($records as $reg) : ?>
				<tr>
					<td><?php echo $reg['estado_descripcion'] ?></td>
					<td>
						<a href="eliminarEstadoCurso.php?id_estado_curso=<?php echo $reg['id_estado_curso'] ?>">
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