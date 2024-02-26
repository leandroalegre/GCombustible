<body style="width: 95%; margin: 3px auto">
			<div class="container">
				<div class="panel-default">
					<div class="panel-heading">
						<h1>Historico de actualizacion de licencias</h1>
					</div>
					<div class="panel-body">
						<br>
						<div class="row">
							<div class="col-md-12">
								<div class="table-responsive">
									<table class="table table-striped table-hover" id="tablalicencias">
										<thead style="background-color: #3175B8; color: white">
											<th>ID</th>
											<th>IMAGEN</th>
											<th>FECHA ANTERIOR</th>
											<TH>FECHA NUEVA</TH>
											<TH>USUARIO</TH>
											<TH>FECHA MOV</TH>
											<TH>PERSONA/LEGAJO</TH>
										</thead>
										<tbody>
											<tr>
												<?php foreach ($historico as $h ): ?>

													
                                                    <TD><?php echo $h->id_historico ?></TD>
                                                    <TD><button type="submit" data-toggle="modal" name="verLicencia" id="<?php echo $h->id_historico ?>" value="<?php echo $h->name ?>" class="btn-sm btn-verLicencia"><img src="<?php echo base_url().'public/images/licencias/'.$h->name ?>" class="img-thumbnail" style="width: 60px; height: 40px "/></button></TD>
                                                    <TD><?php echo $h->fecha_anterior ?></TD>
                                                    <TD><?php echo $h->fecha_nueva ?></TD>
                                                    <TD><?php echo $h->username ?></TD>
                                                    <TD><?php echo $h->fecha_movimiento ?></TD>
                                                    <TD><?php echo $h->nombre." (".$h->legajo.")" ?></TD>
													
													
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
            <!-- modal -->
    <div class="modal fade" id="modal-verLicencia">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
            
          </div>
          <div class="modal-footer">        
          </div>
        </div>
      </div>
    </div>
<!-- /.modal -->  

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

        $(document).on('click', '.btn-verLicencia', function(){
    var foto = $(this).attr("value");
    var base_url = "<?php echo base_url();?>";
    var html = '<body><img src="'+base_url+'public/images/licencias/'+foto+'"   class="img-thumbnail"/></body>';
    $("#modal-verLicencia").modal("show");
    $("#modal-verLicencia .modal-body").html(html);
  })

        $("#tablalicencias").DataTable({
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