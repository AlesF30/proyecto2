<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include (ROOT_PATH .'config/database/functions/evento.php');
include (ROOT_PATH .'config\db_functions.php');
include(ROOT_PATH .'includes\header.php');
include(ROOT_PATH .'includes\nav.php');

$id_eventos=$_GET['id_eventos'];

$datosEventos=obtenerEventos($id_eventos);

$records=selectall('evento_estado');

foreach ($datosEventos as $datos):
?>
<body>
    
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

    <section class="cont-formularioAlumno">
        <div class="formularioA">
            <form action="procesarModificarEventos.php" method="POST">
                <fieldset>
                    <legend>Editar el Estado del Evento</legend>
                    
                    <br>
                            <input type="hidden" name="id_eventos" value="<?php echo $id_eventos ?>"/>
                            
                            <label for="evento_estado">Estado:</label>
                            <select name="evento_estado" id="evento_estado">
                                <option value="0"> - Seleccione un estado -</option>
                                <?php foreach ($records as $reg): ?>
                                    <option value="<?php echo $reg['id_evento_estado'] ?>">
                                    <?php echo $reg['descripcion_estado'] ?>
                                </option>
                                <?php endforeach ?>
                            </select>
                        </br>
                            <br>

                            <input type="submit" name="Enviar">

            </form>
        </div>
</body>

<?php
endforeach;
?>


