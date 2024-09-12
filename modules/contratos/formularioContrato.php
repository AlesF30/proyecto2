<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
require_once ('../../config/database/connect.php');
include(ROOT_PATH .'includes/header.php');
include(ROOT_PATH .'includes/nav.php');
include (ROOT_PATH .'config/database/functions/contratos.php');
include (ROOT_PATH .'config/db_functions.php');

$recordsDato = selectall('categoria_eventos');
$records = selectall('tipo_evento');
$recordsEvento = selectall('evento_estado');
$recordsContrato = selectall('estado_contrato');
$recordsDuracion = selectall('duracion_dias');
$recordsDatoContrato = obtenerDatoContrato();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Datos del Contrato</title>
</head>
<body>

<a href="../contratos/listadoContrato.php" class="boton-volver">
    Volver
</a>

<section class="cont-formularioAlumno">
    <div class="formularioA">
        <form action="procesarContrato.php" method="POST" onsubmit="return validarFormulario()">
            <fieldset>
                <legend>Datos del Contrato</legend>

                <label for="contrato_fecha_alta">Fecha Alta:</label>
                <input type="date" name="contrato_fecha_alta" required><br><br>

                <label for="duracion_dias">Duración del Evento:</label>
                <select name="duracion_dias" id="duracion_dias" required>
                    <option value="0"> - Seleccione una Opción -</option>
                    <?php foreach ($recordsDuracion as $reg): ?>
                        <option value="<?php echo $reg['id_duracion_dias'] ?>">
                            <?php echo $reg['descripcion'] ?>
                        </option>
                    <?php endforeach ?>
                </select><br><br>

                <label for="valor">Ingresar Cantidad de Días:</label>
                <input type="number" name="valor" required><br><br>

                <label for="contrato_precio">Precio Acordado:</label>
                <input type="number" name="contrato_precio" required><br><br>

                <label for="clientes">Cliente:</label>
                <select name="clientes" id="clientes" required>
                    <option value="0"> - Seleccione un Cliente -</option>
                    <?php foreach ($recordsDatoContrato as $reg): ?>
                        <option value="<?php echo $reg['id_clientes'] ?>">
                            <?php echo $reg['nombre'] . ' ' . $reg['apellido'] . ' - ' . $reg['nombre_empresa'] ?>
                        </option>
                    <?php endforeach ?>
                </select><br><br>

                <label for="categoria_eventos">Categoría:</label>
                <select name="categoria_eventos" id="categoria_eventos" required>
                    <option value="0"> - Seleccione una Categoría -</option>
                    <?php foreach ($recordsDato as $reg): ?>
                        <option value="<?php echo $reg['id_categoria'] ?>">
                            <?php echo $reg['categoria_descripcion'] ?>
                        </option>
                    <?php endforeach ?>
                </select><br><br>

                <label for="tipo_evento">Tipo Evento:</label>
                <select name="tipo_evento" id="tipo_evento" required>
                    <option value="0"> - Seleccione un Tipo -</option>
                    <?php foreach ($records as $reg): ?>
                        <option value="<?php echo $reg['id_tipo'] ?>">
                            <?php echo $reg['tipo_descripcion'] ?>
                        </option>
                    <?php endforeach ?>
                </select><br><br>

                <label for="evento_estado">Estado del Evento:</label>
                <select name="evento_estado" id="evento_estado" required>
                    <option value="0"> - Seleccione un Estado -</option>
                    <?php foreach ($recordsEvento as $reg): ?>
                        <option value="<?php echo $reg['id_evento_estado'] ?>">
                            <?php echo $reg['descripcion_estado'] ?>
                        </option>
                    <?php endforeach ?>
                </select><br><br>

                <label for="estado_contrato">Estado del Contrato:</label>
                <select name="estado_contrato" id="estado_contrato" required>
                    <option value="0"> - Seleccione un Estado -</option>
                    <?php foreach ($recordsContrato as $reg): ?>
                        <option value="<?php echo $reg['id_estado_contrato'] ?>">
                            <?php echo $reg['contrato_estado'] ?>
                        </option>
                    <?php endforeach ?>
                </select><br><br>

                <input type="hidden" name="id_contrato" value="<?php echo $id_contrato ?>">
                <input type="hidden" name="id_eventos" value="<?php echo $id_eventos ?>">

                <input type="submit" name="Enviar" value="Enviar">
            </fieldset>
        </form>

        <!-- Mensaje de alerta -->
        <div id="mensajeAlerta" class="alert">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            <strong>¡Alerta!</strong> Por favor, complete todos los campos correctamente.
        </div>
    </div>
</section>

<script>
function validarFormulario() {
    var fechaAlta = document.querySelector('input[name="contrato_fecha_alta"]').value;
    var duracion = document.getElementById('duracion_dias').value;
    var cantidadDias = document.querySelector('input[name="valor"]').value;
    var precio = document.querySelector('input[name="contrato_precio"]').value;
    var cliente = document.getElementById('clientes').value;
    var categoria = document.getElementById('categoria_eventos').value;
    var tipoEvento = document.getElementById('tipo_evento').value;
    var estadoEvento = document.getElementById('evento_estado').value;
    var estadoContrato = document.getElementById('estado_contrato').value;

    if (fechaAlta === '' || duracion === '0' || cantidadDias === '' || precio === '' || cliente === '0' || categoria === '0' || tipoEvento === '0' || estadoEvento === '0' || estadoContrato === '0') {
        mostrarAlerta();
        return false;
    }

    return true;
}

function mostrarAlerta() {
    var alerta = document.getElementById('mensajeAlerta');
    alerta.style.display = 'block'; // Mostrar el mensaje de alerta
    setTimeout(function() {
        alerta.style.display = 'none'; // Ocultar el mensaje después de 3 segundos
    }, 3000); // 3000 milisegundos = 3 segundos
}
</script>

</body>
</html>
