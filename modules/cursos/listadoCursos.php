<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include(ROOT_PATH .'includes\header.php');
include(ROOT_PATH .'includes\nav.php');
include(ROOT_PATH .'config\database\functions\cursos.php');

$records = obtenerListadoCursos();

?>

<body>

    <div class="cont-indicador">
            <ul class="indicador">
                <li>
                    <a href="<?php echo BASE_URL?>modules/dashboard/dashboard.php">Inicio</a>
                </li>
            
                <li class="indicador-item">
                    <a>Academia</a>
                </li>
                <li class="indicador-item">
                    <a>Cursos</a>
                </li>
                <li class="indicador-item">
                    <a href="listadoCursos.php" title="Listado Cursos">Listado Cursos</a>
                </li>
            </ul>

    <div class="conteiner">
        <div class="contenedor-boton">
            <a href="formularioCursos.php">
                <button class= "boton_agregar">
                    <img src="<?php echo BASE_URL?>assets/icons/mas.png" alt="">
                    Nuevo Curso
                </button>
            </a>
        </div>

        <div class="Tabla_Alumnos">
        
            <h1>LISTADO DE CURSOS</h1>

            <table border=1 width="700">

                <tr>
                    <th>Nombre de Curso</th>
                    <th>Nivel</th>
                    <th>Modalidad</th>
                    <th>Periodo</th>
                    <th>Estado Curso</th>
                    <th>Fecha de Inicio</th>
                    <th>Fecha de Fin</th>
                    <th>Precio</th>
                    <th>Duraci&oacuten</th>
                    <th>Modificar</th>
                    <th>Borrar</th>
                </tr>

                <?php foreach ($records as $reg): ?>

                    <tr>
                        <td><?php echo $reg['cursos_nombre'] ?></td>
                        <td><?php echo $reg['nivel'] ?></td>
                        <td><?php echo $reg['modalidad'] ?></td>
                        <td><?php echo $reg['periodo'] ?></td>
                        <td><?php echo $reg['estado_descripcion'] ?></td>
                        <td><?php echo $reg['cursos_fecha_inicio'] ?></td>
                        <td><?php echo $reg['cursos_fecha_fin'] ?></td>

                        <td><?php echo $reg['cursos_precio'] ?></td>
                        
                        <td><?php echo $reg['valor'] ?>
                        <?php echo $reg['descripcion_duracion'] ?></td>

                        <td>
                            <a href="<?php echo BASE_URL?>modules\cursos\modificar_cursos.php?id_cursos=<?php echo $reg['id_cursos'] ?>">
                                <button class="BotonModificar">
                                    <img src="<?php echo BASE_URL?>assets/icons/editar.png" alt="">        
                                </button>
                            </a>
                        </td>
                        <td>
                            <a href="<?php echo BASE_URL?>modules\usuarios\bajaUsuario.php?id_usuario=<?php echo $reg['id_usuario'] ?>">
                                <button class="BotonEliminar">
                                    <img src="<?php echo BASE_URL?>assets/icons/basura.png" alt="">        
                                </button>
                            </a>
                        </td>
                    </tr>

                <?php endforeach ?>

            </table>
        </div>
    </div>

<?php
	include(ROOT_PATH . 'includes\footer.php');
?>    

</body>
</html>