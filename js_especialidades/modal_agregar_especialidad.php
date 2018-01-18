<form id="guardarDatos" enctype="multipart/form-data">
	<div class="modal fade" id="dataRegister" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
		<div class="modal-dialog" role="document" id="mdialTamanio">
			<div class="modal-content">
		    	<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        	<h4 class="modal-title" id="exampleModalLabel">Incluir Especialidad</h4>
		      	</div>
		      	<div class="modal-body">
					<div class="form-group form-inline col-xs-12">
						<label for="nombre" class="sr-only control-label">Identificacion de Especialidad </label>
						<input type="text" placeholder="Identificacion de Especialidad" class="form-control" id="nombre" name="nombre" required value="" maxlength="50" size="50">
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