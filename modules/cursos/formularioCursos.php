<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include(ROOT_PATH .'includes\header.php');
include(ROOT_PATH .'includes\nav.php');
include (ROOT_PATH .'config/database/functions/cursos.php');
include (ROOT_PATH .'config\db_functions.php');


$recordsDato=selectall('modalidad');

$records=selectall('periodos');

$recordsNiveles=selectall('niveles');

$recordsEstadoCurso=selectall('estado_curso');

$recordsDuracionCurso=selectall('duracion');



?>
<body>

    <a href="..\cursos\listadoCursos.php" class="boton-volver">
		Volver
	</a>

    <section class="cont-formularioAlumno">
            <div class="formularioA">
                <form action="procesarCursos.php" method="POST">
                    <fieldset>
                        <legend>Datos de Cursos</legend>
                        
                        <br>
                
                                <label for="cursos_fecha_inicio">Fecha Inicio:</label>
                                <input type="date" name="cursos_fecha_inicio"/><br />
                            
                                <br>

                                <label for="cursos_fecha_fin">Fecha Fin:</label>
                                <input type="date" name="cursos_fecha_fin"/><br />

                                <br>

                                <label for="cursos_nombre">Nombre del Curso:</label>
                                <input type="text" name="cursos_nombre" /><br>

                                
                                <br>

                                <label for="cursos_precio">Precio de un Curso:</label>
                                <input type="text" name="cursos_precio" /><br>

                                <br>
                                    <label for="niveles">Nivel: </label>
                                    <select name="niveles" id="niveles">
                                        <option value="0"> - Seleccione un nivel -</option>
                                        <?php foreach ($recordsNiveles as $reg): ?>
                                        <option value="<?php echo $reg['id_niveles'] ?>">
                                        <?php echo $reg['descripcion'] ?>
                                        </option>
                                        <?php endforeach ?>
                                    </select>
                            
                                </br>

                                <br>
                                    <label for="modalidad">Modalidad: </label>
                                    <select name="modalidad" id="modalidad">
                                        <option value="0"> - Seleccione una modalidad -</option>
                                        <?php foreach ($recordsDato as $reg): ?>
                                        <option value="<?php echo $reg['id_modalidad'] ?>">
                                        <?php echo $reg['descripcion'] ?>
                                        </option>
                                        <?php endforeach ?>
                                    </select>
                            
                                </br>

                                <br>
                                    
                                    <label for="periodos">Periodo:</label>
                                    <select name="periodos" id="periodos">
                                        <option value="0"> - Seleccione un Periodo -</option>
                                        <?php foreach ($records as $reg): ?>
                                            <option value="<?php echo $reg['id_periodos'] ?>">
                                            <?php echo $reg['descripcion'] ?>
                                        </option>
                                        <?php endforeach ?>
                                    </select>

                                <br>

                                
                                <br>
                                    <label for="estado_curso">Estado del Curso: </label>
                                    <select name="estado_curso" id="estado_curso">
                                        <option value="0"> - Seleccione un nivel -</option>
                                        <?php foreach ($recordsEstadoCurso as $reg): ?>
                                        <option value="<?php echo $reg['id_estado_curso'] ?>">
                                        <?php echo $reg['estado_descripcion'] ?>
                                        </option>
                                        <?php endforeach ?>
                                    </select>
                            
                                </br>

                                
                                <br>
                                    <label for="duracion">Duracion del Curso: </label>
                                    <select name="duracion" id="duracion">
                                        <option value="0"> - Seleccione un Opcion -</option>
                                        <?php foreach ($recordsDuracionCurso as $reg): ?>
                                        <option value="<?php echo $reg['id_duracion'] ?>">
                                        <?php echo $reg['descripcion_duracion'] ?>
                                        </option>
                                        <?php endforeach ?>
                                    </select>
                            
                                </br>

                                <label>Ingresar Cantidad de Dias:</label>
                                <input type="text" name="valor">

                                <br>
                                

                                <input type="submit" name="Enviar">

                </form>
    </section>
</body>
</html>