
<body style="width: 95%; margin: 3px auto">
	<div class="container">
		<div class="panel panel-default" >
			<div class="panel-heading">
				<h1>RENDIR TICKET</h1>
			</div>

			<div class="panel-body">
				<br>
				<div class="row">
					<div class="col-md-offset-1 col-md-3 ">
						<button type="button" data-toggle="modal" data-target="#modalticket" class="btn btn-lg btn-block btn-primary btn-search-ticket"><i class="glyphicon glyphicon-search"></i>Seleccionar ticket</button>
					</div>
				</div>
				<br>
				
					<div class="row">
						<div class="col-md-offset-1 col-md-10">
							<div class="panel panel-primary">
								<div class="panel-heading">
									<h5>DATOS DEL TICKET</h5>
								</div>
								<div class="panel-body">
									<div class="col-md-3 col-xs-12 col-sm-12">
										<label>NUMERO DE TICKET</label>
										<input type="text" name="nit" class="form-control" readonly="readonly" required>
									</div>
									<div class="col-md-3 col-xs-12 col-sm-12">
										<label>IMPORTE TICKET</label>
										<input type="text" name="importe_cargado" class="form-control" readonly="readonly" required>
									</div>
										<div class="col-md-3 col-xs-12 col-sm-12">
										<label>FECHA DE EMISION</label>
										<input type="text" name="fecha_emitido" class="form-control" readonly="readonly" required>
									</div>
									<div class="col-md-3 col-xs-12 col-sm-12">
										<label>FECHA DE CARGA</label>
										<input type="hidden" name="id">
										<input type="text" class="form-control" readonly=""  name="fecha_cargado" required>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-offset-1 col-md-10">
							<div class="panel panel-primary">
								<div class="panel-heading">
									<h5>DATOS DE LA PERSONA</h5>
								</div>
								<div class="panel-body">
									<div class="col-md-4 col-xs-12 col-sm-12">
										<label>Legajo</label>
										<input type="text" name="legajo" class="form-control" readonly="readonly">
									</div>
									<div class="col-md-4 col-xs-12 col-sm-12">
										<label>Nombre y apellido</label>
										<input type="text" name="nombre" class="form-control" readonly="readonly">
									</div>
									<div class="col-md-4 col-xs-12 col-sm-12">
										<label>Dni</label>
										<input type="text" name="dni" class="form-control" readonly="readonly">
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-offset-1 col-md-10">
							<div class="panel panel-primary">
								<div class="panel-heading">
									<h5>DATOS DEL VEHICULO</h5>
								</div>
								<div class="panel-body">
									<div class="col-md-4 col-xs-12 col-sm-12">
										<label>Dominio</label>
										<input type="text" name="dominio" class="form-control" readonly="readonly">
									</div>
									<div class="col-md-4 col-xs-12 col-sm-12">
										<label>Marca</label>
										<input type="text" name="marca" class="form-control" readonly="readonly">
									</div>
									<div class="col-md-4 col-xs-12 col-sm-12">
										<label>Modelo</label>
										<input type="text" name="modelo" class="form-control" readonly="readonly">
									</div>
									
									
									<div class="col-md-4 col-xs-12 col-sm-12" style="margin-top: 1%">
										<label>Tipo combustible</label>
										<select class="form-control" name="tipo_comb" required>
											<option>Seleccionar:</option>
											<option value="GNC">GNC</option>
											<option value="Gasoil">Gasoil</option>
											<option value="Gasoil premium">Gasoil premium</option>
											<option value="Nafta">Nafta</option>
											<option value="Nafta premium">Nafta premium</option>
										</select>
									</div>
									<div class="col-md-4 col-xs-12 col-sm-12" style="margin-top: 1%">
										<label>Cantidad</label>
										<input type="number" name="cant_litros" min="0" step="any" class="form-control" required>
									</div>
									<div class="col-md-4 col-xs-12 col-sm-12" style="margin-top: 1%">
										<label>Numero de expediente</label>
										<input type="number" name="expediente" class="form-control" required>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="panel-footer">
					<div class="row">
						<div class="col-md-offset-4 col-md-8 col-xs-12">
							
						<button type="submit" class="btn btn-lg btn-rendir btn-success btn-c" style="text-align: center;">Rendir ticket <i class="fa fa-circle-o-notch fa-spin" id="spinner" style="font-size:22px;display: none"></i></button>
							
								<a href="<?php echo base_url(); ?>"><button type="button" style="text-align: center;"  class="btn btn-lg btn-danger"> Cancelar</button></a>
							</div>
						</div>
					</div>
				</div>
				</div>

			</div>


			<!-- /.modal -->
			<div class="modal fade" id="modalticket">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span></button>
								<h2 class="modal-title" style="text-align: center">Listado de tickets</h2>
							</div>
							<div class="modal-body"> 

							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-danger pull-right btn-cerrar-modal-personas" data-dismiss="modal">Cerrar</button>
							</div>
						</div>
						<!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
				</div>
				<!-- /.modal -->
			</body>
			<style type="text/css">
				td,th{
					text-align: center;
				}
			</style>

			<script src="<?php echo base_url();?>public/jquery/jquery-3.4.1.min.js"></script>
			<script type="text/javascript">
				$(document).ready(function(){
					var base_url = "<?php echo base_url(); ?>";

					$(".btn-search-ticket").on("click", function(){
						$.ajax({
							url: base_url + "Ticket/getTickets",
							success:function(r){
								$("#modalticket .modal-body").html(r);
							}
						})
					})
				})


				$(".btn-rendir").on("click", function(){

					var base_url = "<?php echo base_url(); ?>"
					var id = $("input[name='id']").val();
					var nit = $("input[name='nit']").val();
					var importe_cargado = $("input[name='importe_cargado']").val();
					var fecha_emitido = $("input[name='fecha_emitido']").val();
					var fecha_cargado = $("input[name='fecha_cargado']").val();
					var legajo = $("input[name='legajo']").val();
					var nombre = $("input[name='nombre']").val();
					var dni = $("input[name='dni']").val();
					var dominio = $("input[name='dominio']").val();
					var marca = $("input[name='marca']").val();
					var modelo = $("input[name='modelo']").val();
					var tipo_comb = $("select[name='tipo_comb']").val();
					var cant_litros = $("input[name='cant_litros']").val();
					var expediente = $("input[name='expediente']").val();
					if(id=="" || nit=="" || importe_cargado=="" || fecha_emitido=="" ||  legajo=="" || nombre=="" || dni=="" || dominio=="" || marca=="" || modelo=="" || tipo_comb=="" || cant_litros=="" || expediente==""){
						swal({
							icon: "warning",
							title: "Error!",
							text: "Debe completar todos los campos."
						})
					
					}else if(cant_litros <= 0){
						swal({
	                        icon: "error",
	                        title: "Cantidad no permitida.",
	                        text: "Solo esta permitido ingresar cantidades de combustibles mayores a 0.",
                    	})						
					}else{
							swal({
								title: "¿Desea confirmar la operacion?",
								icon: "info",
								buttons: {
									cancel: "Cancelar",
									catch: {
										text: "Confirmar",
										value: "confirmar",
									},
								},
							})
							.then((value) => {
								switch (value) {
									case "confirmar":
									$.ajax({
								url: base_url + "Ticket/rendirTicket/"+id+"/"+cant_litros+"/"+tipo_comb+"/"+expediente,
								success:function(r){
									$("#spinner").css({"display": "inline-block"});
									swal({
										icon: "success",
										title: "Operación exitosa",
										timer: 2000,
									})
									setTimeout(function(){
										window.location = base_url + "Ticket/rendir";
									},2000)
								}
							});
									break;
									default:
									swal.close();
								}
							}); 
							
						}      
    })
				</script>
