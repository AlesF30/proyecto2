<?php

$servername = "localhost";
$username   = "root";
$password   = "";
$database='sistbook';

// Create connection

$connect = new mysqli($servername, $username ,$password,$database);

// Check connection

if ($connect->connect_error){
    die("Problemas con la conexi�n a la base de datos");
}


function consultarPaises() {
  global $connect;

  $sql   = "SELECT * FROM domicilios.paises ORDER BY descripcion";
  $stmnt = $connect->prepare($sql);

  $stmnt->execute();

  $records = $stmnt->get_result()->fetch_all(MYSQLI_ASSOC);

  $stmnt->close();

  return $records;
}

function consultarProvincias($id_pais = 0) {
  global $connect;

  $sql   = "SELECT * FROM domicilios.provincias WHERE id_pais = $id_pais ORDER BY descripcion";
  $stmnt = $connect->prepare($sql);

  $stmnt->execute();

  $records = $stmnt->get_result()->fetch_all(MYSQLI_ASSOC);

  $stmnt->close();

  return $records;
}

function consultarTiposDomicilios() {
  global $connect;

  $sql   = "SELECT * FROM domicilios.tipodomicilio ORDER BY descripcion";
  $stmnt = $connect->prepare($sql);

  $stmnt->execute();

  $records = $stmnt->get_result()->fetch_all(MYSQLI_ASSOC);

  $stmnt->close();

  return $records;
}

function consultarTiposAtributos() {
  global $connect;

  $sql   = "SELECT * FROM domicilios.tipoatributo order by descripcion";
  $stmnt = $connect->prepare($sql);

  $stmnt->execute();

  $records = $stmnt->get_result()->fetch_all(MYSQLI_ASSOC);

  $stmnt->close();

  return $records;
}

function grabarNuevoDomicilio($id_persona, $id_tipoDomicilio, $id_barrio, $observaciones, $atributosSeleccionados, $valoresIngresados) {
  global $connect;

  $connect->begin_transaction();

  $sql   = "INSERT INTO domicilios.personas_domicilios (id_persona,
                                                        id_tipoDomicilio,
                                                        id_barrio,
                                                        observaciones)
            VALUES ($id_persona,
                    $id_tipoDomicilio,
                    $id_barrio,
                    '$observaciones')";
  $stmnt = $connect->prepare($sql);

  if ($stmnt) {
    $stmnt->execute();
    $id_persona_domicilio = $stmnt->insert_id;
    $stmnt->close();
  
    foreach ($atributosSeleccionados as $i => $id_tipoAtributo) {
      $valor = $valoresIngresados[$i];

      $sql2 = "INSERT INTO domicilios.domicilios_atributos (id_persona_domicilio,
                                                            id_tipoAtributo,
                                                            valor)
                VALUES($id_persona_domicilio,
                       $id_tipoAtributo,
                       '$valor')";
      $stmnt2 = $connect->prepare($sql2);

      if ($stmnt2) {
        $stmnt2->execute();
        $stmnt2->close();

        $connect->commit();
      } else {
        $connect->rollback();
        return 0;
      }
    }
  } else {
    $connect->rollback();
    return 0;
  }
}
?>