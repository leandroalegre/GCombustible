			<body style="width: 95%; margin: 1px auto">
				<div class="container">
					<div class="panel panel" style="border-color: black; box-shadow: 8px 6px 5px grey">
						<div class="panel-heading" style="background-color: #DCDCDC;">
							<div class="row">
								<div class="col-md-12 col-xs-12">
									<h1 style="text-align: center; color">Saldo gastado por vehiculo <br> <?php if(isset($fechadesde)){?>
										desde <?php echo $fechadesde ?> hasta <?php echo $fechahasta ?>
									<?php }else{ 
										$hoy = date("Y-m-d",time());?>
										hasta <?php echo $hoy;
									}
									?></h1>
								</div>
							</div>
						</div>
						<br>

						<div class="panel panel-primary" style="border-color: black; width: 75%; margin-left: 12% ">
							<div class="panel-body clearfix">
								<div class="row" >
									<div class="col-md-12 col-xs-12">
										<form method="POST" action="<?php echo base_url()?>Reportes/GastadoPorVehiculoFecha">
											<div class="row">

												<div class="col-md-3 col-xs-12 col-sm-12">
													<label>Desde:</label>
													<input type="date" class="form-control" value="<?php if(ISSET($fechadesde)){echo $fechadesde; }?>" name="desde" required="required">
												</div>
												<div class="col-md-3 col-xs-12 col-sm-12">
													<label>Hasta:</label>
													<input type="date" class="form-control" value="<?php if(ISSET($fechadesde)){echo $fechahasta; }?>" name="hasta" required="required">
												</div>

												<div class="col-md-2 col-xs-12 col-sm-12">
													<label>Secretaria:</label>
													<select class="form-control" name="id_secretaria">
														<?php if ($secretaria->id != NULL) {?>
															<option value="<?php echo $secretaria->id; ?>" selected><?php echo $secretaria->nombre; ?></option>
														<?php } ?>
														<option value="0">SELECCIONAR:</option>
														<option value="1">SECRETARIA DE GOBIERNO Y COORDINACION</option>
														<option value="2">SECRETARIA DE ECONOMIA Y FINANZAS</option>
														<option value="3">SECRETARIA DE TURISMO, CULTURA Y DEPORTES</option>
														<option value="4">SECRETARIA DE DESARROLLO URBANO AMBIENTAL</option>
														<option value="5">SECRETARIA DE SALUD PUBLICA</option>
														<option value="6">SECRETARIA DE DESARROLLO SOCIAL, EDUCACION, GENERO Y DIVERSIDAD</option>
													</select>
												</div>
												<div class="col-md-2 col-xs-12 col-sm-12">
													<label>Tipo vehiculo</label>
													<select class="form-control" name="tipo_vehiculo" id="">
														<option value="5" selected>Todos</option>
														<option value="1">Particular</option>
														<option value="0">Municipal</option>
													</select>
												</div>
												
												<div class="col-md-2 col-xs-12 col-sm-12" align="center">
													<br>
													<button class="btn btn-primary">Consultar</button>
												</div>


											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					
						<div class="col-md-5 col-xs-12 col-sm-12"></div>
						<div class="col-md-2 col-xs-12 col-sm-12" align="center">
							<br>
							<input type="button" class="btn btn-primary" style="margin-bottom: 1%" onclick="printDiv('areaImprimir')" value="Imprimir" />
						</div>
						<br><br><br>
						<div class="row" id="areaImprimir">

							<?php if(ISSET($secretaria->nombre)){ ?>
								<h4 style="text-align: center"><b><?php echo $secretaria->nombre; ?></b></h4> 
							<?php } ?>
							<div class="col-md-8 col-md-offset-2 col-xs-12">
								<div style="display: block; width: 100%; margin: 0 auto;">
									<div class="table-responsive">
										<table class="table table-striped">
											<?php 	 
								$sumaimportes=0;
								?>
											<thead>
												<th><h4><b>Vehiculo</b></h4></th>
												<th><h4><b>Tipo</b></h4></th>
												<th><h4><b>Secretaria</b></h4></th>
												<th><h4><b>Monto total gastado</b></h4></th>
											</thead>
											<tbody>
												<?php foreach ($rep as $r){ ?>

													
													<tr>
														<td><?php echo $r->marca." ".$r->modelo." (".$r->dominio.")"; ?></td>
														<?php if ($r->tipo_vehiculo == 0) { ?>
                            <td> Municipal</td>
                      <?php }else{ ?>
                        <td>Particular</td>
                       <?php } ?>
														<td><?php echo $r->nomb_sec ?></td>
														<td><?php echo $r->importe_cargado; ?></td>
														<?php 	 
										$sumaimportes+=$r->importe_cargado;
										?>
													</tr>
												<?php } ?>
									
											</tbody>
											<?php if(ISSET($secretaria->nombre)){ ?>
									<td style="color: green"><b>TOTAL <?php echo $secretaria->nombre ?></b></td>
									<td></td>
									<td></td>
									<td style="color: green"><b><?php echo $sumaimportes; ?></b></td>

								<?php }else{ ?>
									<td style="color: green"><b>Total</b></td>
									<td></td>
									<td></td>
									<td style="color: green"><b><?php echo $sumaimportes; ?></b></td>	
								<?php } ?>
										</table>					
									</div>

								</div>
							</div>
						</div>

					</div>
				</body>
				<style type="text/css">
					th, td{
						text-align: center;
					}
				</style>

				<script type="text/javascript">
					function printDiv(nombreDiv) {
						var contenido= document.getElementById(nombreDiv).innerHTML;
						var contenidoOriginal= document.body.innerHTML;

						document.body.innerHTML = contenido;

						window.print();

						document.body.innerHTML = contenidoOriginal;
					}
				</script>