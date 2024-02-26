<style type="text/css">
	
</style>
<script type="text/javascript">
	$(document).ready(function(){

          $("#tabladetalle").DataTable({
          	"order": [[4, "desc"]],
            "language": {
              "lengthMenu": "Mostrar _MENU_ registros por pagina",
              "zeroRecords": "No se encontraron resultados en su busqueda",
              "searchPlaceholder": "Buscar registros",
              "info": "Mostrando registros de _START_ al _END_ de un total de  _TOTAL_ registros",
              "infoEmpty": "No existen registros",
              "infoFiltered": "(filtrado de un total de _MAX_ registros)",
              "search": "Buscar:",
              "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
              },
            }

          });

          

        })
</script>
<body style="background-color: #F3F3F3; width: 95%; margin: 3px auto">
	<div class="container" style="background-color: #EEEEEE">
		<div class="col-md-12">
           	<h1 style="font-size: 40px; color:#337AB7"><i>Detalles por vehiculo <br> <?php echo $vehiculo[0]->marca; echo " ".$vehiculo[0]->modelo; echo " - ".$vehiculo[0]->dominio ?></i></h1>
        </div>
        <?php if ($this->session->userdata('rol') == 1 || $this->session->userdata('rol') == 2) {
            ?>
            <a href="<?php echo base_url()?>vehiculos/nuevo_detalle/<?php echo $vehiculo[0]->id?>" class="btn btn-primary btn-abrir-modal pull-right"><i class="glyphicon glyphicon-plus"></i> NUEVO DETALLE</a>
            <br>

        <?php } ?>
        <hr style="border: 0.5px solid black">

        <div class="row">
        	<div class="col-md-12">
            	<div class="table-responsive">
                	<table id="tabladetalle" class="table table-hover">
						<thead>
							
							<th>DETALLE</th>
                            <th>DEPENDENCIA</th>
                            <th>PERSONA</th>
                            <th>USUARIO</th>
							<th>FECHA</th>
						</thead>
						<tbody>
							<?php $id_detalle = 0; ?>
							<?php if (!empty($detalle_vehiculo)): ?>
				                <?php foreach ($detalle_vehiculo as $s): ?>
				                	<tr>
				                		
										<td><?php echo $s->descripcion; ?></td>
                                        <td><?php echo $s->dependencia; ?></td>
                                        <td><?php echo $s->nombre; ?></td>
                                        <td><?php echo $s->username; ?></td>
										<td><?php echo $s->fecha_detalle; ?></td>
									</tr>
				 				<?php endforeach ?>
				            <?php endif ?>
							
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</body>
<div class="modal fade" id="modal-add-detalle">
    <div class="modal-dialog">
        <div class="modal-content">
			<div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h2 class="modal-title" style="text-align: center; color: #337AB7">Nuevo detalle</h2>
            </div>
			<div class="modal-body">
				<div class="row">
                    <div class="col-md-12">
						<div class="panel panel-default">
							
							<div class="panel-body">
								<input type="hidden" name="id_vehiculo" id="id_vehiculo" value="<?php echo $vehiculo[0]->id; ?>">
								<div class="form-group">
                                        <label for="detalle">DETALLE:</label>
                                        <textarea name="detalle" class="form-control detalle" required="required" autocomplete="off"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>DEPENDENCIA:</label>
                                    <select class="form-control" name="dependencia" id="dependencia" required>
                                        <option>Seleccionar:</option>
                                        <?php foreach ($dependencias as $d): ?>
                                        <option value="<?php echo $d->id_dependencia;?>"><?php echo $d->dependencia;?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
							</div>
						</div>
					</div>
				</div>
 			</div>
 			
        </div>
    </div>
</div>
<script src="<?php echo base_url();?>public/sweetAlert/sweetAlert.min.js"></script>
<script src="<?php echo base_url();?>public/jquery/jquery-3.4.1.min.js"></script>
