<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include(ROOT_PATH .'includes\header.php');
include(ROOT_PATH .'includes\nav.php');
include(ROOT_PATH .'config\database\functions\contratos.php');

$datos = obtenerListadoContrato();



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
                    <a href="listadoContrato.php" title="Listado de Contratos">Listado de Contratos</a>
                </li>
            </ul>
        </div>
    

    <div class="Tabla_Alumnos">
        <table border=1 width="700">

            <tr>
                <th>Estado del Evento</th>
                <th>Categoria Evento</th>
                <th>Tipo Evento</th>
            </tr>

            <?php while($registro = $datos->fetch_assoc()) { ?>

                <tr>
                    <td><?php echo $registro['evento_estado'] ?></td>
                    <td><?php echo $registro['categoria_descripcion'] ?></td>
                    <td><?php echo $registro['tipo_descripcion'] ?></td>
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