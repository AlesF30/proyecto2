<?php

require_once('path.php');
require_once(ROOT_PATH . 'config/database/connect.php');

function selectall ($table, $conditions=[]){
    global $connect;

    if (empty($conditions)){
        $sql="SELECT * FROM $table";
    }else{
        $sql="SELECT * FROM $table ";
        $i=0;
        foreach($conditions as $key => $valor){
            if($i == 0){
                $sql= $sql . "WHERE $key = $valor";
            }else{
                $sql= $sql . "and $key = '$valor'";
            }
            $i++;
        }
    }

    $s=$connect->prepare($sql);
    $s->execute();

    $records=$s->get_result()->fetch_all(MYSQLI_ASSOC);
    $s->close();

    return $records;




    
}