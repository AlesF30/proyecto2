<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include(ROOT_PATH .'includes\header.php');
include(ROOT_PATH .'includes\nav.php');
include(ROOT_PATH .'config\database\functions\usuarios.php');

$records = obtenerDatoUsuario();

?>

<body>

    <div class="cont-indicador">
            <ul class="indicador">
                <li>
                    <a href="<?php echo BASE_URL?>modules/dashboard/dashboard.php">Inicio</a>
                </li>
            
                <li class="indicador-item">
                    <a>Gesti&oacute;n de Sistema</a>
                </li>
                <li class="indicador-item">
                    <a>Usuarios</a>
                </li>
                <li class="indicador-item">
                    <a href="listadoUsuario.php" title="Listado de Usuario">Listado de Usuario</a>
                </li>
            </ul>

    <div class="conteiner">
        <div class="contenedor-boton">
            <a href="formularioUsuarioListado.php">
                <button class= "boton_agregar">
                    <img src="<?php echo BASE_URL?>assets/icons/mas.png" alt="">
                    Nuevo Usuario
                </button>
            </a>
        </div>

        <div class="Tabla_Alumnos">
            <table border=1 width="700">

                <tr>
                    <th>Id Usuario</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Usuario</th>
                    <th>Contrase&ntilde;a</th>
                    <th>Perfil</th>
                    <th>Modificar</th>
                    <th>Borrar</th>
                </tr>

                <?php foreach ($records as $reg): ?>

                    <tr>
                        <td><?php echo $reg['id_usuario'] ?></td>
                        <td><?php echo $reg['nombre'] ?></td>
                        <td><?php echo $reg['apellido'] ?></td>
                        <td><?php echo $reg['usuario'] ?></td>
                        
                        <td>
                            <a href="<?php echo BASE_URL?>resetar_contrasea_usuario.php?id_usuario=<?php echo $reg['id_usuario'] ?>">
                                <button class="BotonContrasena">
                                    <img src="<?php echo BASE_URL?>assets/icons/contrasena.png" alt="">        
                                </button>
                            </a>
                        </td>
                        
                        <td><?php echo $reg['descripcion'] ?></td>
                        <td>
                            <a href="<?php echo BASE_URL?>modules\usuarios\modificar_usuario.php?id_usuario=<?php echo $reg['id_usuario'] ?>">
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