<?php
session_start();
include_once('../funciones.php');
include_once('../dbconfig.php');
if (empty($_POST['nombre']) or empty($_POST['id']) or ($_POST['cuenta']<0))
{
	$errors[] = "Datos Invalidos para el banco";
}
else
{
	try
	{
		$id_banco = (isset($_POST['id'])?$_POST['id']:'n-a');
		$cuenta = (isset($_POST['cuenta'])?$_POST['cuenta']:'n-a');
		$codigo_banco = (isset($_POST['codigo_banco'])?$_POST['codigo_banco']:'n-a');
		$nombre = (isset($_POST['nombre'])?$_POST['nombre']:'n-a');
// echo $_POST['cuenta'].$codigo_banco;
		if (substr($cuenta,0,4) == $codigo_banco)
		{
			$ip=la_ip();
			$usuario=el_usuario();
			$registro=ahora($db_con);
			$registro=$registro['hoy1'];
			$sql="UPDATE bancos SET cuenta = :cuenta, nombre = :nombre, codigo_banco = :codigo_banco, ip_registro = :ip_registro, registrado = :registrado WHERE id_banco=:id_banco";
			$db_con->begintransaction();
			$con=$db_con->prepare($sql);
			$query_update = $con->execute(array(
					":id_banco"=>$id_banco,
					":cuenta"=>$cuenta,
					":nombre"=>$nombre,
					":codigo_banco"=>$codigo_banco,
					":registrado"=>$registro,
					":ip_registro"=>$ip,
				));
			$db_con->commit();
		}
		else 
			$errors []= "El chequeo del banco no coincide"; 
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