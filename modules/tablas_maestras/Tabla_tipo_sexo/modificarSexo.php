<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include (ROOT_PATH .'config/database/functions/tipo_sexo.php');
include (ROOT_PATH .'config\db_functions.php');
include(ROOT_PATH .'includes\header.php');
include(ROOT_PATH .'includes\nav.php');


$id_tipo_sexo=$_GET['id_tipo_sexo'];

$consultarTipoSexo=consultarTipoSexo($id_tipo_sexo);

$records=selectall('tipo_sexo');

foreach ($consultarTipoSexo as $datos):
?>
<body>
    <section class="cont-formularioAlumno">
        <div class="formularioA">>
            <form action="procesarModificarSexo.php" method="POST">
                <fieldset>
                    <legend>Editar datos del Sexo</legend>
                    
                    <br>
                        <input type="hidden" name="id_tipo_sexo" value="<?php echo $id_tipo_sexo ?>"/>
                        <label for="sexo">Sexo:</label>
                        <input type="text" name="descripcion" value="<?php echo $datos['descripcion'] ?>"/><br />
                    
                    <br>
                        
                            
                        <input type="submit" name="Enviar">

            </form>
        </div>
</body>

<?php
endforeach;
?>


