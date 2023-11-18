<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include (ROOT_PATH .'config/database/functions/dias_semana.php');
include (ROOT_PATH .'config\db_functions.php');
include(ROOT_PATH .'includes\header.php');
include(ROOT_PATH .'includes\nav.php');


$id_dias=$_GET['id_dias'];


$datosDiasSemana=obtenerDiasSemanas($id_dias);


foreach ($datosDiasSemana as $reg):

?>

<body>
    <section class="cont-formularioAlumno">
        <div class="formularioA">
            <form action="procesarModificarDiaSemana.php" method="POST">
                <fieldset>
                    <legend>Editar Datos del Dia de la Semana</legend>
                    
                    <br>
                        <input type="hidden" name="id_dias" value="<?php echo $id_dias ?>"/>
                        <label for="descripcion">Dia de la Semana:</label>
                        <input type="text" name="descripcion" value="<?php echo $reg['descripcion'] ?>"/><br />

                        <br>
                            
                        <input type="submit" name="Enviar">

            </form>
        </div>
</body>

<?php
endforeach;
?>