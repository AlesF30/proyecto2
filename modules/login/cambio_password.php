<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include ('../../config/database/connect.php');

$error_msg = '';
$success_msg = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'];
    $contrasena_actual = $_POST['contrasena_actual'];
    $nueva_contrasena = $_POST['nueva_contrasena'];
    $verificar_contrasena = $_POST['verificar_contrasena'];

    // Validación para las contraseñas
    if (empty($contrasena_actual) || empty($nueva_contrasena) || empty($verificar_contrasena)) {
        $error_msg = "Todos los campos son obligatorios.";
    } elseif ($nueva_contrasena !== $verificar_contrasena) {
        $error_msg = "La nueva contraseña y la verificación de la contraseña no coinciden.";
    } elseif ($contrasena_actual === $nueva_contrasena) {
        $error_msg = "La nueva contraseña no puede ser igual a la contraseña actual.";
    } else {
        // Verifica la contraseña actual utilizando password_verify
        $sql = "SELECT contrasena FROM sistbook.usuarios WHERE usuario = ?";
        $stmt = $connect->prepare($sql);
        $stmt->bind_param('s', $usuario);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $reg = $result->fetch_assoc();
            if (!password_verify($contrasena_actual, $reg['contrasena'])) {
                $error_msg = "La contraseña actual es incorrecta.";
            } else {
                // Encriptar la nueva contraseña
                $nueva_contrasena_hashed = password_hash($nueva_contrasena, PASSWORD_DEFAULT);

                // Actualizar la contraseña en la base de datos
                $sql = "UPDATE sistbook.usuarios SET contrasena = ? WHERE usuario = ?";
                $stmt = $connect->prepare($sql);
                $stmt->bind_param('ss', $nueva_contrasena_hashed, $usuario);

                if ($stmt->execute()) {
                    $success_msg = "Contraseña actualizada con éxito.";
                    header('location:' . BASE_URL . 'modules/login/login.php?message=contraseña_actualizada');
                    exit();
                } else {
                    $error_msg = "Error al actualizar la contraseña: " . $connect->error;
                }
            }
        } else {
            $error_msg = "Error: Usuario no encontrado.";
        }

        $stmt->close();
    }
}

$usuario = $_GET['user'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cambiar Contraseña</title>
    <meta name="author" content="Fernandez Soledad Alejandra">
    <meta name="description" content="Cambio de contraseña">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/estiloslogin.css">
    <link rel="icon" href="<?php echo BASE_URL; ?>assets/icons/B3.png">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
    <div>
        <form action="" method="post">
            <fieldset>
                <img src="../../assets/img/logo_login.png" class="imagen-login">
                <h1><legend>Cambiar Contraseña</legend></h1>
                <input type="hidden" name="usuario" value="<?php echo htmlspecialchars($usuario); ?>">
                <label for="current_password">
                    <img src="<?php echo BASE_URL; ?>assets/icons/candado.png">Contraseña Actual:
                    <input
                        type="password"
                        id="current_password"
                        name="contrasena_actual"
                        placeholder="Contraseña Actual"
                    />
                </label>
                <label for="new_password">
                    <img src="<?php echo BASE_URL; ?>assets/icons/candado.png">Nueva Contraseña:
                    <input
                        type="password"
                        id="new_password"
                        name="nueva_contrasena"
                        placeholder="Nueva Contraseña"
                    />
                </label>
                <label for="verify_password">
                    <img src="<?php echo BASE_URL; ?>assets/icons/candado.png">Verificar Nueva Contraseña:
                    <input
                        type="password"
                        id="verify_password"
                        name="verificar_contrasena"
                        placeholder="Verificar Nueva Contraseña"
                    />
                </label>
            </fieldset>
            <button type="submit">Actualizar Contraseña</button>
        </form>
        <?php if ($error_msg) { ?>
            <span class='errormsj'>
                <img src="<?php echo BASE_URL; ?>assets/icons/alerta.png"> <?php echo $error_msg; ?>
            </span>
        <?php } ?>
        <?php if ($success_msg) { ?>
            <span class='successmsj'>
                <img src="<?php echo BASE_URL; ?>assets/icons/check.png"> <?php echo $success_msg; ?>
            </span>
        <?php } ?>
    </div>
</body>
</html>
