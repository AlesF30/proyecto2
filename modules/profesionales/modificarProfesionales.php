<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include (ROOT_PATH .'config/database/functions/personas.php');
include (ROOT_PATH .'config\db_functions.php');
include(ROOT_PATH .'includes\header.php');
include(ROOT_PATH .'includes\nav.php');

$id_persona=$_GET['id_persona'];

$datosProfesionales=obtenerDatoProfesionales($id_persona);

foreach ($datosProfesionales as $datos):
?>
<body>
    <section class="cont-formularioAlumno">
        <div class="formularioA">
            <form action="procesarModificarProfesionales.php" method="POST">
                <fieldset>
                    <legend>Editar datos del Clientes</legend>
                    
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

                            <label for="profesionales_descripcion">Observaciones:</label>
                            <input type="text" name="profesionales_descripcion" value="<?php echo $datos ['profesionales_descripcion'];    ?>" /><br>


                            <input type="submit" name="Enviar">

            </form>
        </div>
</body>

<?php
endforeach;
?>


