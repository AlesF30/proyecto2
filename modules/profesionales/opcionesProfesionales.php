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
                <li class="indicador-item">
                    <a href="opcionesProfesionales.php" title="Informacion Profesionales">Informacion Profesionales</a>
                </li>
            </ul>
        </div>
<div class="conteiner">
    <div class="contenedor-boton">
        <a href="..\profesionales\listadoProfesionales.php" class="boton-volver">
            Volver
        </a>

    <div class="Tabla_Alumnos">
        
        <h1>Informacion de Profesionales</h1>

        <table border=1 width="700">

            <tr>
            <th>#</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Documento</th>
                <th>Contactos</th>
                <th>Sexo</th>
                <th>Medidas</th>
                <th>Book de Fotos</th>
            </tr>

            <?php while($registro = $datos->fetch_assoc()) { ?>

                <tr>
                <td><?php echo $registro['id_profesionales'] ?></td>
                    <td><?php echo $registro['nombre'] ?></td>
                    <td><?php echo $registro['apellido'] ?></td>
                    <td>
                        <a href="../documentos/altaDocumentos.php?id_persona=<?php echo $registro['id_persona'] ?>&modulo=profesionales">
                            <button class="BotonVer">
                                <img src="<?php echo BASE_URL?>assets/icons/ojo.png" alt="">        
                            </button>
                        </a>
				    </td>
                    <td>
                        <a href="../contactos/altaContactos.php?id_persona=<?php echo $registro['id_persona'] ?>&modulo=profesionales">
                            <button class="BotonVer">
                                <img src="<?php echo BASE_URL?>assets/icons/ojo.png" alt="">        
                            </button>
                        </a>
				    </td>
                    <td>
                        <a href="..\persona_sexo\AltaSexo.php?id_persona=<?php echo $registro['id_persona'] ?>&modulo=profesionales">
                            <button class="BotonVer">
                                <img src="<?php echo BASE_URL?>assets/icons/ojo.png" alt="">        
                            </button>
                        </a>
				    </td>
                    <td>
                        <a href="..\personaFisico\altaPersonaFisico.php?id_persona=<?php echo $registro['id_persona'] ?>&modulo=profesionales">
                            <button class="BotonVer">
                                <img src="<?php echo BASE_URL?>assets/icons/ojo.png" alt="">        
                            </button>
                        </a>
                    </td>
                    <td>
                        <a href="..\book_profesionales\formularioBook_profesionales.php?id_profesionales=<?php echo $registro['id_profesionales'] ?>&modulo=profesionales">
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