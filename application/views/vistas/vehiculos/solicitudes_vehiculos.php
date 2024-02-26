<body style="width: 95%; margin: 3px auto">
    <div class="container">

        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-12">
                        <h1>SOLICITUDES DE SALDO</h1>
                    </div>
                </div>
                
               
            </div>
            <div class="panel-body">
               
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id="tablaTE">
                                <thead style="background-color:#3175B8; color: white;">
                                <th>SECRETARIA</th>
                                    <th>DOMINIO</th>
                                    <th>FECHA DE SOLICITUD</th>
                                    <th>MONTO MENSUAL</th>
                                    <th>OPERACIONES</th>
                                </thead>
                                <tbody>
                                    <?php foreach ($soli as $s): ?>
                                        <tr>
                                            <td style="vertical-align: middle;"><?php echo $s->nombre;?></td>
                                            <td style="vertical-align: middle;"><?php echo $s->dominio;?></td>
                                            <td style="vertical-align: middle;"><?php echo $s->fecha_solicitud;?></td>
                                            <td style="vertical-align: middle;"><?php echo $s->maximo_mensual;?></td>
                                           
                                            <td style="vertical-align: middle;"><button class="btn btn-success btn-info-solcitud" data-toggle='modal' data-target='#modal-saldo-vehiculos' value="<?php echo $s->id_solicitud ?>"><i class=" glyphicon glyphicon-check"></i> 
                                            INGRESAR SALDO</button>
                                            <button class="btn btn-danger btn-rechazar" value="<?php echo $s->id_solicitud;?>"><i class=" glyphicon glyphicon-remove"></i> RECHAZAR</button></td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    


    <!-- /.modal -->
    <div class="modal fade" id="modal-saldo-vehiculos">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h2 class="modal-title" style="text-align: center">OTORGAR SALDO</h2>
                </div>
                <div class="modal-body"> 
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-right btn-cerrar-info-solcitud" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->




    <style type="text/css">
        th,td{
            text-align: center;
            font-size:18px;
            vertical-align: middle;
        }
    </style>
</body>
<style type="text/css">
    th,td{
        text-align: center;
    }
</style>
<script src="<?php echo base_url();?>public/sweetAlert/sweetAlert.min.js"></script>
<script src="<?php echo base_url();?>public/jquery/jquery-3.4.1.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        var base_url = "<?php echo base_url();?>";


     
        

        //-----------------------------------------------------------------

        $(".btn-info-solcitud").on("click", function(){
            var val = $(this).val();
            $.ajax({
                url: base_url + "Vehiculos/otorgarSaldoVehiculos/" + val,
                success:function(r){
                  $("#modal-saldo-vehiculos .modal-body").html(r);
                }
            })
        })

        $(".btn-rechazar").on("click", function(){
            var id_solicitud = $(this).val();
          
            swal({
                title: "Se rechazará la solicitud",
                text: "¿Desea continuar?",
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
                        url: base_url + "Vehiculos/rechazarSolicitud/"+id_solicitud,
                        success:function(r){
                            if (r == "true") {
                                swal({
                                    icon: "success",
                                    title: "Operación exitosa",
                                    timer: 2000,
                                })
                                setTimeout(function(){
                                    location.reload();
                                },2000)
                            }else if (r == "false"){
                                swal({
                                    icon: "error",
                                    title: "Hubo un problema al realizar la operación.",
                                })
                            }
                        }
                    })
                    break;
                    default:
                    swal.close();
                }
            });
        })

        

        $("#tablaTE").DataTable({
            "order":[2, "desc"],
            "pageLength": 25,
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
      })

    

    })
</script>