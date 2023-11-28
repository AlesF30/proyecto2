<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include(ROOT_PATH .'includes\header.php');
include(ROOT_PATH .'includes\nav.php');
include(ROOT_PATH .'config\database\functions\personas.php');

$datos = obtenerListadoDocentes();

?>

<body>
    <section>
        <div class="cont-indicador">
            <ul class="indicador">
                <li>
                    <a href="<?php echo BASE_URL?>modules/dashboard/dashboard.php">Inicio</a>
                </li>
            
                <li class="indicador-item">
                    <a>Academia</a>
                </li>
                <li class="indicador-item">
                    <a href="listadoDocente.php" title="Listado de Docentes">Listado de Docentes</a>
                </li>
            </ul>
        </div>
<div class="conteiner">
    <div class="contenedor-boton">
        <a href="formulario_docente.php">
            <button class= "boton_agregar">
                <img src="<?php echo BASE_URL?>assets/icons/mas.png" alt="">
                Agregar Docente
            </button>
        </a>
    </div>

    <div class="Tabla_Alumnos">
        
        <h1>Listado de Docentes</h1>
        
        <table border=1 width="700">

            <tr>
                <th>Id Docente</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Fecha Nacimiento</th>
                <th>Documento</th>
                <th>Contactos</th>
                <th>Sexo</th>
                <th>Titulo</th>
                <th>Modificar</th>
                <th>Borrar</th>
            </tr>

            <?php while($registro = $datos->fetch_assoc()) { ?>

                <tr>
                    <td><?php echo $registro['id_docentes'] ?></td>
                    <td><?php echo $registro['nombre'] ?></td>
                    <td><?php echo $registro['apellido'] ?></td>
                    <td><?php echo $registro['fecha_nacimiento'] ?></td>
                    <td>
                        <a href="../documentos/altaDocumentos.php?id_persona=<?php echo $registro['id_persona'] ?>&modulo=docentes">
                            <button class="BotonVer">
                                <img src="<?php echo BASE_URL?>assets/icons/ojo.png" alt="">        
                            </button>
                        </a>
				    </td>
                    <td>
                        <a href="../contactos/altaContactos.php?id_persona=<?php echo $registro['id_persona'] ?>&modulo=docentes">
                            <button class="BotonVer">
                                <img src="<?php echo BASE_URL?>assets/icons/ojo.png" alt="">        
                            </button>
                        </a>
				    </td>
                    <td>
                        <a href="..\persona_sexo\AltaSexo.php?id_persona=<?php echo $registro['id_persona'] ?>&modulo=docentes">
                            <button class="BotonVer">
                                <img src="<?php echo BASE_URL?>assets/icons/ojo.png" alt="">        
                            </button>
                        </a>
				    </td>
                    <td>
                        <a href="../docente_titulo/altaTituloDocente.php?id_docentes=<?php echo $registro['id_docentes'] ?>&modulo=docentes">
                            <button class="BotonVer">
                                <img src="<?php echo BASE_URL?>assets/icons/ojo.png" alt="">        
                            </button>
                        </a>
                    </td>
                    <td>
                        <a href="<?php echo BASE_URL?>modules\docentes\modificar_docente.php?id_persona=<?php echo $registro['id_persona'] ?>">
                            <button class="BotonModificar">
                                <img src="<?php echo BASE_URL?>assets/icons/editar.png" alt="">        
                            </button>
                        </a>
                    </td>
                    <td>
                        <a href="<?php echo BASE_URL?>modules\docentes\baja_docente.php?id_persona=<?php echo $registro['id_persona']?>">
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