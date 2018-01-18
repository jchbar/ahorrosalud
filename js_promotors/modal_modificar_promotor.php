<form id="actualizarDatos">
<div class="modal fade" id="dataUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document" id="mdialTamanio">
    <div class="modal-content">
      	<div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        	<h4 class="modal-title" id="exampleModalLabel">Modificar Cuenta Contable</h4>
   		</div>
     	<div class="modal-body">
			<input type="hidden" class="form-control" id="id" name="id" required maxlength="10">
			<!-- modificar -->
		      	<div class="modal-body">
					<div class="form-group form-inline col-xs-12">
						<label for="rif" class="sr-only control-label">RIF </label>
						<input type="text" placeholder="rif" class="form-control" id="rif" name="rif" required value="" maxlength="10" size="10">
					</div>
					<div class="form-group form-inline col-xs-12">
						<label for="nombre" class="sr-only control-label">Nombre </label>
						<input type="text" placeholder="nombre" class="form-control" id="nombre" name="nombre" required value="" maxlength="100" size="70">
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
			    </div>
			<!-- fin modificar -->
      	</div>
				<div class="form-group"> <!-- necesario para la validacion -->
					<div class="col-md-9 col-md-offset-3">
						<div id="messagesm"></div>
					</div>
				</div>
      	<div class="modal-footer">
        	<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        	<button type="submit" class="btn btn-primary">Actualizar datos</button>
      	</div>
    </div>
  </div>
</div>
</form>
