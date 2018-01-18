<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors','1');
/*-----------------------
Autor: Obed Alvarado
http://www.obedalvarado.pw
Fecha: 12-06-2015
Version de PHP: 5.6.3
----------------------------*/

	# conectare la base de datos
	include_once('../funciones.php');
	$mensajes = $errors []= "";
	include_once('../dbconfig.php');
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	$action='ajax';
	if($action == 'ajax'){
		include '../pagination.php'; //incluir el archivo de paginación
		//las variables de paginación
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 8	; //la cantidad de registros que desea mostrar
		$adjacents  = 4; //brecha entre páginas después de varios adyacentes
		$offset = ($page - 1) * $per_page;
		//Cuenta el número total de filas de la tabla*/
		$estatus_pendiente=1;
		$consulta="select count(id_especialista) as numrows from especialistas ";
		// echo $consulta;
		$con=$db_con->prepare($consulta);
		$count_query   = $con->execute();
		$numrows=$con->fetch(PDO::FETCH_ASSOC);
		$numrows=$numrows['numrows'];
		$total_pages = ceil($numrows/$per_page);
		$reload = 'regt.php';
		//consulta principal para recuperar los datos
		$paginas="SELECT *, especialidades.nombre as especialidad, especialistas.activo as activoe, especialistas.nombre as medico,DATE_FORMAT(now(),'%m/%d/%Y') as hoy, DATE_FORMAT(date_add(now(),interval (365) day),'%m/%d/%Y') AS unano FROM especialistas, especialidades WHERE codigo_especialista = id_especialidad ORDER BY especialidad, especialistas.nombre LIMIT $offset,$per_page ";
		$con=$db_con->prepare($paginas);
		$query = $con->execute();
		// echo $paginas;
		
		if ($numrows>0){
			?>
<!-- busqueda -->
					<div id="resultado"></div>

					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<form class="form-inline" name="search" role="form" method="POST" onkeypress="return event.keyCode != 13;">
										<label for="busqueda">Su busqueda</label>
										<input id="busqueda" name="busqueda" type="text" class="form-control" placeholder="Quiero buscar..." autocomplete="off"/>
											<button type="button" class="btn btn-default btnSearch">
												<span class="glyphicon glyphicon-search"> </span>
											</button> 
								</form>
						</div>
					</div>
					<script>$(".tablesearch").hide();</script>

					<script type="text/javascript">
					    $(document).ready(function()
					    {
					        //comprobamos si se pulsa una tecla
					        $("#busqueda").keyup(function(e){
					                                       
					              //obtenemos el texto introducido en el campo de búsqueda
					              consulta = $("#busqueda").val();
					              //hace la búsqueda                                                                
					              $.ajax({
					                    type: "POST",
								url: "js_especialistas/php/search.php",
								data: { query: consulta },
					                    dataType: "html",
					                    beforeSend: function(){
					                    //imagen de carga
							//				$(".tablesearch").fadeOut(300);
					                    	$("#resultado").html("<img src='loader.gif' />");
					                    },
					                    error: function(){
					                    alert("error petición ajax");
					                    },
					                    success: function(data){                                                    
										//	$(".tablesearch").fadeIn(300);
										//	$(this).data('timer', setTimeout(search, 100));

						                    $("#resultado").empty(); $("#resultado").append(data);
							                    //seleccionamos de la lista
						                    var lista = $('div#resultado');
						                    lista.bind("mousedown", function (e) {
						                    e.metaKey = false;
						                    }).selectable({
							                    stop: function () {
								                    var result = $("input#busqueda");
								                    var fakeText = $('p.hidden-tips-text').empty();
								                    $(".ui-selected", this).each(function () {
									                    var index = $(this).text();
									                    fakeText.append((index) + "");
									                });
								                    result.val(fakeText.text());
						        				}
					    					});          
					                  	}
					              	});       
					        	});                                                    
					    });
					  </script>
<!-- fin busqueda -->
		<table class="table table-striped table-bordered table-hover" id="dataTables-example">
			  <thead>
				<tr>
				  <th>Nombre</th>
				  <th>Telefono(s)</th>
				  <th>Especialidad</th>
				  <th>Activo</th>
				  <th></th>
				</tr>
			</thead>
			<tbody>
			<?php
			while($row = $con->fetch(PDO::FETCH_ASSOC)){
				?>
				<tr>
					<td><?php echo substr($row['medico'],0,30);?></td>
					<td><?php echo $row['telefono'].'<br>'.$row['celular1'].'<br>'.$row['celular2']; ?></td>
					<td><?php echo substr($row['especialidad'],0,30); ?></td>
					<td>
					<?php 
						if ($row['activoe'] == 1)
							echo '<button type="button" class="btn btn-success btn-circle" ><i class="fa  fa-arrow-circle-up "></i></button>';
						else 
							echo '<button type="button" class="btn btn-default btn-circle" ><i class="fa f fa-arrow-circle-down"></i></button>';
					?>
					</td>

					<td>
					<?php
						echo '<button type="button" class="btn btn-info" data-toggle="modal" data-target="#dataUpdate" data-id = "'.$row['id_especialista'].'" data-nombre = "'.$row['medico'].'" data-rif = "'.$row['rif'].'"  data-direccion1 = "'.$row['direccion1'].'" data-direccion2 = "'.$row['direccion2'].'" data-telefono = "'.$row['telefono'].'" data-celular1 = "'.$row['celular1'].'" data-celular2 = "'.$row['celular2'].'" data-email = "'.$row['email'].'"  data-contacto_adm = "'.$row['contacto_adm'].'" data-telefono_contacto_adm = "'.$row['telefono_contacto_adm'].'" data-email_contacto_adm = "'.$row['email_adm'].'" data-codigo_especialista = "'.$row['codigo_especialista'].'"> <i class="glyphicon glyphicon-edit"></i> Modificar</button>';

						echo '<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#dataStatus" data-id="'.$row['id_especialista'].'" data-status="'.$row['activo'].'" data-nombre="'.$row['medico'].'"  data-rif="'.$row['rif'].'"><i class="glyphicon glyphicon-refresh "></i> Cambiar Status</button>';

						echo '<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#dataDelete" data-id="'.$row['id_especialista'].'" data-status="'.$row['activo'].'" data-nombre="'.$row['medico'].'" data-rif="'.$row['rif'].'" ><i class="glyphicon glyphicon-trash"></i> Eliminar</button>';
						?>
					</td>
						<?php 
						?>
					</td>
				</tr>
				<?php
			}
			?>
			</tbody>
		</table>
<!-- <form action="opciones.php" method="POST">
		<div class="col-md-6">
		<button class="btn btn-danger" value="Regresar" name="Regresar">Regresar al Men&uacute;</button>
		</div>
	</form> -->
		<div class="table-pagination pull-right">
			<?php echo paginate($reload, $page, $total_pages, $adjacents);?>
		</div>
		
			<?php
			
		} else {
			mensaje(array(
				"titulo"=>"Aviso!!!",
				"tipo"=>"warning",
				"texto"=>"<h4>Aviso!!!</h4> No hay datos para mostrar",
				));
		}
	}
		
?>
		<div class="table-pagination pull-left">
			<h3 class='text-right'>	
			<?php 
				$paginas="SELECT DATE_FORMAT(now(),'%m/%d/%Y') as hoy, DATE_FORMAT(date_sub(now(),interval (18*365) day),'%m/%d/%Y') AS los18";
				$con=$db_con->prepare($paginas);
				$query = $con->execute();
				$row = $con->fetch(PDO::FETCH_ASSOC);
				?> 
				<button type="button" class="btn btn-default" data-toggle="modal" data-target="#dataRegister" data-los18="<?php echo $row['los18']; ?>" data-hoy="<?php echo $row['hoy']; ?>"><i class='glyphicon glyphicon-plus'></i> Agregar</button>

			</h3>
		</div>
    <!-- Page-Level Demo Scripts - Tables - Use for reference 
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
    </script>
    -->
