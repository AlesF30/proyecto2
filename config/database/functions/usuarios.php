<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');


require_once (ROOT_PATH.'config/database/connect.php');


//usuario

function obtenerUsuario($id_usuario){
    global $connect;

    $sql = "SELECT u.*, p.descripcion as perfil_descripcion
            FROM sistbook.usuarios u
            INNER JOIN perfil p ON u.rela_perfil = p.id_perfil
            WHERE u.id_usuario = ?";

    $stmt = $connect->prepare($sql);
    $stmt->bind_param("i", $id_usuario);
    $stmt->execute();
    $result = $stmt->get_result();
    $usuario = $result->fetch_assoc();
    $stmt->close();

    return $usuario;
}

function registrarUsuario($id_persona, $id_perfil, $usuario, $password){
    global $connect;

    // Hashear la contraseña antes de guardarla
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO sistbook.usuarios (`rela_persona`, `rela_perfil`, `usuario`, `contrasena`, fecha_alta, `activo`)
    VALUES ('$id_persona', '$id_perfil', '$usuario', '$hashed_password', NOW(), 1);";

    $s = $connect->prepare($sql);

    if ($s === false) {
        die("Error en la preparación de la consulta de inserción: " . $connect->error);
    }

    $s->execute();
    $s->close();
}

//Listado


function obtenerDatoUsuario($pagina_actual=0){
    global $connect;

	$sql="SELECT * FROM sistbook.usuarios
    inner join perfil on id_perfil=rela_perfil
    inner join personas on id_persona=rela_persona WHERE usuarios.activo=1 ORDER BY id_usuario limit $pagina_actual,4;";

	$s = $connect->prepare($sql);

    $s->execute();

    $records = $s->get_result()->fetch_all(MYSQLI_ASSOC);

    $s->close();

	return $records;
}



//COMBO PARA SELECCIONAR LA PERSONA

function obtenerDatoPersonaUsuario(){
    global $connect;

	$sql="SELECT DISTINCT * FROM personas WHERE activo = 1 AND id_persona NOT IN (SELECT 
            rela_persona FROM usuarios WHERE rela_persona IN (id_persona));";

	$s = $connect->prepare($sql);

    $s->execute();

    $records = $s->get_result()->fetch_all(MYSQLI_ASSOC);

    $s->close();

	return $records;
}
 
//BAJA USUARIO

function baja_usuario($id_usuario){
    global $connect;

    $sql="UPDATE `sistbook`.`usuarios` SET `activo` = '0' WHERE (`id_usuario` = '$id_usuario');";


	$s = $connect->prepare($sql);

    $s->execute();

    $s->close();

}

//MODIFICAR USUARIO

function modificar_usuario($id_usuario, $id_perfil, $usuario){
    global $connect;

    $sql = "UPDATE `sistbook`.`usuarios` 
            SET `rela_perfil` = ?,
                `usuario` = ?
            WHERE `id_usuario` = ?";

    $stmt = $connect->prepare($sql);
    $stmt->bind_param("isi", $id_perfil, $usuario, $id_usuario);
    $stmt->execute();
    $stmt->close();
}


function obtenerPass($id_usuario) {
    global $connect;

    $stmt = $connect->prepare("SELECT usuario, contrasena FROM usuarios WHERE id_usuario = ?");
    
    // Vincular parámetros
    $stmt->bind_param("i", $id_usuario);
    

    $stmt->execute();

    // Obtener resultados
    $result = $stmt->get_result();

    // Obtener los datos asociados al usuario
    $usuario = $result->fetch_assoc();

    // Cerrar la consulta
    $stmt->close();

    return $usuario;
}



function cambioDeUsuario($id_usuario, $nuevoUsername) {
    global $connect;

    // Preparar la consulta SQL con marcadores de posición (?)
    $sql = "UPDATE usuarios SET usuario = ? WHERE id_usuario = ?";

    // Preparar la declaración
    $stmt = $connect->prepare($sql);

    // Vincular parámetros y verificar la preparación
    if ($stmt && $stmt->bind_param("si", $nuevoUsername, $id_usuario)) {
        // Ejecutar la consulta
        if ($stmt->execute()) {
            // Éxito al cambiar el usuario
            $stmt->close();
            return true;
        } else {
            // Error al ejecutar la consulta
            $stmt->close();
            return false;
        }
    } else {
        // Error al preparar la consulta
        if ($stmt) {
            $stmt->close();
        }
        return false;
    }
}

function cambiarContrasena($id_usuario, $contrasena_actual, $contrasena_nueva, $repetir_contrasena) {
    global $connect;

    // Verificar que la contraseña actual sea correcta
    $sql = "SELECT contrasena FROM usuarios WHERE id_usuario = ?";
    $stmt = $connect->prepare($sql);

    if ($stmt === false) {
        return "Error en la preparación de la consulta: " . $connect->error;
    }
    
    $stmt->bind_param("i", $id_usuario);
    $stmt->execute();
    $stmt->bind_result($hashed_password);
    $stmt->fetch();
    $stmt->close();

    // Para depuración: Mostrar la contraseña obtenida y la contraseña actual introducida
    echo "Contraseña en la base de datos: " . $hashed_password . "<br>";
    echo "Contraseña actual introducida: " . $contrasena_actual . "<br>";

    if (!password_verify($contrasena_actual, $hashed_password)) {
        return "La contraseña actual es incorrecta.";
    }

    if ($contrasena_actual !== $hashed_password) {
        return "La contraseña actual es incorrecta.";
    }
    
    // Verificar que la nueva contraseña no sea igual a la actual
    if ($contrasena_actual === $contrasena_nueva) {
        return "La nueva contraseña no puede ser igual a la actual.";
    }

    // Verificar que las nuevas contraseñas coincidan
    if ($contrasena_nueva !== $repetir_contrasena) {
        return "Las nuevas contraseñas no coinciden.";
    }

    // Encriptar la nueva contraseña
    $hashed_new_password = password_hash($contrasena_nueva, PASSWORD_DEFAULT);

    // Actualizar la contraseña en la base de datos
    $query = "UPDATE usuarios SET contrasena = ? WHERE id_usuario = ?";
    $stmt = $connect->prepare($query);

    if ($stmt === false) {
        return "Error en la preparación de la consulta de actualización: " . $connect->error;
    }

    $stmt->bind_param("si", $hashed_new_password, $id_usuario);
    if ($stmt->execute()) {
        $stmt->close();
        return true;
    } else {
        $stmt->close();
        return "Hubo un problema al actualizar la contraseña.";
    }
}

// paguinacion

function obtenerTotalUsuarios() {
    global $connect;

    $sql = "SELECT COUNT(*) as total FROM sistbook.usuarios WHERE activo = 1";
    $s = $connect->prepare($sql);
    $s->execute();
    $result = $s->get_result();
    $row = $result->fetch_assoc();
    $s->close();

    return $row['total'];
}



?>