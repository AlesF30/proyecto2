<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
require_once ('../../config/database/connect.php');
include(ROOT_PATH .'includes\header.php');
include(ROOT_PATH .'includes\nav.php');
include ('../../config/database/functions/especialidad.php');


$id_profesionales = $_GET["id_profesionales"];

$success = isset($_GET['success']) ? $_GET['success'] : null;
$error = isset($_GET['error']) ? $_GET['error'] : null;


$datoEspecialidad = obtenerEspecialidad();
$especialidades = obtenerProfesionalPorIdEspecialidad($id_profesionales);


?>


<body>

    <?php if ($error) : ?>
        <div id="mensaje-error" class="mensaje-error">
            <strong>Error:</strong> Por favor selecciona al menos una especialidad.
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
            La especialidad ha sido guardada.
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
                    window.location.href = 'formularioProfesionalesEspecialidad.php?id_profesionales=$id_profesionales';
                }, 3000); // Tiempo en milisegundos (en este caso, 3 segundos)
            });
        });

        </script>

    <a href="../profesionales/listadoProfesionales.php" class="boton-volver">
        Volver
    </a>

    <section class="container">
		<div class="formulario">
            <form id="miFormulario" action="procesarProfesionalesEspecialidad.php" method="post">
                
                
			    <h1>Especialidad:</h1>

                <h3>Selecciona la especialidad del Profesional:</h3>
                
                <select id="especialidadSelect" class="miSelect" name="especialidades[]" multiple="multiple">
                
                    
                    <?php while($registro = $datoEspecialidad->fetch_assoc()): ?>
                        <option value="<?php echo $registro['id_especialidad'] ?>">
                        <?php echo $registro['especialidad_descripcion'] ?>
                        </option>
                        
                    <?php endwhile ?>

                </select>

                <br><br>

                <input type="hidden" name="id_profesionales" value="<?php echo $id_profesionales ?>">

                <input id="enviarBtn" type="submit" value="Guardar">
            
            </form>

            
			<br><br><br>
            
            <table border=1 width="450">
                <tr>
                    <th>Especialidad</th>
                    <th>Borrar</th>
                </tr>
                
                <?php foreach ($especialidades as $reg) : ?>
                    <tr>
                        <td><?php echo $reg['especialidad_descripcion'] ?></td>
                        <td>
                            <a href="eliminarProfesionalesEspecialidad.php?id_profesional_especialidad=<?php echo $reg['id_profesional_especialidad'] ?>">
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