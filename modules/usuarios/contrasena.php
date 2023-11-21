<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
require_once ('../../config/database/connect.php');
include(ROOT_PATH .'includes\header.php');
include(ROOT_PATH .'includes\nav.php');
include (ROOT_PATH .'config\db_functions.php');


    // Obtener el correo electrónico del formulario
    $correo = $_POST['correo'];

    // Verificar si el correo existe en la base de datos
    $sql = "SELECT * FROM usuarios WHERE correo = '$correo'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Generar nueva contraseña aleatoria
        $nueva_contrasena = generarContrasenaAleatoria();

        // Actualizar la contraseña en la base de datos
        $hashed_password = password_hash($nueva_contrasena, PASSWORD_DEFAULT);
        $sql_update = "UPDATE usuarios SET contrasena = '$hashed_password' WHERE correo = '$correo'";
        if ($conn->query($sql_update) === TRUE) {
            // Envío de correo con la nueva contraseña (debes implementar esta funcionalidad)
            enviarCorreoContrasena($correo, $nueva_contrasena);

            echo "La contraseña ha sido reseteada y enviada al correo electrónico.";
        } else {
            echo "Error al resetear la contraseña: " . $conn->error;
        }
    } else {
        echo "El correo electrónico no está registrado en la base de datos.";
    }

    $conn->close();
}

// Función para generar una contraseña aleatoria
function generarContrasenaAleatoria() {
    $longitud = 10;
    $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    return substr(str_shuffle($caracteres), 0, $longitud);
}

function enviarCorreoContrasena($correo, $nueva_contrasena) {
    // Datos del servidor SMTP (reemplaza con los datos de tu servidor)
    $smtpHost = 'tu_servidor_smtp'; // Ejemplo: smtp.tudominio.com
    $smtpUsuario = 'usuario_smtp';
    $smtpClave = 'clave_smtp';
    $smtpPuerto = 587; // Puerto SMTP (generalmente 587 para TLS o 465 para SSL)

    // Configuración para enviar correo vía SMTP
    $smtpConfig = [
        'smtp' => [
            'host' => $smtpHost,
            'username' => $smtpUsuario,
            'password' => $smtpClave,
            'port' => $smtpPuerto,
            'encryption' => 'tls', // O 'ssl' si usas el puerto 465
        ],
    ];

    // Contenido del correo
    $asunto = "Nueva Contraseña";
    $mensaje = "Tu nueva contraseña es: $nueva_contrasena";

    // Cabeceras del correo
    $headers = [
        'From' => 'tu_correo@dominio.com',
        'Reply-To' => 'tu_correo@dominio.com',
        'X-Mailer' => 'PHP/' . phpversion(),
        'Content-type' => 'text/html; charset=utf-8'
    ];

    // Configuración adicional (opcional)
    ini_set('SMTP', $smtpHost);
    ini_set('smtp_port', $smtpPuerto);
    ini_set('sendmail_from', 'tu_correo@dominio.com');

    // Envío de correo usando la función mail() de PHP
    if (mail($correo, $asunto, $mensaje, $headers)) {
        echo "El correo ha sido enviado correctamente.";
    } else {
        echo "Error al enviar el correo.";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Resetear Contraseña</title>
</head>
<body>
    <h2>Resetear Contraseña</h2>
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <label for="correo">Correo electrónico:</label>
        <input type="email" name="correo" required>
        <input type="submit" value="Resetear Contraseña">
    </form>
</body>
</html>
