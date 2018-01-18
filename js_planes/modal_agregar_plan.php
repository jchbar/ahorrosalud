<form id="guardarDatos" enctype="multipart/form-data">
	<div class="modal fade" id="dataRegister" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
		<div class="modal-dialog" role="document" id="mdialTamanio">
			<div class="modal-content">
		    	<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        	<h4 class="modal-title" id="exampleModalLabel">Incluir Plan</h4>
		      	</div>
		      	<div class="modal-body">
					<div class="form-group form-inline col-xs-12">
					<br>
						<label for="nombre" class="sr-only control-label">Identificacion del Plan </label>
						<input type="text" placeholder="Identificacion del Plan" class="form-control" id="nombre" name="nombre" required value="" maxlength="20" size="20">
					</div>
					<div class="form-group form-inline">
						<label for="tipo" class="control-label">Tipo de Plan </label>
						<?php
								include_once('../dbconfig.php');
								$comando="select nombre from configuracion where parametro = 'Plan' order by parametro";
								echo '<select class="form-control" name="tipo" id="tipo" size="1">';
								$con=$db_con->prepare($comando);
								$con->execute();
								while($row = $con->fetch(PDO::FETCH_ASSOC))
									echo '<option '.$row['nombre'].' selected="selected"  value="'.$row['nombre'].'">'.$row['nombre'].' </option>'; 
								echo '</select>'; 
						?>
						<div class="input-group form-inline">
							<label for="inicio" class="sr-only control-label">Inicia el</label>
							<input type="text" placeholder="Inicia el" class="form-control" id="inicio" name="inicio" required maxlength="8" size="8">
			                <span class="input-group-addon">
			  		        	<span class="glyphicon glyphicon-calendar"></span>
			                </span>
						</div>
						<div class="input-group form-inline">
							<label for="final" class="sr-only control-label">Finaliza el</label>
							<input type="text" placeholder="Finaliza el" class="form-control" id="final" name="final" required maxlength="8" size="8">
			                <span class="input-group-addon">
			  		        	<span class="glyphicon glyphicon-calendar"></span>
			                </span>
						</div>
					</div>
					<div class="form-group form-inline col-xs-12">
						<label for="monto" class="sr-only control-label">Inversion Bs. </label>
						<input type="text" placeholder="Inversion Bs. " class="form-control" id="monto" name="monto" required value="" maxlength="10" size="10">
					</div>
		    	</div>
				<div class="form-group"> <!-- necesario para la validacion -->
					<div class="col-md-9 col-md-offset-3">
						<div id="messages"></div>
					</div>
				</div>
			    <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			        <button type="submit" class="btn btn-primary">Guardar datos</button>
			    </div>
		    </div>
		</div>
	</div>
</form>