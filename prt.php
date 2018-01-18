<?php
session_start();
$mostrarerrores=0;
if ($mostrarerrores == 1)
{
	error_reporting(E_ALL);
	ini_set('display_errors','1');
}
date_default_timezone_set('America/Caracas'); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>.:| Ahorro Salud |:.</title>
<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen"> 
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="bootstrap/css/bootstrap-datetimepicker.min.css" rel="stylesheet">  
        <link href="bootstrap/css/toastr.css" rel="stylesheet" type="text/css" />

<!-- script type="text/javascript" src="bootstrap/js/jquery.min.js"></script> -->
<script type="text/javascript" src="bootstrap/js/jquery3.js"></script> 
	<script  type="text/javascript" src="bootstrap/js/toastr.js"></script>
	<script type="text/javascript" src="bootstrap/js/moment.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/validation.min.js"></script>
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

<!-- script type="text/javascript" src="ConsultarCtasAsoc.js"></script-->
<!-- script type="text/javascript" src="javascript.js"></script> -->

<script>
/*
   $(document).ready(function()
   {
      $("#mostrarmodal").modal("show");
   });
*/
</script>
<style>
    #mdialTamanio{
      width: 70% !important;
    }
  </style>
</head>

<body>
<script>
/*
$.sessionTimeout({
        keepAliveUrl: 'keep-alive.html',
        logoutUrl: 'index.php',
        redirUrl: 'locked.php',
        warnAfter: ((5*60)*1000),  // 5 minutos
        redirAfter: ((25+(5*60))*1000), // 
        // warnAfter: (5000),  // segundos 15 
        // redirAfter: (10000), // 
        countdownBar: true,
        countdownMessage: 'Redireccionando en {timer} segundos...'
    });
*/
</script>
<script type="text/javascript">
/*
 $(document).ready(function() {
	toastr.info('prueba');
});
*/
</script>
	
<div class="body-container">
<div class="container">
    <div class='alert alert-success'>
		<button class='close' data-dismiss='alert'>&times;</button>
			<strong>Bienvenido <?php echo $_SESSION['user_session']; ?></strong>.
    </div>
</div>
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
<script type="text/javascript">
    toastr.info('prueba')
    alert('pp')
</script>
<?php echo "<script type='text/javascript'>toastr.info('Your email is not registered, please check.');</script>"; ?>
</body>
</html>
