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
            <img src="<?php echo BASE_URL; ?>assets/icons/cerrar-sesion.png">
            <a href="<?php echo BASE_URL; ?>modules/login/logout.php">Cerrar Sesión</a>
        </li>
    </ul>
</nav>
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