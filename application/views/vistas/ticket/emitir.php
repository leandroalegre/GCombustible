<body style="width: 95%; margin: 3px auto">
	<div class="container">

		<div class="panel panel-default">
			<div class="panel-heading">
				<h1>EMITIR TICKET</h1>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-offset-7 col-md-4">
						<input type="hidden" name="id_usuario" value="<?php echo $this->session->userdata("id") ?>">
						<input type="hidden" name="id_secretaria" value="<?php echo $this->session->userdata("id_secretaria") ?>">
						<input type="hidden" name="id_direccion" value="<?php echo $this->session->userdata("id_direccion") ?>">
						<input type="hidden" name="cant_tickets" value="<?php echo $cantTickets->num ?>">
						<h3>Saldo restante: $<?php echo $cantTickets->num ?></h3>
						<?php if ($_SESSION['rol'] == 3) { ?>
							<button class="btn btn-danger btn-block btn-solicitar" style="font-size: 18px">Solicitar saldo</button>
						<?php } ?>

					</div>
				</div>
				<br>
				<div class="row">
					<div class="buscar persona col-md-offset-1 col-md-5">
						<button type="button" data-toggle="modal" data-target="#modal-personas" class="btn btn-lg btn-block btn-primary btn-search-persona"><i class="glyphicon glyphicon-search"></i> Seleccionar persona</button>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="datos persona col-md-offset-1 col-md-10">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<h5>DATOS DE LA PERSONA</h5>
							</div>
							<div class="panel-body">
								<div class="col-md-4 col-xs-12 col-sm-12">
									<label>Legajo</label>
									<input type="hidden" name="id_persona" value="0">
									<input type="hidden" name="venc_lic" value="0">
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
				<hr>
				<div class="row">
					<div class="buscar vehiculo col-md-offset-1 col-md-5">
						<button type="button" class="btn btn-lg btn-block btn-primary btn-search-vehiculo" data-toggle="modal" data-target="#modal-vehiculos"><i class="glyphicon glyphicon-search"></i> Seleccionar vehículo</button>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="datos vehiculo col-md-offset-1 col-md-10">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<h5>DATOS DEL VEHICULO</h5>
							</div>
							<div class="panel-body">
								<div class="col-md-4 col-xs-12 col-sm-12">
									<label>Dominio</label>
									<input type="hidden" name="id_vehiculo" value="0">
									<input type="hidden" name="tipo_vehiculo">
									<input type="hidden" name="flag_litros">
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

								<div class="col-md-offset-4 col-md-4 col-xs-12 col-sm-12 gnc_class" style="visibility: hidden;">
									<label>Capacidad GNC en m3:</label>
									<input type="number" name="m3_gnc" class="form-control" readonly="readonly">
								</div>

								
							</div>
						</div>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="valor de ticket col-md-offset-1 col-md-10">
						<div class="panel panel-danger">
							<div class="panel-heading">
								<h3>VALOR DEL TICKET</h3>
							</div>
							<div class="panel-body">
								<?php if ($this->session->userdata("id_secretaria") == 4) { ?>
									<div class="col-md-3 col-md-offset-1 col-xs-12 col-sm-12">
										<input type="radio" class="custom-control-input btn-importe" id="radioimporte" checked name="defaultExampleRadios">
										<label>Importe</label>
										<div class="input-group">
											<span class="input-group-addon">$</span>
											<input type="number" class="form-control importe" id="importe" name="importe">
										</div>
									</div>

									<div class="col-md-3 col-xs-12 col-sm-12">
										<input type="radio" class="custom-control-input btn-litros" id="radiolitros" name="defaultExampleRadios">
										<label>Litros/m3</label>
										<div class="input-group">
											<input type="number" class="form-control litros" style="background: #ADADAD" id="litros" name="litros" readonly>
										</div>

									</div>

									<div class="col-md-3 col-xs-12 col-sm-12 div_tipo" style="visibility: hidden">
										<label>Tipo combustible</label>
										<select name="tipo_comb" id="tipo_comb" class="form-control">
											<option value="">Seleccionar:</option>
											<option value="1">Nafta</option>
											<option value="2">Nafta Premium</option>
											<option value="3">Gasoil</option>
											<option value="4">Gasoil premium</option>
											<option value="5">GNC</option>
										</select>
									</div>

								<?php } else { ?>

									<div class="col-md-6 col-md-offset-3 col-xs-12 col-sm-12">
										<label>Importe</label>
										<div class="input-group">
											<span class="input-group-addon">$</span>
											<input type="number" class="form-control" name="importe">
										</div>
									</div>

								<?php } ?>

							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="panel-footer">
				<div class="row">
					<div class="botones guardar y cancelar col-md-offset-2 col-md-8">
						<div class="col-md-6 col-xs-12 col-sm-12">
							<button type="button" id="boton-confirmar" class="btn btn-lg btn-block btn-success btn-confirmar"></i> Confirmar ticket</button>
						</div>
						<div class="col-md-6 col-xs-12 col-sm-12">
							<a href="<?php echo base_url(); ?>"><button type="button" class="btn btn-lg btn-block btn-danger">Cancelar</button></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>



	<!-- /.modal -->
	<div class="modal fade" id="modal-personas">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span></button>
					<h2 class="modal-title" style="text-align: center">Listado de personas</h2>
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


	<!-- /.modal -->
	<div class="modal fade" id="modal-vehiculos">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span></button>
					<h2 class="modal-title" style="text-align: center">Listado de vehículos</h2>
				</div>
				<div class="modal-body">

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger pull-right btn-cerrar-modal-vehiculos" data-dismiss="modal">Cerrar</button>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->

</body>
<style type="text/css">
	th,
	td {
		text-align: center;
	}

	.swal-text {
		text-align: center;
	}
</style>
<script src="<?php echo base_url(); ?>public/sweetAlert/sweetAlert.min.js"></script>
<script src="<?php echo base_url(); ?>public/jquery/jquery-3.4.1.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		var base_url = "<?php echo base_url(); ?>";

		$(".btn-search-persona").on("click", function() {
			var id_secretaria = $("input[name='id_secretaria']").val();
			$.ajax({
				url: base_url + "Personas/getPersonasForEmitirTicket/",
				type: "POST",
				data: "id_secretaria=" + id_secretaria,
				success: function(r) {
					$("#modal-personas .modal-body").html(r);
				}
			})
		})

		$(".btn-litros").on("click", function() {

			$("input[name='importe']").prop("readOnly", true);
			$("input[name='litros']").prop("readOnly", false);
			document.getElementById("importe").style.background = '#ADADAD';
			document.getElementById("litros").style.background = '';
			$(".div_tipo").css("visibility", "visible");

		})

		$(".btn-importe").on("click", function() {

			$("input[name='importe']").prop("readOnly", false);
			$("input[name='litros']").prop("readOnly", true);
			document.getElementById("importe").style.background = '';
			document.getElementById("litros").style.background = '#ADADAD';
			$(".div_tipo").css("visibility", "hidden");


		})

		$(".btn-search-vehiculo").on("click", function() {
			var id_secretaria = $("input[name='id_secretaria']").val();
			$.ajax({
				url: base_url + "Vehiculos/getVehiculosForEmitirTicket/",
				type: "POST",
				data: "id_secretaria=" + id_secretaria,
				success: function(r) {
					$("#modal-vehiculos .modal-body").html(r);
				}
			})
		})

		$("#tipo_comb").change(function(){
			var tipo_comb = $("select[name='tipo_comb']").val();
			if(tipo_comb==5){
				$(".gnc_class").css("visibility", "visible");
			}else{
				$(".gnc_class").css("visibility", "hidden");
			}
		}) 

		$(".btn-confirmar").on("click", function() {
			var id_persona = $("input[name='id_persona']").val();
			var id_vehiculo = $("input[name='id_vehiculo']").val();
			var tipo_vehiculo = $("input[name='tipo_vehiculo']").val();
			var venc_lic = $("input[name='venc_lic']").val();
			var flag_litros = $("input[name='flag_litros']").val();
			var saldo = $("input[name='cant_tickets']").val();

			var intSaldo = parseInt(saldo);
			var intVencLic = parseInt(venc_lic);
			$("#boton-confirmar").prop("disabled", true);

			$.ajax({
				url: base_url + "Ticket/ConsultarMontoVehiculos",
				type: "POST",
				data: "id_vehiculo=" + id_vehiculo,
				success: function(r) {
					info = r.split("-");
					monto_mensual = info[0];
					var limite = info[1];

					if ($('input:radio[id=radiolitros]:checked').val() == "on") {

						var tipo_comb = $("select[name='tipo_comb']").val();
						var cant_litros = $("input[name='litros']").val();
						$.ajax({
							url: base_url + "Ticket/consultarPrecios/",
							type: "POST",
							data: "tipo_comb=" + tipo_comb,
							success: function(r) {
								var importe = r * cant_litros;
								var intImporte = parseInt(importe);
								litros_mensual = (parseFloat(cant_litros)) + (parseFloat(monto_mensual));

								monto_mensual = parseInt(monto_mensual);
							var montofinal = (monto_mensual + intImporte);
								if (id_persona == '0' || id_vehiculo == '0' || cant_litros == "" || tipo_comb == "") {
									if (id_persona == '0') {
										swal({
											icon: "warning",
											title: "Seleccione una persona",
										})
										$("#boton-confirmar").prop("disabled", false);
									} else if (id_vehiculo == '0') {
										swal({
											icon: "warning",
											title: "Seleccione un vehículo",
										})
										$("#boton-confirmar").prop("disabled", false);
									} else if (cant_litros == "") {
										swal({
											icon: "warning",
											title: "Ingrese cantidad de litros",
										})
										$("#boton-confirmar").prop("disabled", false);
									} else {
										swal({
											icon: "warning",
											title: "Ingrese tipo de combustible",
										})
										$("#boton-confirmar").prop("disabled", false);
									}
								} else if (intSaldo < intImporte) {
									swal({
										icon: "error",
										title: "Saldo insuficiente.",
										text: "Saldo insuficiente para la emision de un ticket con monto de $" + importe + "",
									})
									$("#boton-confirmar").prop("disabled", false);
								} else if (intImporte <= 0) {
									swal({
										icon: "error",
										title: "Ticket no permitido.",
										text: "El valor del ticket debe ser mayor a 0.",
									})
									$("#boton-confirmar").prop("disabled", false);
								} else if (litros_mensual > limite && flag_litros==1) {
									swal({
										icon: "error",
										title: "Ticket no permitido.",
										text: "El dominio excede el limite mensual de: "+limite+" litros",
									})
									$("#boton-confirmar").prop("disabled", false);
								}else if (montofinal > limite && tipo_vehiculo == 1) {
								swal({
									icon: "error",
									title: "Ticket no permitido.",
									text: "El monto gastado en el vehiculo en el mes supera el limite",
								})
								$("#boton-confirmar").prop("disabled", false);
							} else {
									var nombre = $("input[name='nombre']").val();
									swal({
											title: "¿Confirma el ticket para " + nombre + " por un monto de $" + importe + "?",
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
													if (intVencLic < 0) {
														swal({
															icon: "error",
															title: nombre + " posee la licencia de conducir fuera de términos",
															text: "Licencia de conducir vencida.",
														})
														$("#boton-confirmar").prop("disabled", false);
													} else {
														$.ajax({
															url: base_url + "Ticket/store/",
															type: "POST",
															data: "id_persona=" + id_persona + "&id_vehiculo=" + id_vehiculo + "&importe=" + intImporte + "&cant_litros=" + cant_litros + "&tipo_comb=" + tipo_comb,
															success: function(r) {
																if (r == "true") {
																	swal({
																		icon: "success",
																		title: "Operación exitosa",
																		timer: 2000,
																	})
																	setTimeout(function() {
																		window.location = base_url + "Ticket";
																	}, 2000)
																} else if (r == "false") {
																	swal({
																		icon: "error",
																		title: "Hubo un problema al realizar la operación",
																	})
																	$("#boton-confirmar").prop("disabled", false);
																}
															}
														})
													}
													break;
												default:
												$("#boton-confirmar").prop("disabled", false);
													swal.close();
											}
										});
								}

							}
						})

					} else {

						var importe = $("input[name='importe']").val();
						var intImporte = parseInt(importe);


						if (id_persona == '0' || id_vehiculo == '0' || importe == "") {
							if (id_persona == '0') {
								swal({
									icon: "warning",
									title: "Seleccione una persona",
								})
								$("#boton-confirmar").prop("disabled", false);
							} else if (id_vehiculo == '0') {
								swal({
									icon: "warning",
									title: "Seleccione un vehículo",
								})
								$("#boton-confirmar").prop("disabled", false);
							} else {
								swal({
									icon: "warning",
									title: "Ingrese el importe del ticket",
								})
								$("#boton-confirmar").prop("disabled", false);
							}
						} else if (intSaldo < intImporte) {
							swal({
								icon: "error",
								title: "Saldo insuficiente.",
								text: "Saldo insuficiente para la emision de un ticket con monto de $" + importe + "",
							})
							$("#boton-confirmar").prop("disabled", false);
						} else if (intImporte <= 0) {
							swal({
								icon: "error",
								title: "Ticket no permitido.",
								text: "El valor del ticket debe ser mayor a 0.",
							})
							$("#boton-confirmar").prop("disabled", false);
						} else if (flag_litros == 1) {
							swal({
								icon: "error",
								title: "Ticket no permitido.",
								text: "Para emitir tickets a cisternas seleccione litros",
							})
							$("#boton-confirmar").prop("disabled", false);
						} else {

							monto_mensual = parseInt(monto_mensual);
							var montofinal = (monto_mensual + intImporte);



							if (montofinal > limite && tipo_vehiculo == 1) {
								swal({
									icon: "error",
									title: "Ticket no permitido.",
									text: "El monto gastado en el vehiculo en el mes supera el limite",
								})
								$("#boton-confirmar").prop("disabled", false);
							} else {


								var nombre = $("input[name='nombre']").val();
								swal({
										title: "¿Confirma el ticket para " + nombre + " por un monto de $" + importe + "?",
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
												if (intVencLic < 0) {
													swal({
														icon: "error",
														title: nombre + " posee la licencia de conducir fuera de términos",
														text: "Licencia de conducir vencida.",
													})
													$("#boton-confirmar").prop("disabled", false);
												} else {
													$.ajax({
														url: base_url + "Ticket/store/",
														type: "POST",
														data: "id_persona=" + id_persona + "&id_vehiculo=" + id_vehiculo + "&importe=" + intImporte,
														success: function(r) {
															if (r == "true") {
																swal({
																	icon: "success",
																	title: "Operación exitosa",
																	timer: 2000,
																})
																setTimeout(function() {
																	window.location = base_url + "Ticket";
																}, 2000)
															} else if (r == "false") {
																swal({
																	icon: "error",
																	title: "Hubo un problema al realizar la operación",
																})
																$("#boton-confirmar").prop("disabled", false);
															}
														}
													})
												}
												break;
											default:
											$("#boton-confirmar").prop("disabled", false);
												swal.close();
										}
									});
							}
						}

					}

				}

			})

		});

		$(".btn-solicitar").on("click", function() {
			var a = "a sec";
			swal({
					title: "Se solicitará saldo al administrador de la secretaría",
					text: "¿Continuar?",
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
								url: base_url + "Ticket/solicitarSaldo/",
								type: "POST",
								data: "aContaduria=" + a,
								success: function(r) {
									if (r == "true") {
										swal({
											icon: "success",
											title: "Operación exitosa",
											timer: 2000,
										})
										setTimeout(function() {
											window.location = base_url + "Ticket";
										}, 2000)
									} else if (r == "false") {
										swal({
											icon: "error",
											title: "Aún no ha sido confirmada su solicitud anterior",
										})
									}
								}
							})
							break;
						default:
							swal.close();
					}
				});
		})


	})
</script>
