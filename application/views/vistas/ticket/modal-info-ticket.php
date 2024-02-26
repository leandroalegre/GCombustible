<?php 
	$a = $t->fecha_emitido;
	$a2 = explode(" ", $a);
	$fec = $a2[0];
	$hora = $a2[1];
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h1><?php echo "TICKET N° ".$t->num ?></h1>
			</div>
			<div class="panel-body">
				<h4>Entregado a <?php echo $t->per;?> (legajo: <?php echo $t->legajo;?>) el día <?php echo $fec;?> a la hora <?php echo $hora;?>, por un monto de <?php echo "$".$t->imp ?> para la carga de combustible en el vehículo <?php echo $t->marca." ".$t->modelo." con dominio ".$t->ve ?></h4>

				<?php if ($t->estado == "Rendido"): ?>
					
				<?php endif ?>
			</div>
		</div>
	</div>
</div>