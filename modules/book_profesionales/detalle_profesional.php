<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include(ROOT_PATH . 'includes/header.php');
include(ROOT_PATH . 'includes/nav.php');
include(ROOT_PATH . 'config/database/functions/book_profesionales.php');
include(ROOT_PATH . 'config/database/functions/personas.php');


if (!isset($_GET['id'])) {
    echo "Error: No se recibió el ID del profesional.";
    exit;
}
$id_profesional = intval($_GET['id']);

// Obtener detalles del profesional
$sql = "SELECT p.profesionales_descripcion
        FROM profesionales p
        WHERE p.id_profesionales = $id_profesional";
$result = $connect->query($sql);
$profesional = $result->fetch_assoc();

if (!$profesional) {
    echo "Error: Profesional no encontrado.";
    exit;
}

// Obtener las fotos del profesional
$sql = "SELECT fotos_book FROM book_profesionales WHERE rela_profesionales = $id_profesional";
$result = $connect->query($sql);
$fotos = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle del Profesional</title>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">

</head>
<body>

<!-- <h3>Detalles del Profesional</h3>
<p><?php echo ($profesional['profesionales_descripcion']); ?></p> -->


<div class="swiper-container">
    <div class="swiper-wrapper">
        <?php foreach ($fotos as $foto): ?>
            <div class="swiper-slide">
                <img src="<?php echo BASE_URL . $foto['fotos_book']; ?>" alt="Foto del profesional">
            </div>
        <?php endforeach; ?>
    </div>
    <div class="swiper-pagination"></div>
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
</div>

<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script>
    var swiper = new Swiper('.swiper-container', {
        slidesPerView: 1,
        spaceBetween: 10,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });
</script>

</body>
</html>
