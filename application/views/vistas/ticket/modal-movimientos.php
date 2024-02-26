<div class="table-responsive">
	<table class="table table-striped" id="tablapersonas">
		<thead style="background-color: #337AB7; color: white;">
			<th>NIT</th>
			<th>MOVIMIENTO</th>
			<th>FECHA</th>
            <TH>MONTO</TH>
		</thead>
		<tbody>
			<?php foreach ($mov as $m): ?>
				<tr>
					<td style="vertical-align: middle; font-size: 15px"><b><?php echo $m->nit;?></b></td>
					<td style="vertical-align: middle; font-size: 15px"><b><?php echo $m->tipo_movimiento;?></b></td>
                    <td style="vertical-align: middle; font-size: 15px"><b><?php echo $m->fecha_movimiento;?></b></td>
                    <?php if($m->tipo_movimiento=="Carga de ticket"){ ?> 
                    <td style="vertical-align: middle; font-size: 15px"><b><?php echo $m->importe_cargado;?></b></td>
                    <?php }else if($m->tipo_movimiento=="Devolucion de saldo"){ ?>
                        <td style="vertical-align: middle; font-size: 15px"><b><?php echo $m->devolucion;?></b></td>
                    <?php }else{ ?>
                        <td style="vertical-align: middle; font-size: 15px"><b><?php echo number_format($m->importe, 2, '.', '');?></b></td>
                    <?php } ?>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>
</div>
