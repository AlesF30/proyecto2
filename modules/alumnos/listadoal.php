<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include(ROOT_PATH .'includes\header.php');
include(ROOT_PATH .'includes\nav.php');
include(ROOT_PATH .'config\database\functions\personas.php');

$datos = obtenerListadoAlumno();

?>

	<body>		
		<section>
			<div class="cont-indicador">
				<ul class="indicador">
					<li>
						<a href="<?php echo BASE_URL?>modules/dashboard/dashboard.php">Inicio</a>
					</li>
				
					<li class="indicador-item">
						<a>Gesti&oacute;n de Sistema</a>
					</li>
					<li class="indicador-item">
						<a href="listadoal.php" title="Listado de Alumnos/as">Listado de Alumnos/as</a>
					</li>
				</ul>
			</div>
			<div class="conteiner">
				<div class="contenedor-boton">
					<a href="formulario_alumno.php">
						<button class= "boton_agregar">
							<img src="<?php echo BASE_URL?>assets/icons/mas.png" alt="">
							Nuevo Alumno
						</button>
					</a>
				</div>

		<div>
			<div class="Tabla_Alumnos">
				<h1>Listado de Alumnos</h1>
			
			<table border=1 width="700">
				<thead>
					
					<tr>
						<th>Nombre</th>
						<th>Apellido</th>
						<th>Fecha Nacimiento</th>
						<th>Informacion</th>
						<th>Modificar</th>
						<th>Borrar</th>
					</tr>

				</thead>

				<?php while($registro = $datos->fetch_assoc()) { ?>

				<tbody>
					<tr>
						<td><?php echo $registro['nombre'] ?></td>
						<td><?php echo $registro['apellido'] ?></td>
						<td><?php echo $registro['fecha_nacimiento'] ?></td>
						<td>
							<a href="../alumnos/opcionesAlumno.php?id_persona=<?php echo $registro['id_persona'] ?>&modulo=alumnos">
								<button class="BotonVer">
									<img src="<?php echo BASE_URL?>assets/icons/ojo.png" alt="">        
								</button>
							</a>
						</td>
						<td>
							<a href="<?php echo BASE_URL?>modules\alumnos\modificar_alumno.php?id_persona=<?php echo $registro['id_persona'] ?>">
								<button class="BotonModificar">
									<img src="<?php echo BASE_URL?>assets/icons/editar.png" alt="">        
								</button>
							</a>
						</td>
						<td>
							<a href="<?php echo BASE_URL?>modules\alumnos\baja_alumno.php?id_persona=<?php echo $registro['id_persona']?>">
								<button class="BotonEliminar">
									<img src="<?php echo BASE_URL?>assets/icons/basura.png" alt="">        
								</button>
							</a>
						</td>
					</tr>

				<?php } ?>

				</tbody>
			</table>
		</div>

	<?php
		include(ROOT_PATH . 'includes\footer.php');
	?>    


  </body>
</html>