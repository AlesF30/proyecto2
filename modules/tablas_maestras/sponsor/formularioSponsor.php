<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include(ROOT_PATH . 'includes\header.php');
include(ROOT_PATH . 'includes\nav.php');
include(ROOT_PATH . 'config/db_functions.php');

$records=selectall('sponsor');

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
				<a href="formularioSponsor.php" title="Formulario Sponsor">Formulario Sponsor</a>
			</li>
		</ul>
	</div>
	<div class="container">
				<form action="procesarSponsor.php" method=post>
					<fieldset>
						<legend>NUEVO SPONSOR</legend>
				
							<label for="sponsor">Nombre del Sponsor:</label>
							<input type="text" name="nuevo_sponsor">
					</fieldset>
					<button class= "boton">Guardar</button>
					<!-- <input type="submit" value="Guardar"> -->
				</form>
	</div>
	<div class="tablaMaestra">
			<table border=1 >
			<tr>
                <th>Fecha Alta</th>
				<th>Sponsor</th>
                <th>Borrar</th>
			</tr>
			<?php foreach ($records as $reg) : ?>
				<tr>
					<td><?php echo $reg['sponsor_fecha_alta'] ?></td>
                    <td><?php echo $reg['sponsor_nombre'] ?></td>
					<td>
						<a href="eliminarSponsor.php?id_sponsor=<?php echo $reg['id_sponsor'] ?>">
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