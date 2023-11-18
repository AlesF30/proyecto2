<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include(ROOT_PATH . 'includes\header.php');
include(ROOT_PATH . 'includes\nav.php');

?>

<section>
    <div class="container">
        <form>
        <table border="1">
            <thead>
            <tr>
                <th>Grupo</th>
                <th>Día</th>
                <th>Horario de inicio</th>
                <th>Horario de fin</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Grupo 1</td>
                <td>Lunes</td>
                <td>
                <select name="inicio_grupo_1">
                    <option value="08:00">08:00</option>
                    <option value="09:00">09:00</option>
                    <!-- Agrega más opciones según sea necesario -->
                </select>
                </td>
                <td>
                <select name="fin_grupo_1">
                    <option value="12:00">12:00</option>
                    <option value="13:00">13:00</option>
                    <!-- Agrega más opciones según sea necesario -->
                </select>
                </td>
            </tr>
            <!-- Puedes agregar más filas para más grupos -->
            </tbody>
        </table>
        <button type="submit" class="boton">Confirmar</button>
        </form>