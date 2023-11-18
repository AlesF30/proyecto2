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
                    <a>Agencia</a>
                </li>
                <li class="indicador-item">
                    <a>Clientes</a>
                </li>
                <li class="indicador-item">
                    <a href="listadoContratos.php" title="Listado de Contratos">Listado de Contratos</a>
                </li>
            </ul>
        </div>
<div class="conteiner">
    <div class="contenedor-boton">
        <a href="formularioContrato.php">
            <button class= "boton_agregar">
                <img src="<?php echo BASE_URL?>assets/icons/mas.png" alt="">
                Nuevo Contrato
            </button>
        </a>
    </div>
    

    <div class="Tabla_Alumnos">
        <table border=1 width="700">

            <tr>
                <th>Datos del Cliente</th>
                <th>Nombre Empresa</th>
                <th>Categoria // Tipo del Evento</th>
                <th>Fecha Alta</th>
                <th>Precio</th>
                <th>Duracion</th>
                <th>Estado Evento // Contrato</th>
                <th>Modificar</th>
            </tr>

            <?php while($registro = $datos->fetch_assoc()) { ?>

                <tr>
                    <td><?php echo $registro['nombre'] ?>
                    <?php echo $registro['apellido'] ?></td>
                    <td><?php echo $registro['nombre_empresa'] ?></td>

                    <td><?php echo $registro['categoria_descripcion'] ?> -
                    <?php echo $registro['tipo_descripcion'] ?></td>
                    
                    <td><?php echo $registro['contrato_fecha_alta'] ?></td>
                    <td><?php echo $registro['contrato_precio'] ?></td>

                    <td><?php echo $registro['valor'] ?>
                    <?php echo $registro['descripcion'] ?></td>
                    
                    <td><?php echo $registro['descripcion_estado'] ?> -                 
                    <?php echo $registro['contrato_estado'] ?></td>
                    <td>
                        <a href="<?php echo BASE_URL?>modules\contratos\modificarContrato.php?id_contrato=<?php echo $registro['id_contrato'] ?>">
                            <button class="BotonModificar">
                                <img src="<?php echo BASE_URL?>assets/icons/editar.png" alt="">        
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