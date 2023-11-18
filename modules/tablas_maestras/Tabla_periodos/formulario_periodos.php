<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include(ROOT_PATH . 'includes\header.php');
include(ROOT_PATH . 'includes\nav.php');
include(ROOT_PATH . 'config/db_functions.php');

$records=selectall('periodos');


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
				<a href="formulario_periodos.php" title="Formulario Periodos">Formulario Periodos</a>
			</li>
		</ul>
	</div>
	<div class="container">
		<form action="procesar_periodos.php" method=post>
			<fieldset>
				<legend>NUEVO PERIODO</legend>
		
					<label for="periodo">Periodo:</label>
					<input type="text" name="nuevo_periodo">
			</fieldset>
			<button class= "boton">Guardar</button>
			<!-- <input type="submit" value="Guardar"> -->
		</form>
	</div>
	
	<div class="tablaMaestra">
		<table border=1 >
			<tr>
				<th>#</th>
				<th>Periodo</th>
				<th>Borrar</th>
			</tr>
			<?php foreach ($records as $reg) : ?>
				<tr>
					<td><?php echo $reg['id_periodos'] ?></td>
					<td><?php echo $reg['descripcion'] ?></td>
					<td>
						<a href="eliminar_periodos.php?id_periodos=<?php echo $reg['id_periodos'] ?>">
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