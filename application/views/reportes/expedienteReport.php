<link rel="stylesheet" href="<?php echo base_url();?>public/bootstrap/css/bootstrap-select.min.css"/>
<div class="panel panel-primary" style="border-color: black; width: 50%; margin-left: 23% ">
				<div class="panel-body clearfix">
					<div class="row" >
						<div class="col-md-12 col-sm-12 col-xs-12">
							<form method="POST" action="<?php echo base_url()?>Reportes/reportePorExpediente">
								<div class="row">
									
						
								
									<div class="col-md-3 col-sm-12 col-xs-12 ">
									<label>Seleccione expediente:</label>
									<div class="row-fluid">
									<select class="selectpicker" name="expediente" data-show-subtext="true" data-live-search="true">
				<option>Seleccionar:</option>
					<?php foreach ($expedientes as $e): ?>
				<option value="<?php echo $e->expediente;?>"><?php echo $e->expediente;?></option>
					<?php endforeach ?>
		</select>
									</div>
									</div>
									<div class="col-md-3 col-sm-12 col-xs-12 " align="center">
										<br>
										<button class="btn btn-primary">Consultar</button>
										<input class="btn btn-success" type="button" onclick="printDiv('imprimir')" value="Imprimir" />
									</div>

								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<?php if(isset($seleccionado)){ ?>
			<div id="imprimir">
			<div class="container">
    <div class="row">
        <div class=" col-md-10 col-sm-12 col-xs-12" style="text-align: center;">
				<h3>Expediente seleccionado: <?php echo $seleccionado; echo ", monto total: "; echo $total?> </h3> <br>
				</div>
    </div>
</div>

<div class="col-md-8 col-md-offset-2 col-xs-12">
					<div style="display: block; width: 100%; margin: 0 auto; text-align: center">
					<h3>TOTAL POR SECRETARIAS</h3>
						<div class="table-responsive" style="text-align: left !important;">
							<table class="table table-striped">
								<thead>
									<th><h4><b>Secretaria</b></h4></th>
									<th><h4><b>Total</b></h4></th>
								</thead>
								<tbody>
									<?php foreach ($porsec as $r){ ?>											
										<tr>
											<td><?php echo $r->nombresec; ?></td>
											<td><?php echo $r->importe_cargado; ?></td>
										</tr>
								
									<?php } ?>				
								</tbody>
					
							</table>					
						</div>

					</div>

				</div>
				<div class="col-md-8 col-md-offset-2 col-xs-12">
				<div style="display: block; width: 100%; margin: 0 auto; text-align: center">
					<h3>TOTAL POR DIRECCIONES</h3>
						<div class="table-responsive" style="text-align: left !important;">
							<table class="table table-striped">
								<thead>
									<th><h4><b>Secretaria</b></h4></th>
									<th><h4><b>Direccion</b></h4></th>
									<th><h4><b>Total</b></h4></th>
								</thead>
								<tbody>
									<?php foreach ($pordir as $r){ ?>											
										<tr>
											<td><?php echo $r->nombresec; ?></td>
											<td><?php echo $r->nombredir ?></td>
											<td><?php echo $r->importe_cargado; ?></td>
										</tr>
								
									<?php } ?>				
								</tbody>
					
							</table>					
						</div>

					</div>

				</div>
		


				</div>

				<?php }else{ ?>


<div style="text-align: center;">
					<h3>Seleccione un expediente para ver resultados.</h3>
</div>



					<?php } ?>
			<script src="<?php echo base_url();?>public/bootstrap/js/bootstrap-select.min.js"></script>  
		<script src="<?php echo base_url();?>public/sweetAlert/sweetAlert.min.js"></script>
		<script src="<?php echo base_url();?>public/jquery/jquery-3.4.1.min.js"></script>

<script>
	function printDiv(nombreDiv) {
     var contenido= document.getElementById(nombreDiv).innerHTML;
     var contenidoOriginal= document.body.innerHTML;

     document.body.innerHTML = contenido;

     window.print();

     document.body.innerHTML = contenidoOriginal;
}
</script>

  
