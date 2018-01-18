<?php
session_start();
$mostrarerrores=0;
if ($mostrarerrores == 1)
{
	error_reporting(E_ALL);
	ini_set('display_errors','1');
}
date_default_timezone_set('America/Caracas'); 
if(!isset($_SESSION['user_session']))
{
	header("Location: index.php");
}

include_once 'dbconfig.php';

/*
$stmt = $db_con->prepare("SELECT * FROM sgcapass WHERE alias=:uid");
$stmt->execute(array(":uid"=>$_SESSION['user_session']));
$row=$stmt->fetch(PDO::FETCH_ASSOC);
*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>.:| Ahorro Salud |:.</title>
<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen"> 
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="bootstrap/css/bootstrap-datetimepicker.min.css" rel="stylesheet">  
        <link href="bootstrap/css/toastr.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="bootstrap/css/bootstrapValidator.min.css"/>

<!-- script type="text/javascript" src="bootstrap/js/jquery.min.js"></script> -->
<script type="text/javascript" src="bootstrap/js/jquery3.js"></script> 
	<script  type="text/javascript" src="bootstrap/js/toastr.js"></script>
	<script type="text/javascript" src="bootstrap/js/moment.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/validation.min.js"></script>
  <script type="text/javascript" src="bootstrap/js/bootstrapValidator.min.js"> </script>
<script type="text/javascript" src="bootstrap/js/daterangepicker.js"></script> 
<link rel="stylesheet" type="text/css" href="bootstrap/css/daterangepicker.css" /> 
<script src="bootstrap/js/bootstrap-session-timeout.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>

<script src="bootstrap/js/fileinput.min.js" type="text/javascript"></script>
<link href="bootstrap/css/fileinput.css" media="all" rel="stylesheet" type="text/css" />

<!-- los enlaces para menu multinivel -->
<!-- SmartMenus jQuery Bootstrap Addon CSS -->
<link href="bootstrap/css/jquery.smartmenus.bootstrap.css" rel="stylesheet">
<!-- SmartMenus jQuery plugin -->
<script type="text/javascript" src="bootstrap/js/jquery.smartmenus.js"></script>
<!-- SmartMenus jQuery Bootstrap Addon -->
<script type="text/javascript" src="bootstrap/js/jquery.smartmenus.bootstrap.js"></script>
<!-- fin de los enlaces para menu multinivel -->
<link href="bootstrap/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/mainJavaScript.js"></script>
<link type="text/css" href="css/master.css" rel="stylesheet" />

<!-- script type="text/javascript" src="ConsultarCtasAsoc.js"></script-->
<!-- script type="text/javascript" src="javascript.js"></script> -->

<script>
   $(document).ready(function()
   {
      $("#mostrarmodal").modal("show");
   });
</script>
<style>
    #mdialTamanio{
      width: 70% !important;
    }
  </style>
</head>

<body>
<script>
$.sessionTimeout({
        keepAliveUrl: 'keep-alive.html',
        logoutUrl: 'index.php',
        redirUrl: 'locked.php',
        warnAfter: ((5*60)*1000),  // 5 minutos
        redirAfter: ((35+(5*60))*1000), // 
        // warnAfter: (5000),  // segundos 15 
        // redirAfter: (10000), // 
        countdownBar: true,
        countdownMessage: 'Redireccionando en {timer} segundos...'
    });
</script>
<script type="text/javascript">
 $(document).ready(function() {
	toast.info('prueba');
});
</script>
	
<?php
{
	date_default_timezone_set('America/Caracas'); 
	include("funciones.php");
}
?>

<div class="body-container">
	<?php 
		menu_normal(); 
		if (!isset($_SESSION['saludo']))
			$_SESSION['saludo']=1;
		if ($_SESSION['saludo'] == 1)
		{
	?>
	<div class="container">
	    <div class='alert alert-success'>
			<button class='close' data-dismiss='alert'>&times;</button>
				<strong>Bienvenido <?php echo $_SESSION['user_session']; ?></strong>.
	    </div> 
	</div>
	<?php
			$_SESSION['saludo']=2;
		}
/*
<div class="container">
<table class="table">
<tr>
</td>
</tr>
</table>
    
    </div>
</div>

</div>
</div>


</div>

</div>
*/
?>
</div>
</body>
</html>

<?php

function pie()
{
	echo '<footer>
		Desarrollado por heros.com.ve || 2017-2018
	</footer>';
}

function buscarpermiso($valor,$permisomenu) {
	for ($i=0; $i<count($permisomenu);$i++) {
		if ($permisomenu[$i] == $valor) {
			return 1;}
	}
return 0;
}

function menu_normal()
{
?>
<!-- Navbar -->
<div class="navbar navbar-default" role="navigation">
  	<div class="navbar-header">
	    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
		    <span class="sr-only">Toggle navigation</span>
		    <span class="icon-bar"></span>
		    <span class="icon-bar"></span>
		    <span class="icon-bar"></span>
	    </button>
    	<a class="navbar-brand" href="#"><img src="imagenes/logo.jpg" width="50" height="50"></a>
  	</div>
  	<div class="navbar-collapse collapse">
    <!-- Left nav -->
    <ul class="nav navbar-nav"> <!-- navbar-right"> -->
		<!-- menu afiliados -->
		<li><a href="#">Afiliados<span class="caret"></span></a>
			<ul class="dropdown-menu">
				<li><a href="#">Actualizacion<span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="regti.php">Titulares</a></li>
						<li><a href="regbe.php">Beneficiarios</a></li>
						<li><a href="regpl.php">Planes</a></li>
						<li><a href="regem.php">Empresas</a></li>
						<li><a href="regpr.php">Promotor</a></li>
						<li class="divider"></li>
						<li><a href="reges1.php">Especialistas</a></li>
						<li><a href="regesp.php">Especialidades</a></li>
						<li class="divider"></li>
						<li><a href="regba.php">Bancos</a></li>
					</ul>
				</li>
				<li class="divider"></li>
				<li><a href="#">Reportes<span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="#">Titulares<span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="rept.php">Titulares</a></li>
								<li><a href="repb.php">Carga Familiar</a></li>
							</ul>
							<li><a href="estadocuenta.php">Estado de Cuenta</a></li>
							<li><a href="vencimiento.php">Vencimiento Polizas</a></li>
							<li><a href="#">Empresas<span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li><a href="rept.php">Solo Empresas</a></li>
									<li><a href="repb.php">Con Afiliados</a></li>
								</ul>
							</li>
						</li>
					</ul>
				</li>
			</ul>
	  	</li>
	    <!-- fin menu titulares -->
	    <!-- movimientos -->
		<li><a href="#">Movimientos<span class="caret"></span></a>
			<ul class="dropdown-menu">
				<li><a href="contra.php">Abrir Contratos</a></li>
				<li class="divider"></li>
				<li><a href="#">Actualizaciones<span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="solpre.php">Eventualidades de Titulares</a></li>
						<li><a href="abonom.php">Pagos de Titulares</a></li>
					</ul>
				</li>
				<li class="divider"></li>
				<li><a href="#">Reportes<span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="renovaciones.php">Renovaciones</a></li>
						<li><a href="#">Impresion de Carnets<span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="rep_carnet_lote.php">En Lote</a></li>
								<li><a href="rep_carnet_reimpresion.php">Reimpresion</a></li>
							</ul>
						</li>
						<li><a href="guiamed.php">Enviar Guia Medica</a></li>
					</ul>
				</li>
			</ul>
	  	</li>
	</ul>
    <ul class="nav navbar-nav navbar-right"> 
    	<li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
			<span class="glyphicon glyphicon-user"></span>&nbsp;Hola <?php echo $_SESSION['user_session']; ?>&nbsp;<span class="caret"></span></a>
            <ul class="dropdown-menu">
                <!-- <li><a href="#"><span class="glyphicon glyphicon-user"></span>&nbsp;View Profile</a></li> -->
            	<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Salir</a></li>
            </ul>
        </li>
    </ul>
</div>


	  <!-- fin menu prestamos -->

	  <!-- contabilidad 
		<li><a href="#">Contabilidad<span class="caret"></span></a>
			<ul class="dropdown-menu">
				<li><a href="#">Asientos<span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="altaasim.php">Simples</a></li>
						<li><a href="altaasigral.php">Generales</a></li>
						<li><a href="editasi2.php">Buscar/Editar</a></li>
					</ul>
				</li>
				<li><a href="#">Cuentas<span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="cuentas.php">Alta</a></li>
						<li><a href="reiniciar.php">Reiniciar</a></li>
						<li><a href="cam_fech.php">Cambio de Fecha</a></li>
						<li><a href="precie.php">Pre-Cierre</a></li>
						<li><a href="ciecon.php">Cierre Contable</a></li>
					</ul>
				</li>
				<li class="divider"></li>
				<li><a href="#">Reportes<span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="cueaso.php">Cuentas Asociadas</a></li>
						<li><a href="#">Balances<span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="balcom.php">Comprobaci&oacute;n</a></li>
								<li><a href="balgen.php">General</a></li>
								<li><a href="estres.php">Estado de Resultados</a></li>
								<li><a href="resdia.php">Resumen de Diario</a></li>
							</ul>
						</li>
						<li><a href="#">Otros<span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="diario.php">Diario</a></li>
								<li><a href="asidescu.php">Comprobantes Diferidos</a></li>
								<li><a href="#">Mayor Anal&iacute;tico<span class="caret"></span></a>
									<ul class="dropdown-menu">
										<li><a href="extractoctas3.php">A&nacute;o Actual</a></li>
										<li><a href="extractoctas_hist.php">A&nacute;os Anteriores</a></li>
									</ul>
								</li>
							</ul>
						</li>
					</ul>
				</li>
			</ul>
	  </li>
	  <!-- fin menu contabilidad -->

	  <!-- menu cheques --
		<li><a href="#">Cheques<span class="caret"></span></a>
			<ul class="dropdown-menu">
				<li><a href="#">Actualizar<span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="cheact.php">Cheques</a></li>
						<li><a href="chequeras.php">Chequeras</a></li>
						<li><a href="bancos.php">Bancos</a></li>
						<li><a href="conceptos.php">Conceptos</a></li>
						<li><a href="che_verif.php">Verificaci&oacute;n</a></li>
					</ul>
				</li>
				<li class="divider"></li>
				<li><a href="#">Reportes<span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="cheimpr.php">Impresi&oacute;n</a></li>
						<li><a href="che_rel.php">Relaci&oacute;n</a></li>
						<li><a href="che_compr.php">Generar comprobantes</a></li>
						<li><a href="conciliacion.php">Conciliaci&oacute;n</a></li>
					</ul>
				</li>
			</ul>
	  </li>
	  <!-- fin menu cheques -->
	  
	  <!-- menu activos fijos  --
		<li><a href="#">Activos Fijos<span class="caret"></span></a>
			<ul class="dropdown-menu">
				<li><a href="#">Actualizar<span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="lisact.php">Incorporaci&oacute;n</a></li>
						<li><a href="desact.php">Desincorporar</a></li>
						<li><a href="depact.php">Depreciaci&oacute;n</a></li>
						<li><a href="departamentos.php">Departamentos</a></li>
					</ul>
				</li>
				<li class="divider"></li>
				<li><a href="#">Reportes<span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a target=\"_blank\" href="lisactpdf.php">Activos Fijos</a></li>
						<li><a href="desactpdf.php">Desincorporados</a></li>
						<li><a href="listotpdf.php">Totalmente Depreciados</a></li>
					</ul>
				</li>
			</ul>
	  </li>
	  <!-- fin menu cheques -->
<?php
}


function ddls($hoy)
{
	$ddls= date('l', strtotime($hoy));
	return $ddls;
}

/*
function msgt()
{
           toastr.options = {
                closeButton: $('#closeButton').prop('checked'),
                debug: $('#debugInfo').prop('checked'),
                newestOnTop: $('#newestOnTop').prop('checked'),
                progressBar: $('#progressBar').prop('checked'),
                rtl: $('#rtl').prop('checked'),
                positionClass: $('#positionGroup input:radio:checked').val() || 'toast-top-right',
                preventDuplicates: $('#preventDuplicates').prop('checked'),
                onclick: null
	var $toast = toastr[shortCutFunction](msg, title); 
}
*/
