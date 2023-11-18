<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include(ROOT_PATH . 'includes\header.php');
include(ROOT_PATH . 'includes\nav.php');
include(ROOT_PATH . 'config/db_functions.php');

$records=selectall('categoria_eventos');


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
				<a>Gesti&oacute;n Agencia</a>
			</li>
			<li class="indicador-item">
				<a href="formulario_categoriaEvento.php" title="Formulario Categoria Evento">Formulario Categoria Evento</a>
			</li>
		</ul>
	</div>
	<div class="container">
				<form action="procesar_categoria.php" method=post>
					<fieldset>
						<legend>NUEVA CATEGORIA</legend>
				
							<label for="categoria de evento">Categoria de Evento:</label>
							<input type="text" name="nueva_categoria_evento">

                            <legend>PRECIO</legend>
                            
                            <label for="precio">Precio:</label>
                            <input type="text" name="precio">
					</fieldset>
					<button class= "boton">Guardar</button>
					<!-- <input type="submit" value="Guardar"> -->
				</form>
	</div>
	<div class="tablaMaestra">
			<table border=1 >
			<tr>
				<th>#</th>
				<th>Categoria</th>
                <th>Precio</th>
                <th>Modificar</th>
				<th>Borrar</th>
			</tr>
			<?php foreach ($records as $reg) : ?>
				<tr>
					<td><?php echo $reg['id_categoria'] ?></td>
					<td><?php echo $reg['categoria_descripcion'] ?></td>
                    <td><?php echo $reg['precio'] ?></td>
					<td>
						<a href="modificarCategoriaEvento.php?id_categoria=<?php echo $reg['id_categoria'] ?>">
							<button class="BotonModificar">
								<img src="<?php echo BASE_URL?>assets/icons/editar.png" alt="">
								
							</button>
						</a>
					</td>
                    <td>
						<a href="eliminar_categoriaEvento.php?id_categoria=<?php echo $reg['id_categoria'] ?>">
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