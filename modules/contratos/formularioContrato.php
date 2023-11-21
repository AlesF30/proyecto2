<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
require_once ('../../config/database/connect.php');
include(ROOT_PATH .'includes\header.php');
include(ROOT_PATH .'includes\nav.php');
include (ROOT_PATH .'config/database/functions/contratos.php');
include (ROOT_PATH .'config\db_functions.php');


$recordsDato=selectall('categoria_eventos');

$records=selectall('tipo_evento');

$recordsEvento=selectall('evento_estado');

$recordsContrato=selectall('estado_contrato');

$recordsDuracion=selectall('duracion_dias');

$recordsDatoContrato = obtenerDatoContrato();


?>
<body>

    <a href="..\contratos\listadoContrato.php" class="boton-volver">
		Volver
	</a>

    <section class="cont-formularioAlumno">
            <div class="formularioA">
                <form action="procesarContrato.php" method="POST">
                    <fieldset>
                        <legend>Datos del Contrato</legend>
                        
                        <br>
                
                                <label for="contrato_fecha_alta">Fecha Alta:</label>
                                <input type="date" name="contrato_fecha_alta"/><br />
                            

                                <br>
                                    <label for="duracion_dias">Duraci&oacuten del Evento:</label>
                                    <select name="duracion_dias" id="duracion_dias">
                                        <option value="0"> - Seleccione una Opcion -</option>
                                        <?php foreach ($recordsDuracion as $reg): ?>
                                        <option value="<?php echo $reg['id_duracion_dias'] ?>">
                                        <?php echo $reg['descripcion'] ?>
                                        </option>
                                        <?php endforeach ?>
                                    </select>
                            
                                </br><br>

                                <label>Ingresar Cantidad de Dias:</label>
                                <input type="text" name="valor">
                                
                                <br>

                                <label for="contrato_precio">Precio Acordado:</label>
                                <input type="text" name="contrato_precio" /><br>

                                <br>
                                    <label for="clientes">Cliente: </label>
                                    <select name="clientes" id="clientes">
                                        <option value="0"> - Seleccione un cliente -</option>
                                        <?php foreach ($recordsDatoContrato as $reg): ?>
                                        <option value="<?php echo $reg['id_clientes'] ?>">
                                        <?php echo $reg['nombre'] ?>
                                        <?php echo $reg['apellido'] ?>
                                        <?php echo $reg['nombre_empresa'] ?>
                                        </option>
                                        <?php endforeach ?>
                                    </select>
                            
                                </br>

                                <br>
                                    <label for="categoria_eventos">Categor&iacutea: </label>
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

                                <br>

                              
                                <br>
                                    
                                    <label for="evento_estado">Estado del Evento:</label>
                                    <select name="evento_estado" id="evento_estado">
                                        <option value="0"> - Seleccione un tipo -</option>
                                        <?php foreach ($recordsEvento as $reg): ?>
                                            <option value="<?php echo $reg['id_evento_estado'] ?>">
                                            <?php echo $reg['descripcion_estado'] ?>
                                        </option>
                                        <?php endforeach ?>
                                    </select>

                                <br><br>
                                                              
                                    <label for="estado_contrato">Estado del Contrato:</label>
                                    <select name="estado_contrato" id="estado_contrato">
                                        <option value="0"> - Seleccione un tipo -</option>
                                        <?php foreach ($recordsContrato as $reg): ?>
                                            <option value="<?php echo $reg['id_estado_contrato'] ?>">
                                            <?php echo $reg['contrato_estado'] ?>
                                        </option>
                                        <?php endforeach ?>
                                    </select>

                                <br><br>

                                
                                <input type="hidden" name="id_contrato" value="<?php echo $id_contrato ?>">
                                <input type="hidden" name="id_eventos" value="<?php echo $id_eventos ?>">

                                <input type="submit" name="Enviar">

                </form>
    </section>
</body>
</html>