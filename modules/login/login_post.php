<?php
include ('../../config/database/connect.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');

$user = $_POST['usuario'];
$pass = $_POST['contrasena'];

if (empty($user) || empty($pass)) {
    header('location:' . BASE_URL . 'modules/login/login.php?error=1');
    exit;
}

// Consulta para obtener el usuario
$sql = "SELECT perfil.id_perfil, perfil.descripcion, usuarios.id_usuario, usuarios.usuario, usuarios.contrasena, personas.nombre, personas.apellido
        FROM perfil 
        INNER JOIN usuarios ON perfil.id_perfil = usuarios.rela_perfil
        INNER JOIN personas ON usuarios.rela_persona = personas.id_persona
        WHERE usuarios.usuario = ?";
$stmt = $connect->prepare($sql);
$stmt->bind_param('s', $user);
$stmt->execute();
$datos_pass = $stmt->get_result();

if ($datos_pass->num_rows == 1) {
    $reg = $datos_pass->fetch_assoc();

    // Verificar la contraseña usando password_verify
    if (password_verify($pass, $reg['contrasena'])) {
        // Si la contraseña es la predeterminada '123', redirigir para que la cambie
        if ($pass == '123') {
            header('location:' . BASE_URL . 'modules/login/cambio_password.php?user=' . urlencode($user));
            exit();
        }

        session_start();
        $_SESSION['id_perfil'] = $reg['id_perfil'];
        $_SESSION['id_usuario'] = $reg['id_usuario'];
        $_SESSION['usuario'] = $reg['usuario'];
        $_SESSION['descripcion'] = $reg['descripcion'];
        $_SESSION['nombre'] = $reg['nombre'];
        $_SESSION['apellido'] = $reg['apellido'];

        header('location:' . BASE_URL . 'modules/dashboard/dashboard.php');
    } else {
        header('location:' . BASE_URL . 'modules/login/login.php?error=2');
    }
} else {
    header('location:' . BASE_URL . 'modules/login/login.php?error=1');
}
?>
