<style type="text/css">
	th, td, input{
		text-align: center;
	}
</style>
<div class="container">
	<div class="col-md-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3><i class="fa fa-address-card"></i> PRECIOS DE COMBUSTIBLES</h3>
			</div>
			<div class="panel-body">
				<button class="btn btn-info btn-modificar">MODIFICAR</button>
				<br>
				<div class="table-responsive">
					<table class="table table-striped">
						<thead>
							<th style="font-size: 20px">COMBUSTIBLE</th>
							<th style="font-size: 20px">PRECIO X LITRO</th>
							<th style="font-size: 20px"></th>
							
						</thead>
						<tbody>
							<?php foreach ($precios as $p){ ?>				
							<tr>
								<td><?php echo $p->combustible ?></td>
								<td><?php echo $p->precio_litro ?></td>
								<td><a href="<?php echo base_url()?>Reportes/ver_historico/<?php echo $p->id_precio; ?>">Ver histórico</a></td>	
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- modal -->
	<div class="modal fade" id="modal-modificar">
		<div class="modal-dialog">
			<div class="modal-content" style="background-color: #EEEEEE">
				<div class="modal-body"> 
				</div>
				<div class="modal-footer">	
				</div>
			</div>
		</div>
	</div>
<!-- /.modal -->
<script type="text/javascript">
	$(document).ready(function(){
		var base_url = "<?php echo base_url();?>";
		$('.btn-modificar').on("click", function(){
			$.ajax({
				url: base_url + "Reportes/modificar_modal",
				success:function(comb){
					$("#modal-modificar").modal("show");
					$("#modal-modificar .modal-body").html(comb);
				}
			})
		})
	})
</script>