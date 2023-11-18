<?php 
    require_once('bd_functions.php');

    $paises          = consultarPaises();
    $tiposDomicilios = consultarTiposDomicilios();
    $tiposAtributos  = consultarTiposAtributos();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="author" content="Prof. Manuel Díaz">
        <meta name="description" content="Gestión Básica de Domicilios">
        <title> Domicilios </title>
        <style>
            body {
                background-color: #385499;
                font-family: arial;
                text-align: center;
            }
            
            h1 {
                color: white;
            }

            div.contenedor {
                margin: auto;
                padding: 25px;
                background-color: white;
                width: 90%;
                min-height: 500px;
            }

            fieldset {
                text-align: left;
                color: #385499;
                margin: 15px;
                font-style: italic;
            }

            fieldset div.contenedor-form label {
                margin: 5px;
                padding: 10px;
                display: inline-block;
                width: 20%;
                text-align: right;
                font-weight: bold;
                font-style: italic;
            }

            fieldset div.contenedor-form select {
                width: 30%;
                padding: 7px;
            }

            fieldset button {
                padding: 7px;
                border-radius: 50%;
            }

            table {
                margin: auto;
                width: 50%;
                text-align: center;
                border-collapse: collapse;
            }

            table,
            table tr,
            table tr th,
            table tr td {
                border: 1px solid #DDDDDD;
            }

            table th {
                background-color: #DDDDDD;
                color:#525252;
            }

            table th,
            table td {
                padding: 5px;
            }

            button {
                background-color:#385499;
                padding: 15px;
                color: white;
                border-color: #385499;
                font-weight: bold;
                cursor: pointer; 
            }

            button:hover {
                background-color: #5c7bc7;
            }

            button.eliminar {
                background-color: #cd3333;
                border-color: #cd3333;
            }

            button.eliminar:hover {
                background-color: #e75757;
            }
        </style>
    </head>
    <body>
        <h1> Gesti&oacute;n de Domicilios </h1>
        
        <div class="contenedor">
            <form action="confirmacion.php" method="post">
                <input type="hidden" name="id_persona" value="<?php echo $id_persona = 1; ?>">

                <fieldset>
                    <legend>Localizaci&oacute;n</legend>

                    <div class="contenedor-form">                   
                        <label for="pais"> Pa&iacute;s </label>
                        <select id="pais" name="pais">
                            <option value="0"> - Seleccionar Opci&oacute;n - </option>

                            <?php foreach ($paises as $pais) { ?>
                                <option value="<?php echo $pais['id_pais']; ?>"> <?php echo $pais['descripcion']; ?> </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="contenedor-form">                   
                        <label for="provincia"> Provincia </label>
                        <select id="provincia" name="provincia">
                            <option value="0"> - Seleccionar Opci&oacute;n- </option>
                        </select>
                    </div>

                    <div class="contenedor-form">                   
                        <label for="localidad"> Localidad </label>
                        <select id="localidad" name="localidad">
                            <option value="0"> - Seleccionar Opci&oacute;n- </option>
                        </select>
                    </div>

                    <div class="contenedor-form">                   
                        <label for="barrio"> Barrio </label>
                        <select id="barrio" name="barrio">
                            <option value="0"> - Seleccionar Opci&oacute;n- </option>
                        </select>
                    </div>
                </fieldset>

                <fieldset>
                    <legend> Atributos del Domicilio </legend>

                    <table id="atributosDomicilios">
                        <thead>
                            <tr>
                                <th>
                                    Atributo
                                </th>
                                <th>
                                    Valor
                                </th>
                                <th>
                                </th>
                            </tr>
                            <tr>
                                <th>
                                    <select id="tipoAtributo" name="tipoAtributo">
                                        <option value="0"> - Seleccionar Opci&oacute;n - </option>
   
                                        <?php foreach ($tiposAtributos as $atributo) { ?>
                                            <option value="<?php echo $atributo['id_tipoAtributo']; ?>"> <?php echo $atributo['descripcion']; ?> </option>
                                        <?php } ?>
                                    </select>
                                </th>
                                <th>
                                    <input type="text" id="valorAtributo" name="valorAtributo">
                                </th>
                                <th>
                                    <button type="button" title="Agregar" onclick="agregarAtributo()"> + </button>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </fieldset>

                <fieldset>
                    <legend> Otros Datos </legend>

                    <div class="contenedor-form">                   
                        <label for="tipoDomicilio"> Tipo de Domicilio </label>
                        <select id="tipoDomicilio" name="tipoDomicilio">
                            <option value="0"> - Seleccionar Opci&oacute;n- </option>

                            <?php foreach ($tiposDomicilios as $tipoDomicilio) { ?>
                                <option value="<?php echo $tipoDomicilio['id_tipoDomicilio']; ?>"> <?php echo $tipoDomicilio['descripcion']; ?> </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="contenedor-form">                   
                        <label for="observaciones"> Observaciones </label>
            
                        <textarea id="observaciones" name="observaciones" rows="1" cols="30"></textarea>
                    </div>
                </fieldset>

                <button type="submit"> Confirmar Domicilio </button>
            </form>
        </div>

    </body>

    <script>
        function agregarAtributo() {
            let tipoAtributo  = document.getElementById('tipoAtributo');
            let valorAtributo = document.getElementById('valorAtributo');

            let tipoAtributo_val  = tipoAtributo.value;
            let valorAtributo_val = valorAtributo.value;

            /* Se obtiene la descripcion en texto de la opcion seleccionada */
            let tipoAtributo_desc = tipoAtributo.options[tipoAtributo.selectedIndex].text;

            /* Se crea la fila nueva */
            let fila = document.createElement('tr');
            fila.innerHTML = '<tr></tr>';

            /* Se crean inputs ocultos para guardar los valores seleccionados */
            let input_tipoAtributo = document.createElement('input');
            input_tipoAtributo.setAttribute('type', 'hidden');
            input_tipoAtributo.setAttribute('name', 'atributosSeleccionados[]');
            input_tipoAtributo.setAttribute('value', tipoAtributo_val);

            let input_valorAtributo = document.createElement('input');
            input_valorAtributo.setAttribute('type', 'hidden');
            input_valorAtributo.setAttribute('name', 'valoresIngresados[]');
            input_valorAtributo.setAttribute('value', valorAtributo_val);

            /* Se crean las celdas */
            let celda_tipoAtributo = document.createElement('td');
            celda_tipoAtributo.innerHTML = tipoAtributo_desc;
            celda_tipoAtributo.appendChild(input_tipoAtributo);
            fila.appendChild(celda_tipoAtributo);

            let celda_valorAtributo = document.createElement('td');
            celda_valorAtributo.innerHTML = valorAtributo_val;
            celda_valorAtributo.appendChild(input_valorAtributo);
            fila.appendChild(celda_valorAtributo);

            let celda_boton = document.createElement('td');
            celda_boton.innerHTML = '<button type="button" class="eliminar" onclick="eliminarAtributo(this)" title="Eliminar"> X </button>';
            fila.appendChild(celda_boton);

            /* Se identifica la tabla  y le asigno la fila creada */
            let tabla = document.getElementById('atributosDomicilios');
            tabla.tBodies[0].appendChild(fila);

            /* Se resetean el combo y la caja  de texto */
            tipoAtributo.value  = 0;
            valorAtributo.value = "";
        }

        function eliminarAtributo(boton) {
            let fila = boton.parentNode.parentNode;

            let tabla = document.getElementById('atributosDomicilios');
            tabla.tBodies[0].removeChild(fila);
        }
    </script>
</html>