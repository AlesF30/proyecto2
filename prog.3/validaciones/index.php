<?php 

    require_once('control.php');


    if (isset($_POST['submit'])) {
        //VALIDACIONES
        validar($_POST['nombre'], $_POST['apellido'], $_POST['dni']);

        //Si no se produjo ningun error, procedo a realizar el alta del formulario
        if (($error_nombre == false) && ($error_apellido == false) && ($error_dni == false)) {
            alta($_POST['nombre'], $_POST['apellido'], $_POST['dni']);
        }
    }

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="author" content="Prof. Manuel Díaz">
        <meta name="description" content="Validaciones Básicas">
        <title> Validaciones </title>
    </head>
    <body>
        <h1 id="titulo"> Validaciones </h1>
        
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" value="<?php if (isset($_POST['nombre'])) { echo $_POST['nombre']; } ?>">

                <?php 
                    if ($error_nombre) {
                        echo $error_nombre_mensaje;
                    }
                ?>

                <br>

                <label for="apellido">Apellido:</label>
                <input type="text" name="apellido" value="<?php if (isset($_POST['apellido'])) { echo $_POST['apellido']; } ?>">
                <?php 
                    if ($error_apellido) {
                        echo $error_apellido_mensaje;
                    }
                ?>

                <br>

                <label for="dni">DNI:</label>
                <input type="text" name="dni" value="<?php if (isset($_POST['dni'])) { echo $_POST['dni']; } ?>">
                <?php 
                    if ($error_dni) {
                        echo $error_dni_mensaje;
                    }
                ?>

                <br>

                <button type="submit" name="submit"> Confirmar </button>
            </form>
        </div>

    </body>



</html>

