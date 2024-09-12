<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include('../../config/database/connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_usuario = $_POST['id_usuario'];

    // Encriptar la contraseña por defecto "123"
    $contrasena_default = password_hash('123', PASSWORD_DEFAULT);

    // Actualizar la contraseña en la base de datos del usuario objetivo
    $sql = "UPDATE sistbook.usuarios SET contrasena = ? WHERE id_usuario = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param('si', $contrasena_default, $id_usuario);

    if ($stmt->execute()) {
        // Redirigir con mensaje de éxito
        header('Location: ' . BASE_URL . 'modules/usuarios/listadoUsuario.php?message=success');
        exit();
    } else {
        // Redirigir con mensaje de error
        header('Location: ' . BASE_URL . 'modules/usuarios/listadoUsuario.php?message=error');
        exit();
    }
    $stmt->close();
}

//ID del usuario que la contraseña sera reseteada
$id_usuario = $_GET['id_usuario'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resetear Contraseña</title>
    <meta name="author" content="Fernandez Soledad Alejandra">
    <meta name="description" content="Resetear la contraseña de un usuario">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/estilos_reset.css">
    <link rel="icon" href="<?php echo BASE_URL; ?>assets/icons/B3.png">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
    <div class="reset-container">
        <form action="" method="post">
            <fieldset>
                <img src="../../assets/img/logo_login.png" class="imagen-login">
                <h1><legend>Resetear Contrase&ntilde;a</legend></h1>
                <input type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>">
            </fieldset>
            <button type="submit">Resetear Contrase&ntilde;a</button>
        </form>
    </div>
</body>
</html>
