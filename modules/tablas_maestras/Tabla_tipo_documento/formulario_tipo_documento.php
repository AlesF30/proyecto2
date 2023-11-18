<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include(ROOT_PATH . 'includes\header.php');
include(ROOT_PATH . 'includes\nav.php');
include(ROOT_PATH . 'config/db_functions.php');


$records=selectall('tipo_documento');


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
				<a href="formulario_tipo_documento.php" title="Formulario Tipo Documento">Formulario Tipo Documento</a>
			</li>
		</ul>
	</div>
	<div class="container">
				<form action="procesar_tipo_documento.php" method=post>
					<fieldset>
						<legend>NUEVO DOCUMENTO</legend>
				
							<label for="documento">Documento:</label>
							<input type="text" name="nuevo_documento">
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
					<td><?php echo $reg['id_tipo_documento'] ?></td>
					<td><?php echo $reg['descripcion'] ?></td>
					<td>
						<a href="eliminar_tipo_documento.php?id_tipo_documento=<?php echo $reg['id_tipo_documento'] ?>">
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