<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include(ROOT_PATH . 'includes\header.php');
include(ROOT_PATH . 'includes\nav.php');
include(ROOT_PATH . 'config/db_functions.php');

$records=selectall('estado_contrato');

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
				<a href="formularioEstadoContrato.php" title="Formulario Estado del Contrato">Formulario Estado del Contrato</a>
			</li>
		</ul>
	</div>
	<div class="container">
				<form action="procesarEstadoContrato.php" method=post>
					<fieldset>
						<legend>NUEVO ESTADO - CONTRATO </legend>
				
							<label for="estado_contrato">Duracion:</label>
							<input type="text" name="nuevo_contrato_estado">
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
					<td><?php echo $reg['contrato_estado'] ?></td>
					<td>
						<a href="eliminarEstadoContrato.php?id_estado_contrato=<?php echo $reg['id_estado_contrato'] ?>">
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