<?php function diamesanio($fecha){ 
      return substr($fecha,8,2)."/". substr($fecha, 5,2)."/".substr($fecha, 0,4);  
    } ?>
<body style="width: 95%; margin: 3px auto">
    <div class="container">

        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-12">
                        <h1>SOLICITUDES DE SALDO</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="pull-right">Saldo restante: $<?php echo $saldo->num?></h3>
                        <input type="hidden" name="saldo_actual_sec" value="<?php echo $saldo->num?>">
                    </div> 
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-danger pull-right btn-solicitar" style="font-size: 18px">Solicitar saldo a contaduría</button>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="pull-right">
                            <button class="btn btn-primary btn-lg" type="button" data-toggle='modal' data-target='#modal-o-s'><i class="glyphicon glyphicon-plus"></i> OTORGAR SALDO A DIRECCIÓN</button>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id="tablaTE">
                                <thead style="background-color:#3175B8; color: white;">
                                    <th>DIRECCIÓN SOLICITANTE</th>
                                    <th>FECHA DE SOLICITUD</th>
                                    <th>OPERACIONES</th>
                                </thead>
                                <tbody>
                                    <?php foreach ($soli as $s): ?>
                                        <tr>
                                            <td style="vertical-align: middle;"><?php echo $s->nombre;?></td>
                                            <td style="vertical-align: middle;"><?php echo diamesanio($s->fecha);?></td>
                                            <td style="vertical-align: middle;"><button class="btn btn-success btn-info-solcitud" data-toggle='modal' data-target='#modal-info-solcitud' value="<?php echo $s->id ?>"><i class=" glyphicon glyphicon-check"></i> 
                                            INGRESAR SALDO</button>
                                            <button class="btn btn-danger btn-rechazar" value="<?php echo $s->id."*".$s->nombre;?>"><i class=" glyphicon glyphicon-remove"></i> RECHAZAR</button></td>
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
    <div class="modal fade" id="modal-o-s">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h2 class="modal-title" style="text-align: center">OTORGAR SALDO A DIRECCION</h2>
                </div>
                <div class="modal-body"> 
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h5>CAMPOS OBLIGATORIOS <span style="color: red">*</span></h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <select class="form-control" id="selectSec" name='selectSec'>
                                                <option value="0">SELECCIONE LA DIRECCION:</option>
                                                <?php foreach ($direcciones as $s): ?>
                                                    <option value="<?php echo $s->id."*".$s->saldo."*".$s->nombre;?>"><?php echo $s->nombre." - <b class='textSaldo'>$".$s->saldo."</b>";?></option>
                                                <?php endforeach ?>
                                            </select>
                                            <br>
                                            <div class="input-group" >
                                                 <span class="input-group-addon">$</span>
                                                 <input type="number" class="form-control" id="montoOtorgado" readonly="readonly" required="required" name="montoOtorgado" placeholder="INGRESE EL MONTO">
                                            </div>
                                            <span style="color: red" class="help-block">Aún no se ha seleccionado la direccion.*</span>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="button" class="btn btn-success pull-right btn-o-s">CONFIRMAR</button>
                                        </div>   
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-right btn-cerrar-modal" data-dismiss="modal">CERRAR</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->


    <!-- /.modal -->
    <div class="modal fade" id="modal-info-solcitud">
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


        //modal orotgar a direccion sin solicitud

        $("#selectSec").on("change", function(){
            var val = $(this).val();
            if (val != '0') {
                $("#montoOtorgado").attr("readonly", false);
                $(".help-block").css({"display":"none"});
            }else{
                 $("#montoOtorgado").attr("readonly", true);
                 $(".help-block").css({"display":"block"});
            }
        })

        $(".btn-o-s").on("click", function(){
            var val = $("#selectSec").val();
            var info = val.split("*");
            var id_dir = info[0];
            var saldo_actual = info[1];
            var nombre = info[2];
            var monto = $("input[name='montoOtorgado']").val();

            var intSaldoActual = parseInt(saldo_actual);
            var intMonto = parseInt(monto);
            var total = (intSaldoActual + intMonto);

            var saldo_actual_sec = $("input[name='saldo_actual_sec']").val();
            var intSaldo_actual_sec=parseInt(saldo_actual_sec);

            if (id_dir == '0') {
                swal({
                    icon: "warning",
                    title: "SELECCIONE UNA DIRECCION"
                })
            }else{
                if (monto == "") {
                    swal({
                        icon: "warning",
                        title: "INGRESE EL MONTO A OTORGAR"
                    })
                }else{
                    if (intMonto > intSaldo_actual_sec) {
                        swal({
                            icon: "error",
                            title: "SALDO INSUFICIENTE.",
                            text: "Se recomienda solicitar saldo a contaduría"
                        })
                    }else if(monto <= 0){
                        swal({
                            icon: "error",
                            title: "Monto no permitido.",
                            text: "Solo esta permitido ingresar montos mayor a 0.",
                        })
                    }else{
                        swal({
                            title: "Se otorgarán $"+monto+" a la "+nombre+", quedando con un saldo total de $"+total,
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
                                    url: base_url + "Ticket/otorgarSaldoDesdeSecToDirSinSolicitud/",
                                    type: "POST",
                                    data: "id_dir="+id_dir+"&monto="+total+"&otorgando="+monto+"&saldo_actual_sec="+saldo_actual_sec,
                                    success:function(r){
                                        if (r = true) {
                                            swal({
                                                icon: "success",
                                                title: "Operación exitosa",
                                                timer: 2000,
                                            })
                                            setTimeout(function(){
                                                location.reload();
                                            },2000)
                                        }else{
                                            swal({
                                                icon: "error",
                                                title: "Hubo un problema al realizar la operación",
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
                }
            }   
        })

        //-----------------------------------------------------------------

        $(".btn-info-solcitud").on("click", function(){
            var val = $(this).val();
            $.ajax({
                url: base_url + "Ticket/otorgarSaldoModalSecDir/" + val,
                success:function(r){
                    $("#modal-info-solcitud .modal-body").html(r);
                }
            })
        })

        $(".btn-rechazar").on("click", function(){
            var val = $(this).val();
            var info = val.split("*");
            var id = info[0];
            var nombre = info[1];
            swal({
                title: "Se rechazará la solicitud de la "+nombre,
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
                        url: base_url + "Ticket/rechazarSolicitud/"+id,
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

        $(".btn-solicitar").on("click", function(){
            var a = "a contaduria";
            swal({
                title: "Se solicitará saldo a contaduría.",
                text: "¿Continuar?",
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
                        url: base_url + "Ticket/solicitarSaldo/",
                        type: "POST",
                        data: "aContaduria="+a,
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
                                    title: "Aún no ha sido confirmada su solicitud anterior",
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
            "order":[1, "desc"],
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