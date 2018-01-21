<?php
session_start();
include("home.php");
include_once('dbconfig.php');
$paginas="SELECT DATE_FORMAT(now(),'%m/%d/%Y') as hoy, DATE_FORMAT(date_add(now(),interval (365) day),'%m/%d/%Y') AS unano, DATE_FORMAT(date_sub(now(),interval (365*18) day),'%m/%d/%Y') AS los18, '01/01/1901' as inicio";
$con=$db_con->prepare($paginas);
$query = $con->execute();
$query = $con->fetch(PDO::FETCH_ASSOC);
// echo 'php '.$query['hoy'];
// hoyjs = <?php echo $query['hoy']; 
?>
<?php
$sqlf="SELECT DATE_FORMAT(now(),'%Y-%m-%d %H:%i') as hoy, CONCAT(SUBSTR(NOW(),1,5),'01-01') AS inicio, CONCAT(SUBSTR(NOW(),1,8),'01') AS minimo, date_sub(now(),interval (365*18) day) as l18, DATE_FORMAT(date_sub(now(),interval (365*18) day),'%m/%d/%Y') AS los18, '1901-01-01' as isiglo";
$stmt=$db_con->prepare($sqlf);
$stmt->execute();
$fechas=$stmt->fetch(PDO::FETCH_ASSOC);

$sql="SELECT nombre FROM `configuracion` WHERE parametro='Parentesco'";
$stmt=$db_con->prepare($sql);
$stmt->execute();
// $parentesco=$stmt->fetch(PDO::FETCH_ASSOC);
$elparentesco='<select style="width: 150px;" class="form-control" name="parentesco[]" id="parentesco[]" size="1">';
while($row = $stmt->fetch(PDO::FETCH_ASSOC))
	$elparentesco.='<option '.$row['nombre'].' value="'.trim($row['nombre']).'">'.trim($row['nombre']).' </option>'; 
$elparentesco.='</select>'; 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<script type="text/javascript" src="js_contrato/prevision.js"> </script>
</head>

<body>
<?php
/*
echo '
<script type="text/javascript">
console.log("prueba php");
console.log("hoy '.$query['hoy'].'");

				$(\'input[name="nacio"]\').daterangepicker({
				"singleDatePicker": true,
				"startDate":  button.data(\''.$query['hoy'].'\')
			}, function(start, end, label) {
			});
</script>';
*/
?>
<script type="text/javascript">
$(document).ready(function($) {
/*
//	$(function() {
//    	$('input[name="nacio"]').daterangepicker(
		$('input[name="nacio"]').daterangepicker({
				"singleDatePicker": true,
				"startDate":  button.data("<?php echo $query['hoy']; ?>"),  // "11/07/2016", 
				"endDate": button.data("<?php echo $query['unano']; ?>"), // "11/30/2016", 
				"minDate": button.data("<?php echo $query['hoy']; ?>"), // "11/01/2016",
				"maxDate": button.data("<?php echo $query['unano']; ?>") // "11/30/2016"
//				)
			});
	//when the Add Filed button is clicked
	// console.log(<php echo 'variale' ?>); 
*/
	$("#add").click(function (e) {
		//Append a new row of code to the "#items" div
		var variable = ''
		variable = '<div class="form-group form-inline col-xs-11">'
		variable += '<input type="text" placeholder="Cedula" class="form-control"  name="cedulas[] required value="" maxlength="11" size="11">'
		variable += '<input type="text" placeholder="Apellidos" class="form-control"  name="apellidos[] required value="" maxlength="20" size="15">';
		variable += '<input type="text" placeholder="Nombres" class="form-control"  name="nombres[] required value="" maxlength="20" size="15">'
		variable += '<input type="text" placeholder="Nacimiento" class="form-control" id="nacio[]" name="nacio[]" required maxlength="8" size="8">'
		variable += <?php echo "'".$elparentesco."'"; ?>

//////////
//		variable +='$(function() {$(\'input[name="nacio[]"]\').daterangepicker({"singleDatePicker": true,timePicker: false,"timePicker24Hour": false,"applyLabel": "Guardar","cancelLabel": "Cancelar","fromLabel": "Desde","toLabel": "Hasta",locale: {format: "YYYY-MM-DD",daysOfWeek: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi","Sa"],monthNames: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],customRangeLabel: "Personalizado",applyLabel: "Aplicar",fromLabel: "Desde",toLabel: "Hasta",},"startDate": "<php echo $fechas["minimo"]?>","endDate": "<php echo $fechas["hoy"]?>", "minDate": "<php echo $fechas["inicio"]?>","maxDate": "<php echo $fechas["hoy"]?>" });});'
//////////
		variable += '<button class="btn btn-warning delete">Eliminar<i class="glyphicon glyphicon-trash"></i></button></div>'
		$("#items").append(variable)
		});
	$("body").on("click", ".delete", function (e) {
		$(this).parent("div").remove();
	});
	$(".scroll").click(function(event){		
		event.preventDefault();
		$('html,body').animate({scrollTop:$(this.hash).offset().top},1200);
	});

	//  seleccion empresa
	$("#selectAliado").change(function()
	{
	  var id = $(this).find(":selected").val();
	//  $('#capa').load('tickets/seleccionaliado.php?action='+id);

      $('#dir1emp').prop("disabled", false);
      $('#dir2emp').prop("disabled", false);
      $('#alias').prop("disabled", false);
	  var dataString = 'action='+ id;
	  // alert(dataString);
	  $.ajax(
	  {
	    url: 'js_contrato/seleccion_empresa.php',
	    data: dataString,
	    dataType: "json", // tipo de datos a enviar
	    type: "get", // metodo de petición
	   // cache: false,
	   success: function(resultado)
	   {
	   		if (resultado['activo'] == 1)
	   		{
			    $("#dir1emp").val(resultado['direccion1']);
			    $("#dir2emp").val(resultado['direccion2']);
			    $("#alias").val(resultado['alias']);
			    $('#dir1emp').prop("disabled", true);
		    	$('#dir2emp').prop("disabled", true);
		      	$('#alias').prop("disabled", true);
		    }
		    else
		    {
			    $("#dir1emp").val('');
			    $("#dir2emp").val('');
			    $("#alias").val('');
			    $('#dir1emp').prop("disabled", false);
		    	$('#dir2emp').prop("disabled", false);
		      	$('#alias').prop("disabled", false);
		    }

	    if (resultado['saldo'] > 0)
	    {
	      $.getJSON("tickets/cargartarifas.php")
	        .done( function( data )
	        {
	          var existen=0;
	            // console.log(data);
	          for (i=0; i < lineas ; i++ )
	          {
	            $("#tablaTarifas tbody tr").remove();
	          }
	          $.each(data, function()
	          {
	            lineas++;
	            alto=150;
	            ancho=150;
	            maximo = 2000;
	            var col1='<td><span class="idtarifa">'+this.id+'</span></td>';
	            var col2='<td><span class="descripcion">'+this.descripcion+'</span></td><td><div class="row"><img class="img-responsive" src="img/'+this.imagen+'" width="'+ancho+'" heigth="'+alto+'"></div></td>';
	            var col3='<td><span class=""><span class="verprecio">'+numeral(this.precio).format('0,00.00')+'</span></span></td>';
	            
	            var col4= '<td><select class="escogercantidad" id="'+this.id+'"><option value="SEL">[seleccione]';
	            for (i=16; i< maximo; (i*=2) )
	            {
	             // console.log("valor i="+i);
	              col4=col4+'</option><option value='+i+'>'+i;
	            }
	            col4+='</select></td>';
	            var col5='<td><span class="h3"><span class="versubtotal">0.00</span></span></td>';
	            var col6='<td style="display:none;""><span class=""><span class="referencia">'+this.referencia+'</span></span></td>';
	            var col7='<td><span class=""><span class="peaje_nombre">'+this.peaje_nombre+'</span></span></td>';
	            var col8='<td style="display:none;"><span class=""><span class="id_peaje">'+this.peaje_id+'</span></span></td>';
	            var row='<tr>'+col7+col1+col2+col3+col4+col5+col6+col8+'</tr>';
	            var preciotarifa=numeral($(this).closest('tr').find('.verprecio').text()).format('0');
	            if (this.precio > 0)
	            {
	              lineas--;
	              $("#tablaTarifas tbody").append(row);
	              existen = 1;
	            }
	            // var cantidad= numeral($("#"+valores[0]).val()).format('0');
	            // var subtotal= parseInt(preciotarifa) * parseInt(cantidad);
	            // var total= numeral($('#spanTotal').text()).format('0');
	            //alert(parseInt(preciotarifa) * parseInt(cantidad));
	            //$(this).closest('tr').find('.versubtotal').text(numeral(subtotal).format('0,00.00'));

	            //$('#spanTotal').text(numeral(total).add(subtotal).format('0,00.00'));
	            //$("body").append($("<label>").text(this.precio));
	          });
	          if (existen == 0)
	          {
	            var col1='<td align="center" colspan="7"><span class=""><span"><strong><h1>NO HAY TARIFAS DEFINIDAS CON SUS FECHAS</span></span></strong></h1></td>';
	            var row='<tr>'+col1+'</tr>';
	            $("#tablaTarifas tbody").append(row);
	          }
	        })
	        .fail(function( jqxhr, textStatus, error )
	        {
	          console.log( "Error cargando tarifas: " + textStatus + " - Detail: " + error );
	        });
	    }
	    else
	    {
	      $.getJSON("tickets/cargartarifas.php")
	        .done( function( data )
	        {
	          // console.log('removeer' +data);
	          $.each(data, function()
	          {
	            $("#tablaTarifas tbody tr").remove();
	          }
	        );
	        });
	    }
	  }
	})
	}); 
	// fin seleccion empresa


});


</script>
<div class="body-container">
	<form id="guardarDatos" enctype="multipart/form-data">
	<!--      form id="envioForm" method="post" class="form-horizontal" role="form" enctype="application/x-www-form-urlencoded"> -->
	<div class="ontainer">
		<div class="row">
			<div class="col-xs-12" class="text-center btn-inverse">
				<fieldset>
					<legend class="text-center btn-info">Datos de Titular</legend>
					<div class="form-group form-inline col-xs-12">
						<input type="text" placeholder="Cedula" class="form-control" id="cedula" name="cedula" required value="" maxlength="11" size="11"">
						<input type="text" placeholder="Apellidos" class="form-control" id="apellido" name="apellido" required value="" maxlength="20" size="20"">
						<input type="text" placeholder="Nombres" class="form-control" id="nombre" name="nombre" required value="" maxlength="20" size="20"">
						<input type="text" placeholder="Nacimiento" class="form-control" id="nace" name="nace" required maxlength="8" size="8">
			                <script type="text/javascript">
			                $(function() {
			                    $('input[name="nace"]').daterangepicker(
			                    {
									"singleDatePicker": true,
			                        timePicker: false,
			                        "timePicker24Hour": false,
			                         "applyLabel": "Guardar",
						            "cancelLabel": "Cancelar",
						            "fromLabel": "Desde",
						            "toLabel": "Hasta",
			                        locale: {
			                            format: 'YYYY-MM-DD',
			                        daysOfWeek: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi','Sa'],
			                        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
			                        customRangeLabel: 'Personalizado',
			                        applyLabel: 'Aplicar',
			                        fromLabel: 'Desde',
			                        toLabel: 'Hasta',
			                    },
			                        "startDate": "<?php echo $fechas['l18']?>",
			                        "endDate": "<?php echo $fechas['l18']?>", 
			                        "minDate": "<?php echo $fechas['isiglo']?>",
			                        "maxDate": "<?php echo $fechas['l18']?>" 
			                    }
			                    );
			                });
			                </script>
					</div>
					<div class="form-group form-inline col-xs-12">
						<label for="direccion1" class="sr-only control-label">Direcci&oacute;n 1 </label>
						<input type="text" placeholder="direccion1" class="form-control" id="direccion1" name="direccion1" required value="" maxlength="60" size="60">
						<label for="direccion2" class="sr-only control-label">Direcci&oacute;n 2 </label>
						<input type="text" placeholder="direccion2" class="form-control" id="direccion2" name="direccion2" required value="" maxlength="60" size="60">
						<label for="estado" class="sr-only control-label">Estado </label>
						<?php
								include_once('../dbconfig.php');
								$comando="select estado from estados order by estado";
								$con=$db_con->prepare($comando);
								$con->execute();
								echo '<select class="form-control" name="estado" id="estado" size="1">';
								while($row = $con->fetch(PDO::FETCH_ASSOC))
									echo '<option '.$row['estado'].' value="'.$row['estado'].'">'.$row['estado'].' </option>'; 
								echo '</select>'; 
						?>
					</div>
					<div class="form-group form-inline col-xs-12">
						<div class="input-group form-inline">
							<label for="telefono" class="sr-only control-label">Tel&eacute;fono</label>
							<input type="text" placeholder="Telefono" class="form-control" id="telefono" name="telefono" required value="" maxlength="15" size="15">
			                <span class="input-group-addon">
			  		        	<span class="glyphicon glyphicon-phone-alt"></span>
			                </span>
			        	</div>
						<div class="input-group form-inline">
							<label for="celular1" class="sr-only control-label">Celular 1</label>
							<input type="text" placeholder="Celular 1" class="form-control" id="celular1" name="celular1" required value="" maxlength="15" size="15">
			                <span class="input-group-addon">
			  		        	<span class="glyphicon glyphicon-phone"></span>
			                </span>
			        	</div>
						<div class="input-group form-inline">
							<label for="celular2" class="sr-only control-label">Celular 2</label>
							<input type="text" placeholder="Celular 2" class="form-control" id="celular2" name="celular2" required value="" maxlength="15" size="15">
			                <span class="input-group-addon">
			  		        	<span class="glyphicon glyphicon-phone"></span>
			                </span>
			        	</div>
					</div>
					<div class="form-group form-inline col-xs-12">
						<div class="input-group form-inline">
							<label for="email" class="sr-only control-label">email</label>
							<input type="text" placeholder="email" class="form-control" id="email" name="email" required value="" maxlength="100" size="100">
			                <span class="input-group-addon">
			  		        	<span class="glyphicon glyphicon-envelope"></span>
			                </span>
			        	</div>
			        </div>
					<div class="form-group form-inline col-xs-12">
						<div class="input-group form-inline">
							<label for="profesion" class="sr-only control-label">Profesi&oacute;n</label>
							<input type="text" placeholder="Profesi&oacute;n" class="form-control" id="profesion" name="profesion" required value="" maxlength="15" size="15">
			        	</div>
						<div class="input-group form-inline">
							<label for="cargo" class="sr-only control-label">Cargo</label>
							<input type="text" placeholder="Cargo" class="form-control" id="cargo" name="cargo" required value="" maxlength="15" size="15">
			        	</div>
						<div class="input-group form-inline">
		                  <label for="selectAliado">Empresa </label>
		                  <select id="selectAliado" name="selectAliado">
		                  <?php
		                      $comando="SELECT *  FROM empresas WHERE activo = :activo order by nombre";
		                      $con=$db_con->prepare($comando);
		                      $con->execute(array(
		                        ":activo"=>1,
		                        ));
		                      echo '<option value="">Seleccione...:</option>';

		                      while($row = $con->fetch(PDO::FETCH_ASSOC))
		                        echo '<option value="'.$row['id_empresa'].'">'.$row['rif'].'->'.$row['alias'].' </option>'; 
		                      echo '</select>'; 
		                    ?>
			        	</div>
					</div>
					<div class="form-group form-inline col-xs-12">
						<div class="input-group form-inline">
							<input type="hidden" placeholder="Empresa" class="form-control" id="activo" name="activo" required value="0">
							<label for="alias" class="sr-only control-label">Empresa</label>
							<input type="text" placeholder="Empresa" class="form-control" id="alias" name="alias" required value="" maxlength="60" size="30">
			        	</div>
						<div class="input-group form-inline">
							<label for="dir1emp" class="sr-only control-label">Dir1.Empr</label>
							<input type="text" placeholder="Dir1.Empr" class="form-control" id="dir1emp" name="dir1emp" required value="" maxlength="60" size="20">
			        	</div>
						<div class="input-group form-inline">
							<label for="dir2emp" class="sr-only control-label">Dir2.Empr</label>
							<input type="text" placeholder="Dir2.Empr" class="form-control" id="dir2emp" name="dir2emp" required value="" maxlength="60" size="20">
			        	</div>
			        </div>
					</fieldset>
			</div>
		</div>

		<div class="row">
			<div class="col-xs-11" class="text-center">
				<!-- form action='contra.php?accion=Listado' name='form1' method='post' class='form-inline'> -->
					<fieldset class="text-center btn-info">Datos para Beneficiarios  &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; 
					<button class="btn btn-default" id="add">Agregar Beneficiario <i class='glyphicon glyphicon-plus'></i></button></fieldset>
					<div id="items">
						<div class="form-group form-inline col-xs-12">
							<div><input type="text" placeholder="Apellidos" class="form-control" id="apellidosb" name="apellidosb[] required value="" maxlength="20" size="20"">
							<input type="text" placeholder="Nombres" class="form-control" id="nombresb" name="nombresb[] required value="" maxlength="20" size="20"">
							<input type="text" placeholder="Cedula" class="form-control" id="cedulasb" name="cedulasb[] required value="" maxlength="11" size="11"">
							<input type="text" placeholder="Nacimiento" class="form-control" id="naciob[]" name="naciob[]" required maxlength="8" size="8">
							<?php
								echo $elparentesco;
							?>
			                <script type="text/javascript">
			                $(function() {
			                    $('input[name="naciob[]"]').daterangepicker(
			                    {
									"singleDatePicker": true,
			                        timePicker: false,
			                        "timePicker24Hour": false,
			                         "applyLabel": "Guardar",
						            "cancelLabel": "Cancelar",
						            "fromLabel": "Desde",
						            "toLabel": "Hasta",
			                        locale: {
			                            format: 'YYYY-MM-DD',
			                        daysOfWeek: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi','Sa'],
			                        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
			                        customRangeLabel: 'Personalizado',
			                        applyLabel: 'Aplicar',
			                        fromLabel: 'Desde',
			                        toLabel: 'Hasta',
			                    },
			                        "startDate": "<?php echo $fechas['minimo']?>",
			                        "endDate": "<?php echo $fechas['hoy']?>", 
			                    //    "minDate": "<?php echo $fechas['inicio']?>",
			                        "maxDate": "<?php echo $fechas['hoy']?>" 
			                    }
			                    );
			                });
			                </script>
			            </div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

				<div class="form-group"> <!-- necesario para la validacion -->
					<div class="col-md-9 col-md-offset-3">
						<div id="messages"></div>
					</div>
				</div>

<?php pie(); ?>
</body>
</html>
