<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
require_once(ROOT_PATH.'config/database/connect.php');

// Función para obtener un perfil
function obtenerPerfil($id_perfil){
    global $connect;
    $sql = "SELECT * FROM sistbook.perfil WHERE id_perfil = ?";
    $s = $connect->prepare($sql);
    $s->bind_param('i', $id_perfil);
    $s->execute();
    $records = $s->get_result()->fetch_all(MYSQLI_ASSOC);
    $s->close();
    return $records;
}

// Función para dar de alta un perfil
function alta_perfil($perfil){
    global $connect;
    $sql = "INSERT INTO sistbook.perfil (descripcion) VALUES (?)";
    $s = $connect->prepare($sql);
    $s->bind_param('s', $perfil);
    $s->execute();
    $s->close();
}

// Función para desactivar un perfil (anteriormente baja_perfil)
function desactivar_perfil($id_perfil){
    global $connect;
    $sql = "UPDATE sistbook.perfiles_modulos SET activo = 0 WHERE rela_perfil = ?";
    $s = $connect->prepare($sql);
    $s->bind_param('i', $id_perfil);
    $s->execute();
    $s->close();
}

// Función para activar un perfil
function activar_perfil($id_perfil){
    global $connect;
    $sql = "UPDATE sistbook.perfiles_modulos SET activo = 1 WHERE rela_perfil = ?";
    $s = $connect->prepare($sql);
    $s->bind_param('i', $id_perfil);
    $s->execute();
    $s->close();
}

// Función para modificar un perfil
function modificar_perfil($id_perfil, $descripcion){
    global $connect;
    $sql = "UPDATE sistbook.perfil SET descripcion = ? WHERE id_perfil = ?";
    $s = $connect->prepare($sql);
    $s->bind_param('si', $descripcion, $id_perfil);
    $s->execute();
    $s->close();
}
?>
