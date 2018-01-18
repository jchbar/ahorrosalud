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
						<label for="codigo_banco" class="sr-only control-label">Banco </label>
						<?php
								include_once('../dbconfig.php');
								$comando="select bnkcd, bankt from entidades order by bankt";
								$con=$db_con->prepare($comando);
								$con->execute();
								echo '<select class="form-control" name="codigo_banco" id="codigo_banco" size="1">';
								while($row = $con->fetch(PDO::FETCH_ASSOC))
									echo '<option '.$row['bkncd'].' value="'.$row['bnkcd'].'">'.$row['bankt'].' </option>'; 
								echo '</select>'; 
						?>
						<label for="cuenta" class="sr-only control-label">Nro de Cuenta </label>
						<input type="text" placeholder="cuenta" class="form-control" id="cuenta" name="cuenta" required value="" maxlength="20" size="20">
			        </div>
					<div class="form-group form-inline col-xs-12">
						<label for="nombre" class="sr-only control-label">A Nombre de </label>
						<input type="text" placeholder="A nombre de" class="form-control" id="nombre" name="nombre" required value="" maxlength="100" size="70">
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
