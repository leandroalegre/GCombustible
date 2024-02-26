<body style="width: 95%; margin: 3px auto">
    <div class="container">

        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-12">
                        <h1>SOLICITUDES CONFIRMADAS Y RECHAZADAS</h1>
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
                                    <th>FECHA SOLICITUD</th>
                                    <th>FECHA CONFIRMACION</th>
                                    <th>ESTADO</th>

                                    <th>MONTO MENSUAL</th>
                                </thead>
                                <tbody>
                                    <?php foreach ($solicitudes as $s): ?>
                                        <tr>
                                            <td style="vertical-align: middle;"><?php echo $s->nombre;?></td>
                                            <td style="vertical-align: middle;"><?php echo $s->dominio;?></td>
                                            <td style="vertical-align: middle;"><?php echo $s->fecha_solicitud;?></td>
                                            <td style="vertical-align: middle;"><?php echo $s->fecha_confirmacion;?></td>
                                            <?php if($s->estado_soli=="Confirmado"){?> 
                                            <td style="vertical-align: middle; color: green;"><?php echo $s->estado_soli;?></td>
                                            <?php }else{?>
                                                <td style="vertical-align: middle; color: red;"><?php echo $s->estado_soli;?></td>
                                            <?php } ?>
                                            <td style="vertical-align: middle;"><?php echo $s->saldo;?></td>
                                           
                                          
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


     
        

        

        

        $("#tablaTE").DataTable({
            "order":[3, "desc"],
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
