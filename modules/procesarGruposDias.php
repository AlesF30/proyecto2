<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include(ROOT_PATH .'config/database/functions/cursos.php');
include(ROOT_PATH .'config/db_functions.php');

global $connect;

// Verificar si se ha enviado el formulario y si los datos esperados están presentes
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedCourse = filter_input(INPUT_POST, 'cursos', FILTER_VALIDATE_INT);

    if ($selectedCourse && isset($_POST["confirmar"])) {
        // Preparar la consulta SQL para insertar los datos
        $sql = "INSERT INTO grupos_dias (rela_grupo, rela_dias, rela_cursos, horario_inicio, horario_fin) VALUES (?, ?, ?, ?, ?)";
        $stmt = $connect->prepare($sql);

        // Recorrer los datos enviados y verificar cada combinación grupo/día
        foreach ($_POST as $key => $value) {
            if (strpos($key, 'inicio_') === 0) {
                // Extraer el grupo y el día desde la clave del campo
                preg_match('/inicio_(\d+)_(\d+)/', $key, $matches);
                $groupId = $matches[1];
                $dayId = $matches[2];

                // Obtener los valores correspondientes
                $horario_inicio = filter_input(INPUT_POST, "inicio_{$groupId}_{$dayId}", FILTER_SANITIZE_STRING);
                $horario_fin = filter_input(INPUT_POST, "fin_{$groupId}_{$dayId}", FILTER_SANITIZE_STRING);

                // Validar que los horarios no estén vacíos
                if ($horario_inicio && $horario_fin) {
                    // Vincular los parámetros y ejecutar la consulta
                    $stmt->bind_param("iiiss", $groupId, $dayId, $selectedCourse, $horario_inicio, $horario_fin);
                    $stmt->execute();
                }
            }
        }

        // Cerrar la declaración
        $stmt->close();

        // Redirigir a una página de éxito
        header('Location: cursos\listadoCursos.php?success=1');
        exit();
    } else {
        // En caso de error, redirigir al formulario con un mensaje de error
        header('Location: formularioTresPasos.php?error=missing_data');
        exit();
    }
} else {
    // Si no se accede a través de un método POST, redirigir a la página del formulario
    header("Location: formularioTresPasos.php");
    exit();
}
?>
