<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include(ROOT_PATH . 'includes\header.php');
include(ROOT_PATH . 'includes\nav.php');
include(ROOT_PATH . 'config/db_functions.php');

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Formulario de Horario</title>
</head>
<body>
    <div class="container">
        <h2>Asignar Dias A Grupos</h2>
        <form>
            <table border="1">
            <tr>
                <th></th>
                <th>Lunes</th>
                <th>Martes</th>
                <th>Miércoles</th>
                <th>Jueves</th>
                <th>Viernes</th>
                <!-- Agregar más días según sea necesario -->
                </tr>
            <tr>
                <td>Grupo 1</td>
                <td><input type="checkbox" name="grupo1-lunes"></td>
                <td><input type="checkbox" name="grupo1-martes"></td>
                <td><input type="checkbox" name="grupo1-miercoles"></td>
                <td><input type="checkbox" name="grupo1-jueves"></td>
                <td><input type="checkbox" name="grupo1-viernes"></td>
                <!-- Agregar más filas para otros grupos -->
            </tr>
            <tr>
                <td>Grupo 2</td>
                <td><input type="checkbox" name="grupo2-lunes"></td>
                <td><input type="checkbox" name="grupo2-martes"></td>
                <td><input type="checkbox" name="grupo2-miercoles"></td>
                <td><input type="checkbox" name="grupo2-jueves"></td>
                <td><input type="checkbox" name="grupo2-viernes"></td>
                <!-- Agregar más filas para otros grupos -->
            </tr>
            <!-- Agregar más filas para otros grupos -->
            </table>

            <input type="submit" value="Enviar">
        </form>
    </div>
</body>
</html>
