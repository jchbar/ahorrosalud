<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();
extract($_GET);
extract($_POST);
extract($_SESSION);
include_once 'dbconfig.php';
require('funciones.php');
require('fpdf/fpdf.php');
define('FPDF_FONTPATH','fpdf/font/');
//header('Content-type: application/pdf');
class PDF extends FPDF
{
/*
	// Cabecera de página
	function Header()
	{
	    // Logo
        // $this->Image('fpdf/logo/logo.jpg',10,0,20);
	    // Arial bold 15
	    $this->SetFont('Arial','B',15);
	    // Movernos a la derecha
	    $this->Cell(80);
	    // Título
	    //$this->Cell(30,10,'Title',1,0,'C');
	    // Salto de línea
	    $this->Ln(20);
	}
*/
	// Pie de página
	function Footer()
	{
	    // Posición: a 1,5 cm del final
	    $this->SetY(-15);
	    // Arial italic 8
	    $this->SetFont('Arial','I',8);
	    // Número de página
	    //$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
	}
}
$arreglo=stripslashes ($_GET['arreglo']);
$arreglo=unserialize($arreglo);
$enviaremail=$arreglo['enviaremail'];
$columna=3;
$rpl=230; 	// registros por listado
$crl=0;		// contador de registros por listado
$col_listado=0;
$nuevoarchivo=false;
$col_listado=0;
$header=array('Lin N°','Ubicacion','Referencia','Cedula','Apellidos y Nombres','Credito','Cuota');
$alto=4;
$salto=$alto;
$ancho=80;
$w=array(15,20,20,20,50,25,25); // ,25,25,25,25,25,25);
$p[0]=15;
for ($posicion=1;$posicion<count($w);$posicion++) 
	$p[$posicion]=$p[$posicion-1]+$w[$posicion-1];

$pdf=new PDF('L','mm','Letter');
$pdf->SetFont('Arial','',10);
//$pdf->Open();
//$sql="SELECT *, especialidades.nombre as nombreespecialidad FROM `especialistas`, especialidades  WHERE codigo_especialista = especialidades.id_especialidad order by nombreespecialidad";
$registro=ahora($db_con);
$registro=$registro['ahora'];
$fgen=substr($registro,0,10);
$hgen=substr($registro,-8);
$fgen=explode('-',$fgen);
$hgen=explode(':',$hgen);
$fgen=$fgen[0].$fgen[1].$fgen[2];
$fgen.=$hgen[0].$hgen[1];

$sql="select * from especialidades where (activo = 1) order by nombre";
$linea=encabeza($header, $w, $p, $pdf, $salto, $alto, $db_con);
try
{
	$agrupados = $db_con->prepare($sql);
	$agrupados->execute();
	$columnas=array(10,100,190);
	$columna=0;
	while ($especialidad = $agrupados->fetch(PDO::FETCH_ASSOC))
	{
		$nombreespecialidad=$especialidad['nombre'];
		$id_especialidad=$especialidad['id_especialidad'];
//		echo 'nombreespecialidad'.$nombreespecialidad;
		$sql = "select estado from especialistas where (codigo_especialista = :id_especialidad) and (activo = 1) group by estado order by estado";
		$estados=$db_con->prepare($sql);
		$estados->execute(array(":id_especialidad"=>$id_especialidad));
		while ($estado = $estados->fetch(PDO::FETCH_ASSOC))
		{
			$nombreestado = $estado['estado'];
//	echo 'estado'.$nombreestado;
			$sql = "select * from especialistas where (codigo_especialista = :id_especialidad) and (activo = 1) and (estado = :estado) order by estado, nombre";
			$medicos=$db_con->prepare($sql);
			$medicos->execute(array(
				":id_especialidad"=>$id_especialidad,
				":estado"=>$nombreestado,
				));
			$registros=$medicos->rowCount();
			set_time_limit($registros<30?30:$registros);
			$linea=encabeza_columna($pdf, $salto, $alto, $db_con, $nombreestado, $linea, $columnas[$columna], 13, 1, $ancho);
			if ($medicos->rowCount() > 0)
			{
				// imprimir encabezado por columna (3)
				// imprimir detalle
				$linea=encabeza_columna($pdf, $salto, $alto, $db_con, $nombreespecialidad, $linea, $columnas[$columna], 10, 2, $ancho);
				while ($medico = $medicos->fetch(PDO::FETCH_ASSOC))
				{
//					echo $medico['nombre'];
					$suma = ($linea-($salto * 4));
					$rxl=150;
					if (($rxl - $suma) < 0)
					{
						$columna++;
					// echo ($rxl - $suma).'/'.$suma."/$columna<br>";
						if ($columna < count($columnas))
						{
							$linea=28;
							$linea=encabeza_columna($pdf, $salto, $alto, $db_con, $nombreestado, $linea, $columnas[$columna], 13, 1, $ancho);
							$linea=encabeza_columna($pdf, $salto, $alto, $db_con, $nombreespecialidad, $linea, $columnas[$columna], 10, 2, $ancho);
						}
					}
					if ($columna == count($columnas))
					{
						$columna=0;
						$linea=encabeza($header, $w, $p, $pdf, $salto, $alto, $db_con);
						$linea=encabeza_columna($pdf, $salto, $alto, $db_con, $nombreestado, $linea, $columnas[$columna], 13, 1, $ancho);
						$linea=encabeza_columna($pdf, $salto, $alto, $db_con, $nombreespecialidad, $linea, $columnas[$columna], 10, 2, $ancho);
					}
					$linea=detalle_columna($pdf, $salto, $alto, $medico, $columnas[$columna], $linea, $ancho);
				}
			}
		}
	}
	$pdf->Output('F','e_guia/guia'.$fgen.'.pdf');
	$pdf->Output();
	if ($enviaremail == 1)
	{
	///////////////
		$sql = "select * from titulares where activo = :activo";
		$titulares = $db_con->prepare($sql);
		$titulares->execute(array(":activo"=>1));

		$mailenviadopor=obtener_parametro('mailenviadopor', $db_con);
		$responderemail=obtener_parametro('responderemail', $db_con);
		$direccionweb=obtener_parametro('direccionweb', $db_con);

/*
		$buscar="select * from configuracion where nombreparametro = ''";
		$resb=$db_con->prepare($buscar);
		$resb->execute(array(":nombreparametro"=>'mailenviadopor'));
		$enviadopor=$resb->fetch(PDO::FETCH_ASSOC);
		$enviadopor = '$enviadopor['valorparametro']';
		
		$buscar="select * from configuracion where nombreparametro = ''";
		$resb=$db_con->prepare($buscar);
		$resb->execute(array(":nombreparametro"=>'responderemail'));
		$respondera=$resb->fetch(PDO::FETCH_ASSOC);
		$respondera = $respondera['valorparametro'];

		$buscar="select * from configuracion where nombreparametro = ''";
		$resb=$db_con->prepare($buscar);
		$resb->execute(array(":nombreparametro"=>'direccionweb'));
		$dirweb=$resb->fetch(PDO::FETCH_ASSOC);
		$dirweb = $dirweb['valorparametro'];
*/
		include_once('enviarmail.php');

		while ($afiliado = $titulares->fetch(PDO::FETCH_ASSOC))
		$cuento= '<table>';
		$cuento.= '<tr>';
		$cuento.= '<td><img src="'.$dirweb.'/identificacion/logo.jpg"/></td>';
		$cuento.= '</tr>';
		$cuento.= '<tr>';
		$cuento.= '<td><strong>Estimada(o) Afiliada(o):</strong></td>';
		$cuento.= '</tr>';
		$cuento.= '<tr>';
		$cuento.= '<td><strong>'.trim($afiliado['apellidos']). ' '.trim($afiliado['nombres']) .'</strong> ('.$_SESSION['rif'].')</td>';
		$cuento.= '</tr>';
		$cuento.= '<tr>';
		$cuento.= '</tr>';
		$cuento.= '<tr>';
		$cuento.= '<td>Adjunto al presente encontrara Guia Medica (AhorroSalud) con los especialistas actualizada</td>';
		$cuento.= '</tr>';

		$cuento.= '<tr>';
		$cuento.= '<td>Gracias por su atenci&oacuten</td>';
		$cuento.= '</tr>';
		$cuento.= '</table>';
// echo $cuento;
		return (enviar_email('Guia Medica AhorroSalud', $cuento, true, $archivoimagen, $enviadopor, $respondera , $enviara ) >0);
	///////////////	
	}
}
catch (PDOException $e) 
{
//	mensaje(['tipo'=>'warning','titulo'=>'Aviso','texto'=>'<h2>Fallo llamado</h2>'.$e->getMessage()]);
		die('Fallo call'. $e->getMessage().$sql);
}
set_time_limit(30);

////////////////////////////////////////////////////
function detalle_columna(&$pdf, $salto, $alto, $medico, $posicion, &$linea, $ancho)
{
	$pdf->SetY($linea);
	$pdf->SetFont('Arial','I',6);
	$pdf->SetX($posicion); $pdf->Cell($ancho, $alto, substr($medico['nombre'],0,$ancho)."($linea)",0,0,'LRTB',0);
	$linea+=$salto;
	$pdf->SetFont('Arial','',6);
	$pdf->SetY($linea);
	$pdf->SetX($posicion); $pdf->Cell($ancho, $alto, substr($medico['direccion1'],0,$ancho),0,0,'R',0);
	if (!empty($medico['direccion2']))
	{
		$linea+=$salto;
		$pdf->SetY($linea);
		$pdf->SetX($posicion); $pdf->Cell($ancho, $alto, substr($medico['direccion2'],0,$ancho),0,0,'R',0);
	}
	$linea+=$salto;
	$pdf->SetY($linea);
	$telefonos=$medico['telefono'];
	if (!empty($medico['celular1']))
		$telefonos.='/'.$medico['celular1'];
	if (!empty($medico['celular2']))
		$telefonos.='/'.$medico['celular2'];
	$telefonos.="($linea)";
	$pdf->SetX($posicion); $pdf->Cell($ancho, $alto, $telefonos,0,0,'R',0);
	$linea+=$salto;
	return $linea;
}
////////////////////////////////////////////////////
function encabeza_columna(&$pdf, $salto, $alto, $db_con, $cuento, &$linea, $columna, $tamano, $tipo, $ancho)
{
	$pdf->SetFont('Arial','B',$tamano);
	// $pdf->AddPage();
	$pdf->SetFillColor(200,200,200);
	if ($tipo == 1)
	{
		$pdf->SetFillColor(0,0,255);
		$pdf->SetTextColor(255,255,255);
	}
	else 
	{
		$pdf->SetFillColor(0,191,255);
		$pdf->SetTextColor(255,255,255);
	}
	$pdf->SetDrawColor(0,0,0);
	$pdf->SetLineWidth(.2);

	$pdf->SetFont('Arial','B',10);
	$pdf->SetY($linea);
	$pdf->SetX($columna);
	$pdf->Cell($ancho,$alto,$cuento,1,1,'C',1);
	$pdf->SetY($linea);
	$pdf->SetFont('Arial','',7);
	$linea+=$salto;
	$pdf->SetY($linea);

	//Restauración de colores y fuentes
	$pdf->SetFillColor(224,235,255);
	$pdf->SetTextColor(0);
	$pdf->SetFont('Arial','',10);
/*
	$linea+=$salto;
	$linea+=$salto;
	$pdf->SetY($linea);
/*
	$pdf->SetX($p[0]);
	$pdf->Cell(0,0,'  ',1,0,'L',0);
*/
	return $linea;
}

////////////////////////////////////////////////////


function encabeza($header, $w, $p, &$pdf, $salto, $alto, $db_con)
{
	$linea=15; // encabezado($pdf, 0, $db_con, $referencia, $concepto);
	$pdf->SetFont('Arial','B',14);
	$pdf->AddPage();
	$pdf->SetFont('Arial','B',10);
	$pdf->SetY($linea);
	$pdf->SetX(0);
	$pdf->Cell(200,0,"Guia medica Ahorro SAlud ",0,0,'C',0);
	//$pdf->Cell(200,0,"Guia medica Ahorro SAlud ".convertir_fechadmy($fechadescuento),0,0,'C',0);
	$pdf->SetY($linea);
	$pdf->SetFont('Arial','',7);
	$linea+=5;
	$pdf->SetX(170);
	$pdf->Cell(20,0,'Realizado el '.date('d/m/Y h:i A'),0,0,'L'); 
	//Títulos de las columnas
	$linea+=5;
	$pdf->SetY($linea);
	//$header=array($$arrtitulo);
	//Colores, ancho de línea y fuente en negrita
/*
	$pdf->SetFillColor(200,200,200);
	$pdf->SetTextColor(0);
	$pdf->SetDrawColor(0,0,0);
	$pdf->SetLineWidth(.2);
	$pdf->SetFont('Arial','B',10);
	//Cabecera
	for($i=0;$i<count($header);$i++){
		$pdf->SetY($linea);
		$pdf->SetX($p[$i]);
		$pdf->Cell($w[$i],$alto,$header[$i],1,0,'C',1);
	}
*/
	//Restauración de colores y fuentes
	$pdf->SetFillColor(224,235,255);
	$pdf->SetTextColor(0);
	$pdf->SetFont('Arial','',10);
	$linea+=$salto;
	$pdf->SetY($linea);
/*
	$pdf->SetX($p[0]);
	$pdf->Cell(0,0,'  ',1,0,'L',0);
*/
	return $linea;
}

?>
