<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include(ROOT_PATH . 'includes\header.php');
include(ROOT_PATH . 'includes\nav.php');
include(ROOT_PATH . 'config/db_functions.php');


$records=selectall('tipo_sexo');


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
				<a href="formulario_tipo_sexo.php" title="Formulario Tipo Sexo">Formulario Tipo Sexo</a>
			</li>
		</ul>
	</div>
	<div class="container">
				<form action="procesarModicarSexo.php" method=post>
					<fieldset>
						<legend>NUEVO SEXO</legend>
				
							<label for="sexo">Sexo:</label>
							<input type="text" name="nuevo_sexo">
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
				<th>Modificar</th>
				<th>Borrar</th>
			</tr>
			<?php foreach ($records as $reg) : ?>
				<tr>
					<td><?php echo $reg['id_tipo_sexo'] ?></td>
					<td><?php echo $reg['descripcion'] ?></td>
					<td>
						<a href="<?php echo BASE_URL?>modules\tablas_maestras\Tabla_tipo_sexo\modificarSexo.php?id_tipo_sexo=<?php echo $reg['id_tipo_sexo'] ?>">
							<button class="BotonModificar">
								<img src="<?php echo BASE_URL?>assets/icons/editar.png" alt="">   
								
							</button>
						</a>
					</td>
					<td>
						<a href="eliminar_tipo_sexo.php?id_tipo_sexo=<?php echo $reg['id_tipo_sexo'] ?>">
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