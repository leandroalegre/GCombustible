<body style="background-color: #F3F3F3; width: 95%; margin: 3px auto">
  <div class="container" style="background-color: #EEEEEE">
    <div class="row">
      <div class="col-md-12">
        <h1 style="font-size: 50px; color:#337AB7"><i>Personas</i></h1>
        <input type="hidden" id="rolusuario" value="<?php echo $this->session->userdata('rol'); ?>">
      </div>
    </div>
    
<?php 
    if ($this->session->userdata('rol') == 1 || $this->session->userdata('rol') == 8 || $this->session->userdata('rol') == 10) { ?>
    <button type="button" id="add_button" data-toggle="modal" data-target="#userModal" class="btn btn-primary btn-abrir-modal pull-right"><i class="glyphicon glyphicon-plus"></i> NUEVA PERSONA</button>
    <?php }else{ ?>
       <button type="button" id="add_button" data-toggle="modal" data-target="#userModal" class="btn btn-primary btn-abrir-modal pull-right" disabled><i class="glyphicon glyphicon-plus"></i> NUEVA PERSONA</button>
     <?php } ?>


    <br>
    <hr style="border: 0.5px solid black">
    <div class="row">
      <div class="col-md-12">
        <div class="table-responsive">
          <table id="user_data" class="table table-bordered table-striped"> 
            <thead>
              <th width="10%">Imagen</th>  
              <th width="25%">Nombre</th>  
              <th width="15%">Dni</th> 
              <th width="15%">Legajo</th> 
              <th width="15%">Vencimiento licencia</th>
              <th width="15%">Telefono</th>
              <th width="10%">Estado</th>
              <th width="10%">Editar</th>  
              <th width="10%">Eliminar</th>  
            </thead>          
          </table>                   
        </div>
      </div>
    </div>
  </div>
</body>

<div id="userModal" class="modal fade">  
  <div class="modal-dialog">  
   <form method="post" id="user_form">  
    <div class="modal-content">  
     <div class="modal-header">  
      <button type="button" class="close" data-dismiss="modal">&times;</button>  
      <h4 class="modal-title">Nueva persona</h4>  
    </div>  
    <div class="modal-body">  
      <div class="col-md-6">
        <div class="panel panel-default">
          <div class="panel-heading cleafix">
            <h2 style="text-align: center;">Datos <br> de la <br> persona</h2>
          </div>
          <div class="panel-body">
           <div class="form-group">
            <label for="nombre">APELLIDO Y NOMBRE:</label>
            <input type="text" name="nombre" id="nombre" class="form-control" required="required" autocomplete="off" placeholder="Apellido y nombre">
          </div>
          <div class="form-group">
            <label for="dni">DNI:</label>
            <input type="number" name="dni" id="dni" class="form-control" required="required" autocomplete="off" placeholder="Numero de documento">
          </div>
          <div class="form-group">
            <label for="telefono">LEGAJO:</label>
            <input type="number" name="legajo" id="legajo" class="form-control" min="1" required="required" autocomplete="off" placeholder="Numero de legajo">
          </div>
          <div class="form-group">
            <label for="telefono">EMAIL:</label>
            <input type="text" name="email" placeholder="Correo electrónico" id="email" class="form-control" required="required" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="telefono">TELEFONO:</label>
            <input type="number" name="telefono" placeholder="Telefono" id="telefono" class="form-control" required="required" autocomplete="off">
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
              <label>SECRETARÍA:</label>
              <select class="form-control" name="secretaria" id="secretaria" required>
                <option>Seleccionar:</option>
                <?php foreach ($sec as $s): ?>
                  <option value="<?php echo $s->id;?>"><?php echo $s->nombre;?></option>
                <?php endforeach ?>
              </select>
            </div>
            <div class="form-group">
              <label>DIRECCIÓN:</label>
              <select class="form-control" name="direccion" id="direccion" required>
                <option>Seleccionar:</option>
                <?php foreach ($dir as $d): ?>
                  <option value="<?php echo $d->id;?>"><?php echo $d->nombre;?></option>
                <?php endforeach ?>
              </select>
            </div>
            <div class="form-group">
              <label>ÁREA:</label><select class="form-control" name="area" id="area" required>
                <option>Seleccionar:</option>
                <?php foreach ($ar as $a): ?>
                  <option value="<?php echo $a->id;?>"><?php echo $a->nombre;?></option>
                <?php endforeach ?>
              </select>
            </div>
          </div>
          <?php if ($this->session->userdata('rol') == 8) { ?>
           <div class="selects">
              <div class="form-group">
                <label>ESTADO:</label>
                <select class="form-control" name="estado" id="estado" required>
                  <option value="2" class="form-control" selected>Solo conducción</option>
                </select>
              </div>
            </div>
          <?php }else{ ?>
            <div class="selects">
              <div class="form-group">
                <label>ESTADO:</label>
                <select class="form-control" name="estado" id="estado" required>
                  <option>Seleccionar:</option>
                  <option value="1" class="form-control">Carga combustible</option>
                  <option value="2" class="form-control">Solo conducción</option>
                </select>
              </div>
            </div>
          <?php } ?>
        </div>
      </div>
    </div>



    <div class="row">
      <div class="col-md-12">
         
        <div class="panel panel-primary">
          <div class="panel-heading">
            <h3>Subir imágenes</h3>
          </div>
          <div class="panel-body">
           
            <div class="form-group">
              <label>FOTO DE LA PERSONA</label>
              <input type="file" name="archivo" id="archivo" />  
              <span id="user_uploaded_image"></span>  
            </div>
            </div>
        </div>
      </div>
    </div>



  </div>  
  <div class="modal-footer">  
    <input type="hidden" name="user_id" id="user_id" />  
    <input type="submit" name="action" id="action" class="btn btn-success btn-des" value="Agregar" />  
    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>  
  </div>  
</div>  
</form>  
</div>  
</div>
<!-- modal -->
    <div class="modal fade" id="modal-verfoto">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h2 class="modal-title" style="text-align: center">IMAGEN PERSONAL</h2>
          </div>
          <div class="modal-body">
            
          </div>
          <div class="modal-footer">        
          </div>
        </div>
      </div>
    </div>
<!-- /.modal -->  
<style type="text/css">
 td,th{
  text-align: center;
}
.btn-edit,.btn-delete{
  border-radius: 20px;
}
</style>
<script type="text/javascript" language="javascript" > 
var rolusuario = $('#rolusuario').val();

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

 $(document).on('click', '.delete', function(){  
   var user_id = $(this).attr("id");  
   swal({
    title: "¿Desea eliminar la persona de la lista?",
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
       url:"<?php echo base_url(); ?>Personas/delete_single_user",  
       method:"POST",  
       data:{user_id:user_id},  
       success:function(data)  
       {  
        if (data == "true") {
                        swal({
                          icon: "success",
                          title: "La persona ha sido deshabilitada.",
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
    });
      break;
      default:
      swal.close();
    }
  }); 

   

 });

 $(document).ready(function(){  
  $('#add_button').click(function(){  
   $('#user_form')[0].reset();  
   $('.modal-title').text("Nueva persona");  
   $('#action').val("Agregar");  
   $('#user_uploaded_image').html('');  
 })  
  var dataTable = $('#user_data').DataTable({ 

   "processing":true,  
   "serverSide":true,  
   "order":[],  
   "ajax":{  
    url:"<?php echo base_url() . 'Personas/fetch_user'; ?>",  
    type:"POST"  
  },  
  "columnDefs":[  
  {  
   "targets":[0, 5, 6],  
   "orderable":false,  
 },  
 ],  
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
  $(document).on('submit', '#user_form', function(event){  
   event.preventDefault();  
   var nombre = $('#nombre').val();  
   var dni = $('#dni').val(); 
   var legajo = $('#legajo').val();  
   var email = $('#email').val();
   var telefono = $('#telefono').val();
   var secretaria = $('#secretaria').val(); 
   var direccion = $('#direccion').val();  
   var estado = $('#estado').val();
   var area = $('#area').val();  
   var action = $('#action').val();
   var extension = $('#archivo').val().split('.').pop().toLowerCase();  
   if(extension != '')  
   {  
    if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)  
    {  
			swal({
                          icon: "error",
                          title: "El formato de la imagen es inválido, formatos permitidos: png, jpg, jpeg",
                        })
     $('#archivo').val('');  
     return false;  
   }  
 }       
 if(nombre != '' && dni != '' && legajo != '' && dni != '' && email != '' && telefono != '' && secretaria != '' && direccion != '' && area != '' && estado != 0)  
 {  
  $(".btn-des").attr("disabled", true);
  $.ajax({  
   url:"<?php echo base_url() . 'Personas/user_action/'?>"+action,  
   method:'POST',  
   data:new FormData(this),  
   contentType:false,  
   processData:false,  
   success:function(data)  
   {  
		 
		  if(data==0){
				swal({
                          icon: "error",
                          title: "Hubo un problema al cargar la imagen",
                        })
												$(".btn-des").attr("disabled", false);
      $('#archivo').val(''); 
			}else{ 
			
			if (action=="Agregar") {
     swal({
      title: "Exito!",
      text: "Se ha añadido correctamente.",
      icon: "success",
      timer: 2000,
    });
   }else{
     swal({
      title: "Exito!",
      text: "Se ha editado correctamente.",
      icon: "success",
      timer: 2000,
    });
   }
   setTimeout(function(){
    $('#user_form')[0].reset();  
    $('#userModal').modal('hide'); 
    location.reload();
  },2000); 
            }
	}  
          });  
}  
else  
{  
  alert("Bother Fields are Required");  
}  
});  
  $(document).on('click', '.btn-verfoto', function(){
    var foto = $(this).attr("value");
    var base_url = "<?php echo base_url();?>";
    var html = '<body><img src="'+base_url+'public/imagenes_personas/'+foto+'"   class="img-thumbnail"/></body>';
    $("#modal-verfoto").modal("show");
    $("#modal-verfoto .modal-body").html(html);
  })

  $(document).on('click', '.update', function(){  
   var user_id = $(this).attr("id");  
   $.ajax({  
    url:"<?php echo base_url(); ?>Personas/fetch_single_user",  
    method:"POST",  
    data:{user_id:user_id},  
    dataType:"json",  
    success:function(data)  
    {  
      if (rolusuario == 1) {
        $('#userModal').modal('show');  
        $('#nombre').val(data.nombre);
        $('#nombre').prop("disabled", false);  
        $('#dni').val(data.dni);
        $('#dni').prop("disabled", false);  
        $('#legajo').val(data.legajo);
        $('#legajo').prop("disabled", false);  
        $('#email').val(data.email);
        $('#email').prop("false",true);
         $('#telefono').val(data.telefono);
        $('#secretaria').val(data.secretaria); 
        $('#direccion').val(data.direccion); 
        $('#area').val(data.area);
        $('#estado').val(data.estado);
        $('.modal-title').text("Editar persona");  
        $('#user_id').val(user_id);  
        $('#user_uploaded_image').html(data.archivo);
        $('#user_uploaded_image').prop("disabled", false);  
        $('#action').val("Editar");
      }else{
        $('#userModal').modal('show');  
        $('#nombre').val(data.nombre);
        $('#nombre').prop("readonly",true);  
        $('#dni').val(data.dni); 
        $('#dni').prop("readonly",true); 
        $('#legajo').val(data.legajo);
        $('#legajo').prop("readonly",true);  
        $('#email').val(data.email);
        $('#email').prop("readonly", false); 
         $('#telefono').val(data.telefono);
        $('#secretaria').val(data.secretaria);
        $('#secretaria option:not(:selected)').attr('disabled',true); 
        $('#direccion').val(data.direccion);
        $('#direccion option:not(:selected)').attr('disabled',true);  
        $('#area').val(data.area);
        $('#area option:not(:selected)').attr('disabled',true); 
        $('#estado').val(data.estado);
        $('#estado option:not(:selected)').attr('disabled',true); 
        $('.modal-title').text("Editar persona");  
        $('#user_id').val(user_id);  
        $('#user_uploaded_image').html(data.archivo);
        $('#archivo').css("visibility","hidden");  
        $('#action').val("Editar");

      }
       

   }  
 })  
 });  
});  
</script>  
