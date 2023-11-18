<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include(ROOT_PATH .'includes\header.php');
include(ROOT_PATH .'includes\nav.php');

// Consulta para obtener los cursos más solicitados
$sql = "SELECT nombre, solicitudes FROM cursos ORDER BY solicitudes DESC";
$resultado = $conn->query($sql);

// Generar el informe HTML
echo '<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Informe de Cursos Más Solicitados</title>
</head>
<body>
    <h1>Informe de Cursos Más Solicitados</h1>
    <table>
        <tr>
            <th>Curso</th>
            <th>Solicitudes</th>
        </tr>';

if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        echo '<tr>
                <td>' . $fila["nombre"] . '</td>
                <td>' . $fila["solicitudes"] . '</td>
            </tr>';
    }
}

echo '</table></body></html>';

// Cerrar la conexión a la base de datos
$conn->close();
?>