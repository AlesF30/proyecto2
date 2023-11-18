  	</head>
  	<body>
		<?php 
			//Se crea una funcion utilizada para identificar menues padres e hijos
			//Utilizar funciones permite ahorrar codigo
			function search($array, $key, $value) {

				$results   =   array();
				if (is_array($array)) {
					if (isset($array[$key]) && $array[$key] == $value) {
						$results[]   =   $array;
					}
					foreach ($array as $subarray) {
						$results   =   array_merge($results, search($subarray, $key, $value));
					}
				}
				return $results;
			}

			//Se setean arrays de cada nivel de menu
            $menu_nivel1   =   array();
            $menu_nivel2   =   array(); 

			$sql= "SELECT perfil.descripcion, modulos.id_modulos, modulos.descripcion as m_descripcion, nivel, orden, padre, ruta
			FROM perfil INNER JOIN perfiles_modulos ON perfil.id_perfil = perfiles_modulos.rela_perfil
			INNER JOIN modulos ON perfiles_modulos.id_perfiles_modulo = modulos.id_modulos WHERE perfil.id_perfil = perfil.id_perfil order by nivel asc, orden asc;";
			
			$menues = $connect->query($sql);

			foreach ($menues as $menu) {
				switch ($menu['nivel']) {
					case "1":
						$menu_nivel1[$menu['id_modulos']]   =   $menu;
						break;
					case "2":
						$menu_nivel2[$menu['id_modulos']]   =   $menu;
						break;
				}
			}

			//En caso de no tener ordenados los menues por nivel y orden, se deben ordenar antes de imprimir
			//Para ordenar arrays multidimensionales en php, se utiliza las siguientes funciones:
			// * array_column: permite obtener una columna especifica de un array
			// * array_multisort: 
				//Como primer parámetro se le pasa la columna de nivel, junto con la forma de ordenacion ascendente
				//Como segundo parámetro se le pasa la columna de orden, junto con la forma de ordenacion ascendente
				//Por ultimo se incorpora el array o vector a ordenar
			//
			//ACLARACION: es recomendable que los menues ya vengan ordenados desde la consulta de bd, utilizando ORDER BY
			//

			array_multisort(array_column($menu_nivel1, 'nivel'),  SORT_ASC,
							array_column($menu_nivel1, 'orden'), SORT_ASC,
							$menu_nivel1);

			array_multisort(array_column($menu_nivel2, 'nivel'),  SORT_ASC,
							array_column($menu_nivel2, 'orden'), SORT_ASC,
							$menu_nivel2);
		?>


		<nav class="horizontal">
			<ul>
				<?php 
					$html   =   "";

					foreach ($menu_nivel1 as $menu1) {
						$temp   =   array();
						$temp   =   search($menu_nivel2, 'padre', $menu1['id_modulos']);   //Busca hijos del nivel 1   

						if (empty($temp)) {   //No se encuentran hijos del nivel 1
							$html   .=   '<li> <a href="' . $menu1['ruta'] . '">' . $menu1['m_descripcion'] . '</a> </li>';
						} else {   //Si se encuentran hijos del nivel 1
							$html   .=   '<li class="dropdown">';
								$html   .=   '<a href="#" class="dropbtn">' . $menu1['m_descripcion'] . '</a>';
								$html   .=   '<div class="dropdown-content">';
									$html   .=   '<ul>';
									foreach ($temp as $menu2) {
										$html   .=   '<li> <a href="' . $menu2['ruta'] . '">' . $menu2['m_descripcion'] . '</a> </li>';
									}
									$html   .=   '</ul>';
									$html 	.= '</li>';
									
								$html   .=   '</div>';
							$html   .=   '</li>';
						}
					} 
					
					echo $html;
				?>
			</ul>
		</nav>

  	</body>
</html>