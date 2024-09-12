<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');


require_once (ROOT_PATH.'config/database/connect.php');



// personas

function crear_persona($nombre, $apellido, $FechaNac) {
	global $connect;

	$sql = "INSERT INTO `sistbook`.`personas` (`nombre`, `apellido`, "
		. "`fecha_nacimiento`, `activo`) VALUES ('$nombre', '$apellido', '$FechaNac', '1');";
	
	$connect->query($sql);

	$id_persona = $connect->insert_id;

	return $id_persona;
}



// alumnos

function obtenerDatoAlumno($id_persona){
    global $connect;

	$sql="SELECT * FROM sistbook.personas where id_persona=$id_persona;";

	$s = $connect->prepare($sql);

    $s->execute();

    $records = $s->get_result()->fetch_all(MYSQLI_ASSOC);

    $s->close();

	return $records;
}


function obtenerListadoAlumno(){
    global $connect;

    $sql="SELECT alumnos.id_alumnos, personas.id_persona, personas.nombre, personas.apellido, personas.fecha_nacimiento " 
    	. "FROM alumnos join personas  on personas.id_persona=alumnos.rela_personas where personas.activo=1 ORDER BY id_alumnos ;";

    $datos = $connect->query($sql);

    return $datos;

}

function crear_alumnos($id_persona) {
	global $connect;
	$sql = "INSERT INTO alumnos (rela_personas) "
	     . "VALUES($id_persona)";

	$connect->query($sql);
}

function baja_alumno($id_persona){
    global $connect;
    $sql="UPDATE `sistbook`.`personas` SET `activo` = '0' WHERE (`id_persona` = '$id_persona');";

    $connect->query($sql);

}

function modificar_alumno($id_persona, $nombre, $apellido, $FechaNac){
    global $connect;
    
	$sql="UPDATE `sistbook`.`personas` 
		SET  `nombre` = '$nombre', 
		`apellido` = '$apellido', 
		`fecha_nacimiento` = '$FechaNac'
		WHERE (`id_persona` = '$id_persona');";

	$s = $connect->prepare($sql);

    $s->execute();

    $s->close();
}

// documento

function obtenerTiposDocumento() {
	global $connect;
	
	$sql = "SELECT * FROM tipo_documento";
	$datosTiposDocumentos = $connect->query($sql);
	return $datosTiposDocumentos;
}


function obtenerDocumentoPorIdPersona($id_persona) {
	global $connect;
	$sql = "SELECT persona_documento.valor, tipo_documento.descripcion as tipo_documento, persona_documento.id_persona_documento, personas.nombre, personas.apellido
		FROM persona_documento
		INNER JOIN tipo_documento ON tipo_documento.id_tipo_documento = persona_documento.rela_tipo_documento
		INNER JOIN personas ON personas.id_persona = persona_documento.rela_persona
		WHERE persona_documento.rela_persona = $id_persona";

	$datosDocumentos = $connect->query($sql);

	return $datosDocumentos;
}


function alta_documento($idTipoDocumento, $valor, $id_persona){
    global $connect;
 
	$sql="INSERT INTO `sistbook`.`persona_documento` (rela_persona, rela_tipo_documento, valor) "
    	. "VALUES ($id_persona, $idTipoDocumento, '$valor')";

    $connect->query($sql);

}




// contactos

function obtenerTiposContactos() {
	global $connect;

	$sql = "SELECT * FROM tipo_contacto";
	$datosTiposContactos = $connect->query($sql);
	return $datosTiposContactos;
}


function obtenerContactosPorIdPersona($id_persona) {
	global $connect;
	
	$sql = "SELECT persona_contacto.valor, tipo_contacto.descripcion as tipo_contacto,
		persona_contacto.id_persona_contacto, personas.nombre, personas.apellido
		FROM persona_contacto
		INNER JOIN tipo_contacto ON tipo_contacto.id_tipo_contacto = persona_contacto.rela_tipo_contacto
		INNER JOIN personas ON personas.id_persona = persona_contacto.rela_persona
		WHERE persona_contacto.rela_persona = $id_persona";

	$datosContactos = $connect->query($sql);

	return $datosContactos;
}


function crear_nuevo_contacto($idTipoContacto, $valor, $id_persona) {
	global $connect;
	
	$sql = "INSERT INTO persona_contacto (rela_persona, rela_tipo_contacto, valor) "
	     . "VALUES ($id_persona, $idTipoContacto, '$valor')";

	$connect->query($sql);
}

// SEXO

function obtenerTipoSexo() {
	global $connect;

	$sql = "SELECT * FROM tipo_sexo";
	$datoTipoSexo = $connect->query($sql);
	return $datoTipoSexo;
}


function obtenerSexoPorIdPersona($id_persona) {
	global $connect;
	
	$sql = "SELECT persona_sexo.valor, tipo_sexo.descripcion, persona_sexo.id_persona_sexo, personas.nombre, personas.apellido
		FROM persona_sexo
		INNER JOIN tipo_sexo ON tipo_sexo.id_tipo_sexo = persona_sexo.rela_tipo_sexo
		INNER JOIN personas ON personas.id_persona = persona_sexo.rela_persona
		WHERE persona_sexo.rela_persona = $id_persona";

	$datoSexo = $connect->query($sql);

	return $datoSexo;
}


function crear_nuevo_sexo($id_persona, $idTipoSexo, $valor) {
	global $connect;
	
	$sql = "INSERT INTO persona_sexo (rela_persona, rela_tipo_sexo, valor) "
	     . "VALUES ($id_persona, $idTipoSexo, '$valor')";

	$connect->query($sql);
}


// Clientes

function crear_clientes($id_persona, $nombre_empresa) {
	global $connect;

	$sql = "INSERT INTO clientes (rela_personas, nombre_empresa) VALUES($id_persona, '$nombre_empresa')";

	$connect->query($sql);
	
}

function obtenerDatoCliente($id_persona){
    global $connect;

	$sql="SELECT * FROM clientes join personas on personas.id_persona=clientes.rela_personas where id_persona= $id_persona;";

	$s = $connect->prepare($sql);

    $s->execute();

    $records = $s->get_result()->fetch_all(MYSQLI_ASSOC);

    $s->close();

	return $records;
}

function obtenerListadoClientes(){
    global $connect;

    $sql="SELECT clientes.id_clientes, clientes.nombre_empresa, personas.id_persona, personas.nombre, personas.apellido, personas.fecha_nacimiento FROM clientes
	join personas  on personas.id_persona = clientes.rela_personas where personas.activo=1;";

    $datos = $connect->query($sql);

    return $datos;

}

function baja_cliente($id_persona){
    global $connect;
    $sql="UPDATE `sistbook`.`personas` SET `activo` = '0' WHERE (`id_persona` = '$id_persona');";

    $connect->query($sql);

}

function modificar_cliente($id_persona, $nombre, $apellido, $FechaNac, $nombreEmpresa){
    global $connect;
    
	$sql="UPDATE `personas`
		INNER JOIN
			`clientes` 
			SET 
			`nombre` = '$nombre',
			`apellido` = '$apellido',
			`fecha_nacimiento` = '$FechaNac',
			`nombre_empresa` = '$nombreEmpresa'
			WHERE
			(`id_persona` = '$id_persona'
				AND `rela_personas` = '$id_persona');";

	$s = $connect->prepare($sql);

    $s->execute();

    $s->close();
}

// FISICO

function obtenerCaracteristica() {
	global $connect;

	$sql = "SELECT * FROM caracteristica";
	
	$datoCaracteristica = $connect->query($sql);

	return $datoCaracteristica;
}


function obtenerFisicoPorIdPersona($id_persona) {
	global $connect;
	
	$sql = "SELECT persona_fisico.valor, caracteristica.descripcion, persona_fisico.id_persona_fisico, personas.nombre, personas.apellido
	FROM persona_fisico
	INNER JOIN caracteristica ON caracteristica.id_caracteristica= persona_fisico.rela_caracteristica
	INNER JOIN personas ON personas.id_persona = persona_fisico.rela_persona
	WHERE persona_fisico.rela_persona = $id_persona";

	$datoFisico = $connect->query($sql);

	return $datoFisico;
}


function crear_nuevo_fisico($id_persona, $idCarcateristica, $valor) {
	global $connect;
	
	$sql = "INSERT INTO persona_fisico (rela_persona, rela_caracteristica, valor) "
	     . "VALUES ($id_persona, $idCarcateristica, '$valor')";

	$connect->query($sql);
}


// PROFESIONALES

function crear_profesionales($id_persona, $id_contrato, $profesionales_descripcion) {
	global $connect;

	$sql = "INSERT INTO `sistbook`.`profesionales`
		(`rela_personas`, `rela_contrato`, `profesionales_descripcion`, `activo`)
		VALUES ('$id_persona', '$id_contrato', '$profesionales_descripcion', 1)";

	$connect->query($sql);
	
}

function obtenerDatoProfesionales($id_persona){
    global $connect;

	$sql="SELECT * FROM profesionales
		JOIN personas on personas.id_persona=profesionales.rela_personas
		WHERE id_persona= $id_persona;";

	$s = $connect->prepare($sql);

    $s->execute();

    $records = $s->get_result()->fetch_all(MYSQLI_ASSOC);

    $s->close();

	return $records;
}

function obtenerListadoProfesionales(){
    global $connect;

    $sql="SELECT profesionales.id_profesionales, profesionales.profesionales_descripcion,
	personas.id_persona, personas.nombre, personas.apellido, personas.fecha_nacimiento
    FROM profesionales JOIN personas ON profesionales.rela_personas=personas.id_persona
	WHERE personas.activo=1 AND profesionales.activo=1;";

    $datos = $connect->query($sql);

    return $datos;

}

function baja_profesionales($id_persona){
    global $connect;
	
    $sql="UPDATE `sistbook`.`personas`
		INNER JOIN
			`profesionales`
			SET
			`personas`.`activo` = '0',
			`profesionales`.`activo` = '0'
			WHERE
			(`id_persona` = '$id_persona'
				AND `rela_personas` = '$id_persona');";

    $connect->query($sql);

}

function modificar_profesionales($id_persona, $nombre, $apellido, $FechaNac, $profesionales_descripcion){
    global $connect;
    
	$sql="UPDATE `personas`
		INNER JOIN
			`profesionales` 
			SET 
			`nombre` = '$nombre',
			`apellido` = '$apellido',
			`fecha_nacimiento` = '$FechaNac',
			`profesionales_descripcion` = '$profesionales_descripcion'
			WHERE
			(`id_persona` = '$id_persona'
				AND `rela_personas` = '$id_persona');";

	$s = $connect->prepare($sql);

    $s->execute();

    $s->close();
}


function obtenerProfesionales() {
	global $connect;

	$sql = "SELECT * from profesionales INNER JOIN personas ON profesionales.rela_personas = personas.id_persona
		WHERE personas.activo=1 AND profesionales.activo=1;";
	
	$datoProfesionales = $connect->query($sql);

	return $datoProfesionales;

}


function obtenerProfesionalesPorContrato($id_contrato) {

	global $connect;

    $sql = "SELECT 
				pc.id_profesionales_contratos,
				p.nombre,
				p.apellido,
				pr.profesionales_descripcion,
				c.*
			FROM
				profesionales_contratos pc
					INNER JOIN
				contratos c ON pc.rela_contrato = c.id_contrato
					INNER JOIN
				profesionales pr ON pc.rela_profecionales = pr.id_profesionales
					LEFT JOIN
				personas p ON pr.rela_personas = p.id_persona
			WHERE
				pc.rela_contrato = ?;";


    $stmt = $connect->prepare($sql);


    $stmt->bind_param("i", $id_contrato);
    $stmt->execute();


    $result = $stmt->get_result();


    $profesionalesContrato = array();

    
    while ($row = $result->fetch_assoc()) {
        $profesionalesContrato[] = $row;
    }

    
    $stmt->close();
    $connect->close();

    return $profesionalesContrato;

}


function guardarProfesionalesParaContrato($id_contrato, $id_profesionales) {
       
	global $connect;

    $sql = "INSERT INTO profesionales_contratos (rela_contrato, rela_profesionales) VALUES (?, ?)";

    $stmt = $connect->prepare($sql);


    $stmt->bind_param("ii", $id_contrato, $id_profesionales);
    $stmt->execute();


    if ($stmt->affected_rows > 0) {
        echo "Profesional guardado en el contrato correctamente.";
    } else {
        echo "Hubo un error al guardar el profesional en el contrato.";
    }


    $stmt->close();
    $connect->close();

}


// DOCENTES

function crear_docentes($id_persona) {
	global $connect;

	$sql = "INSERT INTO docentes (rela_personas) VALUES($id_persona)";

	$connect->query($sql);
	
}

function obtenerDatoDocentes($id_persona){
    global $connect;

	$sql="SELECT * FROM docentes join personas on personas.id_persona=docentes.rela_personas where id_persona= $id_persona;";

	$s = $connect->prepare($sql);

    $s->execute();

    $records = $s->get_result()->fetch_all(MYSQLI_ASSOC);

    $s->close();

	return $records;
}

function obtenerListadoDocentes(){
    global $connect;

    $sql="SELECT docentes.id_docentes, personas.id_persona, personas.nombre, personas.apellido, personas.fecha_nacimiento FROM docentes
		join personas  on personas.id_persona = docentes.rela_personas where personas.activo=1 ORDER BY personas.activo DESC;";

    $datos = $connect->query($sql);

    return $datos;

}

function baja_docentes($id_persona){
    global $connect;
    $sql="UPDATE `sistbook`.`personas` SET `activo` = '0' WHERE (`id_persona` = '$id_persona');";

    $connect->query($sql);

}

function modificar_docentes($id_persona, $nombre, $apellido, $FechaNac){
    global $connect;
    
	$sql="UPDATE `sistbook`.`personas` 
		SET  `nombre` = '$nombre', 
		`apellido` = '$apellido', 
		`fecha_nacimiento` = '$FechaNac'
		WHERE (`id_persona` = '$id_persona');";

	$s = $connect->prepare($sql);

    $s->execute();

    $s->close();
}

function crear_nuevo_tituloDocente($id_docentes, $id_profesion, $fechaTitulo) {
	global $connect;
	
	$sql = "INSERT INTO titulo_docente (rela_docentes, rela_profesion, fecha_titulo) "
	     . "VALUES ($id_docentes, $id_profesion, '$fechaTitulo')";

	$connect->query($sql);
}



// DOCENTE TITULO

function obtenerProfesion() {
	global $connect;

	$sql = "SELECT * FROM profesion";
	$datoprofesion = $connect->query($sql);
	return $datoprofesion;
}


function obtenerProfesionPorIdDocente($id_docentes) {
	global $connect;
	
	$sql = "SELECT titulo_docente.fecha_titulo, profesion.descripcion_titulo, titulo_docente.id_titulo_docente, personas.nombre, personas.apellido
	FROM titulo_docente
	INNER JOIN profesion ON profesion.id_profesion = titulo_docente.rela_docentes
	INNER JOIN docentes ON docentes.id_docentes = titulo_docente.rela_docentes
    LEFT JOIN personas ON personas.id_persona = docentes.rela_personas
	WHERE titulo_docente.rela_docentes= $id_docentes;";

	$datoTituloDocente = $connect->query($sql);

	return $datoTituloDocente;
}



?>