<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include(ROOT_PATH .'includes\header.php');
include(ROOT_PATH .'includes\nav.php');
include (ROOT_PATH .'config/database/functions/book_profesionales.php');
include (ROOT_PATH .'config\db_functions.php');

$id_profesionales=$_POST['id_profesionales'];
echo $id_profesionales;

?>

<!DOCTYPE html>
<html>
<head>
    <title>Formulario de Carga de Book para Profesionales</title>
    <link rel="stylesheet" href="estilos.css"> <!-- Agrega tu archivo de estilos CSS -->
</head>
<body>
    <div class="container">
        <h2>Agregar Foto/s al Book</h2>
        <form action="procesar_bookProfesionles.php" method="post" enctype="multipart/form-data">

			<input type="hidden" name="id_profesionales" value="<?php echo $id_profesionales; ?>">

            <label for="fotos">Seleccione las fotos para cargar:</label>
            <input type="file" id="fotos" name="fotos[]" multiple accept="image/*" required><br><br>

            <input type="submit" value="Guardar" name="submit">
        </form>
    </div>    
</body>

<?php
include(ROOT_PATH . 'includes/footer.php');
?>

</html>

