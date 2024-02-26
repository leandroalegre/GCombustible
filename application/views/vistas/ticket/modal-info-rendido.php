<?php 
	$a = $r->fecha_rendido;
	$a2 = explode(" ", $a);
	$fec = $a2[0];
	$hora = $a2[1];
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h1><?php echo "TICKET N° ".$r->num ?></h1>
			</div>
			<div class="panel-body">
				<h4>Rendido por <?php echo $r->per;?> (legajo: <?php echo $r->legajo;?>) el día <?php echo $fec;?> a la hora <?php echo $hora;?>, por un monto de <?php echo "$".$r->imp ?> cargado en el vehículo <?php echo $r->marca." ".$r->modelo." con dominio ".$r->ve ?>. Expediente N° <?php echo $r->expediente ?></h4>

				
			</div>
		</div>
	</div>
</div>