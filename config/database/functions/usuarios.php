<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');


require_once (ROOT_PATH.'config/database/connect.php');


//usuario
function obtenerUsuario($id_usuario){
    global $connect;

	$sql="SELECT * FROM sistbook.usuarios where id_usuario=$id_usuario;";

	$s = $connect->prepare($sql);

    $s->execute();

    $records = $s->get_result()->fetch_all(MYSQLI_ASSOC);

    $s->close();

	return $records;
}

function registrarUsuario($id_persona, $id_perfil, $usuario, $password){
    global $connect;

    $sql = "INSERT INTO sistbook.usuarios (`rela_persona`, `rela_perfil`, `usuario`, `contrasena`, fecha_alta, `activo`)
    VALUES ('$id_persona', '$id_perfil', '$usuario', '$password', NOW(), 1);";

    $s=$connect->prepare($sql);

    $s->execute();

    $s->close();

}

//Listado

function obtenerDatoUsuario(){
    global $connect;

	$sql="SELECT * FROM sistbook.usuarios
    inner join perfil on id_perfil=rela_perfil
    inner join personas on id_persona=rela_persona WHERE usuarios.activo=1;";

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
    
	$sql="UPDATE `sistbook`.`usuarios` SET `rela_perfil` = '$id_perfil',
        `usuario` = '$usuario' WHERE (`id_usuario` = '$id_usuario');";


	$s = $connect->prepare($sql);

    $s->execute();

    $s->close();
}


function obtenerPass($id_usuario){
    global $connect;

	$sql="SELECT usuario, contrasena FROM sistbook.usuarios where id_usuario=$id_usuario;";

	$s = $connect->prepare($sql);

    $s->execute();

    $records = $s->get_result()->fetch_all(MYSQLI_ASSOC);

    $s->close();

	return $records;
}