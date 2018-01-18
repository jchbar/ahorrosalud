<form id="actualizarStatus">
<div class="modal fade" id="dataStatus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      	<div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        	<h4 class="modal-title" id="exampleModalLabel">Modificar Cuenta Contable</h4>
   		</div>
     	<div class="modal-body">
			<input type="hidden" class="form-control" id="id" name="id" required maxlength="10">
			<!-- modificar -->
			<div class="form-group form-inline col-xs-12">
			<!--
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
				<?php
				/*
					include_once('../dbconfig.php');
					if ($row['activo'] == 1)
						echo '<button type="button" class="btn btn-success btn-circle" ><i class="fa  fa-arrow-circle-up "></i></button>';
					else 
						echo '<button type="button" class="btn btn-default btn-circle" ><i class="fa f fa-arrow-circle-down"></i></button>';
						*/
				?>
				-->
			</div>
			<!-- fin modificar -->
      	</div>
      	<div class="modal-footer">
        	<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        	<button type="submit" class="btn btn-primary">Actualizar datos</button>
      	</div>
    </div>
  </div>
</div>
</form>
