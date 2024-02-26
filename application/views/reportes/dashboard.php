<?php 
function dmy($fecha){
	$dmy = date("d/m/Y", strtotime($fecha));
	return $dmy;	
}
?>
<body style="width: 95%; margin: 1px auto">
	<div class="container">
	<?php if($this->session->userdata('rol')==10){ ?>
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3><i class="fa fa-exclamation-triangle"></i> ADMINISTRADOR DE LECTOR</h3>
					</div>
					<div class="panel-body">
					<h4><strong>• Podrá cargar nuevas personas desde el apartado "Personas", sin posibilidad de cargar la licencia de conducir.</strong></h4>
					<h4><strong>• Podrá cargar nuevos vehiculos con su respectivo llavero. </strong></h4>					
				</div>
			</div>
		</div>
	</div>
	<?php } ?>
	<?php if($this->session->userdata('rol')==1 || $this->session->userdata('rol')==2){ ?>
	<!-- <div class="row">
			<div class="col-md-12">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3><i class="fa fa-exclamation-triangle"></i> Actualizacíon de sistema del día 18/08/2020 </h3>
					</div>
					<div class="panel-body">
					<h4><strong>• Se estableció un límite mensual de $2500 para vehículos particulares.  </strong></h4>
					<h4><strong>• Se estableció un límite mensual de 1000 (mil) LITROS para CISTERNAS. </strong></h4>
						<h4><strong>• En caso de requerir un mayor saldo se podrá solicitar ingresando en la pestaña "Vehículos" en el apartado "Solicitar saldo". </strong></h4>
						
				</div>
			</div>
		</div>
	</div> -->

	<?php } ?>
	<?php if($this->session->userdata('rol')==1){ ?>
<div class="row" >
	<div class="col-md-offset-3 col-md-6" >
			<div class="panel panel-box clearfix">
				<div class="panel-icon pull-left bg-green">
					<a href="<?php echo base_url();?>Vehiculos/listSolicitudes"><i class="fa fa-folder-open"></i></a>
						</div>
					<div class="panel-value pull-right">
						<h2 class="margin-top"><?php echo $solicitudesVe ?></h2>
						<a href="<?php echo base_url();?>Vehiculos/listSolicitudes" class="text-muted">SOLICITUDES DE SALDO DE VEHICULOS</a>
						</div>
					</div>
				</div>
				</div>

				<?php } ?> 
				<?php if($this->session->userdata('rol')!=10){ ?>
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3><i class="fa fa-address-card"></i> LICENCIAS DE CONDUCIR PROXIMAS A VENCER</h3>
					</div>
					<div class="panel-body">
						<div class="table-responsive">
							<table class="table table-striped">
								<thead>
									<th style="font-size: 20px">PERSONA / LEGAJO</th>
									<th style="font-size: 20px">VENC LICENCIA</th>
									<th style="font-size: 20px">CADUCIDAD</th>
									<th></th>
								</thead>
								<tbody>
									<?php $acum=0;?>
									<?php foreach ($lic as $l): ?>
										<?php if ($l->dif <0): ?>
											<?php $acum++; ?>
											<tr>
												<td style="font-size: 17px; color: red"><?php echo $l->nombre." / ".$l->legajo;?></td>
												<td style="font-size: 17px; color: red"><?php echo dmy($l->venc_lic);?></td>
												<td style="font-size: 17px; color: red"><?php echo "Vencida hace <b>".substr($l->dif, 1)."</b> Días";?></td>
												<td><a class="btn-mail" href="<?php echo base_url()?>Personas/enviarrecordatorio1/<?php echo $l->id; ?>">Enviar Mail</a></td>

											</tr>
											<?php elseif ($l->dif == 0): ?>
												<?php $acum++; ?>
												<tr>
													<td style="font-size: 17px; color: red"><?php echo $l->nombre." / ".$l->legajo;?></td>
													<td style="font-size: 17px; color: red"><?php echo dmy($l->venc_lic);?></td>
													<td style="font-size: 17px; color: red">Vence hoy</td>
													<td><a class="btn-mail" href="<?php echo base_url()?>Personas/enviarrecordatorio1/<?php echo $l->id; ?>">Enviar Mail</a></td>
												</tr>
												<?php elseif ($l->dif >0 && $l->dif <= 30): ?>
													<?php $acum++; ?>
													<tr>
														<td style="font-size: 17px"><?php echo $l->nombre." / ".$l->legajo;?></td>
														<td style="font-size: 17px"><?php echo dmy($l->venc_lic);?></td>
														<td style="font-size: 17px"><?php echo "Vence en <b>".$l->dif."</b> Días";?></td>
														<td><a class="btn-mail" class="btn-mail" href="<?php echo base_url()?>Personas/enviarrecordatorio2/<?php echo $l->id; ?>">Enviar Mail</a></td>
													</tr>
												<?php endif ?>

											<?php endforeach ?>
											<?php if ($acum==0): ?>
												<tr>
													<td><span></span></td>
													<td style="font-size: 17px"><span>No hay licencias proximas a vencer</span></td>
													<td></td>
												</tr>
											<?php endif ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<hr>
	<?php } ?> 
	<?php if ($this->session->userdata("rol") == '8' || $this->session->userdata("rol") == '3' || $this->session->userdata("rol") == '1' || $this->session->userdata("rol") == '10') {
		
	}else{ ?>
	<div class="row">
		<div class="col-md-6">
			<div class="panel panel-box clearfix">
				<div class="panel-icon pull-left bg-green">
					<?php if ($this->session->userdata("rol") == '2'): ?>
						<a href="<?php echo base_url();?>Ticket/listSolicitudes"><i class="fa fa-folder-open"></i></a>
						<?php elseif ($this->session->userdata("rol") == '5'): ?>
							<a href="<?php echo base_url();?>Ticket/listSolicitudesForSecretario"><i class="fa fa-folder-open"></i></a>
						<?php endif ?>
					</div>
					<div class="panel-value pull-right">
						<h2 class="margin-top"><?php echo $solicitudes->cant_soli ?></h2>
						<?php if ($this->session->userdata("rol") == '2'): ?>
							<a href="<?php echo base_url();?>Ticket/listSolicitudes" class="text-muted">SOLICITUDES DE PARTIDAS</a>
							<?php elseif ($this->session->userdata("rol") == '5'): ?>
								<a href="<?php echo base_url();?>Ticket/listSolicitudesForSecretario" class="text-muted">SOLICITUDES DE PARTIDAS</a>
							<?php endif ?>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="panel panel-box clearfix">
						<div class="panel-icon pull-left bg-red">
							<a href="<?php echo base_url();?>Personas/index"><i class="fa fa-user"></i></a>
						</div>
						<div class="panel-value pull-right">
							<h2 class="margin-top"><?php echo $personas->cant?></h2>
							<a href="<?php echo base_url();?>Personas/listapersonas" class="text-muted">PERSONAS AUTORIZADAS A LA CARGA DE COMBUSTIBLE</a>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="panel panel-box clearfix">
						<div class="panel-icon pull-left" style="background-color: #6F42C1; opacity: 0.8">
							<a href="<?php echo base_url();?>Ticket/listEmitidos"><i class="fa fa-file"></i></a>
						</div>
						<div class="panel-value pull-right">
							<h2 class="margin-top"><?php echo $tickets->cant?></h2>
							<a href="<?php echo base_url();?>Ticket/listEmitidos" class="text-muted">TICKETS ACTIVOS SIN CARGAR</a>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="panel panel-box clearfix">
						<div class="panel-icon pull-left" style="background-color: #DBAB09; opacity: 0.8">
							<a href="<?php echo base_url();?>vehiculos/index"><i class="fa fa-car"></i></a>
						</div>
						<div class="panel-value pull-right">
							<h2 class="margin-top"><?php echo $vehiculos->cant?></h2>
							<a href="<?php echo base_url();?>vehiculos/index" class="text-muted">VEHÍCULOS AUTORIZADOS A LA CARGA DE COMBUSTIBLE</a>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-offset-4 col-md-4">
					<input type="button" class="btn btn-primary" style="margin-bottom: 1%" onclick="printDiv('areaImprimir')" value="Imprimir personas" />
					<input type="button" class="btn btn-primary" style="margin-bottom: 1%" onclick="printDiv('areaImprimir2')" value="Imprimir vehículos" />
					
				</div>
			</div>
			<br>
			<div id="areaImprimir" style="visibility: collapse;">
				<div class="col-md-8 col-md-offset-2 col-xs-12">
					<div style="display: block; width: 100%; margin: 0 auto;">
						<h3 align="center"><?php echo $this->session->userdata('nombre_secretaria'); ?></h3>
						<div class="table-responsive">
							<table class="table table-striped">
								<thead>
									<th><h4><b>Nombre</b></h4></th>
									<th><h4><b>Dni</b></h4></th>
									<th><h4><b>Legajo</b></h4></th>
									<th><h4><b>Estado</b></h4></th>
								</thead>
								<tbody>
									<?php foreach ($personas_print as $p){ ?>
										<tr>
											<td><?php echo $p->nombre; ?></td>
											<td><?php echo $p->dni; ?></td>
											<td><?php echo $p->legajo; ?></td>
											<td><?php if ($p->estado == 1) {?>
												Carga combustible
											<?php }else if ($p->estado == 2) {?>
												Solo conduccion
											<?php } ?>
												
											</td>

										</tr>
									<?php } ?>
								</tbody>
							</table>					
						</div>

					</div>
				</div>
			</div>	
			<div id="areaImprimir2" style="visibility: collapse;">
				<div class="col-md-8 col-md-offset-2 col-xs-12">
					<div style="display: block; width: 100%; margin: 0 auto;">
						<h3 align="center"><?php echo $this->session->userdata('nombre_secretaria'); ?></h3>
						<div class="table-responsive">
							<table class="table table-striped">
								<thead>
									<th><h4><b>Marca</b></h4></th>
									<th><h4><b>Modelo</b></h4></th>
									<th><h4><b>Dominio</b></h4></th>
									<th><h4><b>Llavero</b></h4></th>
									<th><h4><b>Tipo</b></h4></th>
								</thead>
								<tbody>
									<?php foreach ($vehiculos_print as $p){ ?>
										<tr>
											<td><?php echo $p->marca; ?></td>
											<td><?php echo $p->modelo; ?></td>
											<td><?php echo $p->dominio; ?></td>
											<td><?php 
						                       if ($p->num_llavero == 0) {
						                           echo "No usa llavero";
						                       }else{
						                           echo $p->num_llavero; 
						                       }?>
						                    </td>
						                    <td><?php 
						                       if ($p->tipo_vehiculo == 0) {
						                           echo "Municipal";
						                       }else{
						                           echo "Particular";
						                       }?>
											</td>
										</tr>
									<?php } ?>
								</tbody>
							</table>					
						</div>

					</div>
				</div>
			</div>	
		</div>
	<?php } ?>
		<style type="text/css">
			th,td{
				text-align: center;
			}
		</style>
	</body>
	<script src="<?php echo base_url();?>public/sweetAlert/sweetAlert.min.js"></script>
	<script src="<?php echo base_url();?>public/jquery/jquery-3.4.1.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){


		$(".btn-mail").on("click", function(){
			 swal({
                        icon: "success",
                        title: "Operación exitosa",
                        text: "El correo ha sido enviado"
                    })
                    setTimeout(function(){
                        window.location = base_url;
                    },2000)
		})



		})
		function printDiv(nombreDiv) {
			var contenido= document.getElementById(nombreDiv).innerHTML;
			var contenidoOriginal= document.body.innerHTML;

			document.body.innerHTML = contenido;

			window.print();

			document.body.innerHTML = contenidoOriginal;
		}
	</script>
