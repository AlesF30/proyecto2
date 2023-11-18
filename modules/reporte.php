
<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');

include(ROOT_PATH .'config\database\functions\cursos.php');

$records = reporteCursos();

$recordsCriterio = criterioCursos();


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/estiloreporte.css">
    <title>Informe de Cursos Más Solicitados</title>
</head>
<body>
    <div class="containerReporte">
        <header>
            <div class="logo">
                <img src="<?php echo BASE_URL; ?>assets/img/logo_login.png"/>
            </div>
            <h1>Reporte de Cursos con m&aacutes Inscripciones</h1>
        </header>

        <div class="contenedorCriterio">
            <h2>CRITERIOS DE BUSQUEDA:</h2>
            
            Fecha Actual:
            
            <?php foreach ($recordsCriterio as $reg): ?>
                <?php echo $reg['FechaActual'] ?></td>    
            <?php endforeach ?>

            <br>
            Cantidad de Inscripciones:
                

            <?php foreach ($recordsCriterio as $reg): ?>
                <?php echo $reg['CantidadInscripciones'] ?></td>
            <?php endforeach ?>
        
        </div>

        <br>

        <table>
            <tr>
                <th>Nivel</th>
                <th>Modalidad</th>
                <th>Periodo</th>
                <th>Estado Curso</th>
                <th>Fecha de Inicio</th>
                <th>Fecha de Fin</th>
                <th>Nombre de Curso</th>
                <th>Precio</th>
                <th>Duraci&oacuten</th>
                <th>Resultado</th>
            </tr>

            <?php foreach ($records as $reg): ?>
            <tr>
                <td><?php echo $reg['nivel'] ?></td>
                <td><?php echo $reg['modalidad'] ?></td>
                <td><?php echo $reg['periodo'] ?></td>
                <td><?php echo $reg['estado_descripcion'] ?></td>
                <td><?php echo $reg['cursos_fecha_inicio'] ?></td>
                <td><?php echo $reg['cursos_fecha_fin'] ?></td>
                <td><?php echo $reg['cursos_nombre'] ?></td>
                <td><?php echo $reg['cursos_precio'] ?></td>
                <td><?php echo $reg['valor'] ?>
                <?php echo $reg['descripcion_duracion'] ?></td>
                <td><?php echo $reg['CantidadInscripciones'] ?></td>
            </tr>
            
            <?php endforeach ?>
        
        </table>
    </div>


</body>
</html>