<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include(ROOT_PATH . 'includes\header.php');
include(ROOT_PATH . 'includes\nav.php');

include (ROOT_PATH .'config/db_functions.php');

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

$connect->close();

?>

	<section>
		<article>
			<div>
				<strong>
					<h2><ins>Hola, <?php echo $_SESSION['nombre'] . ' ' . $_SESSION['apellido'] ?></ins></h2>
					<!-- <br><br>
					<span>Usuario: <?php echo $_SESSION['usuario']?></span>
					<br>
					<span>Perfil: <?php echo $_SESSION['descripcion'] ?></span>	
					<br><br>	 -->
					<figure>
						<img src="../../assets/img/inicio1.jpg">
						<figcaption>Academia y Agencia de Modelos</figcaption>
					</figure>

			</div>
		</article>
		<div id="chartContainer" style="height: 300px; width: 80%; margin:0 auto;"></div>
			<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
			<script>
				var datos = <?php echo json_encode($data); ?>;
				
				var chart = new CanvasJS.Chart("chartContainer", {
					animationEnabled: true,
					title: {
						text: "Porcentaje por Sexo"
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
			</script>
		
		<article>
			<div>
				<ul>
					<li>
						<i class="bi-android2"></i>
						Primer Objetivo
						<p class="hidden">
							Automatizar información sobre los cursos que se dictan, quienes las dictan, horarios y días.
						</p>
					</li>
					<li>
						<i class="bi-android2"></i>
							Segundo Objetivo
						<p class="hidden">
							Visualizar y difundir la sesión de fotos en un portafolio denominado book, donde se visualicen los diferentes modelos que puede brindar la academia.
						</p>
					</li>
					<li>
						<i class="bi-android2"></i>
							Tercer Objetivo
						<p class="hidden">
							El sistema deberá brindar accesos a consultas personales con algunos de los profesionales docentes para un asesoramiento y/o cambios de
							look de acuerdo a lo que necesite el alumno, ya sea para su imagen personal y/o profesional o en el caso de tener que asistir a un evento al que fue contratado por un cliente.
						</p>	
					</li>
					<li>
						<i class="bi-android2"></i>
							Quinto Objetivo
						<p class="hidden">
							Proporcionar comodidad y practicidad al momento de registrar o gestionar las inscripciones, cobros, pagos, eventos y cursos.
						</p>
					</li>
					<li>
						<i class="bi-android2"></i>
							Sexto Objetivo
						<p class="hidden">
							Difundir la organización a través de una breve descripción de “quienes somos”, medio de contactos y la red social de Book Management.
						</p>
					</li>
				</ul>
			</div>
		</article>
	</section>


<?php
	include(ROOT_PATH . 'includes\footer.php');
?>