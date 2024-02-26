<?php 
	$a = $t->fecha_emitido;
	$a2 = explode(" ", $a);
	$fec = $a2[0];
	$hora = $a2[1];
?>
<input type="hidden" name="id_ticket" value="<?php echo $t->id_ticket; ?>">
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h1><?php echo "TICKET N° ".$t->num ?></h1>
			</div>
			<div class="panel-body">

				<div class="container">
    <div class="row">
        <div class="col-md-6 col-xs-8"><label>Ingrese el motivo por el que desea cancelar el ticket:</label></div>
    </div>
    <div class="row">
        <div class="col-md-4 col-xs-8"><textarea type="text" class="form-control" name="motivo"></textarea> </div>
    </div>
</div>
				
				
			</div>
		</div>
	</div>
</div>