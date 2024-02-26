<div class="table-responsive">
	<table class="table table-striped" id="tablapersonas">
		<thead style="background-color: #337AB7; color: white;">
			<th>NOMBRE Y APELLIDO</th>
			<th>LEGAJO</th>
			<th>DNI</th>
			<th>SELECCIONAR</th>
		</thead>
		<tbody>
			<?php foreach ($per as $p): ?>
				<tr>
					<td style="vertical-align: middle; font-size: 15px"><b><?php echo $p->nombre;?></b></td>
					<td style="vertical-align: middle; font-size: 15px"><b><?php echo $p->legajo;?></b></td>
					<td style="vertical-align: middle; font-size: 15px"><b><?php echo $p->dni;?></b></td>
					<td style="vertical-align: middle; font-size: 15px"><button type="button" class="btn btn-lg btn-success btn-check" value="<?php echo $p->id."+".$p->nombre."+".$p->legajo."+".$p->dni."+".$p->dif."+".$p->vencimiento_licencia;?>"><i class="glyphicon glyphicon-check"></i></button></td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>
</div>
<script type="text/javascript">
	
	$(".btn-check").on("click", function(){
		var val = $(this).val();
		info = val.split("+");

		id = info[0];
		nombre = info[1];
		legajo = info[2];
		dni = info[3];
		venc_lic = info[4];
		vencimiento_licencia = info[5];

		$("input[name='id_persona']").val(id);
		$("input[name='nombre']").val(nombre);
		$("input[name='legajo']").val(legajo);
		$("input[name='dni']").val(dni);
		$("input[name='venc_lic']").val(venc_lic);
		$("input[name='vencimiento_licencia']").val(vencimiento_licencia);
		$(".btn-cerrar-modal-personas").click();
	})

	$("#tabla1").dataTable().fnDestroy();

	$("#tablapersonas").DataTable({
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