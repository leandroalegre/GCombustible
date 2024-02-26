<table class="table table-striped" id="tabla2">
	<thead>
		<th>NUMERO TICKET</th>
		<th>PERSONA</th>
		<th>VEHICULO MARCA</th>
		<th>MODELO</th>
		<th>DOMINIO</th>
		<TH>IMPORTE</TH>
		<TH>FECHA CARGA</TH>
		<th>SELECCIONAR</th>
	</thead>
	<tbody>
		<?php foreach ($tic as $t ) { ?>
			
		
		<tr>
			<td style="vertical-align: middle; font-size: 15px"><?php echo $t->nit; ?></td>
			<td style="vertical-align: middle; font-size: 15px"><?php echo $t->nombre; ?></td>
			<td style="vertical-align: middle; font-size: 15px"><?php echo $t->marca; ?></td>
			<td style="vertical-align: middle; font-size: 15px"><?php echo $t->modelo; ?></td>
			<td style="vertical-align: middle; font-size: 15px"><?php echo $t->dominio; ?></td>
			<td style="vertical-align: middle; font-size: 15px"><?php echo $t->importe_cargado; ?></td>
			<td style="vertical-align: middle; font-size: 15px"><?php echo $t->fecha_cargado; ?></td>
			<td style="vertical-align: middle; font-size: 15px"><button type="button" class="btn btn-lg btn-success btn-check" value="<?php echo $t->nit."*".$t->importe_cargado."*".$t->fecha_emitido."*".$t->id."*".$t->legajo."*".$t->nombre."*".$t->dni."*".$t->dominio."*".$t->marca."*".$t->modelo."*".$t->fecha_cargado;?>"><i class="glyphicon glyphicon-check"></i></button></td>
		</tr>
	<?php } ?>
	</tbody>
</table>

<script type="text/javascript">
	
	$(".btn-check").on("click", function(){
		var val = $(this).val();
		info = val.split("*");

		nit = info[0];
		importe_cargado = info[1];
		fecha_emitido = info[2];
		id = info[3];
		legajo = info[4];
		nombre = info[5];
		dni = info[6];
		dominio = info[7];
		marca = info[8];
		modelo = info[9];
		fe_carg = info[10];

		$("input[name='nit']").val(nit);
		$("input[name='importe_cargado']").val(importe_cargado);
		$("input[name='fecha_emitido']").val(fecha_emitido);
		$("input[name='fecha_cargado']").val(fe_carg);
		$("input[name='id']").val(id);
		$("input[name='legajo']").val(legajo);
		$("input[name='nombre']").val(nombre);
		$("input[name='dni']").val(dni);
		$("input[name='dominio']").val(dominio);
		$("input[name='marca']").val(marca);
		$("input[name='modelo']").val(modelo);
		$(".btn-cerrar-modal-personas").click();
	})


		$("#tabla2").DataTable({
			"order": [0, 'desc'], 
		"language": {
			"lengthMenu": "Mostrar _MENU_ registros por pagina",
			"zeroRecords": "No se encontraron resultados en su busqueda",
			"searchPlaceholder": "Buscar registros",
			"info": "Mostrando registros de _START_ al _END_ de un total de  _TOTAL_ registros",
			"infoEmpty": "No existen registros",
			"infoFiltered": "(filtrado de un total de _MAX_ registros)",
			"search": "Buscar:",
			"paginate": {
				"first": "Primero",
				"last": "Último",
				"next": "Siguiente",
				"previous": "Anterior"
			},
		}
	});
</script>

