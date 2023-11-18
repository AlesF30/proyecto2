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

            .contenedor {
                margin: auto;
                padding: 25px;
                background-color: white;
                width: 90%;
                min-height: 500px;
            }

            button {
                margin: auto;
                text-align: center;
                padding: 15px;
                background-color: #385499;
                border-color: #385499;
                color: white;
                font-weight: bold;
                cursor: pointer;
            }

            button:hover {
                background-color: #5475c6;
            }

            button.eliminar {
                background-color: #ce4949;
                border-color: #ce4949;
            }

            button.eliminar:hover {
                background-color: #e86666;
            }

            fieldset {
                text-align: left;
                color: #385499;
                font-style: italic;
                margin: 15px;
            }

            fieldset div.contenedor-input label {
                margin: 5px;
                padding: 10px;
                display: inline-block;
                width: 20%;
                text-align: right;
                font-weight: bold;
                font-style: italic;
            }

            fieldset div.contenedor-input select {
                width: 30%;
            }

            fieldset button {
                padding: 7px;
                border-radius: 50%;
            }

            select {
                padding: 7px;
            }


            input[type=text] {
                padding: 7px;
            }

            table {
                margin: auto;
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
                color: #5e5e5e; 
            }

            table th,
            table td {
                padding: 5px;
            }

            table select {
                max-width: 300px;
            }
        </style>
    </head>
    <body>
        <h1 id="titulo"> Gesti&oacute;n de Domicilios </h1>
        
        <div class="contenedor">
            <form action="confirmacion.php" method="post">
                <input type="hidden" id="id_persona" name="id_persona" value=<?php echo $id_persona = 1;   /* PERSONA SELECCIONADA */ ?>>

                <fieldset>
                    <legend>Localizaci&oacute;n:</legend>

                    <div class="contenedor-input">
                        <label for="pais">Pa&iacute;s:</label>
                        
                        <select id="pais" name="pais" onchange="CargarProvincias(this.value)">
                            <option value="0" selected>- Seleccionar Opci&oacute;n -</option>

                            <?php foreach ($paises as $pais) { ?>
                                <option value="<?php echo $pais['id_pais']; ?>"> <?php echo $pais['descripcion'];?> </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="contenedor-input">
                        <label for="provincia">Provincia:</label>
                        
                        <select id="provincia" name="provincia">
                            <option value="0">- Seleccionar Opci&oacute;n -</option>
                        </select>
                    </div>

                    <div class="contenedor-input">
                        <label for="provincia">Localidad:</label>
                        
                        <select id="localidad" name="localidad">
                            <option value="0">- Seleccionar Opci&oacute;n -</option>
                        </select>
                    </div>

                    <div class="contenedor-input">
                        <label for="barrio">Barrio:</label>
                        
                        <select id="barrio" name="barrio">
                            <option value="0">- Seleccionar Opci&oacute;n -</option>
                        </select>
                    </div>
                </fieldset>

                <fieldset>
                    <legend>Atributos del Domicilio:</legend>

                    <table id="atributosDomicilio">
                        <thead>
                            <tr>
                                <th> 
                                    Atributo 
                                </th>
                                <th> 
                                    Valor 
                                </th>
                                <th></th>
                            </tr>
                            <tr>
                                <th>
                                    <select id="tipoAtributo" name="tipoAtributo">
                                        <option value="0">- Seleccionar Opci&oacute;n -</option>

                                        <?php foreach ($tiposAtributos as $tipoAtributo) { ?>
                                            <option value="<?php echo $tipoAtributo['id_tipoAtributo']; ?>"> <?php echo $tipoAtributo['descripcion'];?> </option>
                                        <?php } ?>
                                    </select>
                                </th>
                                <th>
                                    <input type="text" id="valorAtributo" name="valorAtributo">
                                </th>
                                <th>
                                    <button type="button" title="Agregar" onclick="AgregarAtributo();">+</button>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td> prueba </td>
                                <td> prueba </td>
                                <td> prueba </td>
                            </tr>
                        </tbody>
                    </table>
                </fieldset>

                <fieldset>
                    <legend>Otros Datos:</legend>

                    <div class="contenedor-input">
                        <label for="tipoDomicilio">Tipo de Domicilio:</label>
                        
                        <select id="tipoDomicilio" name="tipoDomicilio">
                            <option value="0">- Seleccionar Opci&oacute;n -</option>

                            <?php foreach ($tiposDomicilios as $tipoDomicilio) { ?>
                                <option value="<?php echo $tipoDomicilio['id_tipoDomicilio']; ?>"> <?php echo $tipoDomicilio['descripcion'];?> </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="contenedor-input">
                        <label for="observaciones">Observaciones:</label>
                        
                        <textarea id="observaciones" name="observaciones" rows="1" cols="30"></textarea>
                    </div>
                </fieldset>

                <button type="submit"> Confirmar Domicilio </button>
            </form>
        </div>


        
        <script src="code.jquery.com_jquery-3.7.1.js"> </script>


        <script>
            $(document).ready(function() {
                alert($("#titulo").text());
            });





            function AgregarAtributo() {
                let tipoAtributo  = document.getElementById('tipoAtributo');
                let valorAtributo = document.getElementById('valorAtributo');

                let tipoAtributo_val  = tipoAtributo.value;
                let valorAtributo_val = valorAtributo.value;

                let tipoAtributo_desc = tipoAtributo.options[tipoAtributo.selectedIndex].text;


                //Se crea un input oculto donde voy a guardar el ID del atributo
                let input_tipoAtributo = document.createElement('input');
                input_tipoAtributo.setAttribute('type', 'hidden');
                input_tipoAtributo.setAttribute('name', 'atributosSeleccionados[]');
                input_tipoAtributo.setAttribute('value', tipoAtributo_val);

                //Se crea un input oculto donde voy a guardar el valor del atributo
                let input_valorAtributo = document.createElement('input');
                input_valorAtributo.setAttribute('type','hidden');
                input_valorAtributo.setAttribute('name','valoresIngresados[]');
                input_valorAtributo.setAttribute('value', valorAtributo_val);

                //Se crea la fila nueva
                let fila = document.createElement('tr');
                fila.innerHTML = '<tr></tr>';

                //Se crean las celdas para la fila nueva
                let celda_tipoAtributo       = document.createElement('td');
                celda_tipoAtributo.innerHTML = '<b>' + tipoAtributo_desc + '</b>';
                celda_tipoAtributo.appendChild(input_tipoAtributo);
                fila.appendChild(celda_tipoAtributo);
                
                let celda_valorAtributo       = document.createElement('td');
                celda_valorAtributo.innerHTML = '<b>' + valorAtributo_val + '</b>';
                celda_valorAtributo.appendChild(input_valorAtributo);
                fila.appendChild(celda_valorAtributo);

                let celda_boton       = document.createElement('td'); 
                celda_boton.innerHTML = '<button type="button" class="eliminar" onclick="EliminarAtributo(this)" title="Eliminar"> X </button>';
                fila.appendChild(celda_boton);

                //Se identifica la tabla y le asigno la fila creada anteriormente
                let tabla = document.getElementById('atributosDomicilio');
                tabla.tBodies[0].appendChild(fila);

                //Se resetea el combo y la caja de texto
                tipoAtributo.value = 0;
                valorAtributo.value = ""
            }

            function EliminarAtributo(boton) {
                let fila = boton.parentNode.parentNode;

                let tabla = document.getElementById('atributosDomicilio');
                tabla.tBodies[0].removeChild(fila);
            }

            function CargarProvincias(id_pais) {
                let resultado;
                let datos_provincias;
                let nuevaOpcion;

                if (id_pais != 0) {
                    document.getElementById('provincia').value = "0";

                    //AJAX

                    let xmlhttp;
                    if (window.XMLHttpRequest) {   //code for IE7+, Firefox, Chrome, Opera, Safari
                        xmlhttp = new XMLHttpRequest();
                    } else {   // code for IE6, IE5
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }

                    xmlhttp.onreadystatechange = function () {   //Cuando cambia el estado de la petición
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {   //4 significa que terminó y 200 es la rpta OK del server
                            resultado = xmlhttp.responseText;

                            






                            //ACA MANIPULO LA RESPUESTA DEL SERVIDOR


                            if (resultado != 0) {
                                datos_provincias = JSON.parse(resultado);   //El json en texto plano, se convierte en OBJETO json

                                for (let i=0; i<datos_provincias.length; i++) {           
                                    nuevaOpcion = new Option(datos_provincias[i]['descripcion'], datos_provincias[i]['id_provincia']);
                                    document.getElementById('provincia').add(nuevaOpcion, undefined);
                                }   
                            } else {
                                alert('Sin provincias');
                            }

                            











                        }
                    }

                    xmlhttp.open("POST", "control.php", true);
                    xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');   //Modo en que se envia el dato
                    xmlhttp.send("function=LeerProvincias&id_pais="+id_pais);
                } else {
                    alert('Debe seleccionar el país');
                }
            }
        </script>
    </body>
</html>

