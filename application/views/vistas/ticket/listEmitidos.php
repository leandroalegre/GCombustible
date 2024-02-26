<body style="width: 95%; margin: 3px auto">
    <div class="container">
        <div class="panel-default">
            <div class="panel-heading">
                <h1>REGISTRO DE TICKETS EMITIDOS <small>Sin cargar</small></h1>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="pull-right">
                            <?php if ($this->session->userdata('rol') == 2) { ?>
                            <a href="<?php echo base_url();?>Ticket/"><button class="btn btn-primary btn-lg"><i class="glyphicon glyphicon-plus"></i> NUEVO TICKET</button></a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id="tablaTE">
                                <thead style="background-color:#3175B8; color: white;">
                                    <th>TICKET</th>
                                    <th>PERSONA</th>
                                    <th>DOMINIO</th>
                                    <th>IMPORTE</th>
                                    <?php if ($this->session->userdata('rol')==1 || $this->session->userdata('rol')==6){ ?>
                                       <th>SECRETARIA</th> 
                                    <?php } ?>
                                    <th>FECHA</th>
                                    <th>INFO</th>
                                    <th>CANCELAR</th>
                                </thead>
                                <tbody>
                                    <?php foreach ($emi as $e): ?>
                                        <tr>
                                            <td><?php echo "N° ".$e->num;?></td>
                                            <td><?php echo $e->per;?></td>
                                            <td><?php echo $e->ve;?></td>
                                            <td><?php echo "$".$e->imp;?></td>
                                            <?php if ($this->session->userdata('rol')==1 || $this->session->userdata('rol')==6){ ?>
                                            <td><?php echo $e->sec; ?></td>
                                            <?php } ?>
                                            <td><?php echo $e->fecha;?></td>
                                            <td><button class="btn btn-info btn-info-ticket" data-toggle='modal' data-target='#modal-info-ticket' value="<?php echo $e->id ?>"><i class=" glyphicon glyphicon-search"></i></button></td>
                                            <TD><button class="btn btn-danger btn-cancelar-ticket" data-toggle='modal' data-target='#modal-cancelar-ticket' value="<?php echo $e->id ?>"><i class="glyphicon glyphicon-remove"></i></button></TD>
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
    <style type="text/css">
        th,td{
            text-align: center;
            font-size:18px;
            vertical-align: middle;
        }
    </style>

    <!-- /.modal -->
    <div class="modal fade" id="modal-info-ticket">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h2 class="modal-title" style="text-align: center">Detalle del ticket</h2>
                </div>
                <div class="modal-body"> 

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-right btn-cerrar-info-ticket" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->


    <!-- /.modal -->
    <div class="modal fade" id="modal-cancelar-ticket">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h2 class="modal-title" style="text-align: center">Cancelar ticket</h2>
                </div>
                <div class="modal-body"> 

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success btn-confirmar">Confirmar</button>
                    <button type="button" class="btn btn-danger pull-right btn-cerrar-info-ticket" data-dismiss="modal">Cerrar</button>
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
</style>
<script src="<?php echo base_url();?>public/sweetAlert/sweetAlert.min.js"></script>
<script src="<?php echo base_url();?>public/jquery/jquery-3.4.1.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        var base_url = "<?php echo base_url();?>";

        $(".btn-info-ticket").on("click", function(){
            var val = $(this).val();
            $.ajax({
                url: base_url + "Ticket/getInfoTicketById/" + val,
                success:function(r){
                    $("#modal-info-ticket .modal-body").html(r);
                }
            })
        })

         $(".btn-cancelar-ticket").on("click", function(){
            var val = $(this).val();
            $.ajax({
                url: base_url + "Ticket/getInfoTicketByIdCancelar/" + val,
                success:function(r){
                    $("#modal-cancelar-ticket .modal-body").html(r);
                }
            })
        })


$(".btn-confirmar").on("click", function(){

            var motivo = $("textarea[name='motivo']").val();
            var id_ticket = $("input[name='id_ticket']").val();
            $(".btn-confirmar").prop("disabled", true);
            if (motivo=="") {
                $(".btn-confirmar").prop("disabled", false);
                 swal({
            title: "Falta información",
            text: "Debe completar el motivo",
            icon: "warning",
        });
             }else{
            $.ajax({
                url: base_url + "Ticket/cancelarTicket/" + id_ticket,
                type: "POST",
                data: "motivo="+motivo,
                success:function(r){
                  if(r=="true"){
                                swal({
                                    icon: "success",
                                    title: "Operación exitosa",
                                    timer: 2000,
                                })
                                setTimeout(function(){
                                    window.location = base_url + "Ticket/listEmitidos";
                                },2000)
                               
                            }else{
                                $(".btn-confirmar").prop("disabled", false);
                            }


                
           
                }
            })
            }
        })


 <?php if ($this->session->userdata('rol')==1){ ?>
        $("#tablaTE").DataTable({
            "order":[5, "desc"],
            "pageLength": 10,
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

    <?php }else{ ?>

        $("#tablaTE").DataTable({
            "order":[4, "desc"],
            "pageLength": 10,
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

    <?php } ?>

    })
</script>