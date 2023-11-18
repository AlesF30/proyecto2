<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include(ROOT_PATH . 'includes\header.php');
include(ROOT_PATH . 'includes\nav.php');
include(ROOT_PATH . 'config/db_functions.php');

$records=selectall('dias');

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
				<a href="formularioDiasSemanas.php" title="Formulario Dias de la Semana">Formulario Dias de la Semana</a>
			</li>
		</ul>
	</div>
	<div class="container">
				<form action="procesarDiasSemanas.php" method=post>
					<fieldset>
						<legend>NUEVO DIA DE LA SEMANA </legend>
				
							<label for="dias_semana">Dias de la Semana:</label>
							<input type="text" name="nuevo_diaSemana">
					</fieldset>
					<button class= "boton">Guardar</button>
					<!-- <input type="submit" value="Guardar"> -->
				</form>
	</div>
	<div class="tablaMaestra">
			<table border=1 >
			<tr>
				<th>Duracion</th>
				<th>Modificar</th>
                <th>Borrar</th>
			</tr>
			<?php foreach ($records as $reg) : ?>
				<tr>
					<td><?php echo $reg['descripcion'] ?></td>
                    <td>
						<a href="modificarDiasSemanas.php?id_dias=<?php echo $reg['id_dias'] ?>">
							<button class="BotonModificar">
								<img src="<?php echo BASE_URL?>assets/icons/editar.png" alt="">
								
							</button>
						</a>
					</td>
					<td>
						<a href="eliminarDiasSemanas.php?id_dias=<?php echo $reg['id_dias'] ?>">
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