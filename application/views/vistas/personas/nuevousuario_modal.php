<div class="row">
	<div class="col-md-offset-3 col-md-6 col-sm-12 col-xs-12">
		<label>Nombre de usuario:</label>
	</div>
	<div class="col-md-offset-3 col-md-6 col-sm-12 col-xs-12">
		<input type="text" class="form-control" name="username" placeholder="Username">
	</div>
	
</div>
<br>
<div class="row">
	<div class="col-md-offset-3 col-md-6 col-sm-12 col-xs-12">
		<label>Password:</label>
	</div>
	<div class="col-md-offset-3 col-md-6 col-sm-12 col-xs-12">
		<input type="text" class="form-control" name="password" value="Se genera al hacer Log in" disabled>
	</div>
</div>
<br>
<div class="row">
	<div class="col-md-offset-3 col-md-6 col-sm-12 col-xs-12">
		<label>Rol:</label>
	</div>
	<div class="col-md-offset-3 col-md-6 col-sm-12 col-xs-12">
		<select class="form-control divdependencia" name="rol" id="rol" required>
		
			<option>Seleccionar:</option>
			<?php foreach ($roles as $r): ?>
				<option value="<?php echo $r->id;?>"><?php echo $r->descripcion;?></option>
			<?php endforeach ?>
		</select>
	</div>
</div>
<br>
<div class="row div-dependencia" style="visibility:hidden">
	<div class="col-md-offset-3 col-md-6 col-sm-12 col-xs-12">
		<label>Dependencia:</label>
	</div>
	<div class="col-md-offset-3 col-md-6 col-sm-12 col-xs-12">
		<select class="form-control" name="dependencia" id="dependencia" required>
			<option>Seleccionar:</option>
			<?php foreach ($dependencias as $d): ?>
				<option value="<?php echo $d->id_dependencia;?>"><?php echo $d->dependencia;?></option>
			<?php endforeach ?>
		</select>
	</div>
</div>
<br>
<div class="row">
	<div class="col-md-offset-3 col-md-6 col-sm-12 col-xs-12" align="center">
		<button type="button" class="btn btn-primary btn-crear"><i class="fa fa-check"></i> Crear</button>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		var base_url = "<?php echo base_url();?>";	

		$("select[name=rol]").change(function(){
			if($("select[name=rol]").val()==9){			
				$(".div-dependencia").css("visibility", "visible");
			}else{
				$(".div-dependencia").css("visibility", "hidden");
			}
			

		})

		$('.btn-crear').on("click", function(){
			var username = $("input[name='username']").val();
			var rol = $("select[name='rol']").val();
			var dependencia = $("select[name='dependencia']").val();
			
			if(username=="" || rol=="Seleccionar:" || (dependencia=="Seleccionar:" && $(".div-dependencia").css("visibility")=="visible")){
				swal({
                        icon: "warning",
                        title: "Complete todos los campos",
                    })
			}else{
			$.ajax({
				url: base_url + "Personas/crear_usuario/",
				type: "POST",
				data: "username="+username+"&rol="+rol+"&dependencia="+dependencia,
				success:function(resp){
					if (resp == "true") {
                        swal({
                            title: "Exito!",
                            text: "Usuario creado.",
                            icon: "success",
                            timer: 2000,
                        });
                        setTimeout(function(){
                            window.location= base_url+"Personas/listausuarios/";
                        },2000);
                    }else{
						swal({
                            title: "Error!",
                            text: "El usuario no puede contener espacios",
                            icon: "warning",
                            timer: 2000,
                        });
					}
				}
			})
		}
		})
	
	})
</script>