<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include(ROOT_PATH . 'includes\header.php');
include(ROOT_PATH . 'includes\nav.php');
include(ROOT_PATH . 'config\database\functions\usuarios.php');
include(ROOT_PATH . 'config/db_functions.php');


$recordsDato=obtenerDatoPersonaUsuario();



$records=selectall('perfil');



?>
    <section class="cont-formularioAlumno">
            <div class="formularioA">
                <form action="procesarUsuario.php" method="POST">
                    <fieldset>
                        <legend>Datos del Usuario</legend>
                                

                        
                        <br>
                                <label for="persona">Persona: </label>
                                <select name="persona" id="persona">
                                    <option value="0"> - Seleccione una persona -</option>
                                    <?php foreach ($recordsDato as $reg): ?>
                                    <option value="<?php echo $reg['id_persona'] ?>">
                                    <?php echo $reg['nombre'] ?>
                                    <?php echo $reg['apellido'] ?>
                                    </option>
                                    <?php endforeach ?>
                                </select>

                            

                        </br>


                        <br>
                            
                            <label for="perfil">Perfil</label>
                            <select name="perfil" id="perfil">
                                <?php foreach ($records as $reg): ?>
                                <option value="<?php echo $reg['id_perfil'] ?>">
                                <?php echo $reg['descripcion'] ?>
                                </option>
                                <?php endforeach ?>
                            </select>
                        </br>
                           
                        <br>
                        
                            <label for="usuario">Usuario:</label>
                            <input type="text" name="usuario"/><br />
                        
                            <br>

                            <label for="password">Contrase&ntilde;a:</label>
                            <input type="password" name="password" /><br />

                            <br>
                        
                        <input type="hidden" name="id_persona" value="<?php echo $id_persona ?>">

                            <input type="submit" name="Enviar">

                </form>
    </section>
</body>
</html>