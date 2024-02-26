<body style="background-color: #F3F3F3; width: 95%; margin: 3px auto">
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                Cargado por persona
            </div>
            <div class="panel-body">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-offset-3 col-sm-5"> 
                            <div class="form-group">
                                <button type="button" data-toggle="modal" data-target="#modal-personas" class="btn btn-primary btn-search-persona"><i class="glyphicon glyphicon-search"></i> Seleccionar persona</button>
                            </div>
                        </div>
                    </div>
                    <form method="POST" action="<?php base_url()?>buscarPersonaCargada">
                        <div class="row">
                            <div class="col-sm-offset-3 col-sm-5">         
                                <div class="form-group">
                                    <input type="hidden" name="id_persona" class="form-control">
                                    <label for="">Persona</label>
                                    <input type="text" name="nombre" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-offset-5 col-sm-3">
                                <button type="submit" class="btn btn-success">Buscar</button>
                            </div>
                        </div>
                    </form> 
                </div>
                <br>
                <?php if (isset($movtickets)) { ?>
                    <h3>Persona: <?php echo $nombre; ?></h3>
                    <?php $monto_total=$suma->suma - $suma->devolucion ?>
                <h3>Monto cargado $<?php echo round($monto_total,3)  ?></h3><br>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="tablamovimientos">
                                    <thead style="background-color: #3175B8; color: white">
                                        <th>N° TICKET</th>
                                        <th>FECHA</th>
                                        <th>MARCA</th>
                                        <TH>MODELO</TH>
                                        <th>DOMINIO</th>
                                        <th>TIPO VEHICULO</th>
                                        <TH>IMPORTE EMITIDO</TH>
                                        <TH>IMPORTE CARGADO</TH>
                                        <th>MOVIMIENTOS</th>
                                    
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <?php foreach ($movtickets as $m) : ?>

                                                <TD><?php echo $m->nit ?></TD>
                                                <td><?php echo $m->fecha_movimiento; ?></td>
                                                <td><?php echo $m->marca; ?></td>
                                                <td><?php echo $m->modelo; ?></td>
                                                <td><?php echo $m->dominio; ?></td>
                                                <?php if ($m->tipo_vehiculo == 0) { ?>
                                                <td> Municipal</td>
                                                <?php }else{ ?>
                                                <td>Particular</td>
                                                <?php } ?>
                                                <td><?php echo "$" . $m->importe; ?></td>
                                                <td><?php echo "$" . $m->importe_cargado; ?></td>
                                                <td><button value="<?php echo $m->nit ?>" data-toggle="modal" data-target="#modal-movimientos" class="btn btn-default btn-search-movimientos">Ver más</button></td>
                                        </tr>
                                    <?php endforeach ?>
                                    </tbody>

                            </div>
                        </div>
                    </div>
                                                                                             
            </div>
            <?php }else{ ?>
                <div align="center">
                <h3>No se encontraron resultados</h3>
                </div>
            <?php } ?>  
        </div>
    </div>
    <style type="text/css">
        td {
            text-align: center;
            vertical-align: center;
            font-size: 16px;
        }

        th {
            text-align: center;
            vertical-align: center;
            font-size: 18px;
        }
    </style>
    <!-- /.modal -->
    <div class="modal fade" id="modal-personas">
        <div class="modal-dialog modal-lg"> 
            <div class="modal-content" >
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h2 class="modal-title" style="text-align: center">Listado de personas</h2>
                </div>
                <div class="modal-body"> 

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-right btn-cerrar-modal-personas" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->


    <!-- /.modal -->
    <div class="modal fade" id="modal-movimientos">
        <div class="modal-dialog modal-lg"> 
            <div class="modal-content" >
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h2 class="modal-title" style="text-align: center">Movimiento ticket</h2>
                </div>
                <div class="modal-body"> 

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-right btn-cerrar-modal-movimientos" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->


</body>
<script type="text/javascript">
var base_url = "<?php echo base_url();?>";
                    
        $(".btn-search-persona").on("click", function(){
            $.ajax({
                url: base_url + "Personas/getPersonasForEmitirTicketDetalle/",
                success:function(r){
                    $("#modal-personas .modal-body").html(r);
                }
            })
        })

        $(".btn-search-movimientos").on("click", function(){
            var nit = $(this).val();
            $.ajax({
                url: base_url + "Ticket/getMovimientosporTicket/"+nit,
                success:function(r){
                    $("#modal-movimientos .modal-body").html(r);
                }
            })
        })

</script>
