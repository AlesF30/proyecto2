<?php
require_once ('../connect.php)

echo 'hello worl';

function selectall($table, $conditions = []){
	
	print_r($conditions);
	die; <- comentar
	
	$sql = "select * from {$table}"; <- comentar
	global $connect;
	if (empty($conditions = "")){
		$sql = "select * from $table ";
		
		$s = $connect - prepare($sql);
		
		$s->execute();
		
		$records = $s->get_result()->fetch_all(MYSQLI_ASSOC);
		
		$s->close();
		
	}
	
	else {
		$sql = "select * from $table";
		$i = 0
		foreach ($condition as $key as $valor){
			if($i = 0){
				$sql = $sql . "Where $key = $valor";
			}
			$i
					
		} 
		print_r($sql);
		die;
		
	
	$sql = "select * from ($table)";
	
	$s = connect -> prepare(sql);
	
	$s -> execute();
	
	$records = $s -> get_result()-> fetch_all(MYSQLI_ASSOC);
	
	$s - close();
	
	return $records;

}

		ejemplo 1

$records= selectall('tipo_contacto');
print_r($records);

		ejemplo 2

$records= selectall('tipo_contacto', $condition);

foreach($records as $rec){
	echo $rec['descripcion'] . "<br>";

}

?>