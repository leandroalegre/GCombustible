<style type="text/css">
	th, td, input{
		text-align: center;
	}
	.btn-aceptar{
		width: 100%;
	}
</style>
<form method="POST" action="<?php echo base_url()?>Reportes/modificar_precios">
	<div class="table-responsive">
		<table class="table table-striped">
			<thead>
				<th style="font-size: 20px">COMBUSTIBLE</th>
				<th style="font-size: 20px">MODIFICAR</th>
			</thead>
			<tbody>				
				<tr>
					<td><?php echo $precios[0]->combustible; ?></td>
					<td><div align="center"><input type="text" class="form-control" name="nafta" value="<?php echo $precios[0]->precio_litro; ?>" style="width: 50%"></div></td>
				</tr>
				<tr>
					<td><?php echo $precios[1]->combustible; ?></td>
					<td><div align="center"><input type="text" class="form-control" name="nafta_premium" value="<?php echo $precios[1]->precio_litro; ?>" style="width: 50%"></div></td>
				</tr>
				<tr>
					<td><?php echo $precios[2]->combustible; ?></td>
					<td><div align="center"><input type="text" class="form-control" name="gasoil" value="<?php echo $precios[2]->precio_litro; ?>" style="width: 50%"></div></td>
				</tr>
				<tr>
					<td><?php echo $precios[3]->combustible; ?></td>
					<td><div align="center"><input type="text" class="form-control" name="gasoil_premium" value="<?php echo $precios[3]->precio_litro; ?>" style="width: 50%"></div></td>
				</tr>

				<tr>
					<td><?php echo $precios[4]->combustible; ?></td>
					<td><div align="center"><input type="text" class="form-control" name="gnc" value="<?php echo $precios[4]->precio_litro; ?>" style="width: 50%"></div></td>
				</tr>
				
			</tbody>
			<br>
			<br>
		</table>
		<div class="col-md-offset-4 col-md-4 col-xs-12 col-sm-12">
			<button class="btn btn-success btn-aceptar">Aceptar</button>
		</div>
	</div>
</form>
