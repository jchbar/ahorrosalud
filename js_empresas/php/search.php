<?php
try 
{
	require('../../dbconfig.php');
	// echo (file_exists('../../dbconfig.php')?' existe':' fallo');
	// Output HTML formats
	$html1='<div class="result mt">';
	$html1.='<div class="col-lg-12">';
	$html1.='<div class="content-panel tablesearch">';
	$html1.='<section id="unseen">';
	$html1.='<table id="resultTable" class="table table-bordered table-hover table-condensed">';
	$html1.='<thead>';
	$html1.='<tr>';

	$html1.='<th class="small">RIF</th>';
	$html1.='<th class="small">Nombre</th>';
	$html1.='<th class="small">Status</th>';
	$html1.='</tr>';
	$html1.='</thead>';
	$html1.='<tbody>';
	$html = '<tr>';
	$html .= '<td class="small">nameString</td>';
	$html .= '<td class="small">compString</td>';
	$html .= '<td class="small">zipString</td>';
	$html .= '<td class="small">opciones</td>';
	$html .= '</tr>';

	echo $html1;
	// Get the Search
	$search_string = preg_replace("/[^A-Za-z0-9]-/", " ", $_POST['query']);
	// $search_string = $db_con->real_escape_string($search_string);

	// Check if length is more than 1 character
	if (strlen($search_string) >= 3 && $search_string !== ' ') 
	{
		// Query
		$query = 'SELECT * FROM empresas WHERE (nombre LIKE "%'.$search_string.'%") OR (rif LIKE "%'.$search_string.'%") ORDER BY nombre LIMIT 10';
		$result = $db_con->prepare($query);
		$result->execute();
		echo $sql;
		while($results = $result->fetch(PDO::FETCH_ASSOC)) 
		{
			$result_array[] = $results;
		}
		if (isset($result_array)) 
		{
			// $o = str_replace('nameString', $html, $html1);
			foreach ($result_array as $result) 
			{
				// Output strings and highlight the matches
				$d_name = preg_replace("/".$search_string."/i", "<b>".$search_string."</b>", $result['rif']);
				$d_comp = preg_replace("/".$search_string."/i", "<b>".$search_string."</b>", $result['nombre']);
				$d_zip = $result['status'];
//				$d_city = $result['nomsudeca'];
				// Replace the items into above HTML
				$o = '<td>'.str_replace('nameString', $d_name, $html).'</td>';
				$o = '<td>'.str_replace('compString', $d_comp, $o).'</td>';
				$o = '<td>'.str_replace('zipString', $d_zip, $o).'</td>';
//				$o = '<td>'.str_replace('cityString', $d_city, $o).'</td>';
//				$op_modificar = '<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#dataUpdate" data-id="'.$result['cedula'].'" data-codigo="'.$result['cedula'].'" data-nombre="'.$result['nombre'].'"><i class="glyphicon glyphicon-edit"></i> Modificar</button>';
/*
				$op_modificar = '<button type="button" class="btn btn-info" data-toggle="modal" data-target="#dataUpdate" data-id = "'.$row['id_especialista'].'" data-nombre = "'.$row['medico'].'" data-rif = "'.$row['rif'].'"  data-direccion1 = "'.$row['direccion1'].'" data-direccion2 = "'.$row['direccion2'].'" data-telefono = "'.$row['telefono'].'" data-celular1 = "'.$row['celular1'].'" data-celular2 = "'.$row['celular2'].'" data-email = "'.$row['email'].'"  data-contacto_adm = "'.$row['contacto_adm'].'" data-telefono_contacto_adm = "'.$row['telefono_contacto_adm'].'" data-email_contacto_adm = "'.$row['email_adm'].'" data-codigo_especialista = "'.$row['codigo_especialista'].'"> <i class="glyphicon glyphicon-edit"></i> Modificar</button>';
				$op_modificar .= '<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#dataStatus" data-id="'.$row['id_especialista'].'" data-status="'.$row['activo'].'" data-nombre="'.$row['medico'].'"  data-rif="'.$row['rif'].'"><i class="glyphicon glyphicon-refresh "></i> Cambiar Status</button>';
				$op_modificar .= '<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#dataDelete" data-id="'.$row['id_especialista'].'" data-status="'.$row['activo'].'" data-nombre="'.$row['medico'].'" data-rif="'.$row['rif'].'" ><i class="glyphicon glyphicon-trash"></i> Eliminar</button>';
*/
				$o = '<td>'.str_replace('opciones', $op_modificar, $o).'</td>';
	//			$o.='</td>';
				// Output it
				echo($o);
			}
		}
		else
		{
			// Replace for no results
			$o = str_replace('nameString', '<span class="label label-danger">No se han conseguido resultados con los datos indicados</span>', $html);
			$o = str_replace('compString', '', $o);
			$o = str_replace('zipString', '', $o);
			// $o = str_replace('cityString', '', $o);
			// Output
			echo($o);
		}
	}
	else
	{
		// Replace for no results
		$o = str_replace('nameString', '<span class="label label-warning">No hay suficientes datos para realizar una busqueda</span>', $html);
		$o = str_replace('compString', '', $o);
		$o = str_replace('zipString', '', $o);
		// $o = str_replace('cityString', '', $o);
		// Output
		echo($o);
	}
} 
catch (Exception $e) 
{
	die('fallo '.$e->getMessage(). ' '.$query);
}

?>