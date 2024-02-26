
<form method="POST" action="<?php echo base_url()?>personas/edit">	
	<div class="row">
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading cleafix">
					<h2 style="text-align: center;">Datos <br> del <br> vehículo</h2>
				</div>
				<div class="panel-body">
					<?php if ($this->session->userdata('rol') == 1)) { ?>					
					<div class="form-group">
						<label for="nombre_secretaria">Nombre y apellido</label>
						<input type="hidden" name="id" value="<?php echo $s->id ?>">
						<input type="text" name="nombre" class="form-control" value="<?php echo $s->nombre;?>">
					</div>
					<?php }else{ ?>
					<div class="form-group">
						<label for="nombre_secretaria">Nombre y apellido</label>
						<input type="hidden" name="id" value="<?php echo $s->id ?>">
						<input type="text" name="nombre" class="form-control" value="<?php echo $s->nombre;?>" disabled>
					</div>
					<?php } ?>
					<?php if ($this->session->userdata('rol') == 1)) { ?>
					<div class="form-group">
						<label for="nombre_secretaria">Dni</label>
						<input type="text" name="dni" class="form-control" value="<?php echo $s->dni;?>">
					</div>
					<?php }else{ ?>
					<div class="form-group">
						<label for="nombre_secretaria">Dni</label>
						<input type="text" name="dni" class="form-control" value="<?php echo $s->dni;?>" disabled>
					</div>	
					<?php } ?>
					<?php if ($this->session->userdata('rol') == 1)) { ?>
					<div class="form-group">
						<label for="nombre_secretaria">Legajo</label>
						<input type="text" name="legajo" class="form-control" value="<?php echo $s->legajo;?>">
					</div>
					<?php }else{ ?>
					<div class="form-group">
						<label for="nombre_secretaria">Legajo</label>
						<input type="text" name="legajo" class="form-control" value="<?php echo $s->legajo;?>" disabled>
					</div>	
					<?php } ?>
					<?php if ($this->session->userdata('rol') == 1 || $this->session->userdata('rol') == 2)) { ?>
					<div class="form-group">
						<label for="telefono">FECHA DE VENCIMIENTO DE LICENCIA:</label>
						<input type="date" name="vencimiento_licencia" value="<?php echo $s->vencimiento_licencia ?>" class="form-control" required="required" autocomplete="off">
					</div>
					<?php }else{ ?>
					<div class="form-group">
						<label for="telefono">FECHA DE VENCIMIENTO DE LICENCIA:</label>
						<input type="date" name="vencimiento_licencia" value="<?php echo $s->vencimiento_licencia ?>" class="form-control" required="required" autocomplete="off" disabled>
					</div>
					<?php } ?>
					<?php if ($this->session->userdata('rol') == 1 || $this->session->userdata('rol') == 2)) { ?>
					<div class="form-group">
						<label for="telefono">EMAIL:</label>
						<input type="text" name="email" value="<?php echo $s->mail ?>" class="form-control" required="required" autocomplete="off">
					</div>
					<?php }else{ ?>
					<div class="form-group">
						<label for="telefono">EMAIL:</label>
						<input type="text" name="email" value="<?php echo $s->mail ?>" class="form-control" required="required" autocomplete="off" disabled>
					</div>	
					<?php } ?>	
				</div>
			</div>
		</div>      

		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading cleafix">
					<h2 style="text-align: center;">Área donde desempeña actividades</h2>
				</div>
				<div class="panel-body">
					<div class="selects">
						<div class="form-group">
							<label>SECRETARIA:</label><select class="form-control" name="id_sec" id="id_sec">
								<option value="<?php echo $s->id_sec ?>" selected><?php echo $s->nom_sec ?></option>
								<?php foreach ($sec as $se): ?>
									<?php if ($s->nom_sec!=$se->nombre){ ?>
										<option value="<?php echo $se->id;?>"><?php echo $se->nombre;?></option>
									<?php } ?>
								<?php endforeach ?>


							</select>
						</div>
						<div class="form-group">
							<label>DIRECCION:</label><select class="form-control" name="id_dir" id="id_dir">
								<option value="<?php echo $s->id_dir ?>" selected><?php echo $s->nom_dir ?></option>
								<?php foreach ($direccion as $row): ?>
									<?php if ($s->nom_dir!=$row->nombre){ ?>
										
										<option value="<?php echo $row->id_dire ;?>"><?php echo $row->nombre;?></option>
										<?php 
									} ?>
								<?php endforeach ?>

							</select>
						</div>
						<div class="form-group">
							<label>AREA:</label><select class="form-control" name="id_area" id="id_area">
								<option value="<?php echo $s->id_are ?>" selected><?php echo $s->nom_ar ?></option>
								<?php foreach ($ar as $aa): ?>
									<?php if ($s->nom_ar!=$aa->nombre_ar){ ?>
										
										<option value="<?php echo $aa->id_area;?>"><?php echo $aa->nombre_ar;?></option>
										<?php 
									} ?>
								<?php endforeach ?>
							</select>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<br>
	<button type="submit" style="width: 65%; margin: 0 auto; display: block" class="btn btn-success" onclick="alert()">EDITAR</button>
</form>

<script src="<?php echo base_url();?>public/sweetAlert/sweetAlert.min.js"></script>
<script type="text/javascript">





	$(document).on("change", "#id_sec", function(){
		$("#id_sec option:selected").each(function () {
			id_sec = $('#id_sec').val();
			$.post("<?php echo base_url() ?>Vehiculos/getDirecciones", {
				id_sec: id_sec
			}, function (data) {
				$("select[name='id_dir']").html(data);
			});
		});
	});


	$(document).on("change", "#id_dir", function(){
		$("#id_dir option:selected").each(function () {
			id_dir = $('#id_dir').val();
			id_sec = $('#id_sec').val();
			$.post("<?php echo base_url() ?>Vehiculos/getAreas", {
				id_dir: id_dir, id_sec : id_sec
			}, function (data) {
				$("select[name='id_area']").html(data);
			});
		});
	});



	function alert(){
		swal({
			icon: "success",
			title: "Exito!",
			text: "Vehículo editado correctamente"
		})
	}
</script>