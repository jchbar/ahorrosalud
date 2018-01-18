<?php
session_start();
/*
error_reporting(E_ALL);
ini_set('display_errors','1');
/*Inicia validacion del lado del servidor*/
//$errors[] = $messages[] = "";
include_once('../funciones.php');
include_once('../dbconfig.php');
if (empty($_POST['nombre']) or ($_POST['monto']<0))
{
	$errors[] = "Datos Invalidos para el plan";
}
else
{
	try
	{
		$nombre = (isset($_POST['nombre'])?$_POST['nombre']:'n-a');
		$tipo = (isset($_POST['tipo'])?$_POST['tipo']:'n-a');
		$monto = (isset($_POST['monto'])?$_POST['monto']:0);
		$inicio = (isset($_POST['inicio'])?$_POST['inicio']:'1001-01-01');
		$final = (isset($_POST['final'])?$_POST['final']:'n-a');
		$inicio=explode('/', $inicio); $inicio=$inicio[2].'-'.$inicio[0].'-'.$inicio[1];
		$final=explode('/', $final); $final=$final[2].'-'.$final[0].'-'.$final[1];
		$ip=la_ip();
		$usuario=el_usuario();
		$registro=ahora($db_con);
		$registro=$registro['hoy1'];
		//$registro=$registro['hoy'];
		$sql="INSERT INTO planes (nombre_plan, inicio, final, registrado, ip_registro, tipo, activo, monto) VALUES (:nombre_plan, :inicio, :final, :registrado, :ip_registro, :tipo, :activo, :monto)";
		$db_con->begintransaction();
		$con=$db_con->prepare($sql);
		$uno=1;
		$query_update = $con->execute(array(
					":nombre_plan"=>$nombre,
					":inicio"=>$inicio,
					":final"=>$final,
					":registrado"=>$registro,
					":ip_registro"=>$ip,
					":tipo"=>$tipo,
					":activo"=>$uno,
					":monto"=>$monto,
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