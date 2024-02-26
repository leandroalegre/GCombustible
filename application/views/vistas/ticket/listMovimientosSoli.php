		<body style="width: 95%; margin: 3px auto">
			<div class="container" >
				<div class="panel-default">
					<div class="panel-heading">
						<h1>LISTADO MOVIMIENTOS DE SOLICITUD DE SALDO</h1>
					</div>
					<div class="panel-body" >
						<br>
						<div class="row">
							<div class="col-md-12">
								<div class="table-responsive">
									<table class="table table-striped table-hover" id="tablamovimientos">
										<thead style="background-color: #3175B8; color: white">
										
											<th>MOVIMIENTO</th>
											<th>FECHA</th>
											<th>USUARIO</th>
											<TH>IMPORTE</TH>
											<TH>SECRETARÍA</TH>
											<TH>DIRECCIÓN</TH>
										</thead>
										<tbody>
											<tr>
												<?php foreach ($movtickets as $m ): ?>
													
													<td><?php echo $m->tipo_movimiento; ?></td>
													<td><?php echo $m->fecha_movimiento; ?></td>
													<td><?php echo $m->username; ?></td>
													<td><?php echo "$".$m->importe; ?></td>
													<td><?php echo $m->nom_sec; ?></td>
													<td><?php echo $m->nom_dir; ?></td>
													
												</tr>
											<?php endforeach ?>
										</tbody>
										
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<style type="text/css">
				td{
					text-align: center;
					vertical-align: center;
					font-size: 16px;
				}

				th{
					text-align: center;
					vertical-align: center;
					font-size: 18px;
				}
			</style>




			</body>
			<style type="text/css">
    th,td{
        text-align: center;
    }
</style>
<script src="<?php echo base_url();?>public/sweetAlert/sweetAlert.min.js"></script>
<script src="<?php echo base_url();?>public/jquery/jquery-3.4.1.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){

        var base_url = "<?php echo base_url();?>";

    

        $("#tablamovimientos").DataTable({
            "order":[1, "desc"],
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