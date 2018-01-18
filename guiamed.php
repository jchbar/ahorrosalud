<?php
include("home.php");
extract($_GET);
extract($_POST);
extract($_SESSION);
$sql="select DATE_FORMAT(now(),'%m/%d/%Y') as hoy, DATE_ADD(NOW(), INTERVAL 24 MONTH) AS futuro, DATE_SUB(NOW(), INTERVAL 6 WEEK) AS pasado";
$stmt=$db_con->prepare($sql);
$stmt->execute();
$res=$stmt->fetch(PDO::FETCH_ASSOC);
$hoy=$res['hoy'];
$pasado=$res['pasado'];
$futuro=$res['futuro'];
?>

<script language="javascript">
function abrir2Ventanas(arreglo)
{
	window.open("guiamed_pdf.php?arreglo="+arreglo,"parte1","top=0,left=395,status=no,toolbar=no,scrollbar=yes,location=no,type=fullWindow,fullscreen");	
}
</script>
<script language="javascript">
//Creo una función que imprimira en la hoja el valor del porcentanje asi como el relleno de la barra de progreso
function callprogress(vValor){
 document.getElementById("progress-txt").innerHTML = vValor;
 document.getElementById("progress-txt").innerHTML = '<div class="progress-bar" role="progressbar" style="width:'+vValor+'%; min-width:10%">'+vValor+'%</div>';
}
</script>
<?php
$ip = la_ip();
$momento = ahora($db_con)['ahora'];
if (!$accion) 
{
	?>
<div class="body-container">
	<div class="container">
		<div class="row">
			<div class="col-xs-6" class="text-center">
				<form action='guiamed.php?accion=Listado' name='form1' method='post' class='form-inline'>
				<fieldset><legend>Informaci&oacute;n Para Generar Guia Medica</legend>
					<label for="enviaremail" class="control-label">Enviar por email a afiliados</label>
					<input type="checkbox" checked id="enviaremail" name="enviaremail" value="1" >
					<input type="submit" class="btn btn-success" name="Submit" value="Enviar" />
				</fieldset>
				</form>
			</div>
		</div>
	</div>
</div>
<?php
}	// !$accion

if (($accion=='Listado')) 
{
/*
	echo '<div class="row">';
		echo '<div class="col-md-4">';
			echo 'Proceso Interno <div id="progress-txt" class="progress  progress-bar-success">';
				// echo '<div id="progress-bs" class="progress-bar" role="progressbar" style="width:30%; min-width:10%">';
				echo '<div class="progress-bar" role="progressbar" style="width:30%">';
					echo '0%';
				echo '</div>';
				echo '<span class="sr-only"></span>';
			echo '</div>';
		echo '</div>';
	echo '</div>';
*/
	// probamdo enviar arreglos por url
	$arreglo=array(
		"enviaremail"=>$_POST['enviaremail'],
	);
	$arreglo=serialize($arreglo);
	$arreglo=urlencode($arreglo);
	?>
	<div class="body-container">
		<div class="container">
	<?php
	echo '<input type="submit" class="btn btn-info" name="Submit" value="Proceder con la Guia Medica" onClick="abrir2Ventanas(';
	echo "'";
	echo $arreglo;
	echo "'";
	echo ');">  ';
	?>
		</div>
	</div>
	<?php
/*
			echo '</legend>';
			echo '</form>';
			echo '</div>';	
	set_time_limit(30);
*/
}	// ($accion=='Listado')
?>
 <?php pie(); ?>
</body>
</html>

