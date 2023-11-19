<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include(ROOT_PATH . 'config\database\functions\usuarios.php');

$id_usuario     = htmlspecialchars($_POST['id_usuario']);
$records     = obtenerPass($id_usuario);


foreach($records as $reg){
    $passwordActual = $reg['contrasena'];
    $usernameActual = $reg['usuario'];
}
$nuevoUsername     = htmlspecialchars($_POST['nuevoUsuario']);
$password    = $_POST['contrasenaActual'];


if(!empty(trim($id_usuario)) &&
    !empty(trim($nuevoUsername)) &&
    !empty(trim($password))){

        if($password === $passwordActual){

            if($nuevoUsername !== $usernameActual){
                $confirmacion = cambioDeUsuario($id_usuario, $nuevoUsername);
                if($confirmacion === true){
                    header('Location:' . BASE_URL . 'modules\usuarios\misDatos.php?mensaje=CAMBIO EXITOSO');
                }
            }
        }

}else{
    header('Location:' . BASE_URL . 'modules\usuarios\cambioUsuario.php?mensaje=ERROR, PRUEBE CON OTRO USUARIO');;
}