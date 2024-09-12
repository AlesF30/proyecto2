<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include(ROOT_PATH . 'config/database/functions/book_profesionales.php');

// Verifica la conexión
if ($connect->connect_error) {
    die("Conexión fallida: " . $connect->connect_error);
}

// Validaciones iniciales
if (!isset($_POST['id_profesionales']) || !isset($_FILES['fotos'])) {
    echo '<div class="mensaje-error">Error: Datos incompletos.</div>';
    exit;
}

$id_profesionales = $_POST['id_profesionales'];
$fotos = $_FILES['fotos'];

// Configuración de validaciones
$allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif']; // Tipos de imágenes permitidos
$maxFileSize = 5 * 1024 * 1024; // Tamaño máximo del archivo: 5MB
//$uploadDirectory = $_SERVER['DOCUMENT_ROOT'] . '/proyecto/uploads/bookFotosProfesionales/' . $id_profesionales . '/';
$uploadDirectory = 'uploads/bookFotosProfesionales/' . $id_profesionales . '/';

// Verifica si la carpeta existe y créala si no existe
if (!file_exists($uploadDirectory)) {
    mkdir($uploadDirectory, 0777, true);
}

// Array para almacenar mensajes de error y éxito
$messages = [];

foreach ($fotos['tmp_name'] as $key => $tmp_name) {
    $fileName = basename($fotos['name'][$key]);
    $fileTmpName = $fotos['tmp_name'][$key];
    $fileSize = $fotos['size'][$key];
    $fileError = $fotos['error'][$key];
    $fileType = $fotos['type'][$key];
    $filePath = $uploadDirectory . $fileName;

    // Validación del archivo
    if ($fileError === UPLOAD_ERR_OK) {
        // Verifica el tamaño del archivo
        if ($fileSize > $maxFileSize) {
            $messages[] = "El archivo '$fileName' excede el tamaño máximo permitido de 5MB.";
            continue;
        }

        // Verifica el tipo MIME del archivo
        if (!in_array($fileType, $allowedMimeTypes)) {
            $messages[] = "El archivo '$fileName' no es un tipo de imagen válido.";
            continue;
        }

        // Mueve el archivo subido a la carpeta correspondiente
        if (move_uploaded_file($fileTmpName, $filePath)) {
            // Inserta la información en la base de datos
            $sql = "INSERT INTO book_profesionales (rela_profesionales, fotos_book) VALUES ('$id_profesionales', '$filePath')";
            if ($connect->query($sql) !== TRUE) {
                $messages[] = "Error al insertar la ruta del archivo '$fileName' en la base de datos.";
            } else {
                $messages[] = "Archivo '$fileName' subido y registrado correctamente.";
            }
        } else {
            $messages[] = "Error al mover el archivo '$fileName'.";
        }
    } else {
        $messages[] = "Error al subir el archivo '$fileName': " . $fileError;
    }
}

$connect->close();

// Muestra los mensajes de error y éxito
foreach ($messages as $message) {
    echo "<div class='mensaje'>" . ($message) . "</div>";
}

// Redirige a la página de formulario con los parámetros necesarios
header("Location: formularioBook_profesionales.php?id_profesionales=$id_profesionales&modulo=profesionales");
exit;

?>



