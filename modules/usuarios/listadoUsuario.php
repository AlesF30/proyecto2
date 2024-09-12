<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include(ROOT_PATH . 'includes/header.php');
include(ROOT_PATH . 'includes/nav.php');
include(ROOT_PATH . 'config/database/functions/usuarios.php');

$items_per_page = 4;
$pagina_actual = isset($_GET['pagina_actual']) ? (int)$_GET['pagina_actual'] : 1;
$offset = ($pagina_actual - 1) * $items_per_page;

// Obtener los registros y el total de usuarios
$records = obtenerDatoUsuario($offset, $items_per_page);
$total_usuarios = obtenerTotalUsuarios();
$total_paginas = ceil($total_usuarios / $items_per_page);

?>

<body>
    <!-- Capturar y mostrar mensajes de éxito o error solo cuando corresponda -->
    <?php if (isset($_GET['message'])): ?>
        <?php if ($_GET['message'] == 'success'): ?>
            <div class="successmsj" id="alert-message">
                <img src="<?php echo BASE_URL; ?>assets/icons/check.png" alt="Éxito"> Contraseña restablecida con éxito.
            </div>
        <?php elseif ($_GET['message'] == 'error'): ?>
            <div class="errormsj" id="alert-message">
                <img src="<?php echo BASE_URL; ?>assets/icons/alerta.png" alt="Error"> Error al restablecer la contraseña.
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <div class="cont-indicador">
        <ul class="indicador">
            <li>
                <a href="<?php echo BASE_URL ?>modules/dashboard/dashboard.php">Inicio</a>
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
    </div>

    <div class="conteiner">
        <div class="contenedor-boton">
            <a href="formularioUsuarioListado.php">
                <button class="boton_agregar">
                    <img src="<?php echo BASE_URL ?>assets/icons/mas.png" alt="Agregar Usuario">
                    Nuevo Usuario
                </button>
            </a>
        </div>

        <div class="Tabla_Alumnos">
            <table border=1 width="700">
                <tr>
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
                        <td><?php echo $reg['nombre']; ?></td>
                        <td><?php echo $reg['apellido']; ?></td>
                        <td><?php echo $reg['usuario']; ?></td>
                        <td>
                            <button class="BotonContrasena" onclick="confirmarReseteo('<?php echo $reg['nombre']; ?>', '<?php echo BASE_URL ?>modules/usuarios/resetear_contrasena_usuario.php?id_usuario=<?php echo $reg['id_usuario']; ?>');">
                                <img src="<?php echo BASE_URL ?>assets/icons/contrasena.png" alt="Resetear Contraseña">
                            </button>
                        </td>
                        <td><?php echo $reg['descripcion']; ?></td>
                        <td>
                            <a href="<?php echo BASE_URL ?>modules/usuarios/modificar_usuario.php?id_usuario=<?php echo $reg['id_usuario']; ?>">
                                <button class="BotonModificar">
                                    <img src="<?php echo BASE_URL ?>assets/icons/editar.png" alt="Modificar Usuario">
                                </button>
                            </a>
                        </td>
                        <td>
                            <a href="<?php echo BASE_URL ?>modules/usuarios/bajaUsuario.php?id_usuario=<?php echo $reg['id_usuario']; ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar a este usuario?');">
                                <button class="BotonEliminar">
                                    <img src="<?php echo BASE_URL ?>assets/icons/basura.png" alt="Eliminar Usuario">
                                </button>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>

            <div class="paginacion">
                <?php if ($pagina_actual > 1): ?>
                    <a href="listadoUsuario.php?pagina_actual=<?php echo $pagina_actual - 1; ?>">Anterior</a>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
                    <?php if ($i == $pagina_actual): ?>
                        <strong><?php echo $i; ?></strong>
                    <?php else: ?>
                        <a href="listadoUsuario.php?pagina_actual=<?php echo $i; ?>"><?php echo $i; ?></a>
                    <?php endif; ?>
                <?php endfor; ?>

                <?php if ($pagina_actual < $total_paginas): ?>
                    <a href="listadoUsuario.php?pagina_actual=<?php echo $pagina_actual + 1; ?>">Siguiente</a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php include(ROOT_PATH . 'includes/footer.php'); ?>

    <!-- Modal de confirmación personalizado -->
    <div id="confirmModal" class="modal">
        <div class="modal-content">
            <span class="close-button" onclick="closeModal();">&times;</span>
            <p id="modal-message"></p>
            <div class="modal-buttons">
                <button id="confirm-btn" class="confirm-btn">Confirmar</button>
                <button class="cancel-btn" onclick="closeModal();">Cancelar</button>
            </div>
        </div>
    </div>

    <!-- JavaScript para hacer desaparecer el mensaje de éxito o error -->
    <script type="text/javascript">
        // Desaparecer el mensaje después de 5 segundos
        setTimeout(function() {
            var alertMessage = document.getElementById('alert-message');
            if (alertMessage) {
                alertMessage.style.transition = "opacity 1s ease";
                alertMessage.style.opacity = 0;
                setTimeout(function() {
                    alertMessage.style.display = 'none';
                }, 1000); // El mensaje se ocultará completamente después de que se desvanezca
            }
        }, 5000); // El mensaje comenzará a desvanecerse después de 5 segundos

        function confirmarReseteo(nombreUsuario, resetUrl) {
            document.getElementById('modal-message').textContent = '¿Estás seguro de que deseas resetear la contraseña del usuario "' + nombreUsuario + '"?';
            document.getElementById('confirmModal').style.display = 'block';

            document.getElementById('confirm-btn').onclick = function() {
                window.location.href = resetUrl;
            };
        }

        function closeModal() {
            document.getElementById('confirmModal').style.display = 'none';
        }
    </script>
</body>
</html>
