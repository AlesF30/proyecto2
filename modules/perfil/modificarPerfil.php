<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include (ROOT_PATH .'config/database/functions/perfil.php');
include (ROOT_PATH .'config\db_functions.php');
include(ROOT_PATH .'includes\header.php');
include(ROOT_PATH .'includes\nav.php');

$id_perfil=$_GET['id_perfil'];


$datosPerfil=obtenerPerfil($id_perfil);

$records=selectall('perfil');

foreach ($datosPerfil as $reg):

?>

<body>
    <section class="cont-formularioAlumno">
        <div class="formularioA">
            <form action="procesarModificarPerfil.php" method="POST">
                <fieldset>
                    <legend>Editar datos del Perfil</legend>
                    
                    <br>
                        <input type="hidden" name="id_perfil" value="<?php echo $id_perfil ?>"/>
                        <label for="perfil">Perfil:</label>
                        <input type="text" name="descripcion" value="<?php echo $reg['descripcion'] ?>"/><br />

                            
                        <input type="submit" name="Enviar">

            </form>
        </div>
</body>

<?php
endforeach;
?>