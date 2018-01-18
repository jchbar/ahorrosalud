<?php
session_start();
include_once('../funciones.php');
include_once('../dbconfig.php');
if (empty($_POST['nombre']) or empty($_POST['id']) or ($_POST['rif']<0))
{
	$errors[] = "Datos Invalidos para el especialista";
}
else
{
	try
	{
		$id_especialista = (isset($_POST['id'])?$_POST['id']:'n-a');
		$rif = (isset($_POST['rif'])?$_POST['rif']:'n-a');
		$nombre = (isset($_POST['nombre'])?$_POST['nombre']:'n-a');
		$codigo_especialista = (isset($_POST['codigo_especialidad'])?$_POST['codigo_especialidad']:'n-a');
		$estado = (isset($_POST['estado'])?$_POST['estado']:'n-a');
		$direccion1 = (isset($_POST['direccion1'])?$_POST['direccion1']:'n-a');
		$direccion2 = (isset($_POST['direccion2'])?$_POST['direccion2']:'n-a');
		$telefono = (isset($_POST['telefono'])?$_POST['telefono']:'n-a');
		$celular1 = (isset($_POST['celular1'])?$_POST['celular1']:'n-a');
		$celular2 = (isset($_POST['celular2'])?$_POST['celular2']:'n-a');
		$email = (isset($_POST['email'])?$_POST['email']:'n-a');
		$contacto_adm = (isset($_POST['contacto_adm'])?$_POST['contacto_adm']:'n-a');
		$telefono_contacto_adm = (isset($_POST['telefono_contacto_adm'])?$_POST['telefono_contacto_adm']:'n-a');
		$email_contacto_adm = (isset($_POST['email_contacto_adm'])?$_POST['email_contacto_adm']:'n-a');
		$ip=la_ip();
		$usuario=el_usuario();
		$registro=ahora($db_con);
		$registro=$registro['hoy1'];
		$sql="UPDATE especialistas SET rif = :rif, nombre = :nombre, codigo_especialista = :codigo_especialista, direccion1 = :direccion1, direccion2= :direccion2, telefono= :telefono, celular1= :celular1, celular2= :celular2, email= :email, contacto_adm= :contacto_adm, telefono_contacto_adm= :telefono_contacto_adm, email_adm= :email_adm, ip_registro = :ip_registro, registrado = :registrado, estado = :estado WHERE id_especialista=:id_especialista";
		$con=$db_con->prepare($sql);
		$query_update = $con->execute(array(
					":id_especialista"=>$id_especialista,
					":rif"=>$rif,
					":nombre"=>$nombre,
					":estado"=>$estado,
					":codigo_especialista"=>$codigo_especialista,
					":direccion1"=>$direccion1,
					":direccion2"=>$direccion2,
					":telefono"=>$telefono,
					":celular1"=>$celular1,
					":celular2"=>$celular2,
					":email"=>$email,
					":contacto_adm"=>$contacto_adm,
					":telefono_contacto_adm"=>$telefono_contacto_adm,
					":email_adm"=>$email_contacto_adm,
					":registrado"=>$registro,
					":ip_registro"=>$ip,
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