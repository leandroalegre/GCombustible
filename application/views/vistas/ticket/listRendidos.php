	
<link rel="stylesheet" href="<?php echo base_url();?>public/bootstrap/css/bootstrap-select.min.css"/>
<script type="text/javascript">
	$(document).ready(function(){
		$("#tablaRendidos").DataTable({
			"order":[5, "desc"],
			"pageLength": 10,
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
		})

	})


</script>

<body style="width: 95%; margin: 3px auto">
	<div class="container">
		<div class="panel-default">
			<div class="panel-heading">
				<h1>LISTADO DE TICKETS RENDIDOS</h1>
			</div>
			<div class="panel-body">
				<div class="container">
					<div class="row">
					<form method="POST" target="_blank" action="<?php base_url()?>listPorExpediente">
					<div class="col-md-1 col-sm-2 col-xs-12">
						<h4>Expediente: </h4>
					</div>
				<div class="col-md-3 col-sm-4 col-xs-12" style="margin-left: 1%">
				<div class="row-fluid">
		<select class="selectpicker" name="expediente" data-show-subtext="true" data-live-search="true">
				<option>Seleccionar:</option>
					<?php foreach ($expedientes as $e): ?>
				<option value="<?php echo $e->expediente;?>"><?php echo $e->expediente;?></option>
					<?php endforeach ?>
		</select>
				</div>
				</div>
					<div class="col-md-1 col-sm-2 col-xs-12">
						<button class="btn btn-primary">Buscar</button>
					</div>
						</form>
						<div class="col-md-4"></div>
						<div class="col-md-2"><?php if ($this->session->userdata('rol') == 6) { ?>
							<a href="<?php echo base_url();?>Ticket/rendir"><button class="btn btn-primary btn-lg"><i class="glyphicon glyphicon-plus"></i> RENDIR TICKET</button></a>
							<?php } ?></div>
						</div>
					</div>



					<br>
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-striped table-hover" id="tablaRendidos">
									<thead style="background-color: #3175B8; color: white">
										<th>TICKET</th>
										<th>PERSONA</th>
										<TH>DOMINIO</TH>
										<TH>IMPORTE</TH>
										<th>SECRETARIA</th>
										<TH>FECHA</TH>
										<TH>EXPEDIENTE</TH>
										<TH>INFO</TH>
									</thead>
									<tbody>
										<tr>
											<?php if (!empty($rendidos)){ ?>
												<?php foreach ($rendidos as $r ): ?>
													<td><?php echo $r->num; ?></td>
													<td><?php echo $r->per; ?></td>
													<td><?php echo $r->ve; ?></td>
													<td><?php echo "$". $r->imp; ?></td>
													<td><?php echo $r->sec; ?></td>
													<td><?php echo $r->fecha_rendido; ?></td>
													<td><?php echo $r->expediente; ?></td>
													<td><button class="btn btn-info btn-info-rendidos" data-toggle='modal' data-target='#modal-info-rendido' value="<?php echo $r->id; ?>"><i class="glyphicon glyphicon-search"></i></button></td>
												</tr>
											<?php endforeach ?>
										<?php } ?>
									</tbody>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<style type="text/css">
			th, td{
				text-align: center;
				vertical-align: center;
				font-size: 18px;
			}
		</style>


		<!-- /.modal -->
		<div class="modal fade" id="modal-info-rendido">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span></button>
							<h2 class="modal-title" style="text-align: center">Detalle del ticket</h2>
						</div>
						<div class="modal-body"> 

						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger pull-right btn-cerrar-info-rendido" data-dismiss="modal">Cerrar</button>
						</div>
					</div>
					<!-- /.modal-content -->
				</div>
				<!-- /.modal-dialog -->
			</div>
			<!-- /.modal -->


		</body>
		<style type="text/css">
			th,td{
				text-align: center;
			}
		</style>


		<script src="<?php echo base_url();?>public/bootstrap/js/bootstrap-select.min.js"></script>  
		<script src="<?php echo base_url();?>public/sweetAlert/sweetAlert.min.js"></script>
		<script src="<?php echo base_url();?>public/jquery/jquery-3.4.1.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){

				var base_url = "<?php echo base_url();?>";

				$(".btn-info-rendidos").on("click", function(){
					var val = $(this).val();
					$.ajax({
						url: base_url + "Ticket/getRendidosID/" + val,
						success:function(r){
							$("#modal-info-rendido .modal-body").html(r);
						}
					})
				})





			})
		</script>