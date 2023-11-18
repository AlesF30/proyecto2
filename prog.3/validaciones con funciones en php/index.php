<?php

require_once('control.php');


if (isset($_POST['submit'])) {
    //VALIDACIONES
    $validacion = validar($_POST['nombre'], $_POST['apellido'], $_POST['dni']);
    //print_r($validacion['mensaje']['nombre_mensaje']);


    //Si no se produjo ningun error, procedo a realizar el alta del formulario
    if ($validacion['accion'] == 'exito') {
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
        <input type="text" name="nombre" value="<?php if (isset($_POST['nombre'])) {
            echo $_POST['nombre'];
        } ?>">

        <?php
        if (isset($validacion)) {

            echo $validacion['mensaje']['nombre_mensaje'];
        }
        ?>

        <br>

        <label for="apellido">Apellido:</label>
        <input type="text" name="apellido" value="<?php if (isset($_POST['apellido'])) {
            echo $_POST['apellido'];
        } ?>">
        <?php
        if (isset($validacion)) {
            echo $validacion['mensaje']['apellido_mensaje'];
        }
        ?>

        <br>

        <label for="dni">DNI:</label>
        <input type="text" name="dni" value="<?php if (isset($_POST['dni'])) {
            echo $_POST['dni'];
        } ?>">
        <?php
        if (isset($validacion)) {
            echo $validacion['mensaje']['dni_mensaje'];
        }
        ?>

        <br>

        <button type="submit" name="submit"> Confirmar </button>
    </form>
    </div>

</body>



</html>