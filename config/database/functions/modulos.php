<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');


require_once (ROOT_PATH.'config/database/connect.php');


//MODULOS

function obtenerModulos($pagina_actual = 1, $items_per_page = 4) {
    global $connect;

    $offset = ($pagina_actual - 1) * $items_per_page;

    $sql = "SELECT * FROM sistbook.modulos
            ORDER BY id_modulos
            LIMIT ?, ?;";

    $s = $connect->prepare($sql);
    $s->bind_param("ii", $offset, $items_per_page);
    $s->execute();

    $records = $s->get_result()->fetch_all(MYSQLI_ASSOC);

    $s->close();

    return $records;
}

function obtenerTotalModulos() {
    global $connect;

    $sql = "SELECT COUNT(*) as total FROM sistbook.modulos;";
    $result = $connect->query($sql);
    $row = $result->fetch_assoc();

    return $row['total'];
}


// ALTA MODULOS

function alta_modulos($modulos){
    global $connect;

    $sql="INSERT INTO `sistbook`.`modulos` (`descripcion`) VALUES ('$modulos');";

    $s=$connect->prepare($sql);

    $s->execute();

    $s->close();

}


//BAJA MODULOS

function baja_modulos($id_modulos){
    global $connect;

    $sql="DELETE FROM `sistbook`.`modulos` WHERE (`id_modulos` = '$id_modulos');";

	$s = $connect->prepare($sql);

    $s->execute();

    $s->close();

}

//MODIFICAR MODULOS

function modificar_modulos($id_modulos, $descripcion){
    global $connect;
    
	$sql="UPDATE `sistbook`.`modulos` SET `descripcion` = '$descripcion'
        WHERE (`id_modulos` = '$id_modulos');";


	$s = $connect->prepare($sql);

    $s->execute();

    $s->close();
}


function asignarModulos($id_perfil, $id_modulo) {
    global $connect;
    
    $sql = "INSERT INTO perfiles_modulos (`rela_perfil`, `rela_modulos` , `activo`) "
         . "VALUES (?, ?, '1');";
    
    $s = $connect->prepare($sql);
    $s->bind_param("ii", $id_perfil, $id_modulo);
    
    if ($s->execute()) {
        $s->close();
        return true;
    } else {
        $s->close();
        return false;
    }
}

function obtenerModulosNoAsignados($id_perfil) {
    global $connect;

    $sql = "SELECT * FROM sistbook.modulos WHERE id_modulos NOT IN (
                SELECT rela_modulos FROM sistbook.perfiles_modulos WHERE rela_perfil = ? AND activo = 1
            );";

    $s = $connect->prepare($sql);
    $s->bind_param("i", $id_perfil);
    $s->execute();

    $records = $s->get_result()->fetch_all(MYSQLI_ASSOC);

    $s->close();

    return $records;
}


function consultarPerfilModulo($id_perfil) {
    global $connect;

    $sql = "SELECT m.id_modulos, m.descripcion as valor
            FROM modulos m
            INNER JOIN perfiles_modulos pm ON pm.rela_modulos = m.id_modulos
            WHERE pm.rela_perfil = ? AND pm.activo = 1";
    
    $s = $connect->prepare($sql);
    $s->bind_param("i", $id_perfil);
    $s->execute();
    
    $records = $s->get_result()->fetch_all(MYSQLI_ASSOC);
    $s->close();
    
    return $records;
}

function countTotalModulosAsignados($id_perfil) {
    global $connect;

    $sql = "SELECT COUNT(*) as total FROM perfiles_modulos WHERE rela_perfil = ? AND activo = 1;";
    $s = $connect->prepare($sql);
    $s->bind_param("i", $id_perfil);
    $s->execute();

    $result = $s->get_result();
    $row = $result->fetch_assoc();

    return $row['total'];
}

function obtenerTodosLosModulos() {
    global $connect;

    $sql = "SELECT * FROM sistbook.modulos";
    $result = $connect->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}
