<?php
$id_perfil = $_SESSION['id_perfil'];

function search($array, $key, $value)
{
    $results = array();
    foreach ($array as $item) {
        if (isset($item[$key]) && $item[$key] == $value) {
            $results[] = $item;
        }
    }
    return $results;
}

$sql = "SELECT perfil.id_perfil, perfil.descripcion, modulos.id_modulos, modulos.descripcion as m_descripcion, nivel, orden, padre, ruta
        FROM perfil 
        INNER JOIN perfiles_modulos ON perfil.id_perfil = perfiles_modulos.rela_perfil
        INNER JOIN modulos ON perfiles_modulos.rela_modulos = modulos.id_modulos 
        WHERE perfil.id_perfil = $id_perfil 
        ORDER BY nivel ASC, orden ASC";

$menues = $connect->query($sql);

$menu_levels = array();

foreach ($menues as $menu) {
    $menu_levels[$menu['nivel']][] = $menu;
}
?>

<style>
        /* Estilos para el modal */
.modal {
    display: none; /* Ocultar modal por defecto */
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0,0,0,0.4);
}

.modal-content {
    background-color: #fefefe;
    margin: 10% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
    max-width: 600px;
}

.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}

    </style>

<nav>
    <ul class="menu-horizontal">
        <?php foreach ($menu_levels[1] as $menu1) : ?>
            <li>
                <a href="<?php echo BASE_URL . $menu1['ruta'] ?>">
                    <?php echo $menu1['m_descripcion'] ?>
                </a>
                <?php if (isset($menu_levels[2])) : ?>
                    <ul class="menu-vertical">
                        <?php foreach (search($menu_levels[2], 'padre', $menu1['id_modulos']) as $menu2) : ?>
                            <li>
                                <a href="<?php echo BASE_URL . $menu2['ruta'] ?>">
                                    <?php echo $menu2['m_descripcion'] ?>
                                </a>
                                <?php if (isset($menu_levels[3])) : ?>
                                    <ul class="menu-tercer-nivel">
                                        <?php foreach (search($menu_levels[3], 'padre', $menu2['id_modulos']) as $menu3) : ?>
                                            <li>
                                                <a href="<?php echo BASE_URL . $menu3['ruta'] ?>">
                                                    <?php echo $menu3['m_descripcion'] ?>
                                                </a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
        <li>
            <a href="#" id="miUsuarioBtn">Mi Usuario</a>
        </li>
        <li>
            <img src="<?php echo BASE_URL; ?>assets/icons/cerrar-sesion.png">
            <a href="<?php echo BASE_URL; ?>modules/login/logout.php">Cerrar Sesión</a>
        </li>
    </ul>
</nav>

<div id="miUsuarioModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Mi Usuario</h2>
        <p>Nombre: <?php echo $_SESSION['nombre'] ?></p>
        <br>
        <p>Apellido: <?php echo $_SESSION['apellido'] ?></p>
        <br>
        <p>Nombre de Usuario:<?php echo $_SESSION['usuario']?></p>
        <br>
        <p>Perfil: <?php echo $_SESSION['descripcion'] ?></p>
        <br>
        <a href="..\usuarios\misDatos.php">
            <button class= "boton" id="misDatos">Actualizar mis datos</button>
        </a>
    </div>
</div>

<script>
    // Obtener el modal y el botón de abrir modal
var modal = document.getElementById('miUsuarioModal');
var btn = document.getElementById('miUsuarioBtn');
var span = document.getElementsByClassName('close')[0];
//var cambiarPassBtn = document.getElementById('cambiarPassBtn');

// Abrir modal al hacer clic en el botón "Mi Usuario"
btn.onclick = function() {
    modal.style.display = "block";
}

// Cerrar modal al hacer clic en la X
span.onclick = function() {
    modal.style.display = "none";
}

// Cerrar modal al hacer clic fuera del contenido del modal
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

// Acción al hacer clic en "Cambiar Contraseña"
//cambiarPassBtn.onclick = function() {
    // Aquí puedes implementar la lógica para cambiar la contraseña
//    alert('Implementa aquí la lógica para cambiar la contraseña');
//}
</script>

		<!-- <ul>
			<li><a href="">Inicio</a></li>
				<li><a href="">Agencia</a>
					<ul>
						<li><a href="">Eventos</a></li>
			  			<li><a href="">Profesionales</a></li>
					</ul>
				</li>
				<li><a href="">Academia</a>
					<ul>
						<li><a href="">Cursos</a></li>
			  			<li><a href="">Docentes</a></li>
			  			<li><a href="">Alumnos</a></li>
					</ul>
				</li>
				<li><a href="">Nuestros Trabajos</a></li>
				<li><a href="">Quienes Somos</a></li>
				<li><a href="">Contacto</a></li>

			</ul> -->