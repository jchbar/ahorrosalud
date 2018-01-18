<?php
	/*Inicia validacion del lado del servidor*/
session_start();
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
		$id_especialidad = (isset($_POST['id'])?$_POST['id']:'n-a');
		$nombre = (isset($_POST['nombre'])?$_POST['nombre']:'n-a');
		$ip=la_ip();
		$usuario=el_usuario();
		$registro=ahora($db_con);
		$registro=$registro['hoy1'];
		$sql="UPDATE especialidades SET nombre = :nombre WHERE id_especialidad=:id_especialidad";
		$con=$db_con->prepare($sql);
		$query_update = $con->execute(array(
					":id_especialidad"=>$id_especialidad,
					":nombre"=>$nombre,
			));
	}
	catch(PDOException $e)
	{
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