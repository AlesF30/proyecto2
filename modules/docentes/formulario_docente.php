<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include(ROOT_PATH .'includes\header.php');
include(ROOT_PATH .'includes\nav.php');
include (ROOT_PATH .'config/database/functions/personas.php');
include (ROOT_PATH .'config\db_functions.php');


$records=selectall('tipo_documento');


?>
<body>

    <a href="..\clientes\listadoClientes.php" class="boton-volver">
		Volver
	</a>

    <section class="cont-formularioAlumno">
            <div class="formularioA">
                <form action="procesarDocente.php" method="POST">
                    <fieldset>
                        <legend>Datos personales del Docente</legend>
                        
                        <br>
                
                                <label for="nombre">Nombre:</label>
                                <input type="text" name="nombre"/><br />
                            
                                <br>

                                <label for="apellido">Apellido:</label>
                                <input type="text" name="apellido" /><br />

                                <br>

                                <label for="fecha de nacimiento">Fecha de Nacimiento:</label>
                                <input type="date" name="FechaNac" /><br>


                    
                                <br>
                            
                                <label for="tipodoc">Tipo documento</label>
                                <select name="tipodoc" id="tipodoc">
                                    <?php foreach ($records as $reg): ?>
                                    <option value="<?php echo $reg['id_tipo_documento'] ?>">
                                    <?php echo $reg['descripcion'] ?>
                                    </option>
                                    <?php endforeach ?>
                                </select>

                                
                                <br><br>
                                
                                <label for="documento">Documento:</label>
                                <input type="text" name="documento"/><br>

                                <br>
                                
                                <input type="submit" name="Enviar">

                </form>
    </section>
</body>
</html>