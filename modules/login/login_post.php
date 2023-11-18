<?php
include ('../../config/database/connect.php');
require_once('../../config/path.php');

$user=$_POST['usuario'];
$pass=$_POST['contrasena'];

$sql="SELECT usuario FROM sistbook.usuarios where usuario = '{$user}';";
//$sql= "SELECT usuario FROM usuarios where usuario like '{$user}';";

$datos_user = $connect->query($sql);
if ($datos_user->num_rows == 1){
    $sql="SELECT perfil.id_perfil, perfil.descripcion, usuarios.id_usuario, usuarios.usuario, usuarios.contrasena, personas.nombre, personas.apellido
    FROM perfil 
    INNER JOIN usuarios ON perfil.id_perfil = usuarios.rela_perfil
    INNER JOIN personas ON usuarios.rela_persona = personas.id_persona
    where usuarios.usuario = '{$user}' and usuarios.contrasena = '{$pass}';";
    $datos_pass=$connect->query($sql);
    if($datos_pass->num_rows ==1){

        while ($reg = $datos_pass->fetch_assoc()) {
            $id_perfil=$reg['id_perfil'];
            $id_usuario=$reg['id_usuario'];
            $usuario=$reg['usuario'];
            $perfil=$reg['descripcion']; 
            $nombre=$reg['nombre'];
            $apellido=$reg['apellido'];           
        }
        session_start();
        $_SESSION['id_perfil']= $id_perfil;
        $_SESSION['id_usuario']=$id_usuario;
        $_SESSION['usuario']= $usuario;
        $_SESSION['descripcion']= $perfil;
        $_SESSION['nombre'] = $nombre;
        $_SESSION['apellido'] = $apellido;
        
        header('location:'. BASE_URL . 'modules/dashboard/dashboard.php');
        
    }else{
        header('location:'. BASE_URL . 'modules/login/login.php?error=2');
        
    }
}else{
    header('location:'. BASE_URL . 'modules/login/login.php?error=1');
    
}

?>