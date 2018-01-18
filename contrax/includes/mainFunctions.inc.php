<?php

// Constantes conexión con la base de datos
include('dbconfig.php');

// Variable que indica el status de la conexión a la base de datos
$errorDbConexion = false;


// Función para extraer el listado de usurios
function consultaUsers($linkDB){

	$statusTipo = array("Activo" => "btn-success",
						"Suspendido" => "btn-warning");

	$salida = '';
	$sql="SELECT id_user,usr_nombre,usr_puesto,usr_nick,usr_status FROM tbl_usuarios ORDER BY usr_nombre ASC";
	$consulta = $linkDB->prepare($sql);
	$consulta->execute();
	// echo 'registros '.$consulta->rowCount();
	if($consulta->rowCount() != 0){
		// convertimos el objeto
		while($listadoOK = $consulta->fetch(PDO::FETCH_ASSOC))
		{
			$salida .= '
				<tr>
					<td>'.$listadoOK['usr_nombre'].'</td>
					<td>'.$listadoOK['usr_puesto'].'</td>
					<td>'.$listadoOK['usr_nick'].'</td>
					<td class="centerTXT"><span class="btn btn-mini '.$statusTipo[$listadoOK['usr_status']].'">'.$listadoOK['usr_status'].'</span></td>
					<td class="centerTXT"><a data-accion="editar" class="btn btn-mini" href="'.$listadoOK['id_user'].'">Editar</a> <a data-accion="eliminar" class="btn btn-mini" href="'.$listadoOK['id_user'].'">Eliminar</a></td>
				<tr>
			';
		}
	}
	else{
		$salida = '
			<tr id="sinDatos">
				<td colspan="5" class="centerTXT">NO HAY REGISTROS EN LA BASE DE DATOS</td>
	   		</tr>
		';
	}

	return $salida;
}

/*
// Verificar constantes para conexión al servidor
if(defined('db_host') && defined('db_user') && defined('db_pass') && defined('db_name'))
{
	// Conexión con la base de datos
	
	$mysqli = new mysqli(db_host, db_user, db_pass, db_name);
	
	// Verificamos si hay error al conectar
	if (mysqli_connect_error()) {
	    $errorDbConexion = true;
	}

	// Evitando problemas con acentos
	$mysqli -> query('SET NAMES "utf8"');
}
*/
$mysqli=$db_con;

?>