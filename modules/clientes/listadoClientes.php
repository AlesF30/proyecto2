<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include(ROOT_PATH .'includes\header.php');
include(ROOT_PATH .'includes\nav.php');
include(ROOT_PATH .'config\database\functions\personas.php');

$datos = obtenerListadoClientes();

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
                    <a href="listadoClientes.php" title="Listado de Clientes">Listado de Clientes</a>
                </li>
            </ul>
        </div>
<div class="conteiner">
    <div class="contenedor-boton">
        <a href="formulario_clientes.php">
            <button class= "boton_agregar">
                <img src="<?php echo BASE_URL?>assets/icons/mas.png" alt="">
                Nuevo Cliente
            </button>
        </a>
    </div>

    <div class="Tabla_Alumnos">
    
        <h1>LISTADO DE CLIENTES</h1>

        <table border=1 width="700">

            <tr>
                <th>Id Cliente</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Fecha Nacimiento</th>
                <th>Nombre Empresa</th>
                <th>Documento</th>
                <th>Contactos</th>
                <th>Sexo</th>
                <th>Modificar</th>
                <th>Borrar</th>
            </tr>

            <?php while($registro = $datos->fetch_assoc()) { ?>

                <tr>
                    <td><?php echo $registro['id_clientes'] ?></td>
                    <td><?php echo $registro['nombre'] ?></td>
                    <td><?php echo $registro['apellido'] ?></td>
                    <td><?php echo $registro['fecha_nacimiento'] ?></td>
                    <td><?php echo $registro['nombre_empresa'] ?></td>
                    <td>
                        <a href="../documentos/altaDocumentos.php?id_persona=<?php echo $registro['id_persona'] ?>&modulo=clientes">
                            <button class="BotonVer">
                                <img src="<?php echo BASE_URL?>assets/icons/ojo.png" alt="">        
                            </button>
                        </a>
				    </td>
                    <td>
                        <a href="../contactos/altaContactos.php?id_persona=<?php echo $registro['id_persona'] ?>&modulo=clientes">
                            <button class="BotonVer">
                                <img src="<?php echo BASE_URL?>assets/icons/ojo.png" alt="">        
                            </button>
                        </a>
				    </td>
                    <td>
                        <a href="..\persona_sexo\AltaSexo.php?id_persona=<?php echo $registro['id_persona'] ?>&modulo=clientes">
                            <button class="BotonVer">
                                <img src="<?php echo BASE_URL?>assets/icons/ojo.png" alt="">        
                            </button>
                        </a>
				    </td>
                    <td>
                        <a href="<?php echo BASE_URL?>modules\clientes\modificar_clientes.php?id_persona=<?php echo $registro['id_persona'] ?>">
                            <button class="BotonModificar">
                                <img src="<?php echo BASE_URL?>assets/icons/editar.png" alt="">        
                            </button>
                        </a>
                    </td>
                    <td>
                        <a href="<?php echo BASE_URL?>modules\clientes\baja_clientes.php?id_persona=<?php echo $registro['id_persona']?>">
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