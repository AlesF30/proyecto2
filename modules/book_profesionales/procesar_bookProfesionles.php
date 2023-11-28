<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include(ROOT_PATH . 'config/database/functions/book_profesionales.php');

if (!isset($_POST['id_profesionales'])) {
    echo "Error: No se recibió el ID de profesionales.";
    exit;
}

$id_profesionales = $_POST['id_profesionales'];
$fotos = $_FILES['fotos'];

if ($connect->connect_error) {
    die("Conexión fallida: " . $connect->connect_error);
}

foreach ($fotos['tmp_name'] as $key => $tmp_name) {
    $nombre_imagen = $fotos['name'][$key];
    $ruta = "carpeta_destino/" . $nombre_imagen;

    $sql = "INSERT INTO book_profesionales (rela_profesionales, fotos_book) VALUES ('$id_profesionales', '$ruta')";
    if ($connect->query($sql) !== TRUE) {
        echo '<div class="mensaje-error">Ha ocurrido un error al cargar las imágenes.</div>';
    }
}

$connect->close();

header("location: formularioBook_profesionales.php?id_profesionales=$id_profesionales&modulo=profesionales");

?>


