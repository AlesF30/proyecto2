


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado</title>
	<script src="tableToExcel.js"></script>
</head>

<? php $id=$_POST['nombre_a_buscar'];?>
<div class="text-center">
<form action="" method="post">
    <input name="nombre_a_buscar" type="text" placeholder="Poner nombre alumno">
   <input  value="Buscar" type="submit"   class="tablalistado td">
  </form>
 </div>
  <?php
  

	 
    $id=$_POST['nombre_a_buscar'];
	//$id=is_null($ids);
	
	
	if (empty($id)) {
      $registros=$mysql->query("SELECT * FROM sistbook.personas
      join alumnos on id_persona=rela_personas 
      where activo ='1';") or
      die($mysql->error);
} else {
    $registros=$mysql->query("SELECT * FROM sistbookm.personas
join alumnos on id_persona=rela_persona
where personas_estado ='Alta' and personas_nombre like '%$id%';") or
      die($mysql->error);
	  }
	  ?>
<div>
<div class="row">
            <div class="col-2 offset-10">
                <div class="text-center">
				<div class=>
				<button class="btn btn-danger"type="button" onclick="tableToExcel('testTable', 'W3C Example Table')" class="badge bg-primary text-wrap" style="font-size: 1rem;">Exportar Excel
                </div>
            </div>
        </div>
</div>
    <div class="container">
        <h1 class="text-center">Listado de Alumnos</h1>
        <div class="row">
            <div class="col-2 offset-10">
                <div class="text-center">
                  <a href="formulario_alta_personas.php"><button class="">Agregar</button></a> 
              </div>
            </div>
        </div>
        <br>
        <br>


        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="testTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Genero</th>
						<th>Altura</th>
						<th>Torso</th>
						<th>Cintura</th>
						<th>Calce</th>
                        <th>Modificar</th>
                        <th>Dar de Baja</th>
                    </tr>
                </thead>
                <?php
                while ($reg=$registros->fetch_array())
    {
                        echo '<tr>';
                        echo '<td>';
                        echo $reg['id_persona'];
                        echo '</td>';      
                        echo '<td>';
                        echo $reg['personas_nombre'];      
                        echo '</td>';      
                        echo '<td>';
                        echo $reg['personas_apellido'];      
                        echo '</td>'; 
						echo '<td>';
                        echo $reg['personas_genero'];      
                        echo '</td>';
						echo '<td>';
                        echo $reg['alumnos_altura'];      
                        echo '</td>';
						echo '<td>';
                        echo $reg['alumnos_torso'];      
                        echo '</td>'; 
                        echo '<td>'; 
                        echo $reg['alumnos_cintura'];      
                        echo '</td>';
						echo '<td>'; 
                        echo $reg['num_calce'];      
                        echo '</td>';
						echo '<td>';
                        echo '<a href="modificar.php?codigo='.$reg['id_persona'].'"><i class="bi bi-pencil-square"></i></a>';
                        echo '</td>';    
                        echo '<td>';
                        echo '<a href="borrar.php?codigo='.$reg['id_persona'].'"><i class="bi bi-person-x"></i></a>';
                        echo '</td>';  
                        echo '</tr>';
    }      
                ?>
            </table>
        </div>
    </div>


<!-- CREAR Modal ALUMNO -->
<div class="modal fade" id="modalusuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar Alumno</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      </div>
    </div> 
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

</body>
</html>