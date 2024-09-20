listado alumnos listadoal.php

<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include(ROOT_PATH .'includes/header.php');
include(ROOT_PATH .'includes/nav.php');
include(ROOT_PATH .'config/database/functions/personas.php');

$items_per_page = 4;
$pagina_actual = isset($_GET['pagina_actual']) ? (int)$_GET['pagina_actual'] : 1;
$offset = ($pagina_actual - 1) * $items_per_page;

// Obtener los registros y el total de alumnos
$records = obtenerDatoAlumno($offset, $items_per_page);
$total_alumnos = obtenerTotalAlumno();
$total_paginas = ceil($total_alumnos / $items_per_page);

$datos = obtenerListadoAlumno();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Alumnos</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/estilo.css">
</head>
<body>

    <section>
        <div class="cont-indicador">
            <ul class="indicador">
                <li>
                    <a href="<?php echo BASE_URL?>modules/dashboard/dashboard.php">Inicio</a>
                </li>
                <li class="indicador-item">
                    <a>Gestión de Sistema</a>
                </li>
                <li class="indicador-item">
                    <a href="listadoal.php" title="Listado de Alumnos/as">Listado de Alumnos/as</a>
                </li>
            </ul>
        </div>

        <div class="conteiner">
            <div class="contenedor-boton">
                <a href="formulario_alumno.php">
                    <button class="boton_agregar">
                        <img src="<?php echo BASE_URL?>assets/icons/mas.png" alt="">
                        Nuevo Alumno
                    </button>
                </a>
            </div>
            <div>
                <?php if (isset($_GET['mensaje'])): ?>
                    <div class="mensaje-exito <?php echo $_GET['tipo_mensaje'] === 'success' ? 'success' : 'error'; ?>">
                        <?php echo ($_GET['mensaje']); ?>
                    </div>
                <?php endif; ?>

                <div class="Tabla_Alumnos">
                    <h1>Listado de Alumnos</h1>
                    <table id="miTabla" class="display">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Fecha Nacimiento</th>
                                <th>Información</th>
                                <th>Modificar</th>
                                <th>Borrar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($registro = $datos->fetch_assoc()) { ?>
                                <tr>
                                    <td><?php echo ($registro['nombre']); ?></td>
                                    <td><?php echo ($registro['apellido']); ?></td>
                                    <td><?php echo ($registro['fecha_nacimiento']); ?></td>
                                    <td>
                                        <a href="../alumnos/opcionesAlumno.php?id_persona=<?php echo ($registro['id_persona']); ?>&modulo=alumnos">
                                            <button class="BotonVer">
                                                <img src="<?php echo BASE_URL?>assets/icons/ojo.png" alt="">        
                                            </button>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="<?php echo BASE_URL?>modules/alumnos/modificar_alumno.php?id_persona=<?php echo ($registro['id_persona']); ?>">
                                            <button class="BotonModificar">
                                                <img src="<?php echo BASE_URL?>assets/icons/editar.png" alt="">        
                                            </button>
                                        </a>
                                    </td>
                                    <td>
                                        <button class="BotonEliminar" onclick="openModal('<?php echo ($registro['nombre']); ?>', '<?php echo BASE_URL ?>modules/alumnos/baja_alumno.php?id_persona=<?php echo ($registro['id_persona']); ?>')">
                                            <img src="<?php echo BASE_URL?>assets/icons/basura.png" alt="">        
                                        </button>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <div class="paginacion">
                        <?php if ($pagina_actual > 1): ?>
                            <a href="listadoal.php?pagina_actual=<?php echo $pagina_actual - 1; ?>">Anterior</a>
                        <?php endif; ?>
                        <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
                            <?php if ($i == $pagina_actual): ?>
                                <strong><?php echo $i; ?></strong>
                            <?php else: ?>
                                <a href="listadoal.php?pagina_actual=<?php echo $i; ?>"><?php echo $i; ?></a>
                            <?php endif; ?>
                        <?php endfor; ?>
                        <?php if ($pagina_actual < $total_paginas): ?>
                            <a href="listadoal.php?pagina_actual=<?php echo $pagina_actual + 1; ?>">Siguiente</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal de Confirmación -->
    <div id="confirmModal" class="modal">
        <div class="modal-content">
            <span class="close-button">&times;</span>
            <br>
            <h3 id="modal-message">¿Estás seguro de que deseas eliminar este registro?</h3>
            <div class="modal-buttons">
                <button id="confirm-btn" class="btn-confirm">Sí, eliminar</button>
                <button id="cancel-btn" class="btn-cancel">Cancelar</button>
            </div>
        </div>
    </div>

    <script>
        // Variables para el modal y los botones
        var modal = document.getElementById("confirmModal");
        var confirmBtn = document.getElementById("confirm-btn");
        var cancelBtn = document.getElementById("cancel-btn");
        var closeBtn = document.getElementsByClassName("close-button")[0];
        var modalMessage = document.getElementById("modal-message");
        var currentDeleteUrl = "";

        // Función para abrir el modal con un mensaje y URL de eliminación
        function openModal(nombre, url) {
            modalMessage.textContent = "¿Estás seguro de que deseas eliminar a " + nombre + "?";
            currentDeleteUrl = url;
            modal.style.display = "block";
        }

        // Función para cerrar el modal
        function closeModal() {
            modal.style.display = "none";
        }

        // Evento para el botón de confirmar
        confirmBtn.onclick = function() {
            window.location.href = currentDeleteUrl;
        }

        // Evento para el botón de cancelar
        cancelBtn.onclick = closeModal;

        // Evento para el botón de cerrar (x)
        closeBtn.onclick = closeModal;

        // Cerrar el modal si se hace clic fuera de la ventana modal
        window.onclick = function(event) {
            if (event.target == modal) {
                closeModal();
            }
        }
    </script>

<?php
include(ROOT_PATH . 'includes/footer.php');
?>
</body>
</html>

<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include(ROOT_PATH .'includes/header.php');
include(ROOT_PATH .'includes/nav.php'); 
include(ROOT_PATH .'config/database/functions/personas.php');

$items_per_page = 4;  // Cantidad de alumnos por página
$pagina_actual = isset($_GET['pagina_actual']) ? (int)$_GET['pagina_actual'] : 1;  // Página actual o 1 si no está definida
$offset = ($pagina_actual - 1) * $items_per_page;  // Cálculo del offset

// Obtener los registros y el total de alumnos
$records = obtenerDatoAlumno($offset, $items_per_page);  // Llamada a la función con paginación
$total_alumnos = obtenerTotalAlumno();  // Total de alumnos
$total_paginas = ceil($total_alumnos / $items_per_page);  // Cálculo del total de páginas

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Alumnos</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/estilo.css">
</head>
<body>

    <section>
        <div class="cont-indicador">
            <ul class="indicador">
                <li><a href="<?php echo BASE_URL?>modules/dashboard/dashboard.php">Inicio</a></li>
                <li class="indicador-item"><a>Gestión de Sistema</a></li>
                <li class="indicador-item"><a href="listadoal.php" title="Listado de Alumnos/as">Listado de Alumnos/as</a></li>
            </ul>
        </div>

        <div class="conteiner">
            <div class="contenedor-boton">
                <a href="formulario_alumno.php">
                    <button class="boton_agregar">
                        <img src="<?php echo BASE_URL?>assets/icons/mas.png" alt=""> Nuevo Alumno
                    </button>
                </a>
            </div>
            <div>
                <?php if (isset($_GET['mensaje'])): ?>
                    <div class="mensaje-exito <?php echo $_GET['tipo_mensaje'] === 'success' ? 'success' : 'error'; ?>">
                        <?php echo ($_GET['mensaje']); ?>
                    </div>
                <?php endif; ?>

                <div class="Tabla_Alumnos">
                    <h1>Listado de Alumnos</h1>
                    <table id="miTabla" class="display">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Fecha Nacimiento</th>
                                <th>Información</th>
                                <th>Modificar</th>
                                <th>Borrar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($records as $registro): ?>
                                <tr>
                                    <td><?php echo ($registro['nombre']); ?></td>
                                    <td><?php echo ($registro['apellido']); ?></td>
                                    <td><?php echo ($registro['fecha_nacimiento']); ?></td>
                                    <td>
                                        <a href="../alumnos/opcionesAlumno.php?id_persona=<?php echo ($registro['id_persona']); ?>&modulo=alumnos">
                                            <button class="BotonVer">
                                                <img src="<?php echo BASE_URL?>assets/icons/ojo.png" alt="">
                                            </button>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="<?php echo BASE_URL?>modules/alumnos/modificar_alumno.php?id_persona=<?php echo ($registro['id_persona']); ?>">
                                            <button class="BotonModificar">
                                                <img src="<?php echo BASE_URL?>assets/icons/editar.png" alt="">
                                            </button>
                                        </a>
                                    </td>
                                    <td>
                                        <button class="BotonEliminar" onclick="openModal('<?php echo ($registro['nombre']); ?>', '<?php echo BASE_URL ?>modules/alumnos/baja_alumno.php?id_persona=<?php echo ($registro['id_persona']); ?>')">
                                            <img src="<?php echo BASE_URL?>assets/icons/basura.png" alt="">
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <!-- Paginación -->
                    <div class="paginacion">
                        <?php if ($pagina_actual > 1): ?>
                            <a href="listadoal.php?pagina_actual=<?php echo $pagina_actual - 1; ?>">Anterior</a>
                        <?php endif; ?>
                        <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
                            <?php if ($i == $pagina_actual): ?>
                                <strong><?php echo $i; ?></strong>
                            <?php else: ?>
                                <a href="listadoal.php?pagina_actual=<?php echo $i; ?>"><?php echo $i; ?></a>
                            <?php endif; ?>
                        <?php endfor; ?>
                        <?php if ($pagina_actual < $total_paginas): ?>
                            <a href="listadoal.php?pagina_actual=<?php echo $pagina_actual + 1; ?>">Siguiente</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include(ROOT_PATH . 'includes/footer.php'); ?>
</body>
</html>
