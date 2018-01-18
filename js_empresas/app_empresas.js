function load(page)
{
	var parametros = {"action":"ajax","page":page};
	$("#loader").fadeIn('slow');
	$.ajax({
		url:'js_empresas/lasempresas.php',
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
		  modal.find('.modal-title').text('Registro de Empresa' )
		  modal.find('.modal-body #rif').text(rif)
		  modal.find('.modal-body #nombre').text(nombre)
		  modal.find('.modal-body #alias').text(alias)
		  modal.find('.modal-body #direccion1').text(direccion1)
		  modal.find('.modal-body #direccion2').text(direccion2)
		  modal.find('.modal-body #telefono').text(telefono)
		  modal.find('.modal-body #celular1').text(celular1)
		  modal.find('.modal-body #celular2').text(celular2)
		  modal.find('.modal-body #email').text(email)
		  modal.find('.modal-body #contacto').text(contacto)
		  modal.find('.modal-body #telefono_contacto').text(telefono_contacto)
		  modal.find('.modal-body #email_contacto').text(email_contacto)
		  modal.find('.modal-body #contacto_adm').text(contacto_adm)
		  modal.find('.modal-body #telefono_contacto_adm').text(telefono_contacto_adm)
		  modal.find('.modal-body #email_contacto_adm').text(email_contacto_adm)
//		  modal.find('.modal-body #estado').text(estado)
		  $('.alert').hide();//Oculto alert
})
$( "#guardarDatos" ).submit(function( event ) { // incluir
		var parametros = $(this).serialize();
//	  console.log(parametros);
			 $.ajax({
					type: "POST",
					url: "js_empresas/agregar_empresa.php",
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
		  var rif = button.data('rif') 
		  var alias = button.data('alias')
		  var direccion1 = button.data('direccion1')
		  var direccion2 = button.data('direccion2')
		  var telefono = button.data('telefono')
		  var celular1 = button.data('celular1')
		  var celular2 = button.data('celular2')
		  var email = button.data('email')
		  var contacto = button.data('contacto')
		  var telefono_contacto = button.data('telefono_contacto')
		  var email_contacto = button.data('email_contacto')
		  var contacto_adm = button.data('contacto_adm')
		  var telefono_contacto_adm = button.data('telefono_contacto_adm')
		  var email_contacto_adm = button.data('email_contacto_adm')

		  var modal = $(this)
		  modal.find('.modal-title').text('Modificar Datos Empresa : '+id +' '+nombre)
		  modal.find('.modal-body #id').val(id)
		  modal.find('.modal-body #rif').val(rif)
		  modal.find('.modal-body #nombre').val(nombre)
		  modal.find('.modal-body #alias').val(alias)
		  modal.find('.modal-body #direccion1').val(direccion1)
		  modal.find('.modal-body #direccion2').val(direccion2)
		  modal.find('.modal-body #telefono').val(telefono)
		  modal.find('.modal-body #celular1').val(celular1)
		  modal.find('.modal-body #celular2').val(celular2)
		  modal.find('.modal-body #email').val(email)
		  modal.find('.modal-body #contacto').val(contacto)
		  modal.find('.modal-body #telefono_contacto').val(telefono_contacto)
		  modal.find('.modal-body #email_contacto').val(email_contacto)
		  modal.find('.modal-body #contacto_adm').val(contacto_adm)
		  modal.find('.modal-body #telefono_contacto_adm').val(telefono_contacto_adm)
		  modal.find('.modal-body #email_contacto_adm').val(email_contacto_adm)
		  $('.alert').hide();//Oculto alert
})
$( "#actualizarDatos" ).submit(function( event ) { // modificar
		var parametros = $(this).serialize();
			 $.ajax({
					type: "POST",
					url: "js_empresas/modificar_empresa.php",
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
		  var modal = $(this)
		  
		  modal.find('#id').val(id)
		  modal.find('.modal-body #nombre').val(nombre) 
		  modal.find('.modal-body #status').val(status) 
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

		  modal.find('.modal-title').text('Cambiar Status Empresa ' +id + ' / '+nombre+ ' de '+ estadoA +' -> '+estadoN)
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
					url: "js_empresas/cambiar_empresa.php",
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
	modal.find('.modal-title').text('Eliminar Empresa' +id + ' / '+rif + ' / '+nombre)
})
$( "#eliminarDatos" ).submit(function( event ) {
	var parametros = $(this).serialize();
	$.ajax({
		type: "POST",
		url: "js_empresas/eliminar_empresa.php",
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
