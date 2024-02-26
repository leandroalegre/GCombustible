<body style="width: 95%; margin: 3px auto">
<div class="col-md-8 col-md-offset-2 col-xs-12">
<section class="content-header">
<button class="btn btn-primary pull-right btn-nuevousuario">Nuevo usuario</button>
        <h1>
            Usuarios
            <small>Listado</small>
        </h1>
        
</section>
<section class="content">
        <!-- Default box -->
      
            <div class="box-body">
                
                <hr>
                <div class="row">                            
                    <div class="col-md-12 col-xs-12">
                        <div class="table-responsive">
                            <table id="tabla1" class="table table-bordered table-hover">
                                <thead style="background-color: #3175B8; color: white">
                                    <tr>
                                        <th>Nombres y Apellido</th>                                   
                                        <th>Usuario</th>
                                        <th>Secretaria</th>
                                        <th>Rol</th>
                                        <th>Ultimo Login</th>
                                        <th>Blanquear contraseña</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        <?php foreach ($usu as $usuario): ?>
                                            <tr>
                                                <td><?php echo $usuario->nombre; ?></td>
                                                <td><?php echo $usuario->username; ?></td>
                                                <td><?php echo $usuario->nombresec;?></td>
                                                <td><?php echo $usuario->descripcion; ?></td>
                                                <td><?php echo $usuario->Login; ?></td>
                                                <td>
                                                    <?php if ($usuario->nombresec == "ADMIN") {
                                                        
                                                    }else{ ?>
                                                    <button type="button" id="blanquear-pass-usuario" value="<?php echo $usuario->id_usu?>" style="width: 100px" class="btn btn-primary blanquearpass"><i class="fa fa-key"></i></button>
                                                <?php }; ?>
                                                </td>
                                            </tr> 
                                        <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
</div>

<!-- modal -->
<div class="modal fade" id="modal-nuevousuario">
		<div class="modal-dialog">
			<div class="modal-content" style="background-color: #EEEEEE">
				<div class="modal-header" align="center">
					<h3>NUEVO USUARIO</h3>
				</div>
				<div class="modal-body"> 
				</div>
				<div class="modal-footer">	
				</div>
			</div>
		</div>
	</div>
	<!-- /.modal -->


</body>

<script type="text/javascript">
    var base_url = "<?php echo base_url()?>";


    $('.btn-nuevousuario').on("click", function(){
				$.ajax({
					url: base_url + "Personas/nuevousuario_modal",
					success:function(resp){
						$("#modal-nuevousuario").modal("show");
						$("#modal-nuevousuario .modal-body").html(resp);
					}
				})
			})



    $(".blanquearpass").on("click",function(){
            var id = $(this).val();
            var pass = "";
            var nombre = "";
            $.ajax({
                url: base_url + "Personas/getNombreUsuario/" + id,
                success:function(resp){
                    swal({
                        title: "¿Desea blanquear la clave de "+resp+"?",
                        icon: "warning",
                        buttons: {
                            cancel: "Cancelar",
                            catch: {
                            text: "Confirmar",
                            value: "confirmar",
                            },
                        },
                    })
                    .then((value) => {
                        switch (value) {
                            case "confirmar":
                                 $.ajax({
                                    url: base_url + "Personas/blanquearPass/",
                                    type: "POST",
                                    data: "id="+id+"&pass="+pass,
                                    success:function(resp){
                                        if (resp == "true") {
                                            swal({
                                                title: "Exito!",
                                                text: "Blanqueo de clave exitoso.",
                                                icon: "success",
                                                timer: 2000,
                                            });
                                            setTimeout(function(){
                                                window.location= base_url+"Personas/listausuarios/";
                                            },2000);
                                        }
                                    }
                                });
                            break;
                            default:
                                swal.close();
                        }
                    });
                }
            });
        });
</script>