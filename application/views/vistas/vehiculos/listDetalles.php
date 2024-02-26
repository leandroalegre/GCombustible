<script>
        $(document).ready(function(){

          $("#listDetalle").DataTable({
            "order": [[6, "desc"]],
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
<body style="background-color: #F3F3F3; width: 95%; margin: 3px auto">

    <div class="container" style="background-color: #EEEEEE">
        <div class="row">
 
            <div class="col-md-12">
                <h1 style="font-size: 50px; color:#337AB7"><i>Detalle de vehiculos<h3><?php if (isset($sec)) {echo $sec;} ?></h3></i></h1>
            </div>
        </div>
      
          
            
    

        <hr style="border: 0.5px solid black">
        <?php if ($this->session->userdata('rol') == 8 || $this->session->userdata('rol') == 1) { ?>
        
        
        <div class="row">
          <div class="col-md-offset-3 col-md-4">
            
            <select class="form-control" name="id_secretaria" id="id_sec">
              <option value="0">SELECCIONAR SECRETARIA:</option>
              <option value="1">SECRETARIA DE GOBIERNO Y COORDINACION</option>
              <option value="2">SECRETARIA DE ECONOMIA Y FINANZAS</option>
              <option value="3">SECRETARIA DE TURISMO, CULTURA Y DEPORTES</option>
              <option value="4">SECRETARIA DE DESARROLLO URBANO AMBIENTAL</option>
              <option value="5">SECRETARIA DE SALUD PUBLICA</option>
              <option value="6">SECRETARIA DE DESARROLLO SOCIAL, EDUCACION, GENERO Y DIVERSIDAD</option>
            </select>
          </div>
          <div class="col-md-2">
              <button id="filtro" class="btn btn-info">Filtrar</button>
          </div>
        </div>
      <?php }else{} ?>
        <br>
        <div class="row">
         <div class="col-md-12">
            <div class="table-responsive">
               <table id="listDetalle" class="table table-hover">
           
                <thead>
                 <th>VEHICULO</th>
                 <th>DOMINIO</th>
                 <th>DESCRIPCION</th>
                 <th>DEPENDENCIA</th>
                 <th>PERSONA</th>
                 <th>USUARIO</th>
                 <th>FECHA</th>
                 <?php if ($this->session->userdata('rol') != 9) { ?>
                 <th>VER MAS</th>
                 <?php } ?>
             </thead>
             <tbody>
                <?php if (!empty($detalle)){ ?>
                 <?php foreach ($detalle as $d){ ?>
                    <tr>
                       <td><?php echo $d->marca; echo " "; echo $d->modelo; ?></td>
                       <td><?php echo $d->dominio ?></td>
                       <td><?php echo $d->descripcion ?></td>
                       <td><?php echo $d->dependencia ?></td>
                       <td><?php echo $d->nombre ?></td>
                       <td><?php echo $d->username ?></td>
                       <td><?php echo $d->fecha_detalle ?></td>
                       <?php if ($this->session->userdata('rol') != 9) { ?>
                       <TD><a href="<?php echo base_url();?>Vehiculos/detalleV/<?php echo $d->id_vehiculo; ?>" class="btn btn-warning btn-edit"><i class="glyphicon glyphicon-list-alt"></i></a></TD>
                       <?php } ?>
                 </tr>
         <?php }
         } ?>
     </tbody>
 </table>                   
</div>
</div>
</div>
</div>
</body>


<style type="text/css">
 td,th{
  text-align: center;
}
.btn-edit,.btn-delete{
  border-radius: 20px;
}
</style>
<script type="text/javascript">
  var base_url = "<?php echo base_url();?>";
  var boton = document.getElementById('filtro');
  var id_sec = document.getElementById('id_sec');
  boton.addEventListener("click", function(){
    window.location = base_url+"Vehiculos/detallesfiltradosxsec/"+id_sec.value;
  })
</script>
<!-- console.log(id_sec.value);
    $.ajax({
      url: base_url + "Vehiculos/detallesfiltradosxsec/"+id_sec.value,
      success:function(data){
        var vehfil = JSON.stringify(data);
        //window.location = base_url+"Vehiculos/detallesfiltradosxsec2/"+vehfil;
        
      }
    }) -->