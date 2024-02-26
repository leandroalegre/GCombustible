


<button type="button" class="close" data-dismiss="modal" aria-label="Close">
    						<span aria-hidden="true">&times;</span></button>
    						<?php if ($t == null) { ?> <h2>Este vehiculo no posee tickets habilitados en este momento</h2> <?php ;}else{
    							# code...
    						 ?>
                            <?php foreach ($t as $vehi) {}
                            	?><h2 class="modal-title" style="text-align: center"><?php 		
	echo $vehi->marca." ".$vehi->modelo." dominio ".$vehi->dominio;
 ?>.</h2>
    						<h2 class="modal-title" style="text-align: center"></h2>
    					</div>
    					<div class="modal-body"> 


<div class="table-responsive">
	<table class="table table-striped" id="">
		<thead style="background-color: #337AB7; color: white;">
			<th>N° TICKET</th>
			<th>VEHICULO</th>
			<th>NOMBRE</th>
			<th>FOTO</th>
			<th>IMPORTE</th>
			<th>SELECCIONAR</th>
		</thead>
		<tbody>
			<?php foreach ($t as $row): ?>
				<tr>
					<td style="vertical-align: middle; font-size: 15px"><b><?php echo "Nº ".$row->nit;?></b></td>
					<td style="vertical-align: middle; font-size: 15px"><b><?php echo $row->dominio;?></b></td>
					<td style="vertical-align: middle; font-size: 15px"><b><?php echo $row->nombre;?></b></td>
					<td style="vertical-align: middle; font-size: 15px"><img src="<?php echo base_url()?>/public/imagenes_personas/<?php echo $row->foto ?>" style="width: 60px; height: 60px"></td>
					<td style="vertical-align: middle; font-size: 15px"><b><?php echo "$".$row->importe;?></b></td>
					<td style="vertical-align: middle; font-size: 15px"><button type="button" class="btn btn-lg btn-success btn-check" value="<?php echo $row->id."*".$row->dominio."*".$row->marca."*".$row->modelo."*".$row->nombre."*".$row->dni."*".$row->importe."*".$row->nit."*".$row->id_comb_cargado."*".$row->combustible;?>"><i class="glyphicon glyphicon-check"></i></button></td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>
</div>
<?php }; ?>
<script type="text/javascript">
	
	$(".btn-check").on("click", function(){
		var val = $(this).val();
		info = val.split("*");

		id = info[0];
		dominio = info[1];
		marca = info[2];
		modelo = info[3];
		nombre = info[4];
		dni = info[5];
		importe = info[6];
		nit = info[7];
		id_comb_cargado = info[8]
		combustible = info[9]
		var letraTicket = "Nº Ticket: "+nit;

		if(combustible!='Sin seleccionar'){
			$(".tipo_comb_input").css("visibility", "visible")
		}else{
			$(".tipo_comb_input").css("visibility", "collapse")
		}
		$("input[name='id_ticket']").val(id);
		$("input[name='dominio']").val(dominio);
		$("input[name='marca']").val(marca);
		$("input[name='modelo']").val(modelo);
		$("input[name='nombre']").val(nombre);
		$("input[name='dni']").val(dni);
		$("input[name='importe']").val(importe);
		$("input[name='tipo_comb']").val(combustible);
		$("input[name='id_comb_cargado']").val(id_comb_cargado);
		$("#num_ticket").text(letraTicket);
		$(".btn-cerrar-modal-carga").click();
 document.getElementById('importe_cargado').focus();
 
	})

	$("#tablapersonas").dataTable().fnDestroy();

	$("#tablavehiculos").DataTable({
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
