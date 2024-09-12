<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include(ROOT_PATH . 'includes/header.php');
include(ROOT_PATH . 'includes/nav.php');
include(ROOT_PATH . 'config/database/functions/book_profesionales.php');
include(ROOT_PATH . 'config/database/functions/personas.php');

$profesionales = obtenerListaProfesionales();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrusel de Profesionales</title>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    
</head>
<body>

<div class="swiper-container">
    <div class="swiper-wrapper">
        <?php foreach ($profesionales as $profesional): ?>
            <div class="swiper-slide">
                <img src="<?php echo BASE_URL . ($profesional['fotos_book']); ?>" alt="<?php echo ($profesional['profesionales_descripcion']); ?>" />
                
                <div class="overlay">
                    <h2><?php echo ($profesional['nombre']); ?></h2>
                    <a href="detalle_profesional.php?id=<?php echo ($profesional['id_profesionales']); ?>">
                        <button>Ver Detalle</button>
                    </a>
                </div>
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
