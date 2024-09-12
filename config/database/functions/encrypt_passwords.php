<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
require_once(ROOT_PATH . 'config/database/connect.php');

function encriptarTodasLasContrasenas() {
    global $connect;

    // Seleccionar todas las contraseñas
    $sql = "SELECT id_usuario, contrasena FROM usuarios";
    $resultado = $connect->query($sql);

    if ($resultado->num_rows > 0) {
        // Iterar sobre cada usuario
        while ($fila = $resultado->fetch_assoc()) {
            $id_usuario = $fila['id_usuario'];
            $password_plain = $fila['contrasena'];

            // Verificar si la contraseña necesita ser encriptada
            if (password_needs_rehash($password_plain, PASSWORD_DEFAULT)) {
                // Encriptar la contraseña
                $password_hashed = password_hash($password_plain, PASSWORD_DEFAULT);

                // Actualizar la base de datos con la contraseña encriptada
                $stmt = $connect->prepare("UPDATE usuarios SET contrasena = ? WHERE id_usuario = ?");
                $stmt->bind_param('si', $password_hashed, $id_usuario);

                if (!$stmt->execute()) {
                    echo "Error al actualizar la contraseña para el usuario con ID $id_usuario: " . $stmt->error . "\n";
                }

                $stmt->close();
            }
        }
        echo "Todas las contraseñas han sido encriptadas correctamente.\n";
    } else {
        echo "No se encontraron usuarios.\n";
    }
}

// Ejecutar la función para encriptar todas las contraseñas
encriptarTodasLasContrasenas();

?>
