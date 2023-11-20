<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
require_once ('../../config/database/connect.php');
include(ROOT_PATH .'includes\header.php');
include(ROOT_PATH .'includes\nav.php');
include ('../../config/database/functions/sponsor.php');


$id_eventos = $_GET["id_eventos"];
$success = isset($_GET['success']) ? $_GET['success'] : null;
$error = isset($_GET['error']) ? $_GET['error'] : null;


$datoSponsor = obtenerSponsor();
$sponsors = obtenerSponsorsPorEvento($id_eventos);


?>


<body>

    <?php if ($error) : ?>
        <div id="mensaje-error" class="mensaje-error">
            <strong>Error:</strong> Por favor selecciona al menos un sponsor para el evento.
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
            Los sponsors han sido guardados para el evento.
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
                    window.location.href = 'formularioEventoSponsor.php?id_eventos=$id_eventos';
                }, 3000); // Tiempo en milisegundos (en este caso, 3 segundos)
            });
        });

        </script>

    <a href="../eventos/formularioEventos.php" class="boton-volver">
        Volver
    </a>

    <section class="container">
		<div class="formulario">
            <form id="miFormulario" action="procesarEventoSponsor.php" method="post">
                
                
			    <h1>Multiselect Sponsor</h1>

                <h3>Selecciona los sponsors para el evento:</h3>
                
                <select id="sponsorSelect" class="miSelect" name="sponsors[]" multiple="multiple">
                
                    
                    <?php while($registro = $datoSponsor->fetch_assoc()): ?>
                        <option value="<?php echo $registro['id_sponsor'] ?>">
                        <?php echo $registro['sponsor_nombre'] ?>
                        </option>
                        
                    <?php endwhile ?>

                </select>

                <br><br>

                <input type="hidden" name="id_eventos" value="<?php echo $id_eventos ?>">

                <input id="enviarBtn" type="submit" value="Guardar">
            
            </form>

            
			<br><br><br>
            
            <table border=1 width="450">
                <tr>
                    <th>Categoria Evento</th>
                    <th>Tipo Evento</th>
                    <th>Fecha Alta</th>
                    <th>Nombre Sponsor</th>
                    <th>Borrar</th>
                </tr>
                
                <?php foreach ($sponsors as $reg) : ?>
                    <tr>
                        <td><?php echo $reg['categoria_descripcion'] ?></td>
                        <td><?php echo $reg['tipo_descripcion'] ?></td>
                        <td><?php echo $reg['sponsor_fecha_alta'] ?></td>
                        <td><?php echo $reg['sponsor_nombre'] ?></td>
                        <td>
                            <a href="modificarEventos.php?id_eventos=<?php echo $reg['id_eventos'] ?>">
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