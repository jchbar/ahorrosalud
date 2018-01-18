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
		$sql="SELECT count(id_promotor) AS cuantos FROM contratos WHERE id_promotor=:id_promotor GROUP BY id_promotor";
		$con=$db_con->prepare($sql);
		$query_delete = $con->execute(array(
			':id_promotor' =>$id
			));
		if ($con->rowCount() < 1)
		{
			$sql="DELETE FROM promotores WHERE id_promotor=:id_promotor";
			$con=$db_con->prepare($sql);
			$query_delete = $con->execute(array(
				':id_promotor' =>$id
				));
			$db_con->commit();
		}
		else
		{
			$db_con->rollback();
			mensaje(array(
				"titulo"=>"Error!",
				"tipo"=>"warning",
				"texto"=>'No se puede eliminar promotores porque hay asignados',
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