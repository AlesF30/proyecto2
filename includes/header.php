<?php
// include('../config/path.php');

require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');

session_start();
if (!isset($_SESSION['usuario'])) {
    header('location:' . BASE_URL . 'modules/login/login.php');
}
include (ROOT_PATH . 'config/database/connect.php');
?>


<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Menu de Inicio</title>
	<meta name="author" content= "Fernandez Soledad Alejandra">
	<meta name="description" content="Menu de Inicio">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/estilo.css">
	<link rel="icon" href="<?php echo BASE_URL; ?>assets/icons/B3.png">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
	<div id="agrupar">
		<header id="cabecera">
			<div class="logo">
				<img src="<?php echo BASE_URL; ?>assets/img/logo_login.png"/>
			</div>
			<h1>&iexcl;Bienvenido a Book Management!</h1>
		</header>