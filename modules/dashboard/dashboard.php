<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include(ROOT_PATH . 'includes\header.php');
include(ROOT_PATH . 'includes\nav.php');

?>

	<section>
		<article>
			<div>
				<strong>
					<h2><ins>Hola, <?php echo $_SESSION['nombre'] . ' ' . $_SESSION['apellido'] ?></ins></h2>
					<br><br>
					<span>Usuario: <?php echo $_SESSION['usuario']?></span>
					<br>
					<span>Perfil: <?php echo $_SESSION['descripcion'] ?></span>	
					<br><br>	
					<figure>
						<img src="../../assets/img/inicio1.jpg">
						<figcaption>Academia y Agencia de Modelos</figcaption>
					</figure>

			</div>
		</article>
		
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