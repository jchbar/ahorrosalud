<?php
	/*Inicia validacion del lado del servidor*/
session_start();
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
		$id_plan = (isset($_POST['id'])?$_POST['id']:'n-a');
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
		$sql="UPDATE planes SET nombre_plan = :nombre, inicio = :inicio, final = :final, monto = :monto, tipo = :tipo, ip_registro = :ip_registro, registrado = :registrado WHERE id_plan=:id_plan";
		$con=$db_con->prepare($sql);
		$query_update = $con->execute(array(
					":id_plan"=>$id_plan,
					":nombre"=>$nombre,
					":inicio"=>$inicio,
					":final"=>$final,
					":registrado"=>$registro,
					":ip_registro"=>$ip,
					":tipo"=>$tipo,
					":monto"=>$monto,
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