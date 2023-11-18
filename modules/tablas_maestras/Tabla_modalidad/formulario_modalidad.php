<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include(ROOT_PATH . 'includes\header.php');
include(ROOT_PATH . 'includes\nav.php');
include(ROOT_PATH . 'config/db_functions.php');

$records=selectall('modalidad');

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
				<a href="formulario_modalidad.php" title="Formulario Modalidad">Formulario Modalidad</a>
			</li>
		</ul>
	</div>
	<div class="container">
				<form action="procesar_modalidad.php" method=post>
					<fieldset>
						<legend>NUEVA MODALIDAD</legend>
				
							<label for="modalidad">Modalidad:</label>
							<input type="text" name="nueva_modalidad">
					</fieldset>
					<button class= "boton">Guardar</button>
					<!-- <input type="submit" value="Guardar"> -->
				</form>
	</div>
	<div class="tablaMaestra">
			<table border=1 >
			<tr>
				<th>#</th>
				<th>Modalidad</th>
				<th>Borrar</th>
			</tr>
			<?php foreach ($records as $reg) : ?>
				<tr>
					<td><?php echo $reg['id_modalidad'] ?></td>
					<td><?php echo $reg['descripcion'] ?></td>
					<td>
						<a href="eliminar_modalidad.php?id_modalidad=<?php echo $reg['id_modalidad'] ?>">
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