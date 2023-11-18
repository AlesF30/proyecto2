<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include(ROOT_PATH . 'includes\header.php');
include(ROOT_PATH . 'includes\nav.php');
include(ROOT_PATH . 'config/db_functions.php');

$records=selectall('profesion');


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
				<a href="formulario_profesion.php" title="Formulario profesion">Formulario Profesion</a>
			</li>
		</ul>
	</div>
	<div class="container">
				<form action="procesar_profesion.php" method=post>
					<fieldset>
						<legend>NUEVA PROFESION</legend>
				
							<label for="profesion">Profesion:</label>
							<input type="text" name="nueva_profesion">
					</fieldset>
					<button class= "boton">Guardar</button>
					<!-- <input type="submit" value="Guardar"> -->
				</form>
	</div>
	<div class="tablaMaestra">
			<table border=1 >
			<tr>
				<th>#</th>
				<th>Tipo Profesion</th>
				<th>Borrar</th>
			</tr>
			<?php foreach ($records as $reg) : ?>
				<tr>
					<td><?php echo $reg['id_profesion'] ?></td>
					<td><?php echo $reg['descripcion_titulo'] ?></td>
					<td>
						<a href="eliminar_profesion.php?id_profesion=<?php echo $reg['id_profesion'] ?>">
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