<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include(ROOT_PATH . 'config/database/functions/book_profesionales.php');


if ($connect->connect_error) {
    die("Conexión fallida: " . $connect->connect_error);
}

$id_profesionales = $_POST['id_profesionales'];

echo $id_profesionales;
die;

$fotos = $_FILES['fotos'];

foreach ($fotos['tmp_name'] as $key => $tmp_name) {
    $nombre_imagen = $fotos['name'][$key];
    $ruta = "carpeta_destino/" . $nombre_imagen;

    $sql = "INSERT INTO book_profesionales (rela_profesionales, fotos_book) VALUES ('$id_profesionales', '$ruta')";
    if ($connect->query($sql) === TRUE) {
        echo "Imagen cargada correctamente.";
    } else {
        echo "Error al cargar la imagen: " . $connect->error;
    }
}

$connect->close();

?>
