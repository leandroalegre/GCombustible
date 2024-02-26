<!DOCTYPE html>

  <html lang="es">
    <head>
    <meta charset="UTF-8">
    <title>Control de tickets de nafta </title>
    <link rel="shortcut icon" href="<?php echo base_url(); ?>favicon.ico"/>
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- <link rel="stylesheet" href="<?php echo base_url();?>public/bootstrap/css/navbar.css"/> -->
        <link rel="stylesheet" href="<?php echo base_url();?>public/bootstrap/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="<?php echo base_url();?>public/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
        <link rel="stylesheet" href="<?php echo base_url()?>libs/css/main.css" />
        <link rel="stylesheet" href="<?php echo base_url();?>public/datatables.net-bs/css/dataTables.bootstrap.min.css">
        <script src="<?php echo base_url();?>public/jquery/jquery-3.4.1.min.js"></script>
        <script src="<?php echo base_url();?>public/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url();?>public/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
        <script>

            $(document).ready(function(){

                $("#tabla1").DataTable({
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
                });

            })
        </script>
    </head>
    <body style="width: 95%; margin:3px auto" onload="inactivityTime()">
        <div class="container">
            <div class="panel panel-default">
                <div class="col-sm-3">
                    <img src="<?php echo base_url()?>public/images/logo-transparente.png" style='height: 60px; margin-top: 7px'>
                </div>
                <div class="panel-heading" >
                    <h4 style="margin-left: 60%;">CARGA DE COMBUSTIBLE</h4>
                </div>

                <div class="panel-body">

                    <div class="row">
                        <div class="col-sm-offset-1 col-sm-3">
                            <!-- <h4>Pase tarjeta por el lector</h4> -->
                            
                            <input type="hidden" name="id_row_tarjeta" value="">
                        </div>
                        
                        
                    </div>
                    
                    <div class="row">
                        <div class="datos ticket col-sm-7">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-sm-3"><h5>PERSONA</h5></div>
                                        <h5><div class="col-sm-9"><span id="num_ticket" style="font-size: 18px;"></span></div></h5>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-sm-1">
                                            <input type="text" style="visibility: hidden" id="id_vehiculo" autofocus class="form-control" name="id_vehiculo">
                                        </div>
                                        <div class="col-sm-6">
                                            <label>Nombre y apellido</label>
                                            <input type="text" name="nombre" class="form-control" readonly="readonly">
                                        </div>
                                        <div class="col-sm-4">
                                            <label>Dni</label>
                                            <input type="text" name="dni" class="form-control" readonly="readonly">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        

                        
                        <div class="col-sm-5">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h5>VALOR DEL TICKET</h5>
                                </div>
                                <div class="panel-body">

                                    <div class="col-sm-6">
                                        <label>Importe</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">$</span>
                                            <input type="text" class="form-control" name="importe" readonly>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Cargado</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">$</span>
                                            <input type="number" id="importe_cargado" class="form-control" name="importe_cargado" autofocus>
                                        </div>
                                    </div>
									<div class="col-sm-offset-3 col-sm-6 tipo_comb_input" style="visibility: collapse; margin-top:2%">
									<label>Tipo de combustible</label>
                                        <div class="input-group">
                                            <input type="text" id="tipo_comb" class="form-control" name="tipo_comb">
											<input type="hidden" id="id_comb_cargado" class="form-control" name="id_comb_cargado">
                                        </div>
									</div>
                                </div>
                            </div>
                        </div>
                    </div>


                    
                    <div class="row">
                        <div class="datos vehiculo col-sm-offset-1 col-sm-10">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h5>DATOS DEL VEHÍCULO</h5>
                                </div>
                                <div class="panel-body">
                                    <div class="col-sm-4">
                                        <label>Dominio</label>
                                        <input type="hidden" value="0" name="id_ticket">
                                        <input type="text" name="dominio" class="form-control" readonly="readonly">
                                    </div>
                                    <div class=" col-sm-4">
                                        <label>Marca</label>
                                        <input type="text" name="marca" class="form-control" readonly="readonly">
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Modelo</label>
                                        <input type="text" name="modelo" class="form-control" readonly="readonly">
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="botones guardar y cancelar col-sm-offset-4 col-sm-12">
                            <div class="col-sm-3 ">
                                <button type="button" class="btn btn-lg btn-block btn-success btn-confirmar">Confirmar <i class="glyphicon glyphicon-ok"></i></button>
                            </div>
                            
                        </div>
                    </div>
                </div>
                
            </div>
        </div>


        <!-- /.modal -->
        <div class="modal fade" id="modal-ticket">
            <div class="modal-dialog modal-lg" style="text-align: center">
                <div class="modal-content">
                    <div class="modal-header">
                        

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger pull-right btn-cerrar-modal-carga" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->


        </body>

        <script type="text/javascript">

            function inactivityTime(){
                var myVar = setInterval(refresh, 600000); //refrescar cada tantos segundos luego de algun click (10 min)
                document.onclick = stop;
                

                function refresh() {
                    location.reload();
                }

                function stop() {
                    clearInterval(myVar);
                    setTimeout(inactivityTime, 600000); //tiempo que aguarda para comenzar a refrescar luego de hacer algun click
                }
            }
            document.oncontextmenu = function(){return false}

$(document).keypress(function(e) {
        if(e.which == 13) {
            $(".btn-confirmar").click();
        }
    });


            $(document).ready(function(){
                

                var base_url = "<?php echo base_url(); ?>";

                setInterval(function(){
                    $.ajax({
                        url: base_url + "Tarjeta/readCardEnPlaya/",
                        success:function(r){
                            if (r == "false") {
                                return false;
                            }else{
                                info = r.split("*");
                                $("#id_vehiculo").val(info[0]);
                                $("input[name='id_row_tarjeta']").val(info[1]);
                                abrirModal();
                            }
                        }
                    })
                },100);

                function setearIdTarjeta(){
                    var id_row = $("input[name='id_row_tarjeta']").val();
                    if (id_row == "") {
                        return false;
                    }else{
                        $.ajax({
                            url: base_url + "Tarjeta/setearId/" + id_row
                        })
                    }
                }

                function abrirModal(){
                    var tecla = $("#id_vehiculo").val().length
                    var id_vehiculo = $("input[name='id_vehiculo']").val();

                    // if (tecla>0){
                        $('#modal-ticket').modal('show');
                        setearIdTarjeta();
                        $.ajax({
                            url: base_url + "Ticket/buscarTicketsPorVehiculo",
                            type: "POST",
                            data: "id_vehiculo="+id_vehiculo,
                            success:function(e){
                                $("#modal-ticket .modal-header").html(e);
                                $("#id_vehiculo").val("");
                                $("#id_vehiculo").focus();
                            }
                        })
                    // }else{
                    //     return false;
                    // }
                }

            $("#modal-ticket").on('hidden.bs.modal', function () {
                $("#id_vehiculo").val("");
                $("#id_vehiculo").focus();
            });


            $(".btn-confirmar").on("click", function(){
                var id_ticket = $("input[name='id_ticket']").val();
                var importe_cargado = $("input[name='importe_cargado']").val();
                var importe = $("input[name='importe']").val();
				var tipo_comb = $("input[name='tipo_comb']").val();
				var id_comb_cargado = $("input[name='id_comb_cargado']").val();
                 $(".btn-confirmar").prop("disabled", true);
                if (id_ticket == '0') {
                    swal({
                        icon: "warning",
                        title: "Pase tarjeta por el lector",
                    })
                    $(".btn-confirmar").prop("disabled", false);
                }else if(importe_cargado==""){
                    swal({
                        icon: "warning",
                        title: "Ingrese el importe cargado",
                    })

$(".btn-confirmar").prop("disabled", false);
                }else{
                    var diferencia = importe - importe_cargado;
                        if (diferencia>=1 && diferencia<=importe) {
                            swal({
                                title: "El importe cargado es menor al especificado, desea confirmar?",
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
                                        url: base_url + "Ticket/confirmarCargaSec/"+id_ticket+"/"+importe_cargado+"/"+diferencia+"/"+id_comb_cargado,
                                        success:function(r){
                                            if (r = true) {
                                                swal({
                                                    icon: "success",
                                                    title: "Operación exitosa",
                                                    timer: 2000,
                                                })
                                                setTimeout(function(){
                                                    window.location = base_url + "Ticket/cargaCombustible";
                                                },2000)
                                            }else if (r = false){
                                                swal({
                                                    icon: "error",
                                                    title: "Hubo un problema al realizar la operación",
                                                })
                                                $(".btn-confirmar").prop("disabled", false);
                                            }
                                        }
                                    });
                                    break;
                                    default:
                                    $(".btn-confirmar").prop("disabled", false);
                                    swal.close();
                                }
                            }); 

                            }else if (diferencia==0){
                            swal({
                                title: "¿Desea confirmar la operacion?",
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
                                     $(".btn-confirmar").prop("disabled", true);
                                    $.ajax({
                                    url: base_url + "Ticket/confirmarCarga/"+id_ticket+"/"+importe_cargado+"/"+id_comb_cargado,
                                success:function(r){
                                    
                                    swal({
                                        icon: "success",
                                        title: "Operación exitosa",
                                        timer: 2000,
                                    })
                                    setTimeout(function(){
                                        window.location = base_url + "Ticket/cargaCombustible";
                                    },2000)
                                }
                            });
                                    break;
                                    default:
                                    $(".btn-confirmar").prop("disabled", false);
                                    swal.close();
                                }
                            }); 
                            
                        }else if (diferencia > importe){
                            $(".btn-confirmar").prop("disabled", false);
                            swal({
                                icon: "warning",
                                title: "Error!",
                                text: "El saldo cargado no puede ser negativo",

                            })
                            
                        }else{
                            $(".btn-confirmar").prop("disabled", false);
                            swal({
                                icon: "warning",
                                title: "Error!",
                                text: "El saldo cargado no puede ser mayor al del ticket",

                            })
                        }
                }
            });



            


        });


    </script>
