<?php
session_start();
include_once('../funciones.php');
include_once('../dbconfig.php');
if (empty($_POST['id'])){
	$errors[] = "ID vacio";
}   
else 
{
	$id=$_POST['id'];
	try
	{
		$db_con->begintransaction();
		$sql="select activo from especialidades where id_especialidad = :id_especialidad";
		$con=$db_con->prepare($sql);
		$res = $con->execute(array(
			":id_especialidad" => $id,
			));
		$activo = $con->fetch(PDO::FETCH_ASSOC);
		$activo = $activo['activo'];
		if ($activo == 1)
			$activo = 2;
		else $activo = 1;
		$sql="UPDATE especialidades SET activo = :activo WHERE id_especialidad=:id_especialidad";
		// die($sql);
		$con=$db_con->prepare($sql);
		{
			$query_update = $con->execute(array(
				":id_especialidad" => $id,
				":activo"=>$activo,
				));
		}
		$db_con->commit();
	}
	catch(PDOException $e)
	{
		$db_con->rollback();
		mensaje(array(
			"titulo"=>"Error!",
			"tipo"=>"warning",
			"texto"=>'Falto definir alguno de los valores'.$e->getMessage().$sql,
		));
	}
}
if ($query_update){
		$messages[] = "Los datos han sido actualizados satisfactoriamente.";
} else{
	$errors []= "Lo siento algo ha salido mal intenta nuevamente."; // .mysqli_error($con);
}

if (isset($errors))
{
	foreach ($errors as $error) 
	mensaje(array(
		"titulo"=>"Error!",
		"tipo"=>"danger",
		"texto"=>$error,
	));
}
if (isset($messages))
{
	foreach ($messages as $message) 
	mensaje(array(
		"titulo"=>"Bien Hecho!",
		"tipo"=>"success",
		"texto"=>$message,
	));
}
?>	