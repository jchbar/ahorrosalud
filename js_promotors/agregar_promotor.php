<?php
session_start();
/*
error_reporting(E_ALL);
ini_set('display_errors','1');
/*Inicia validacion del lado del servidor*/
//$errors[] = $messages[] = "";
include_once('../funciones.php');
include_once('../dbconfig.php');
if (empty($_POST['nombre']) or (empty($_POST['rif'])))
{
	$errors[] = "Datos Invalidos para el promotor";
}
else
{
	try
	{
		$rif = (isset($_POST['rif'])?$_POST['rif']:'n-a');
		$nombre = (isset($_POST['nombre'])?$_POST['nombre']:'n-a');
		$estado = (isset($_POST['estado'])?$_POST['estado']:'n-a');
		$direccion1 = (isset($_POST['direccion1'])?$_POST['direccion1']:'n-a');
		$direccion2 = (isset($_POST['direccion2'])?$_POST['direccion2']:'n-a');
		$telefono = (isset($_POST['telefono'])?$_POST['telefono']:'n-a');
		$celular1 = (isset($_POST['celular1'])?$_POST['celular1']:'n-a');
		$celular2 = (isset($_POST['celular2'])?$_POST['celular2']:'n-a');
		$email = (isset($_POST['email'])?$_POST['email']:'n-a');
//		$inicio=explode('/', $inicio); $inicio=$inicio[2].'-'.$inicio[0].'-'.$inicio[1];
//		$final=explode('/', $final); $final=$final[2].'-'.$final[0].'-'.$final[1];
		$ip=la_ip();
		$usuario=el_usuario();
		$registro=ahora($db_con);
		$registro=$registro['hoy1'];
		//$registro=$registro['hoy'];
		$db_con->begintransaction();
		$sql="SELECT rif FROM promotores WHERE rif = :rif";
		$con=$db_con->prepare($sql);
		$query_update = $con->execute(array(
					":rif"=>$rif,
					));
		if ($con->rowCount() < 1)
		{
			$sql="INSERT INTO promotores (rif, nombre, direccion1, direccion2, telefono, celular1, celular2, email, activo, registrado, ip_registro, estado) VALUES (:rif, :nombre, :direccion1, :direccion2, :telefono, :celular1, :celular2, :email, :activo, :registrado, :ip_registro, :estado)";
			$con=$db_con->prepare($sql);
			$uno=1;
			$query_update = $con->execute(array(
						":rif"=>$rif,
						":nombre"=>$nombre,
						":estado"=>$estado,
						":direccion1"=>$direccion1,
						":direccion2"=>$direccion2,
						":telefono"=>$telefono,
						":celular1"=>$celular1,
						":celular2"=>$celular2,
						":email"=>$email,
						":registrado"=>$registro,
						":ip_registro"=>$ip,
						":activo"=>$uno,
					));
			$db_con->commit();
		}
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