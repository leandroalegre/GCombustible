
<body style="background-color: #F3F3F3; width: 95%; margin: 3px auto">

	<div class="container" style="background-color: #EEEEEE">
		<div class="row">
            <?php echo $this->session->flashdata("document_status"); ?>
            <div class="col-md-12">
                <h1 style="font-size: 50px; color:#337AB7"><i>Vehículos</i></h1>
            </div>
        </div>
        <?php if ($this->session->userdata('rol') == 1 || $this->session->userdata('rol') == 10) {
            ?>
            <button type="button" data-toggle='modal' data-target='#modal-add' class="btn btn-primary btn-abrir-modal pull-right"><i class="glyphicon glyphicon-plus"></i> NUEVO VEHICULO</button>
            <br>
        <?php } ?>

        <hr style="border: 0.5px solid black">
        <div class="row">
         <div class="col-md-12">
            <div class="table-responsive">
               <table id="tablaVe" class="table table-hover">
                <?php $this->session->flashdata('item');?>
                <thead>
                    <th>ESTADO</th>
                 <th >MARCA</th>
                 <th>MODELO</th>
                 <th>DOMINIO</th>
                 <th style="width: 15%">SECRETARIA</th>
                 <th>LLAVERO N°</th>
                 <th>TIPO VEHICULO</th>
                 <?php if ($this->session->userdata('rol') == 1 || $this->session->userdata('rol') == 8 || $this->session->userdata('rol') == 2 || $this->session->userdata('rol') == 9 || $this->session->userdata('rol')==10) {
                     ?><th>OPCIONES</th><?php
                 } ?>

             </thead>
             <tbody>
                <?php if (!empty($vehiculos)): ?>
                 <?php foreach ($vehiculos as $s): ?>
                    <tr>
                    <?php if ($s->estado == 0) { ?>
                        <td style="color:red"> deshabilitado</td>
                    <?php }else{ ?>
                    <?php if ($s->num_llavero == 0) { ?>
                            <td style="color:blue"> No carga</td>
                      <?php }else{ ?>
                        <td style="color:green">Carga</td>
                       <?php } }?>
                       
                       
                       <td><?php echo $s->marca;?></td>
                       <td><?php echo $s->modelo;?></td>
                       <td><?php echo $s->dominio;?></td>
                       <td><?php echo $s->nombre;?></td>
                       <td><?php 
                       if ($s->num_llavero == 0) {
                           echo "No usa llavero";
                       }else{
                           echo $s->num_llavero; 
                       }?>
                       </td>
                       <?php if ($s->tipo_vehiculo == 0) { ?>
                            <td> Municipal</td>
                      <?php }else{ ?>
                        <td>Particular</td>
                       <?php } ?>
                       <?php if ($this->session->userdata('rol') == 2) {
                        ?>
                        
                        <td>
                         <a href="<?php echo base_url();?>Vehiculos/detalleV/<?php echo $s->id; ?>" class="btn btn-warning btn-edit"><i class="glyphicon glyphicon-list-alt"></i></a>
                         <a href="<?php echo base_url();?>Vehiculos/editV/<?php echo $s->id; ?>" class="btn btn-warning btn-edit"><i class="glyphicon glyphicon-pencil"></i></a>
                         <?php if ($s->estado == 1) { ?>
                         <button class="btn btn-danger btn-delete btn-eliminar" value="<?php echo $s->id."/".$s->dominio?>" ><i class="glyphicon glyphicon-trash"></i></button>                    
                         <?php } ?>
                        </td>
                         <?php
                    }else if($this->session->userdata('rol') == 1){ ?>
                     <td>
                         <a href="<?php echo base_url();?>Vehiculos/detalleV/<?php echo $s->id; ?>" class="btn btn-warning btn-edit"><i class="glyphicon glyphicon-list-alt"></i></a>
                         <a href="<?php echo base_url();?>Vehiculos/editV/<?php echo $s->id; ?>" class="btn btn-warning btn-edit"><i class="glyphicon glyphicon-pencil"></i></a>
                         <?php if ($s->estado == 1) { ?>
                         <button class="btn btn-danger btn-delete btn-eliminar" value="<?php echo $s->id."/".$s->dominio?>" ><i class="glyphicon glyphicon-trash"></i></button>
                         <?php if ($s->tipo_vehiculo == 1 || $s->flag_litros==1) { ?>
                         <button class="btn btn-warning btn-tope" value="<?php echo $s->id; ?>" data-toggle="modal" data-target="#modal-tope"><i class="glyphicon glyphicon-usd"></i></button>                   
                         <?php } ?>
                         <?php } ?>
                        </td>
                   <?php }else if($this->session->userdata('rol') == 8){ ?>
                        <td>
                            <a href="<?php echo base_url();?>Vehiculos/detalleV/<?php echo $s->id; ?>" class="btn btn-warning btn-edit"><i class="glyphicon glyphicon-list-alt"></i></a>
                        </td>
                    <?php }else if($this->session->userdata('rol') == 9){ ?>
                        <TD><a href="<?php echo base_url()?>vehiculos/nuevo_detalle/<?php echo $s->id; ?>" class="btn btn-warning btn-edit"><i class="glyphicon glyphicon-plus"></i></a></TD> 
                    <?php }else if($this->session->userdata('rol') == 10){ ?>
						<td><a href="<?php echo base_url();?>Vehiculos/editV/<?php echo $s->id; ?>" class="btn btn-warning btn-edit"><i class="glyphicon glyphicon-pencil"></i></a>
						<?php if ($s->estado == 1) { ?>
                         <button class="btn btn-danger btn-delete btn-eliminar" value="<?php echo $s->id."/".$s->dominio?>" ><i class="glyphicon glyphicon-trash"></i></button>
                         <?php if ($s->tipo_vehiculo == 1 || $s->flag_litros==1) { ?>
                         <button class="btn btn-warning btn-tope" value="<?php echo $s->id; ?>" data-toggle="modal" data-target="#modal-tope"><i class="glyphicon glyphicon-usd"></i></button>                   
                         <?php } ?>
                         <?php } ?>
						<?php } ?>
						</td>
                 </tr>
             <?php endforeach ?>
         <?php endif ?>
     </tbody>
 </table>					
</div>
</div>
</div>
</div>
</body>

<!-- /.modal -->
<div class="modal fade" id="modal-add">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h2 class="modal-title" style="text-align: center; color: #337AB7">Nuevo vehículo</h2>
                </div>
                <div class="modal-body"> 
                    <div class="row">
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading cleafix">
                                    <h2 style="text-align: center;">Datos <br> del <br> vehículo</h2>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label for="marca">TARJETA MAGNÉTICA:</label>
                                        <input type="hidden" id="id_row_tarjeta" name="id_row_tarjeta">
                                        
                                        <div class="row">
                                        <div class="col-md-10"><input type="text" name="id_tarjeta" id="id_tarjeta" class="form-control" required="required" readonly autocomplete="off" placeholder="Pase la tarjeta por el lector"></div>
                                        <div class="col-md-1"><input type="checkbox" class="llevatarjeta" name="llevatarjeta"></div>
                                            </div>
                                        </div>
                                    
                                    <div class="form-group">
                                        <label for="marca">MARCA:</label>
                                        <input type="text" name="marca" class="form-control" required="required" autocomplete="off" placeholder="Marca">
                                    </div>
                                    <div class="form-group">
                                        <label for="modelo">MODELO:</label>
                                        <input type="text" name="modelo" class="form-control" required="required" autocomplete="off" placeholder="Modelo">
                                    </div>
                                    <div class="form-group">
                                        <label for="telefono">DOMINIO:</label>
                                        <input type="text" name="dominio" class="form-control" required="required" autocomplete="off" placeholder="Dominio">
                                    </div>
                                    <div class="form-group">
                                        <label for="telefono">¿Es particular?</label>
                                        <select name="tipo_vehiculo" class="form-control">
                                            <option value="">Seleccionar:</option>
                                            <option value="0">No</option>
                                            <option value="1">Si</option>
                                        </select>
                                    </div>
									<div class="form-group">
                                        <label for="gnc">M3 GNC (si corresponde):</label>
                                        <input type="number" name="m3_gnc" class="form-control" autocomplete="off" placeholder="Capacidad del tubo en m3">
                                    </div>
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
                                        <label>SECRETARÍA:</label><select class="form-control" name="secretaria" id="secretaria" required>
                                            <option>Seleccionar:</option>
                                            <?php foreach ($sec as $s): ?>
                                                <option value="<?php echo $s->id;?>"><?php echo $s->nombre;?></option>
                                            <?php endforeach ?>


                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>DIRECCIÓN:</label><select class="form-control" name="direccion" id="direccion" required>


                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>ÁREA:</label><select class="form-control" name="area" id="area" required>

                                        </select>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="panel panel-default">

                            <div class="panel-body">
                             <div class="selects">
                                <div class="form-group">
                                    <label>Numero de llavero:</label>
                                    <input type="number" class="form-control numllavero" readonly name="num_llavero">
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <br>     
        </div>
        <div class="modal-footer">
            <div class="row">
                <div class="col-xs-6 col-md-offset-3 col-md-3">
                    <button type="button" class="btn btn-success btn-add">AÑADIR VEHICULO</button>
                </div>
                <div class="col-xs-6 col-md-3">
                    <button type="button" class="btn btn-danger " data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->



<!-- /.modal -->
<div class="modal fade" id="modal-eliminar">
    <div class="modal-dialog">
        <div class="modal-content">
                <div class="modal-body" align="center"> 
                   <h2 align="center">¿Desea deshabilitar el vehiculo?</h2>
                   <div class="dominio" style="color: blue; font-size: 18px"></div> 
                   <h4 align="center">Ingrese el motivo</h4> 
                   <input type="hidden" name="id_vehiculo_deshabilitar">
                   <textarea name="detalle" id="" cols="40" rows="3"></textarea>
              
        </div>
        <div class="modal-footer">
            <div class="row">
                <div class="col-xs-6 col-md-offset-3 col-md-3">
                    <button type="button" class="btn btn-success btn-deshabilitar">Confirmar</button>
                </div>
                <div class="col-xs-6 col-md-3">
                    <button type="button" class="btn btn-danger " data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<!-- /.modal -->
<div class="modal fade" id="modal-tope">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h2 class="modal-title" style="text-align: center">Establecer maximo de carga</h2>
                </div>
                <div class="modal-body"> 

                
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
<style type="text/css">
 td,th{
  text-align: center;
}
.btn-edit,.btn-delete, .btn-tope{
  border-radius: 20px;
}
</style>
<script src="<?php echo base_url();?>public/sweetAlert/sweetAlert.min.js"></script>
<script type="text/javascript">
 $(document).ready(function(){
  var base_url = "<?php echo base_url();?>";

  function setearAllTarjetas(){
    $.ajax({
        url: base_url + "Tarjeta/setearTodas/"
    })
}

function setearAllTarjetas(){
    $.ajax({
        url: base_url + "Tarjeta/setearTodasAbm/"
    })
}

$(".btn-abrir-modal").on("click", function(){
              // $.ajax({
              //     url: base_url + "Tarjeta/recibirTarjeta/",
              //     success:function(r){
              //       if (r == "no_tarjeta") {
                        // $("#id_tarjeta").val("");
                        setearAllTarjetas();
                        setInterval(function(){
                            $.ajax({
                                url: base_url + "Tarjeta/leerTarjetaJS/",
                                success:function(r2){
                                    if (r2 == "no_tarjeta2") {
                                        $("#id_tarjeta").val("");
                                    }else if(r2 == "existe"){
                                        $("#id_tarjeta").val("TARJETA EN USO");
                                    }else{
                                        var info = r2.split("*");
                                        $("#id_tarjeta").val(info[0]);
                                        $("#id_row_tarjeta").val(info[1]);
                                    }
                                }
                            })
                        },500);
                    // }else if(r == "existe"){
                    //      $("#id_tarjeta").val("TARJETA EN USO");
                    // }else{
                    //     var info = r.split("*");
                    //     $("#id_tarjeta").val(info[0]);
                    //     $("#id_row_tarjeta").val(info[1])
                    // }
          //         }
          //     })
      });

$("#modal-add").on('hidden.bs.modal', function () {
    setearIdTarjeta();
});


function setearIdTarjeta(){
    var id_row = $("input[name='id_row_tarjeta']").val();
    if (id_row == "") {
        return false;
    }else{
        $.ajax({
            url: base_url + "Tarjeta/setearIdAbm/" + id_row
        })
    }
}

$("#secretaria").change(function () {
    $("#secretaria option:selected").each(function () {
        id_secretaria = $('#secretaria').val();
        $.post("<?php echo base_url() ?>personas/getDirecciones", {
            id_secretaria: id_secretaria
        }, function (data) {
            $("#direccion").html(data);
        });
    });
});


$("#direccion").change(function () {
    $("#direccion option:selected").each(function () {
        id_direccion = $('#direccion').val();
        id_secretaria = $('#secretaria').val();
        $.post("<?php echo base_url() ?>personas/getAreas", {
            id_direccion: id_direccion, id_secretaria : id_secretaria
        }, function (data) {
            $("#area").html(data);
        });
    });
});

document.addEventListener("click", function(){
   if($('.llevatarjeta').prop('checked')) {
    $(".numllavero").prop("readonly", false);
}else{
    $(".numllavero").prop("readonly", true);

}
});

$(".btn-add").on("click", function(){


   
     
    var marca = $("input[name=marca]").val();
    var modelo = $("input[name=modelo]").val();
    var dominio = $("input[name=dominio]").val();
    var secretaria = $("select[name=secretaria]").val();
    var direccion = $("select[name=direccion]").val();
    var area = $("select[name=area]").val();
    var num_llavero = $("input[name=num_llavero]").val();
	var m3_gnc = $("input[name=m3_gnc]").val();
    var tipo_vehiculo = $("select[name=tipo_vehiculo]").val();
	
    var estado = 1;

    if($('.llevatarjeta').prop('checked')) {
    var id_tarjeta = $("input[name=id_tarjeta]").val();
    var id_row_tarjeta = $("input[name='id_row_tarjeta']").val();
}else{
    var id_tarjeta = 0;
    var id_row_tarjeta = 0;
    var num_llavero=0;
    var estado = 0;
}


    
    if (marca == "" || modelo == "" || dominio == "" || secretaria == "Seleccionar:" || (direccion == null || direccion == "0") || (area == null || area == "0") || tipo_vehiculo=="") {
        swal({
            title: "Falta información",
            text: "Todos los campos son obligatorios para el alta de un vehículo",
            icon: "warning",
        });
    }else{
        $.ajax({
            url: base_url + "Vehiculos/add/"+marca+"/"+modelo+"/"+dominio+"/"+secretaria+"/"+direccion+"/"+area+"/"+id_tarjeta+"/"+id_row_tarjeta+"/"+num_llavero+"/"+estado+"/"+tipo_vehiculo+"/"+m3_gnc,

            success:function(r){
                if (r = true) {
                    swal({
                        title: "Exito!",
                        text: "Se ha añadido a "+dominio+" correctamente.",
                        icon: "success",
                        timer: 2000,
                    });
                    setTimeout(function(){
                        location.reload();
                    },2000);
                }else{
                    swal({
                        title: "error!",
                        text: "Ha ocurrido un error al añadir una persona.",
                        icon: "error",
                        timer: 2000,
                    });
                }
            }
        });
    }
});

$(".btn-eliminar").on("click", function(){
    var id = $(this).val();
    var separador = id.split("/");
    
    $('#modal-eliminar').modal('show');
    $("input[name='id_vehiculo_deshabilitar']").val(separador[0]);
    $(".dominio").html(separador[1]);
})
   
   $(".btn-deshabilitar").on("click", function(){
        var id = $("input[name='id_vehiculo_deshabilitar']").val();
        var detalle = $("textarea[name='detalle']").val();

    if(id=="" || detalle ==""){
        swal({
            title: "Falta información",
            text: "Complete todos los campos",
            icon: "warning",
        });
    }else{
       
                                $.ajax({
                                    url: "<?php echo base_url();?>Vehiculos/delete/"+id,
                                    type: "POST",
                                    data: "detalle="+detalle,
                                    success:function(resp){
                                        if (resp = true) {
                                            swal({
                                                title: "Exito!",
                                                text: "Se ha deshabilitado correctamente.",
                                                icon: "success",
                                                timer: 2000,
                                            });
                                            setTimeout(function(){
                                                window.location= "<?php echo base_url();?>Vehiculos";
                                            },2000);
                                        }
                                    }
                                });
                            }
                              
   })

   $(".btn-tope").on("click", function(){
    var id_vehiculo = $(this).val();
            $.ajax({
                url: base_url + "Vehiculos/establecerMaximo/",
                type: "POST",
                data: "id_vehiculo="+id_vehiculo,
                success:function(r){
                    $("#modal-tope .modal-body").html(r);
                }
            })
   })
   
$("#tablaVe").DataTable({
            "order": false,
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



// $(".btn-edit").on("click", function(){
//    var val = $(this).val();
//    $.ajax({
//     url: base_url + "Vehiculos/editV/"+val,
//     success:function(r){
//      $("#modal-edit .modal-body").html(r);
//  }
// });
// })

// $(".btn-delete").on("click",function(){
//     var val = $(this).val();
//     $.ajax({
//         url: base_url + "Vehiculos/getDominio/" + val,
//         success:function(r){
//             swal({
//                 title: "¿Desea eliminar el dominio "+r+"?",
//                 icon: "warning",
//                 buttons: {
//                     cancel: "Cancelar",
//                     catch: {
//                         text: "Confirmar",
//                         value: "confirmar",
//                     },
//                 },
//             })
//             .then((value) => {
//                 switch (value) {
//                     case "confirmar":
//                     $.ajax({
//                         url: base_url + "Vehiculos/delete",
//                         type: "POST",
//                         data: "id="+val,
//                         success:function(resp){
//                             if (resp = true) {
//                                 swal({
//                                     title: "Exito!",
//                                     text: "Se ha eliminado correctamente.",
//                                     icon: "success",
//                                     timer: 2000,
//                                 });
//                                 setTimeout(function(){
//                                     window.location= base_url+"Vehiculos/index";
//                                 },2000);
//                             }
//                         }
//                     });
//                     break;
//                     default:
//                     swal.close();
//                 }
//             });
//         }
//     });
// });
});
</script>
