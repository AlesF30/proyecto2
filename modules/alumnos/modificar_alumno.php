<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include (ROOT_PATH .'config/database/functions/personas.php');
include (ROOT_PATH .'config\db_functions.php');
include(ROOT_PATH .'includes\header.php');
include(ROOT_PATH .'includes\nav.php');

$id_persona=$_GET['id_persona'];

$datosAlumnos=obtenerDatoAlumno($id_persona);

foreach ($datosAlumnos as $datos):
?>
<body>

    <a href="..\alumnos\listadoal.php" class="boton-volver">
		Volver
	</a>
    
    <section class="cont-formularioAlumno">
        <div class="formularioA">
            <form action="procesarModificar.php" method="POST">
                <fieldset>
                    <legend>Editar datos del alumno/a</legend>
                    
                    <br>
                            <input type="hidden" name="id_persona" value="<?php echo $id_persona ?>"/>
                            <label for="nombre">Nombre:</label>
                            <input type="text" name="nombre" value="<?php echo $datos['nombre'] ?>"/><br />
                        
                            <br>

                            <label for="apellido">Apellido:</label>
                            <input type="text" name="apellido" value="<?php echo $datos['apellido'] ?>" /><br />

                            <br>

                            <label for="fecha de nacimiento">Fecha de Nacimiento:</label>
                            <input type="date" name="FechaNac" value="<?php echo $datos ['fecha_nacimiento'];    ?>" /><br>

                            <br>
                            
                            <input type="submit" name="Enviar">

            </form>
        </div>
</body>

<?php
endforeach;
?>


