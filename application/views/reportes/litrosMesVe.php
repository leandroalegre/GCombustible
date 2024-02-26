

<div class="panel panel-primary" style="border-color: black; width: 50%; margin-left: 23% ">
				<div class="panel-body clearfix">
				<div class="panel-heading" style="color:blue">La búsqueda se realiza solo sobre los tickets rendidos.</div>
					<div class="row" >
						<div class="col-md-12 col-sm-12 col-xs-12">
							<form method="POST" action="<?php echo base_url()?>Ticket/LitrosMes">
								<div class="row">
								
									
									<div class="col-md-4 col-sm-12 col-xs-12 ">
										<label>Dominio </label>
										<input type="text" class="form-control" placeholder="Ingrese dominio" value="<?php if(isset($dominio))echo $dominio; ?>" name="dominio" required>
									</div>
									<div class="col-md-4 col-sm-12 col-xs-12 ">
										<label>Mes</label>
										<select name="mes" id="mes" class="form-control">
										<option value="00">SELECCIONAR:</option>
										<option value="01">ENERO</option>
										<option value="02">FEBRERO</option>
										<option value="03">MARZO</option>
										<option value="04">ABRIL</option>
										<option value="05">MAYO</option>
										<option value="06">JUNIO</option>
										<option value="07">JULIO</option>
										<option value="08">AGOSTO</option>
										<option value="09">SEPTIEMBRE</option>
										<option value="10">OCTUBRE</option>
										<option value="11">NOVIEMBRE</option>
										<option value="12">DICIEMBRE</option>
										</select>
										<!-- <input type="number" class="form-control" value="<?php if(isset($mes))echo $mes; ?>" placeholder="Ingrese mes con dos digitos" name="mes" required> -->
									</div>
									<div class="col-md-3 col-sm-12 col-xs-12 " align="center">
										<br>
										<button class="btn btn-primary">Consultar</button>
									</div>

								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<?php if(isset($litros)){ ?>
<div id="imprimir">
	<div align="center">
			<div class="container">
    <div class="row">
        <div class=" col-md-10 col-sm-12 col-xs-12">
				<h3>Consulta por dominio <?php echo $dominio; echo "<br>"; echo "Mes: "; echo $mes; echo "<br>"; echo "Litros cargados: "; echo $litros ?> </h3> <br>
				</div>
    </div>
</div>
</div>

					<div class="panel-body">
						<br>
						<div class="row">
							<div class="col-md-12">
								<div class="table-responsive">
								<div style="text-align:center;">
									<table style="margin: 0 auto; width: 60%" class="table table-striped table-hover" id="tablamovimientos">
										<thead style="background-color: #3175B8; color: white">
											<th>N° TICKET</th>
											<th>TIPO MOVIMIENTO</th>
											<th>FECHA CARGADO</th>
											<TH>LITROS</TH>
											<TH>OTORGADO A</TH>
											<TH>DOMINIO</TH>
										</thead>

										<?php 	 
								$sumalitros=0;
								?>
										<tbody>
											<tr>
												<?php foreach ($ticket as $m ): ?>

													
													<TD><?php echo $m->nit ?></TD>
													<td><?php echo $m->tipo_movimiento; ?></td>
													<td><?php echo $m->fecha_movimiento; ?></td>
													<td><?php echo $m->cant_litros; ?></td>
													<td><?php echo $m->nombre; ?></td>
													<td><?php echo $m->dominio; ?></td>
													<?php 	 
										$sumalitros+=$m->cant_litros;
										?>
													</tr>
											<?php endforeach ?>
										</tbody>
										
									<td></td>
									<td></td>
									<td style="color: green"><b>TOTAL</b></td>
									<td style="color: green"><b><?php echo $sumalitros; ?></b></td>
									<td></td>
									<td></td>
										</div>
									</div>
								</div>
							</div>
						</div>

			<?php }else{ ?>
				<div align="center">	
					<br><br>
				<h3>No se encontraron resultados.</h3>
				</div>
			<?php } ?>




<script>
	function printDiv(nombreDiv) {
     var contenido= document.getElementById(nombreDiv).innerHTML;
     var contenidoOriginal= document.body.innerHTML;

     document.body.innerHTML = contenido;

     window.print();

     document.body.innerHTML = contenidoOriginal;
}
</script>

  
