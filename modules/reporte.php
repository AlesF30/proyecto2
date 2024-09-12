<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');

include(ROOT_PATH .'config\database\functions\cursos.php');


session_start();

$_SESSION['usuario'] = array(
    'nombre' => 'Nombre del usuario',
);



if (isset($_SESSION['usuario'])) {
    $usuarioGenerador = $_SESSION['usuario'];
}


$records = reporteCursos();
$recordsCriterio = criterioCursos();

$niveles = obtenerNiveles();

$nivelSeleccionado = isset($_GET['nivel']) ? $_GET['nivel'] : '';

if (!empty($nivelSeleccionado)) {
    $records = obtenerCursosPorNivel($nivelSeleccionado); 
} else {
    // Si no se ha seleccionado un nivel, se obtienen todos los cursos
    $records = reporteCursos();
}

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

            
            <p>Generado por: <?php echo $_SESSION['nombre'] . ' ' . $_SESSION['apellido'] ?></ins></h2></p>
            
            <p>Fecha Actual:
            
            <?php foreach ($recordsCriterio as $reg): ?>
                <?php echo $reg['FechaActual'] ?></td>    
            <?php endforeach ?></p>

            <p>Cantidad de Inscripciones:
                

            <?php foreach ($recordsCriterio as $reg): ?>
                <?php echo $reg['CantidadInscripciones'] ?></td>
            <?php endforeach ?></p>

        </div>

        <br>

        <div class="contenedorFiltro">
            <h2>FILTRO POR NIVEL:</h2>
            <form method="GET" action="<?php echo ($_SERVER["PHP_SELF"]); ?>">
                <select name="nivel">
                    <option value="">Elige un nivel</option>
                    <?php foreach ($niveles as $nivel): ?>
                        <option value="<?php echo $nivel['id_niveles']; ?>"><?php echo $nivel['descripcion']; ?></option>
                    <?php endforeach; ?>
                </select>
                <input type="submit" value="Filtrar">
            </form>

            <button class="botonGenerarReporte" onclick="generarReporte()">
                <img src="<?php echo BASE_URL ?>assets/icons/imprimir.png" alt="Imprimir" class="iconoBoton">
                Generar Reporte
            </button>


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

</div>

    
    <script>
        function generarReporte() {
            window.print();
        }
    </script>

</body>
</html>