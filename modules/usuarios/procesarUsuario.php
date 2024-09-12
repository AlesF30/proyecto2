<?php
// Incluir el archivo de configuración de rutas
require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');

// Incluir funciones relacionadas con la base de datos y usuarios
include(ROOT_PATH . 'config/database/functions/usuarios.php');

// Verificar que se recibió un formulario POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar los datos del formulario
    $id_persona = $_POST['persona'];
    $id_perfil = $_POST['perfil'];
    $usuario = $_POST['usuario'];
    $password = '123'; // Contraseña por defecto

    // Verificar que los datos necesarios no estén vacíos
    if (!empty($id_persona) && !empty($id_perfil) && !empty($usuario)) {
        // Llamar a la función para registrar el usuario
        registrarUsuario($id_persona, $id_perfil, $usuario, $password);

        // Redirigir a la página de listado de usuarios después del registro
        header('Location: ../usuarios/listadoUsuario.php');
        exit();
    } else {
        // Mostrar un mensaje de error si algún campo está vacío
        echo "Error: Todos los campos son obligatorios. Por favor, complete el formulario correctamente.";
        // Aquí podrías redirigir a otra página o mostrar un mensaje de error específico según tu lógica de aplicación
    }
} else {
    // Manejar el acceso incorrecto al script
    echo "Acceso no autorizado.";
}
?>
