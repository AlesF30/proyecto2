<?php 


//OCULTAR DROPDOWNS Y MOSTRAR MENSAJES

//CONFIRMAR TODO EN UNA SOLA TRANSACCION

    require_once('bd_functions.php');

    if (isset($_POST['function'])) {
        switch ($_POST['function']) {
            case 'LeerProvincias':
                LeerProvincias($_POST['id_pais']);
                break;
            case 1:
                echo "i es igual a 1";
                break;
        }
    }






    function LeerProvincias($id_pais) {
        $provincias = consultarProvincias($id_pais);
        if (count($provincias)> 0) {
            echo json_encode($provincias);   //La devolucion de la consulta se formatea como json, perose imprime como texto plano
        } else {
            //echo 'El país ingresado no tiene provincias';

            echo 0;
        }
    }

    function LeerLocalidades() {


    }

?>