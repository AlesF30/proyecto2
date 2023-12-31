<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include(ROOT_PATH .'includes\header.php');
include(ROOT_PATH .'includes\nav.php');
include(ROOT_PATH .'config\database\functions\personas.php');

$datos = obtenerListadoProfesionales();

?>

<body>
    <section>
        <div class="cont-indicador">
            <ul class="indicador">
                <li>
                    <a href="<?php echo BASE_URL?>modules/dashboard/dashboard.php">Inicio</a>
                </li>
            
                <li class="indicador-item">
                    <a>Agencia</a>
                </li>
                <li class="indicador-item">
                    <a>Profesionales</a>
                </li>
                <li class="indicador-item">
                    <a href="listadoProfesionales.php" title="Listado de Profesionales">Listado de Profesionales</a>
                </li>
            </ul>
        </div>
<div class="conteiner">
    <div class="contenedor-boton">
        <a href="formularioProfesionales.php">
            <button class= "boton_agregar">
                <img src="<?php echo BASE_URL?>assets/icons/mas.png" alt="">
                Nuevo Profesional
            </button>
        </a>
    </div>

    <div class="Tabla_Alumnos">

        <h1>LISTADO DE PROFESIONALES</h1>

        <table border=1 width="700">

            <tr>
            <th>#</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Fecha Nacimiento</th>
                <th>Observaciones</th>
                <th>Informacion</th>
                <th>Especialidad</th>
                <th>Modificar</th>
                <th>Borrar</th>
            </tr>

            <?php while($registro = $datos->fetch_assoc()) { ?>

                <tr>
                <td><?php echo $registro['id_profesionales'] ?></td>
                    <td><?php echo $registro['nombre'] ?></td>
                    <td><?php echo $registro['apellido'] ?></td>
                    <td><?php echo $registro['fecha_nacimiento'] ?></td>
                    <td><?php echo $registro['profesionales_descripcion'] ?></td>
                    <td>
                        <a href="../profesionales/opcionesProfesionales.php?id_persona=<?php echo $registro['id_persona'] ?>&id_profesionales=<?php echo $registro['id_profesionales'] ?>&modulo=profeionales">
                            <button class="BotonVer">
                                <img src="<?php echo BASE_URL?>assets/icons/ojo.png" alt="">        
                            </button>
                        </a>
                    </td>
                    <td>
                        <a href="..\profesionalesEspecialidad\formularioProfesionalesEspecialidad.php?id_profesionales=<?php echo $registro['id_profesionales'] ?>&modulo=profeionales">
                            <button class="BotonAsignar">
                                <img src="<?php echo BASE_URL?>assets/icons/asignar.png" alt="">        
                            </button>
                        </a>
                    </td>
                    <td>
                        <a href="<?php echo BASE_URL?>modules\profesionales\modificarProfesionales.php?id_persona=<?php echo $registro['id_persona'] ?>">
                            <button class="BotonModificar">
                                <img src="<?php echo BASE_URL?>assets/icons/editar.png" alt="">        
                            </button>
                        </a>
                    </td>
                    <td>
                        <a href="<?php echo BASE_URL?>modules\profesionales\bajaProfesionales.php?id_persona=<?php echo $registro['id_persona']?>">
                            <button class="BotonEliminar">
                                <img src="<?php echo BASE_URL?>assets/icons/basura.png" alt="">        
                            </button>
                        </a>
                    </td>
                </tr>

            <?php } ?>

        </table>
    </div>
</div>

<?php
	include(ROOT_PATH . 'includes\footer.php');
?>    

</body>
</html>