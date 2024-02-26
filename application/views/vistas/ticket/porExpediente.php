		<script type="text/javascript">

	window.print();


</script>

<?php 
$minfecha = explode(' ', $fechas->minfecha);
$maxfecha = explode(' ', $fechas->maxfecha);
 ?>
<body style="width: 95%; margin: 3px auto">
	<div class="container">
		
			<div class="panel-heading">
				<div class="pull-left"><h3>EXPEDIENTE N° <?php echo $expediente ;?></h3></div>
				<div class="pull-right"><h3><?php echo $minfecha[0] . " - " .$maxfecha[0];?></h3></div><br><br>
				
			</div>
			<hr style="border: 1px solid black">
			<div class="panel-body">
				
				<div class="row">
					<div class="col-md-12">
						<div class="table-responsive">
							<table class="table table-striped table-hover">
								<thead>
									<th >N° TICKET</th>
									<th>PERSONA</th>
									<TH>DOMINIO</TH>
									<TH>MARCA</TH>
									<TH>MODELO</TH>
									<th>LITROS</th>
									<!-- <TH>IMPORTE</TH> -->
								</thead>
								<tbody>
									<?php  
									$total=0;
									$contador=0;
									?>
									<tr>
										<?php foreach ($porExpediente as $r ): ?>
											<td><?php echo $r->num; ?></td>
											<td><?php echo $r->per; ?></td>
											<td><?php echo $r->ve; ?></td>
											<td><?php echo $r->marca; ?></td>
											<td><?php echo $r->modelo; ?></td>
											<TH><?php echo $r->cant_litros ?></TH>
											<!-- <td><?php echo "$". $r->imp; ?></td> -->
											<?php $total=$r->cant_litros+$total;
											$contador++;
											 ?>
										</tr>
									<?php endforeach ?>
									<TH>Cantidad de tickets:<?php echo " ".$contador; ?></TH>
									<TH></TH>
									<TH></TH>
									<TH></TH>
									<th>TOTAL</th>
									<TH><?php echo $total; ?></TH>

								</tbody>

							</div>
						</div>
					</div>
				</div>


			
		</div>


	</body>
	<style type="text/css">
		th,td{
			text-align: center;
		}
	</style>
