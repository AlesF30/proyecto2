<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include (ROOT_PATH .'config/database/functions/categoria_evento.php');
include (ROOT_PATH .'config\db_functions.php');
include(ROOT_PATH .'includes\header.php');
include(ROOT_PATH .'includes\nav.php');


$id_categoria=$_GET['id_categoria'];


$datosCategoriaEvento=obtenerCategoriaEventos($id_categoria);


foreach ($datosCategoriaEvento as $reg):

?>

<body>
    <section class="cont-formularioAlumno">
        <div class="formularioA">
            <form action="procesarModificarCategoria.php" method="POST">
                <fieldset>
                    <legend>Editar datos de Categoria</legend>
                    
                    <br>
                        <input type="hidden" name="id_categoria" value="<?php echo $id_categoria ?>"/>
                        <label for="categoria_descripcion">Categoria:</label>
                        <input type="text" name="categoria_descripcion" value="<?php echo $reg['categoria_descripcion'] ?>"/><br />

                        <br>

                        <label for="precio">Precio:</label>
                        <input type="text" name="precio" value="<?php echo $reg['precio'] ?>"/><br />

                            
                        <input type="submit" name="Enviar">

            </form>
        </div>
</body>

<?php
endforeach;
?>