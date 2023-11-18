<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include (ROOT_PATH .'config/database/functions/persona_fisico.php');
include (ROOT_PATH .'config\db_functions.php');
include(ROOT_PATH .'includes\header.php');
include(ROOT_PATH .'includes\nav.php');


$id_persona_fisico=$_GET['id_persona_fisico'];


$datosPersonaFisico=obtenerPersonaFisico($id_persona_fisico);

$records=selectall('caracteristica');

foreach ($datosPersonaFisico as $reg):

?>

<body>
    <section class="cont-formularioAlumno">
        <div class="formularioA">
            <form action="procesarModificarFisico.php" method="POST">
                <fieldset>
                    <legend>Editar datos Medida</legend>
                    
                    <br>
                        <input type="hidden" name="id_persona_fisico" value="<?php echo $id_persona_fisico ?>"/>
                        <label for="valor">Medida:</label>
                        <input type="text" name="valor" value="<?php echo $reg['valor'] ?>"/><br />

                            
                        <input type="submit" name="Enviar">

            </form>
        </div>
</body>

<?php
endforeach;
?>