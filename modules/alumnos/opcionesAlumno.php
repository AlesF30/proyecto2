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

    <div class="Tabla_Alumnos">
        <table border=1 width="700">

            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Documento</th>
                <th>Contactos</th>
                <th>Sexo</th>
                <th>Medidas</th>
                
            <?php while($registro = $datos->fetch_assoc()) { ?>

                <tr>
                    <td><?php echo $registro['nombre'] ?></td>
                    <td><?php echo $registro['apellido'] ?></td>
                    <td>
                        <a href="../documentos/altaDocumentos.php?id_persona=<?php echo $registro['id_persona'] ?>&modulo=alumnos">
                            <button class="BotonVer">
                                <img src="<?php echo BASE_URL?>assets/icons/ojo.png" alt="">        
                            </button>
                        </a>
                    </td>
                    <td>
                        <a href="../contactos/altaContactos.php?id_persona=<?php echo $registro['id_persona'] ?>&modulo=alumnos">
                            <button class="BotonVer">
                                <img src="<?php echo BASE_URL?>assets/icons/ojo.png" alt="">        
                            </button>
                        </a>
                    </td>
                    <td>
                        <a href="..\persona_sexo\AltaSexo.php?id_persona=<?php echo $registro['id_persona'] ?>&modulo=alumnos">
                            <button class="BotonVer">
                                <img src="<?php echo BASE_URL?>assets/icons/ojo.png" alt="">        
                            </button>
                        </a>
                    </td>
                    <td>
                        <a href="..\personaFisico\altaPersonaFisico.php?id_persona=<?php echo $registro['id_persona'] ?>&modulo=alumnos">
                            <button class="BotonVer">
                                <img src="<?php echo BASE_URL?>assets/icons/ojo.png" alt="">        
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