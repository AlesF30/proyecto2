<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include(ROOT_PATH . 'includes\header.php');
include(ROOT_PATH . 'includes\nav.php');
include(ROOT_PATH . 'config/db_functions.php');



$records=selectall('tipo_contacto');


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
				<a href="formulario_tipo_contacto.php" title="Formulario Tipo Contacto">Formulario Tipo Contacto</a>
			</li>
		</ul>
	</div>
	<div class="container">
				<form action="procesar_tipo_contacto.php" method=post>
					<fieldset>
						<legend>NUEVO CONTACTO</legend>
				
							<label for="contacto">Contacto:</label>
							<input type="text" name="nuevo_contacto">
					</fieldset>
					<button class= "boton">Guardar</button>
					<!-- <input type="submit" value="Guardar"> -->
				</form>
	</div>
	<div class="tablaMaestra">
		<table border=1 >
			<tr>
				<th>#</th>
				<th>Tipo</th>
				<th>Borrar</th>
			</tr>
			<?php foreach ($records as $reg) : ?>
				<tr>
					<td><?php echo $reg['id_tipo_contacto'] ?></td>
					<td><?php echo $reg['descripcion'] ?></td>
					<td>
						<a href="eliminar_tipo_contacto.php?id_tipo_contacto=<?php echo $reg['id_tipo_contacto'] ?>">
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