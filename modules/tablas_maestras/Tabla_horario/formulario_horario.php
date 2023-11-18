<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include(ROOT_PATH . 'includes\header.php');
include(ROOT_PATH . 'includes\nav.php');
include(ROOT_PATH . 'config/db_functions.php');

$records=selectall('horarios');


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
				<a href="formulario_horario.php" title="Formulario Horario">Formulario Horario</a>
			</li>
		</ul>
	</div>
	<div class="container">
				<form action="procesar_horario.php" method=post>
					<fieldset>
						<legend>NUEVO HORARIO</legend>
				
							<label for="horario">Horario Inicio:</label>
							<input type="text" name="nuevo_horario">
							<label for="horario">Horario Fin:</label>
							<input type="text" name="nuevo_horario">
					</fieldset>
					<button class= "boton">Guardar</button>
					<!-- <input type="submit" value="Guardar"> -->
				</form>
	</div>

	<div class="tablaMaestra">
		<table border=1 >
			<tr>
				<th>#</th>
				<th>Horario Inicio</th>
				<th>Horario Fin</th>
				<th>Borrar</th>
			</tr>
			<?php foreach ($records as $reg) : ?>
				<tr>
					<td><?php echo $reg['id_horarios'] ?></td>
					<td><?php echo $reg['horario_inicio'] ?></td>
					<td><?php echo $reg['horario_fin'] ?></td>
					<td>
						<a href="eliminar_horarios.php?id_horarios=<?php echo $reg['id_horarios'] ?>">
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