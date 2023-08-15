<?php

	include_once('include/config.php');
	$data	=	array(
				'nombre'=>"Cecy",
				'apellido'=>"sarango",
				'telefono'=>"4655",
				'correo'=>"correo@hotmail.com",
				'foto_perfil'=>"48",
			);
			
			
	$insert	=	$db->insert('estudiante',$data);
	if($insert){
		echo "<br>Registro insertado correctamente";
	}else{
		echo "<br>No se inserto el registro";
	}

//Eliminar registro
	$data	=	array(
				'id_cedula'=>"47",
			);
			
	$borrar = $db->delete('estudiante',$data);

	if($borrar){
		echo "<br>Registro eliminado correctamente";
	}else{
		echo "<br>No se elimino el registro";
	}
	
//ACTUALIZAR
	$data_SET	=	array(
		'nombre'=>"NOMBRE",
		'apellido'=>"APELLIDO",
		'telefono'=>"TELEFONO",
		'correo'=>"correo@hotmail.com",
		'foto_perfil'=>"44",
			);
	
	$data_WHERE	=	array(
				'id_cedula'=>"15",
			);
	
	$actualizar = $db->update('estudiante',$data_SET,$data_WHERE);		
			
	if($actualizar){
		echo "<br>Registro actualizado correctamente";
	}else{
		echo "<br>El registro no se actualizo";
	}
	//Listar
$condition ="AND estudiante like '% %' ";
$condition ="";
$userData = $db->getAllRecords('estudiante','*',$condition, 'ORDER BY id_cedula');
if(count($userData)>0){
	$s = '';
	echo "<div>";
	echo "<table>";
	echo"<tr class='bg-dark text-white'>";
	echo "              <th>ID</th>";
	echo"               <th>nombre</th>";
	echo"				<th>apellido</th>";
	echo"				<th>telefono</th>";
	echo"				<th>correo</th>";
	echo"				<th>foto_perfil</th>";
	echo"              </tr>";

	foreach($userData as $val){
		$s++;
	echo "<tr>"; 
	  echo"<td >" .$s."</td>";
	  echo"<td >" .$val['nombre']."</td>";
	  echo"<td >" .$val['apellido']."</td>";
	   echo"<td >" .$val['telefono']."</td>";
	   echo"<td >" .$val['correo']."</td>";
	   echo"<td >" .$val['foto_perfil']."</td>";
	echo "</tr>";
	}
	echo "</table>";
	echo"</div>"; 
}
?>