<?php
session_start();
include_once('../funciones.php');
include_once('../dbconfig.php');
if (empty($_POST['id'])){
	$errors[] = "ID vacío";
}
else 
{
	$id=$_POST['id'];
	$db_con->begintransaction();
	try
	{
		$sql="SELECT count(id_especialidad) AS cuantos FROM contratos WHERE id_especialidad=:id_especialidad GROUP BY id_especialidad";
		$con=$db_con->prepare($sql);
		$query_delete = $con->execute(array(
			':id_especialidad' =>$id
			));
		if ($con->rowCount() < 1)
		{
			$sql="DELETE FROM especialidades WHERE id_especialidad=:id_especialidad";
			$con=$db_con->prepare($sql);
			$query_delete = $con->execute(array(
				':id_especialidad' =>$id
				));
			$db_con->commit();
		}
		else
		{
			$db_con->rollback();
			mensaje(array(
				"titulo"=>"Error!",
				"tipo"=>"warning",
				"texto"=>'No se puede eliminar especialidad porque hay contratos asignados',
			));
		}
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
if ($query_delete)
	$messages[] = "Los datos han sido eliminados satisfactoriamente.";
else
	$errors []= "Lo siento algo ha salido mal intenta nuevamente."; // .mysqli_error($con);
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