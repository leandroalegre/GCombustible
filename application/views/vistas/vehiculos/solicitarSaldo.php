<body style="width: 95%; margin: 3px auto">
    <div class="container">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h1>SOLICITUD DE SALDO PARA VEHICULOS</h1>
            </div>
            <div class="panel-body">
            
                <br>
               
       
                <div class="row">
                    <div class="buscar vehiculo col-md-offset-1 col-md-5">
                        <button type="button" class="btn btn-lg btn-block btn-primary btn-search-vehiculo" data-toggle="modal" data-target="#modal-vehiculos"><i class="glyphicon glyphicon-search"></i> Seleccionar vehículo</button>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="datos vehiculo col-md-offset-1 col-md-10">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h5>SOLICITUD</h5>
                            </div>
                            <div class="panel-body">
                                <div class="col-md-4 col-xs-12 col-sm-12">
                                    <label>Dominio</label>
                                    <input type="hidden" name="id_vehiculo" value="0">
                                    <input type="hidden" name="tipo_vehiculo">
                                    <input type="text" name="dominio" class="form-control" readonly="readonly">
                                </div>
                                <div class="col-md-4 col-xs-12 col-sm-12">
                                    <label>Marca</label>
                                    <input type="text" name="marca" class="form-control" readonly="readonly">
                                </div>
                                <div class="col-md-4 col-xs-12 col-sm-12">
                                    <label>Modelo</label>
                                    <input type="text" name="modelo" class="form-control" readonly="readonly"><br>
                                </div>
                                <div class="col-md-offset-3 col-md-4 col-xs-12 col-sm-12">
                                    <label>Motivo por el que solicita saldo</label>
                                    <textarea name="motivo_solicitud" class="form-control" cols="90" rows="5"></textarea>
								</div>
								<div class="col-md-2">
								<label>Limite actual</label>
                                    <input type="text" name="maximo_mensual" class="form-control" readonly="readonly"><br>
								</div>
                            </div>
                        </div>
                    </div>
                </div>
            
                
            </div>
            <div class="panel-footer">
                <div class="row">
                    <div class="botones guardar y cancelar col-md-offset-4 col-md-8">
                        <div class="col-md-6 col-xs-12 col-sm-12">
                            <button type="button" class="btn btn-lg btn-block btn-success btn-confirmar-solicitud"></i> Confirmar solicitud</button>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>



    

        
    <!-- /.modal -->
    <div class="modal fade" id="modal-vehiculos">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h2 class="modal-title" style="text-align: center">Listado de vehículos</h2>
                </div>
                <div class="modal-body"> 

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-right btn-cerrar-modal-vehiculos" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

</body>
<style type="text/css">
    th,td{
        text-align: center;
    }
    .swal-text{
        text-align: center;
    }
</style>
<script src="<?php echo base_url();?>public/sweetAlert/sweetAlert.min.js"></script>
<script src="<?php echo base_url();?>public/jquery/jquery-3.4.1.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        var base_url = "<?php echo base_url();?>";

       

        $(".btn-search-vehiculo").on("click", function(){
          
            $.ajax({
                url: base_url + "Vehiculos/getVehiculosSolicitarSaldo/",
                success:function(r){
                    $("#modal-vehiculos .modal-body").html(r);
                }
            })
        })

        $(".btn-confirmar-solicitud").on("click", function(){
            var id_vehiculo = $("input[name='id_vehiculo']").val();
            var motivo = $("textarea[name='motivo_solicitud']").val();
            var dominio = $("input[name='dominio']").val();


            if(id_vehiculo==0){
                swal({
                        icon: "warning",
                        title: "Seleccione un vehículo",
                    })
            }else if(motivo==""){
                swal({
                        icon: "warning",
                        title: "Complete el motivo",
                    })
            }else{

                swal({
                        title: "¿Confirma la solicitud para el dominio "+dominio+"?",
                        icon: "info",
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
                                    url: base_url + "vehiculos/confirmarSolicitud/",
                                    type: "POST",
                                    data: "id_vehiculo="+id_vehiculo+"&motivo="+motivo,
                                    success:function(r){
                                        if (r == "true") {
                                            swal({
                                                icon: "success",
                                                title: "Operación exitosa",
                                                timer: 2000,
                                            })
                                            setTimeout(function(){
                                                window.location = base_url + "Vehiculos/solicitarSaldo";
                                            },2000)
                                        }else if (r == "tiene"){
                                            swal({
                                                icon: "error",
                                                title: "El vehiculo ya posee una solicitud en espera de aprobacion",
                                            })
                                        }
                                    }
                                })
                            break;
                            default:
                                swal.close();
                        }
                    });  

            }
        })

    })
        
</script>

