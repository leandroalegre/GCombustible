<body style="background-color: #F3F3F3; width: 95%; margin: 3px auto">
	<input type="hidden" name="id_vehiculo" id="id_vehiculo" value="<?php echo $vehiculo; ?>">
    <div class="container">
        <h3>NUEVO DETALLE</h3>
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong><?php echo $vehiculodatos[0]->marca; echo " ".$vehiculodatos[0]->modelo; echo " - ".$vehiculodatos[0]->dominio ?></strong>
            </div>
            <div class="panel-body">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-offset-3 col-sm-5">
                            <div class="form-group">
                                <label for="detalle">DETALLE:</label>
                                <textarea name="detalle" class="form-control detalle" required="required" autocomplete="off"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-offset-3 col-sm-5">
                            <div class="form-group">
                                <label>DEPENDENCIA:</label>
                                <select class="form-control" name="dependencia" id="dependencia" required>
                                    <option>Seleccionar:</option>
                                    <?php foreach ($dependencias as $d): ?>
                                    <option value="<?php echo $d->id_dependencia;?>"><?php echo $d->dependencia;?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-offset-3 col-sm-5"> 
                            <div class="form-group">
                                <button type="button" data-toggle="modal" data-target="#modal-personas" class="btn btn-primary btn-search-persona"><i class="glyphicon glyphicon-search"></i> Seleccionar persona</button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-offset-3 col-sm-5">         
                            <div class="form-group">
                                <input type="hidden" name="id_persona" class="form-control">
                                <input type="hidden" name="venc_lic" value="0">
                                <label for="">Persona</label>
                                <input type="text" name="nombre" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                </div>                                                                            
                <div class="row">
                    <div class="col-sm-offset-5 col-sm-3"> 		
                        <button type="button" class="btn btn-success btn-add">Cargar detalle</button>
                    </div>
                </div> 
            </div>
        </div>
    </div>
    <!-- /.modal -->
    <div class="modal fade" id="modal-personas">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" >
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h2 class="modal-title" style="text-align: center">Listado de personas</h2>
                </div>
                <div class="modal-body"> 

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-right btn-cerrar-modal-personas" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
</body>
<script type="text/javascript">
var base_url = "<?php echo base_url();?>";
                    
        $(".btn-search-persona").on("click", function(){
            $.ajax({
                url: base_url + "Personas/getPersonasForEmitirTicketDetalle/",
                success:function(r){
                    $("#modal-personas .modal-body").html(r);
                }
            })
        })


	
	$(".btn-add").on("click", function(){
		var id_vehiculo = $("input[name='id_vehiculo']").val();
        var id_persona = $("input[name='id_persona']").val();
		var detalle = $(".detalle").val();
		var id_dependencia = $('#dependencia').val();
        var nombre = $("input[name='nombre']").val();
        var venc_lic = $("input[name='venc_lic']").val();
        var intVencLic = parseInt(venc_lic);

        if (id_vehiculo == '' || detalle == '' || id_dependencia == 'Seleccionar:' || id_persona=="") {
            swal({
                icon: "warning",
                title: "Completar todos los campos.",
               
            })
        }else{
            if (intVencLic < 0) {
                                swal({
                                    icon: "error",
                                    title: nombre+" posee la licencia de conducir fuera de términos",
                                    text: "Licencia de conducir vencida.",
                                })
                            }else{
    		$.ajax({
    			url: base_url + "Vehiculos/guardar_detalle/",
    			type: "POST",
    			data: "id_vehiculo="+id_vehiculo+"&detalle="+detalle+"&id_dependencia="+id_dependencia+"&id_persona="+id_persona,
    			success:function(resp){
    				if (resp == "true") {
                        swal({
                            icon: "success",
                            title: "Operación exitosa",
                            timer: 2000,
                        })
                        setTimeout(function(){
                            window.location = base_url + "Vehiculos/detalleV/"+id_vehiculo;
                        },2000)
                    }else if (resp == "false"){
                        swal({
                            icon: "error",
                            title: "Hubo un problema al realizar la operación",
                        })
                    }
    			}
    		})
                            }
        }
	})
</script>