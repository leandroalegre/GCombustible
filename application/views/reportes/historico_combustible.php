<style type="text/css">
	th, td, input{
		text-align: center;
	}
	h3{
		text-transform: uppercase;
	}
</style>
<div class="container">
	<div class="col-md-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3><i class="fa fa-address-card"></i> HISTORICO - <?php echo $combustible[0]->combustible; ?></h3>
			</div>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-striped">
						<thead>
							<th style="font-size: 20px">COMBUSTIBLE</th>
							<th style="font-size: 20px">PRECIO X LITRO</th>
							<th style="font-size: 20px">FECHA</th>
							<th style="font-size: 20px">OBSERVACION</th>
							
						</thead>
						<tbody>
							<?php for ($i=0; $i < $cuenta ; $i++) {?>				
							<tr
								<?php
									if (isset($combustible[$i+1]->precio_litro)) {
										if ($combustible[$i]->precio_litro > $combustible[$i+1]->precio_litro) {
										?>
										style="background-color: #FF9090;"
										<?php
										}else if($combustible[$i]->precio_litro == $combustible[$i+1]->precio_litro){
										?>
										style="background-color: #FDFF90;"
										<?php
										}else if($combustible[$i]->precio_litro < $combustible[$i+1]->precio_litro){
										?>
										style="background-color: #90FF93;"
										<?php
										}
									}else{
										
									}
									?>
							>
								<td><?php echo $combustible[$i]->combustible ?></td>
								<td><?php echo $combustible[$i]->precio_litro ?></td>
								<td><?php echo $combustible[$i]->fecha_movimiento ?></td>	
								<td>
									<?php
									if (isset($combustible[$i+1]->precio_litro)) {
										if ($combustible[$i]->precio_litro > $combustible[$i+1]->precio_litro) {
										echo "Aumentó";

										}else if($combustible[$i]->precio_litro == $combustible[$i+1]->precio_litro){
											echo "Se mantuvo";
										}else if($combustible[$i]->precio_litro < $combustible[$i+1]->precio_litro){
											echo "Bajó";
										}
									}else{
										echo "Primer registro";
									}
										
									
									
									?>
									
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