<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
require_once ('../../config/database/connect.php');
include(ROOT_PATH .'config\db_functions.php');
include (ROOT_PATH .'config/database/functions/contratos.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recopilación de datos del formulario
    $contrato_fecha_alta = $_POST["contrato_fecha_alta"];
    $duracion_dias = $_POST["duracion_dias"];
    $valor = $_POST["valor"];
    $contrato_precio = $_POST["contrato_precio"];
    $id_clientes = $_POST["clientes"];
    $id_categoria = $_POST["categoria_eventos"];
    $id_tipo = $_POST["tipo_evento"];
    $idEvento_estado = $_POST["evento_estado"];
    $estado_contrato = $_POST["estado_contrato"];
    
    // Lógica para insertar el contrato y datos relacionados
    alta_contratos($id_clientes, $id_tipo, $estado_contrato, $contrato_fecha_alta, $contrato_precio);
    // Obtener el último ID insertado en la tabla contratos
    $id_contrato = $connect->insert_id;

    // Insertar duración del contrato
    altaContrato_duracion($duracion_dias, $id_contrato, $valor);

    // Insertar evento
    alta_eventos($idEvento_estado, $id_tipo, $id_categoria, );
    // Obtener el último ID insertado en la tabla eventos
    $id_eventos = $connect->insert_id;

    // Redireccionar o mostrar un mensaje de éxito
    header("Location: ../contratos/listadoContrato.php");

?>
