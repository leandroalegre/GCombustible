<div class="table-responsive">
	<table class="table table-striped" id="tablavehiculos">
		<thead style="background-color: #337AB7; color: white;">
			<th>DOMINIO</th>
			<th>MARCA</th>
			<th>MODELO</th>
			<th>LLAVERO</th>
			<th>SELECCIONAR</th>
		</thead>
		<tbody>
			<?php foreach ($veh as $p): ?>
				<tr>
					<td style="vertical-align: middle; font-size: 15px"><b><?php echo $p->dominio;?></b></td>
					<td style="vertical-align: middle; font-size: 15px"><b><?php echo $p->marca;?></b></td>
					<td style="vertical-align: middle; font-size: 15px"><b><?php echo $p->modelo;?></b></td>
					<td style="vertical-align: middle; font-size: 15px"><b><?php echo $p->num_llavero;?></b></td>
					<td style="vertical-align: middle; font-size: 15px"><button type="button" class="btn btn-lg btn-success btn-check" value="<?php echo $p->id."*".$p->dominio."*".$p->marca."*".$p->modelo."*".$p->tipo_vehiculo."*".$p->flag_litros."*".$p->maximo_mensual."*".$p->m3_gnc;?>"><i class="glyphicon glyphicon-check"></i></button></td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>
</div>
<script type="text/javascript">
	
	$(".btn-check").on("click", function(){
		var val = $(this).val();
		info = val.split("*");

		id = info[0];
		dominio = info[1];
		marca = info[2];
		modelo = info[3];
		tipo_vehiculo = info[4];
		flag_litros = info[5];
		if(flag_litros==1){
		maximo_mensual = info[6]+" litros";
	}else{
		maximo_mensual = info[6]+" pesos";
	}
	m3_gnc = info[7];

		$("input[name='id_vehiculo']").val(id);
		$("input[name='dominio']").val(dominio);
		$("input[name='marca']").val(marca);
		$("input[name='modelo']").val(modelo);
		$("input[name='tipo_vehiculo']").val(tipo_vehiculo);
		$("input[name='flag_litros']").val(flag_litros);
		$("input[name='maximo_mensual']").val(maximo_mensual);
		$("input[name='m3_gnc']").val(m3_gnc);
		$(".btn-cerrar-modal-vehiculos").click();
	})

	$("#tablapersonas").dataTable().fnDestroy();

	$("#tablavehiculos").DataTable({
		"order": [3, "asc"],
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




</script>
