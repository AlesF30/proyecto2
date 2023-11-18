<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include (ROOT_PATH .'config/database/functions/contratos.php');
include (ROOT_PATH .'config\db_functions.php');
include(ROOT_PATH .'includes\header.php');
include(ROOT_PATH .'includes\nav.php');

$id_contrato=$_GET['id_contrato'];


$recordsEvento=selectall('evento_estado');


$datosContrato=obtenerContrato($id_contrato);



foreach ($datosContrato as $datos):
?>
<body>

    <a href="..\contratos\listadoContrato.php" class="boton-volver">
		Volver
	</a>

    <section class="cont-formularioAlumno">
        <div class="formularioA">
            <form action="procesarModificarContrato.php" method="POST">
                <fieldset>
                    <legend>Editar el Estado del Evento</legend>
                    
                    <br>
                            <input type="hidden" name="id_contrato" value="<?php echo $id_contrato ?>"/>
                                    
                                    <label for="evento_estado">Estado del Evento:</label>
                                    <select name="evento_estado" id="evento_estado">
                                        <option value="0"> - Seleccione un tipo -</option>
                                        <?php foreach ($recordsEvento as $reg): ?>
                                            <option value="<?php echo $reg['id_eventos'] ?>">
                                            <?php echo $reg['descripcion_estado'] ?>
                                        </option>
                                        <?php endforeach ?>
                                    </select>

                                <br><br>

                            <input type="submit" name="Enviar">

            </form>
        </div>
</body>

<?php
endforeach;
?>
