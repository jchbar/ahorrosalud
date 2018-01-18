<?php
session_start();
/*
error_reporting(E_ALL);
ini_set('display_errors','1');
/*Inicia validacion del lado del servidor*/
//$errors[] = $messages[] = "";
include_once('../funciones.php');
include_once('../dbconfig.php');
if (empty($_POST['cuenta']))
{
	$errors[] = "Datos Invalidos para la cuenta";
}
else
{
	try
	{
		$cuenta = (isset($_POST['cuenta'])?$_POST['cuenta']:'n-a');
		$codigo_banco = (isset($_POST['codigo_banco'])?$_POST['codigo_banco']:'n-a');
		$nombre = (isset($_POST['nombre'])?$_POST['nombre']:'n-a');
// echo $_POST['cuenta'].$codigo_banco;
		if (substr($cuenta,0,4) == $codigo_banco)
		{
	//		$inicio=explode('/', $inicio); $inicio=$inicio[2].'-'.$inicio[0].'-'.$inicio[1];
	//		$final=explode('/', $final); $final=$final[2].'-'.$final[0].'-'.$final[1];
			$ip=la_ip();
			$usuario=el_usuario();
			$registro=ahora($db_con);
			$registro=$registro['hoy1'];
			//$registro=$registro['hoy'];
			$sql="INSERT INTO bancos (codigo_banco, nombre, cuenta, activo, registrado, ip_registro) VALUES (:codigo_banco, :nombre, :cuenta, :activo, :registrado, :ip_registro)";
			$db_con->begintransaction();
			$con=$db_con->prepare($sql);
			$uno=1;
			$query_update = $con->execute(array(
						":codigo_banco"=>$codigo_banco,
						":nombre"=>$nombre,
						":cuenta"=>$cuenta,
						":registrado"=>$registro,
						":ip_registro"=>$ip,
						":activo"=>$uno,
					));
			$db_con->commit();
		}
		else 
			$errors []= "El chequeo del banco no coincide"; // .mysqli_error($con);
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
/*
	mensaje(array(
				"titulo"=>"Aviso!!!",
				"tipo"=>"info",
				"texto"=>"<h4>mostrar",
				));	
/*
	mensaje(array(
				"titulo"=>"Aviso!!!",
				"tipo"=>"warning",
				"texto"=>"<h4>mostrar",
				));	
	mensaje(array(
				"titulo"=>"Aviso!!!",
				"tipo"=>"info",
				"texto"=>"<h4>mostrar",
				));	
*/
//				print_r($errors);
	foreach ($errors as $error) 
	// for ($elerror = 0; $elerror < count($errors); $elerror++)
	{
/*
	mensaje(array(
		"titulo"=>"Error!",
		"tipo"=>"danger",
		"texto"=>$error,
	));
*/
	mensaje(array(
				"titulo"=>"Error!!!",
				"tipo"=>"danger",
				"texto"=>$error,
				));	
	// echo $errors[$elerror];
	}
//	echo $_POST['cuenta'];
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