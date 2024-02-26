<?php function diamesanio($fecha){ 
      return substr($fecha,8,2)."/". substr($fecha, 5,2)."/".substr($fecha, 0,4);  
    } ?>
<body style="width: 95%; margin: 3px auto">
    <div class="container">

        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-12">
                        <h1>SOLICITUDES DE SALDO PARA DIRECCIONES</h1>
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
                <!-- <div class="row">
                    <div class="col-md-12">
                        <div class="pull-right">
                            <a href="<?php echo base_url();?>Ticket/"><button class="btn btn-primary btn-lg"><i class="glyphicon glyphicon-plus"></i> OTORGAR SALDO</button></a>
                        </div>
                    </div>
                </div>
                <br> -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id="tablaTE">
                                <thead style="background-color:#3175B8; color: white;">
                                    <th>DIRECCIÓN SOLICITANTE</th>
                                    <th>MONTO</th>
                                    <th>FECHA DE SOLICITUD</th>
                                    <th>OPERACIONES</th>
                                </thead>
                                <tbody>
                                    <?php foreach ($soli as $s): ?>
                                        <tr>
                                            <td style="vertical-align: middle;"><?php echo $s->nombre;?></td>
                                            <td style="vertical-align: middle;"><?php echo "$".$s->monto;?></td>
                                            <td style="vertical-align: middle;"><?php echo diamesanio($s->fecha);?></td>
                                            <td style="vertical-align: middle;"><button class="btn btn-success btn-confirm-soli" value="<?php echo $s->id."*".$s->nombre."*".$s->monto."*".$s->id_dir;?>"><i class=" glyphicon glyphicon-check"></i> 
                                            APROBAR</button>
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

        $(".btn-confirm-soli").on("click", function(){
            var val = $(this).val();
            var info = val.split("*");
            var id = info[0];
            var nombre = info[1];
            var monto = info[2];
            var id_dir = info[3];
            var saldo_sec = $("input[name='saldo_actual_sec']").val();

            var intSaldoSec = parseInt(saldo_sec);
            var intMonto = parseInt(monto);

            if (intMonto > intSaldoSec) {
                swal({
                    icon: "success",
                    title: "Saldo Insuficiente.",
                    text: "Se recomienda solicitar saldo a contaduría"
                })
            }else{
                swal({
                    title: "Se acreditarán $"+monto+" a la "+nombre,
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
                            url: base_url + "Ticket/confirmSoliForSecretario/",
                            type: "POST",
                            data: "id_soli="+id+"&monto="+intMonto+"&id_dir="+id_dir+"&saldo_sec="+intSaldoSec,
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
            }
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
                        url: base_url + "Ticket/rechazarSolicitudForSecretario/"+id,
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