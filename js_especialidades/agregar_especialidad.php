<?php
session_start();
/*
error_reporting(E_ALL);
ini_set('display_errors','1');
/*Inicia validacion del lado del servidor*/
//$errors[] = $messages[] = "";
include_once('../funciones.php');
include_once('../dbconfig.php');
if (empty($_POST['nombre']))
{
	$errors[] = "Datos Invalidos para la especialidad";
}
else
{
	try
	{
		$nombre = (isset($_POST['nombre'])?$_POST['nombre']:'n-a');
		$ip=la_ip();
		$usuario=el_usuario();
		$registro=ahora($db_con);
		$registro=$registro['hoy1'];
		//$registro=$registro['hoy'];
		$sql="INSERT INTO especialidades (nombre, activo) VALUES (:nombre, :activo)";
		$db_con->begintransaction();
		$con=$db_con->prepare($sql);
		$uno=1;
		$query_update = $con->execute(array(
					":nombre"=>$nombre,
					":activo"=>$uno,
				));
		$db_con->commit();
	}
	catch(PDOException $e)
	{
		$db_con->rollback();
		mensaje(array(
			"titulo"=>"Error!",
			"tipo"=>"danger",
			"texto"=>$e->getMessage().$sql,
			));
		die($e->getMessage());
	}
	if ($query_update)
	{
		$messages[] = "Los datos han sido guardados satisfactoriamente.";
	} 
	else
	{
		$errors []= "Lo siento algo ha salido mal intenta nuevamente."; // .mysqli_error($con);
	}
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