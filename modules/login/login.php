<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');

?>

<!DOCTYPE html>
<html lang="es">

	<head>
		<meta charset="UTF-8">
		<title>Login</title>
		<meta name="author" content= "Fernandez Soledad Alejandra">
		<meta name="description" content="Inicio de sesion">
		<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/estiloslogin.css">
		<link rel="icon" href="<?php echo BASE_URL; ?>assets/icons/B3.png">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		
	</head>
	<body>
		<div>
			<form action="<?php echo BASE_URL; ?>modules/login/login_post.php" method="post">
				<fieldset>
					<img src="../../assets/img/logo_login.png" class="imagen-login">
					<h1><legend>Inicia sesi&oacute;n</legend></h1>
					<label for="username">
					<img src="<?php echo BASE_URL; ?>assets/icons/usuario.png">Nombre de usuario:
						<input
							type="text"
							id="username"
							name="usuario"
							placeholder="Usuario"
						/>
					</label>
					<label for="password">
					<img src="<?php echo BASE_URL; ?>assets/icons/candado.png">Contrase&ntilde;a:
						<input
						type="password"
						id="password"
						name="contrasena"
						placeholder="Contrase&ntilde;a"
						/>
					</label>
				</fieldset>
				<button type="submit">Iniciar sesi&oacute;n</button>
				<!-- <p>
					<a href="#">&iquest;Olvido el usuario?</a>
					<a href="#">&iquest;Olvido la contrase&ntilde;a?</a>
				</p> -->
			</form>
			<?php if (isset($_GET['error'])) { ?>
				<?php if ($_GET['error'] == '1') { ?>
					<span class='errormsj'>
					<img src="<?php echo BASE_URL; ?>assets/icons/alerta.png">Error:Usuario no encontrado
					</span>
					<?php } else { ?>
						<span class='errormsj'>
						<img src="<?php echo BASE_URL; ?>assets/icons/alerta.png">Error:Contrase&ntilde;a incorrecta
						</span>
					<?php } ?>
				<?php } ?>
		</div>
	</body>
</html>