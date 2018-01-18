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
		$consulta="select count(id_plan) as numrows from planes order by final desc ";
		// echo $consulta;
		$con=$db_con->prepare($consulta);
		$count_query   = $con->execute();
		$numrows=$con->fetch(PDO::FETCH_ASSOC);
		$numrows=$numrows['numrows'];
		$total_pages = ceil($numrows/$per_page);
		$reload = 'regt.php';
		//consulta principal para recuperar los datos
		$paginas="SELECT *, DATE_FORMAT(now(),'%m/%d/%Y') as hoy, DATE_FORMAT(date_add(now(),interval (365) day),'%m/%d/%Y') AS unano, DATE_FORMAT(inicio,'%m/%d/%Y') as inicio, DATE_FORMAT(final,'%m/%d/%Y') as final FROM planes ORDER BY id_plan LIMIT $offset,$per_page ";
		$con=$db_con->prepare($paginas);
		$query = $con->execute();
		// echo $paginas;
		
		if ($numrows>0){
			?>
<!-- busqueda --
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
								url: "js_titular/php/search.php",
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
				  <th>Identificacion del Plan</th>
				  <th>Inicia</th>
				  <th>Finaliza</th>
				  <th>Costo</th>
				  <th>Activo</th>
				  <th></th>
				</tr>
			</thead>
			<tbody>
			<?php
			while($row = $con->fetch(PDO::FETCH_ASSOC)){
				?>
				<tr>
					<td><?php echo substr($row['nombre_plan'],0,20);?></td>
					<td><?php echo substr($row['inicio'],0,20);?></td>
					<td><?php echo substr($row['final'],0,20);?></td>
					<td align="pull-right"><?php echo number_format($row['monto'],2,'.',',');?>
					<td>
					<?php 
						if ($row['activo'] == 1)
							echo '<button type="button" class="btn btn-success btn-circle" ><i class="fa  fa-arrow-circle-up "></i></button>';
						else 
							echo '<button type="button" class="btn btn-default btn-circle" ><i class="fa f fa-arrow-circle-down"></i></button>';
					?>
					</td>

					<td>
						<button type="button" class="btn btn-info" data-toggle="modal" data-target="#dataUpdate" data-id="<?php echo $row['id_plan']?>" data-nombre="<?php echo $row['nombre_plan']?>" data-inicio="<?php echo $row['inicio']?>" data-final="<?php echo $row['final']?>" data-monto="<?php echo $row['monto']?>" ><i class='glyphicon glyphicon-edit'></i> Modificar</button>

						<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#dataStatus" data-id="<?php echo $row['id_plan']?>" data-status="<?php echo $row['activo']?>" data-nombre="<?php echo $row['nombre_plan']?>"><i class='glyphicon glyphicon-refresh '></i> Cambiar Status</button>

						<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#dataDelete" data-id="<?php echo $row['id_plan']?>" data-status="<?php echo $row['activo']?>" data-nombre="<?php echo $row['nombre_plan']?>" ><i class='glyphicon glyphicon-trash'></i> Eliminar</button>
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
