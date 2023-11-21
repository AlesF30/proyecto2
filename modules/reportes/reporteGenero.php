<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
require_once ('../../config/database/connect.php');
include(ROOT_PATH .'includes/header.php');
include(ROOT_PATH .'includes/nav.php');
include (ROOT_PATH .'config/db_functions.php');

// Consulta SQL para obtener los porcentajes de género
$sql = "SELECT ts.descripcion AS genero, COUNT(*) AS cantidad 
    FROM tipo_sexo ts
    INNER JOIN persona_sexo ps ON ts.id_tipo_sexo = ps.rela_tipo_sexo
    GROUP BY ts.descripcion";

$result = $connect->query($sql);
$data = array();

if ($result->num_rows > 0) {
    // Obtener datos de la consulta y prepararlos para el gráfico
    while ($row = $result->fetch_assoc()) {
        $label = $row["genero"]; // Descripción del género (femenino, masculino, no identificado)
        $y = ($row["cantidad"] / totalPersonas($connect)) * 100; // Calcular el porcentaje
        $data[] = array("y" => $y, "label" => $label);
    }
} else {
    echo "No se encontraron resultados";
}

// Función para obtener el total de personas
function totalPersonas($connect) {
    $sql = "SELECT COUNT(*) AS total FROM persona_sexo";
    $result = $connect->query($sql);

    $total = 0;

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $total = $row["total"];
    }

    return $total;
}

$connect->close(); // Cierra la conexión a la base de datos

// Resto del código...
?>

<!DOCTYPE HTML>
<html>
<head>
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
<script>
window.onload = function() {

    var datos = <?php echo json_encode($data); ?>;
    
    var chart = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true,
        title: {
            text: "Porcentaje por género"
        },
        data: [{
            type: "pie",
            startAngle: 240,
            yValueFormatString: "##0.00\"%\"",
            indexLabel: "{label} {y}",
            dataPoints: datos
        }]
    });

    chart.render();

    }
    
</script>
</head>
<body>
<div id="chartContainer" style="height: 300px; width: 100%;"></div>
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
</body>
</html>