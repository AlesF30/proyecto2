<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
require_once ('../../config/database/connect.php');
include(ROOT_PATH .'includes\header.php');
include(ROOT_PATH .'includes\nav.php');
include ('../../config/database/functions/personas.php');


$id_contrato = $_GET["id_contrato"];

$success = isset($_GET['success']) ? $_GET['success'] : null;
$error = isset($_GET['error']) ? $_GET['error'] : null;


$datoProfesionales = obtenerProfesionales();
$profesionalesContrato = obtenerProfesionalesPorContrato($id_contrato);


?>


<body>

    <?php if ($error) : ?>
        <div id="mensaje-error" class="mensaje-error">
            <strong>Error:</strong> Por favor selecciona al menos un profesional para el contrato.
        </div>
        <script>
            var mensajeError = document.getElementById('mensaje-error');
            if (mensajeError) {
                // Ocultar mensaje de error después de 3 segundos (ajustable)
                setTimeout(function () {
                    mensajeError.style.display = 'none';
                }, 3000); // Tiempo en milisegundos (en este caso, 3 segundos)
            }

        </script>
        
    <?php elseif ($success) : ?>
        <div id="mensaje-exito" class="mensaje-exito">
            Profesionales asignaados en el contrato.
        </div>
    <?php endif ?>
    <script>
            var mensajeExito = document.getElementById('mensaje-exito');
            if (mensajeExito) {
                // Ocultar mensaje de error después de 3 segundos (ajustable)
                setTimeout(function () {
                    mensajeExito.style.display = 'none';
                }, 3000); // Tiempo en milisegundos (en este caso, 3 segundos)
            }

            document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('enviarBtn').addEventListener('submit', function () {
                // Recargar la página después de enviar el formulario
                setTimeout(function () {
                    window.location.href = 'listadoContrato.php?id_contrato=$id_contrato';
                }, 3000); // Tiempo en milisegundos (en este caso, 3 segundos)
            });
        });

        </script>

    <a href="../contratos/listadoContrato.php" class="boton-volver">
        Volver
    </a>

    <section class="container">
		<div class="formulario">
            <form id="miFormulario" action="procesarContratoProfesionales.php" method="post">
                
                
			    <h1> Asignar Profesionales</h1>

                <h3>Selecciona los profesionales al contrato:</h3>
                
                <select id="profesionaleesSelect" class="miSelect" name="profesionales[]" multiple="multiple">
                
                    
                    <?php while($registro = $datoProfesionales->fetch_assoc()): ?>
                        <option value="<?php echo $registro['id_profesionales'] ?>">
                        <?php echo $registro['nombre'] ?>
                        <?php echo $registro['apellido'] ?>
                        </option>
                        
                    <?php endwhile ?>

                </select>

                <br><br>

                <input type="hidden" name="id_contrato" value="<?php echo $id_contrato ?>">

                <input id="enviarBtn" type="submit" value="Guardar">
            
            </form>

            
			<br><br><br>
            
            <table border=1 width="450">
                <tr>
                    <th>Nombre Profesional</th>
                    <th>Apellido Profesional</th>
                    <th>Detalles del Profesional</th>
                    <th>Fecha Alta</th>
                    <th>Borrar</th>
                </tr>
                
                <?php foreach ($profesionalesContrato as $reg) : ?>
                    <tr>
                        <td><?php echo $reg['nombre'] ?></td>
                        <td><?php echo $reg['apellido'] ?></td>
                        <td><?php echo $reg['profesionales_descripcion'] ?></td>
                        <td><?php echo $reg['contrato_fecha_alta'] ?></td>
                        <td>
                            <a href="eliminarContratorProfesionales.php?id_profesionales_contratos=<?php echo $reg['id_profesionales_contratos'] ?>">
                                <button class="Boton_eliminar">
                                    <img src="<?php echo BASE_URL?>assets/icons/basura.png" alt="">
                                    
                                </button>
                            </a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </table>
        
        </div>
    

        <br><br>
        
    
    </section>
                    
                <?php
                include(ROOT_PATH . 'includes\footer.php');
                ?>

    <script defer>
        $(document).ready(function() {
            $('.miSelect').select2({
                placeholder: '- Seleccionar una opción -',
                allowClear: true
            });
        });

    </script>

</body>
</html>