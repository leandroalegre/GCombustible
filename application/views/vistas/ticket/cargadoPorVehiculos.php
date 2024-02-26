<body style="width: 95%; margin: 3px auto">
	<div class="container">
		<div class="panel-default">
			<div class="panel-heading">
				<h1>Tickets cargados por vehiculo</h1>
			</div>
			<div class="panel-body">

				<div align="Center">
				<div class="panel panel-default" style="width: 60%" >
					<div class="panel-body">
						<form method="POST" action="<?php base_url() ?>buscarCargado">
							<div class="container">
								<div class="row">
									<div class="col-sm-2"><label for="">Ingrese el dominio</label></div>
									<div class="col-sm-2"><input type="text" name="dominio" class="form-control"></div>
									<div class="col-sm-2"><button type="submit" class="btn btn-success">Buscar</button></div>
								</div>
							</div>
						</form>
					</div>
				</div>
				</div>
				<?php if (isset($movtickets)) { ?>	
					<h3>Vehiculo: <?php echo $vehiculo->dominio ?></h3>
					<h3>Tipo: <?php if($vehiculo->tipo_vehiculo==0){
						echo "Municipal";
					}else{
						echo "Particular";
					} ?></h3>
					<?php $monto_total=$suma->suma - $suma->devolucion ?>
				<h3>Monto cargado $<?php echo $monto_total  ?></h3><br>
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-striped table-hover" id="tablamovimientos">
									<thead style="background-color: #3175B8; color: white">
										<th>N° TICKET</th>
										<th>FECHA</th>
										<TH>IMPORTE CARGADO</TH>
										<TH>IMPORTE DEVUELTO</TH>
										<TH>OTORGADO A</TH>
										<TH>DOMINIO</TH>
									</thead>
									<tbody>
										<tr>
											<?php foreach ($movtickets as $m) : ?>

												<?php $importe = $m->importe;
												$devolucion = $m->devolucion;

												$importe_cargado = $importe - $devolucion;
												?>
												<TD><?php echo $m->nit ?></TD>
												<td><?php echo $m->fecha_movimiento; ?></td>
												<?php if ($m->tipo_movimiento == "Emision de ticket") {
													$importe_cargado = 0;
												} ?>


												<td><?php echo "$" . $importe_cargado; ?></td>
												<td><?php echo "$" . $m->devolucion; ?></td>
												<td><?php echo $m->nombre; ?></td>
												<td><?php echo $m->dominio; ?></td>

										</tr>
									<?php endforeach ?>
									</tbody>

							</div>
						</div>
					</div>
			</div>
		<?php }else{ ?>
			<div align="center">
			<h3>No se encontraron resultados</h3>
			</div>
		<?php } ?>
		</div>
	</div>
	</div>

	<style type="text/css">
		td {
			text-align: center;
			vertical-align: center;
			font-size: 16px;
		}

		th {
			text-align: center;
			vertical-align: center;
			font-size: 18px;
		}
	</style>




</body>
<style type="text/css">
	th,
	td {
		text-align: center;
	}
</style>
<script src="<?php echo base_url(); ?>public/sweetAlert/sweetAlert.min.js"></script>
<script src="<?php echo base_url(); ?>public/jquery/jquery-3.4.1.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {

		var base_url = "<?php echo base_url(); ?>";




		$("#tablamovimientos").DataTable({
			"order": [1, "desc"],
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