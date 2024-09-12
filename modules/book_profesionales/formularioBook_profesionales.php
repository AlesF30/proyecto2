<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include(ROOT_PATH .'includes\header.php');
include(ROOT_PATH .'includes\nav.php');
include (ROOT_PATH .'config/database/functions/book_profesionales.php');
include (ROOT_PATH .'config\db_functions.php');


if (!isset($_GET['id_profesionales'])) {
	echo "error, ingresaste por el lugar equivocado";
 	exit;
}

if (!isset($_GET['modulo'])) {
 	echo "error, enlace incorrecto";
 	exit;
}

$id_profesionales = $_GET['id_profesionales'];
$modulo = $_GET['modulo'];

if ($modulo == "alumnos") {
	$linkVolver = "../alumnos/opcionesAlumno.php";
} elseif ($modulo == "clientes") {
	$linkVolver = "../clientes/listadoClientes.php";
} else if ($modulo == "profesionales") {
	$linkVolver = "..\profesionales\opcionesProfesionales.php";
} else if ($modulo == "docentes") {
	$linkVolver = "../docentes/listadoDocente.php";
}


$datosBookProfesionales = obtenerBookFotos();
$datosFotosProfesionales = obtenerProfesionalesPorIdPersona($id_profesionales);

?>


<body>

<a href="<?php echo $linkVolver ?>" class="boton-volver">
    Volver
</a>

    <title>Formulario de Carga de Book para Profesionales</title>
    <link rel="stylesheet" href="estilos.css">
        
	<section class="container">
		<div class="formulario">
            <h2>Agregar Foto/s al Book</h2>
            <form action="procesar_bookProfesionles.php" method="post" enctype="multipart/form-data">

                <input type="hidden" name="id_profesionales" value="<?php echo $id_profesionales; ?>">
				<input type="hidden" name="modulo" value="<?php echo $modulo; ?>">


                <input type="hidden" name="id_profesionales" value="<?php echo $id_profesionales; ?>">

                <label for="fotos">Seleccione las fotos para cargar:</label>
                <input type="file" id="fotos" name="fotos[]" multiple accept="image/*" required><br><br>

                <input type="submit" value="Guardar" name="submit">
            </form>
        </div>
    	
        <div class="tablaMaestra">
            <table border=1 >
                <tr>
                    <th>Ruta</th>
                    <th>Borrar</th>
                </tr>

                <?php foreach ($datosFotosProfesionales as $reg) : ?>
                    <tr>
                        <td><?php echo $reg['fotos_book'] ?></td>
                        <td>
                            <a href="..\book_profesionales\eliminar_bookFotos.php?id_book_profesionales=<?php echo $reg['id_book_profesionales'] ?>">    
                                <button class="Boton_eliminar">
                                    <img src="<?php echo BASE_URL?>assets/icons/basura.png" alt="">
                                    
                                </button>
                            </a>
                        </td>
                    </tr>
                <?php endforeach ?>

            </table>
        </div>
    </section>

</body>


<?php
include(ROOT_PATH . 'includes/footer.php');
?>


</html>

