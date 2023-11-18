<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include (ROOT_PATH .'config/database/functions/modulos.php');
include (ROOT_PATH .'config\db_functions.php');
include(ROOT_PATH .'includes\header.php');
include(ROOT_PATH .'includes\nav.php');

$id_modulos=$_GET['id_modulos'];


$datosModulos=obtenerModulos($id_modulos);

$records=selectall('modulos');

foreach ($datosModulos as $reg):

?>

<body>
    <section class="cont-formularioAlumno">
        <div class="formularioA">
            <form action="procesarModificar_Modulos.php" method="POST">
                <fieldset>
                    <legend>Editar datos del Modulos</legend>
                    
                    <br>
                        <input type="hidden" name="id_modulos" value="<?php echo $id_modulos ?>"/>
                        <label for="modulos">Modulos:</label>
                        <input type="text" name="descripcion" value="<?php echo $reg['descripcion'] ?>"/><br />

                            
                        <input type="submit" name="Enviar">

            </form>
        </div>
</body>

<?php
endforeach;
?>