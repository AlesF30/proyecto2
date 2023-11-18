<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include(ROOT_PATH . 'includes\header.php');
include(ROOT_PATH . 'includes\nav.php');
include(ROOT_PATH . 'config\database\functions\evento.php');
include(ROOT_PATH . 'config/db_functions.php');


$recordsDato=selectall('categoria_eventos');

$records=selectall('tipo_evento');

$recordsDatoEstado=selectall('evento_estado');

$recordsDatoEvento = obtenerDatoEvento();


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
				<a href="formularioEventos.php" title="Formulario Eventos">Formulario Eventos</a>
			</li>
		</ul>
	</div>
	<div class="container">
                <form action="procesarEventos.php" method="POST">
					<fieldset>
						<legend>Datos de Eventos</legend>
                            
                    <br>
                        <label for="categoria_eventos">Categoria: </label>
                        <select name="categoria_eventos" id="categoria_eventos">
                            <option value="0"> - Seleccione una categoria -</option>
                            <?php foreach ($recordsDato as $reg): ?>
                            <option value="<?php echo $reg['id_categoria'] ?>">
                            <?php echo $reg['categoria_descripcion'] ?>
                            </option>
                            <?php endforeach ?>
                        </select>
                  
                    </br>


                    <br>
                        
                        <label for="tipo_evento">Tipo Evento:</label>
                        <select name="tipo_evento" id="tipo_evento">
                            <option value="0"> - Seleccione un tipo -</option>
                            <?php foreach ($records as $reg): ?>
                                <option value="<?php echo $reg['id_tipo'] ?>">
                                <?php echo $reg['tipo_descripcion'] ?>
                            </option>
                            <?php endforeach ?>
                        </select>
                    </br>
                        
                    <br>
                        
                        <label for="evento_estado">Estado:</label>
                        <select name="evento_estado" id="evento_estado">
                            <option value="0"> - Seleccione un estado -</option>
                            <?php foreach ($recordsDatoEstado as $reg): ?>
                                <option value="<?php echo $reg['id_evento_estado'] ?>">
                                <?php echo $reg['descripcion_estado'] ?>
                            </option>
                            <?php endforeach ?>
                        </select>
                    </br>
                    <br>
                    
                    <input type="hidden" name="id_eventos" value="<?php echo $id_eventos ?>">
                
                </fieldset>
                
                <button class= "boton">Guardar</button>
            
        </form>
        
    </div>
        
        <div class="tablaMaestra">
			<table border=1 >
			<tr>
				<th>#</th>
				<th>Categoria</th>
                <th>Tipo Evento</th>
                <th>Estado</th>
                <th>Modificar</th>
			</tr>
			<?php foreach ($recordsDatoEvento as $reg) : ?>
				<tr>
					<td><?php echo $reg['id_eventos'] ?></td>
                    <td><?php echo $reg['categoria_descripcion'] ?></td>
					<td><?php echo $reg['tipo_descripcion'] ?></td>
                    <td><?php echo $reg['descripcion_estado'] ?></td>
					<td>
						<a href="modificarEventos.php?id_eventos=<?php echo $reg['id_eventos'] ?>">
							<button class="BotonModificar">
								<img src="<?php echo BASE_URL?>assets/icons/editar.png" alt="">
								
							</button>
						</a>
					</td>
				</tr>
			<?php endforeach ?>
			</table>
        
        </div>
    
</section>

</body>
</html>