function load(page)
{
	var parametros = {"action":"ajax","page":page};
	$("#loader").fadeIn('slow');
	$.ajax({
		url:'js_bancos/lasbancos.php',
		data: parametros,
		 beforeSend: function(objeto){
		$("#loader").html("<img src='loader.gif'>");
	},
	success:function(data){
			$(".outer_div").html(data).fadeIn('slow');
			$("#loader").html("");
		}
	})
}
/////////// incluir 
$('#dataRegister').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget) // Botón que activó el modal
/*
		$('input[name="inicio"]').daterangepicker({
				"singleDatePicker": true,
				"startDate":  button.data('hoy'),  // "11/07/2016", 
				"endDate": button.data('unano'), // "11/30/2016", 
				"minDate": button.data('hoy'), // "11/01/2016",
				"maxDate": button.data('unano') // "11/30/2016"
			}, function(start, end, label) {
			  // console.log("New date range selected: ' + startDate.format('YYYY-MM-DD') + ' to ' + endDate.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')");
			});
		$('input[name="final"]').daterangepicker({
				"singleDatePicker": true,
				"startDate":  button.data('hoy'),  // "11/07/2016", 
				"endDate": button.data('unano'), // "11/30/2016", 
				"minDate": button.data('hoy'), // "11/01/2016",
				"maxDate": button.data('unano') // "11/30/2016"
			}, function(start, end, label) {
			  // console.log("New date range selected: ' + startDate.format('YYYY-MM-DD') + ' to ' + endDate.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')");
			});
*/
		  var modal = $(this)
		  modal.find('.modal-title').text('Registro de Banco' )
		  modal.find('.modal-body #cuenta').text(nombre)
		  $('.alert').hide();//Oculto alert
})
$( "#guardarDatos" ).submit(function( event ) { // incluir
		var parametros = $(this).serialize();
//	  console.log(parametros);
			 $.ajax({
					type: "POST",
					url: "js_bancos/agregar_banco.php",
					data: parametros,
					beforeSend: function(objeto){
						$("#datos_ajax").html("Mensaje: Almacenando...");
					},
					success: function(datos){
						$("#datos_ajax").html(datos);
						$('#dataRegister').modal('hide');
						load(1);
				  	}
			});
		  event.preventDefault();
});
//////// fin incluir
///////// fin modificar	
$('#dataUpdate').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) // Botón que activó el modal
		  var id = button.data('id') // Extraer la información de atributos de datos
		  var nombre = button.data('nombre') // Extraer la información de atributos de datos
		  var cuenta = button.data('cuenta') 
		  var codigo_banco = button.data('codigo_banco')

		  var modal = $(this)
		  modal.find('.modal-title').text('Modificar Datos Banco : '+id +' '+nombre + cuenta)
		  modal.find('.modal-body #id').val(id)
		  modal.find('.modal-body #cuenta').val(cuenta)
		  modal.find('.modal-body #nombre').val(nombre)
		  modal.find('.modal-body #codigo_banco').val(codigo_banco)
		  $('.alert').hide();//Oculto alert
})
$( "#actualizarDatos" ).submit(function( event ) { // modificar
		var parametros = $(this).serialize();
			 $.ajax({
					type: "POST",
					url: "js_bancos/modificar_banco.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#datos_ajax").html("Mensaje: Actualizando...");
					  },
					success: function(datos){
					$("#datos_ajax").html(datos);
					$('#dataUpdate').modal('hide');
					
					load(1);
				  }
			});
		  event.preventDefault();
});
///////// fin modificar	
/////////// cambiar status
$('#dataStatus').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) // Botón que activó el modal
		  var id = button.data('id') // Extraer la información de atributos de datos
		  var nombre = button.data('nombre') // Extraer la información de atributos de datos
		  var status = button.data('status') 
		  var cuenta = button.data('cuenta') 
		  var modal = $(this)
		  
		  modal.find('#id').val(id)
		  modal.find('.modal-body #nombre').val(nombre) 
		  modal.find('.modal-body #status').val(status) 
		  modal.find('.modal-body #cuenta').val(cuenta) 
		  if (status == 1)
		  {
			  estadoA = 'Activo'
			  estadoN = 'Inactivo'
		  }
		  else
		  {
			  estadoA = 'Inactivo'
			  estadoN = 'Activo'
		  }

		  modal.find('.modal-title').text('Cambiar Status Banco ' +id + ' / '+nombre+ ' ' +cuenta +' de '+ estadoA +' -> '+estadoN)
		  /*
		  				<label for="condicion" class="control-label">Condicion Actual</label>
				<script type="text/javascript">
				if (status = 1) 
				{
					console.log('estatus '+status)
					document.write('<button type="button" class="btn btn-success btn-circle" ><i class="fa  fa-arrow-circle-up "></i></button>')
					console.log('a')
				}
				else
				{
					document.write('<button type="button" class="btn btn-default btn-circle" ><i class="fa f fa-arrow-circle-down"></i></button>')
					console.log('b')
				}
				</script>
				<label for="condicion" class="control-label">Cambiar a</label>
				<script type="text/javascript">
				if (status = 2) 
				{
					document.write('<button type="button" class="btn btn-success btn-circle" ><i class="fa  fa-arrow-circle-up "></i></button>')
					console.log('c')
				}
				else
				{
					console.log('d')
					document.write('<button type="button" class="btn btn-default btn-circle" ><i class="fa f fa-arrow-circle-down"></i></button>')
				}
				</script>

*/
})
$( "#actualizarStatus" ).submit(function( event ) { // modificar
		var parametros = $(this).serialize();
			 $.ajax({
					type: "POST",
					url: "js_bancos/cambiar_banco.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#datos_ajax_delete").html("Mensaje: Actualizando...");
					  },
					success: function(datos){
					$("#datos_ajax_delete").html(datos);
					$('#dataStatus').modal('hide');
					
					load(1);
				  }
			});
		  event.preventDefault();
});
/////////// fin cambiar status 
////// eliminar
$('#dataDelete').on('show.bs.modal', function (event) {
	var button = $(event.relatedTarget) // Botón que activó el modal
	var id = button.data('id') // Extraer la información de atributos de datos
	var rif = button.data('rif')
	var nombre = button.data('nombre') // Extraer la información de atributos de datos
	var modal = $(this)
		  
	modal.find('#id').val(id)
	modal.find('.modal-body #nombre').val(nombre) 
	modal.find('.modal-body #rif').text(rif)
	modal.find('.modal-title').text('Eliminar Banco' +id + ' / '+rif + ' / '+nombre)
})
$( "#eliminarDatos" ).submit(function( event ) {
	var parametros = $(this).serialize();
	$.ajax({
		type: "POST",
		url: "js_bancos/eliminar_banco.php",
		data: parametros,
		beforeSend: function(objeto){
			$(".datos_ajax_delete").html("Mensaje: Verificando...");
			},
			success: function(datos){
				$(".datos_ajax_delete").html(datos);
				$('#dataDelete').modal('hide');
				load(1);
			}
		});
		 event.preventDefault();
});
////// fin eliminar
