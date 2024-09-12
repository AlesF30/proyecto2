<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include(ROOT_PATH . 'includes\header.php');
include(ROOT_PATH . 'includes\nav.php');
include(ROOT_PATH . 'config/db_functions.php');

// Función para obtener todos los registros de duracion_dias
$records = selectall('duracion_dias');

// Verificar si hay un parámetro de eliminación exitosa en la URL
$mensaje = '';
if (isset($_GET['eliminacion']) && $_GET['eliminacion'] == 'exitosa') {
    $mensaje = '<p style="color: green;">El registro ha sido eliminado exitosamente.</p>';
}

// Aquí comienza tu código HTML/PHP existente
?>
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
                <a>Gesti&oacute;n de Agencia</a>
            </li>
            <li class="indicador-item">
                <a href="formularioDuracionDias.php" title="Formulario Duracion Dias">Formulario Duraci&oacuten</a>
            </li>
        </ul>
    </div>
    <div class="container">
        <form action="procesarDuracionDias.php" method="post">
            <fieldset>
                <legend>NUEVA DURACI&Oacute;N - EVENTOS </legend>
                <label for="duracion_dias">Duracion:</label>
                <input type="text" name="nueva_duracionDias">
            </fieldset>
            <button class="boton">Guardar</button>
            <!-- <input type="submit" value="Guardar"> -->
        </form>
    </div>
    <div class="tablaMaestra">
        <?php echo $mensaje; // Mostrar el mensaje de eliminación exitosa si existe ?>
        <table border="1">
            <tr>
                <th>#</th>
                <th>Duracion</th>
                <th>Borrar</th>
            </tr>
            <?php foreach ($records as $reg) : ?>
                <tr>
                    <td><?php echo $reg['id_duracion_dias'] ?></td>
                    <td><?php echo $reg['descripcion'] ?></td>
                    <td>
                        <button class="Boton_eliminar" onclick="confirmarEliminacion(<?php echo $reg['id_duracion_dias'] ?>)">
                            <img src="<?php echo BASE_URL ?>assets/icons/basura.png" alt="">
                        </button>
                    </td>
                </tr>
            <?php endforeach ?>
        </table>
    </div>
</section>

<?php
include(ROOT_PATH . 'includes\footer.php');
?>

<script>
    function confirmarEliminacion(id) {
        if (confirm('¿Estás seguro que quieres eliminar este registro?')) {
            window.location.href = 'eliminarDuracionDias.php?id_duracion_dias=' + id;
        }
    }
</script>
