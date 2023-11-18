<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include(ROOT_PATH . 'includes\header.php');
include(ROOT_PATH . 'includes\nav.php');
include(ROOT_PATH . 'config/db_functions.php');

$records=selectall('tipo_evento');


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
				<a href="formulario_tipo_evento.php" title="Formulario Tipo Evento">Formulario Tipo Evento</a>
			</li>
		</ul>
	</div>
	<div class="container">
				<form action="procesar_tipo_evento.php" method=post>
					<fieldset>
						<legend>NUEVO EVENTO</legend>
				
							<label for="evento">Evento:</label>
							<input type="text" name="nuevo_tipo_evento">
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
					<td><?php echo $reg['id_tipo'] ?></td>
					<td><?php echo $reg['tipo_descripcion'] ?></td>
					<td>
						<a href="eliminar_tipo_evento.php?id_tipo=<?php echo $reg['id_tipo'] ?>">
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