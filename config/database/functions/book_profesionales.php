<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
require_once(ROOT_PATH . 'config/database/connect.php');


function cargarBookProfesional($idProfesional, $fotos) {

    global $connect;
    
    foreach ($fotos['tmp_name'] as $key => $tmp_name) {
        $nombre_imagen = $fotos['name'][$key];
        $ruta = "carpeta_book/" . $nombre_imagen;
        move_uploaded_file($tmp_name, $ruta);

    
        $sql = "INSERT INTO book_profesionales (rela_profesionales, fotos_book) VALUES ('$idProfesional', '$ruta')";
        if ($conexion->query($sql) !== TRUE) {
            echo "Error al cargar la imagen: " . $connect->error;
            return false;
        }
    }

    $connect->close();
    return true;
}

function consultarBookProfesional($idProfesional) {

    global $connect;

    $sql = "SELECT * FROM book_profesionales WHERE rela_profesionales = $idProfesional";
    $resultado = $connect->query($sql);

    $bookProfesional = array();
    if ($resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            $bookProfesional[] = $fila;
        }
    }

    $connect->close();
    return $bookProfesional;
}


function actualizarFotoProfesional($idProfesional, $idFoto, $nuevaRutaFoto) {
    
    global $connect;

    $sql = "UPDATE book_profesionales SET fotos_book = '$nuevaRutaFoto' WHERE rela_profesionales = '$idProfesional' AND id_book_profesionales = '$idFoto'";
    if ($connect->query($sql) !== TRUE) {
        echo "Error al actualizar la foto: " . $connect->error;
        return false;
    }

    $connect->close();
    return true;
}


function eliminarFotoProfesional($idProfesional, $idFoto) {
    
    global $connect;

    $sql = "DELETE FROM book_profesionales WHERE rela_profesionales = '$idProfesional' AND id_book_profesionales = '$idFoto'";
    if ($connect->query($sql) !== TRUE) {
        echo "Error al eliminar la foto: " . $connect->error;
        return false;
    }

    $connect->close();
    return true;
}


function obtenerBookFotos() {
	global $connect;

	$sql = "SELECT * FROM book_profesionales";
	$datosBookProfesionales = $connect->query($sql);
	return $datosBookProfesionales;
}


function obtenerProfesionalesPorIdPersona($id_profesionales) {
	global $connect;
	
	$sql = "SELECT *
        FROM book_profesionales
        INNER JOIN profesionales ON profesionales.id_profesionales = book_profesionales.rela_profesionales
        LEFT JOIN personas ON personas.id_persona = profesionales.rela_personas
        WHERE book_profesionales.rela_profesionales = $id_profesionales;";

	$datosFotosProfesionales = $connect->query($sql);

	return $datosFotosProfesionales;
}

?>
