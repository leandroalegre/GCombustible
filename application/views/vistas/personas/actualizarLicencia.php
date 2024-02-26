<body style="width: 95%; margin: 3px auto">
    <div class="container">
        <form method="post" id="user_form">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1>ACTUALIZAR LICENCIA</h1>
                </div>
                <div class="panel-body">
                    <input type="hidden" name="id_secretaria" value="<?php echo $this->session->userdata("id_secretaria") ?>">
                    <br>
                    <div class="row">
                        <div class="buscar persona col-md-offset-1 col-md-5">
                            <button type="button" data-toggle="modal" data-target="#modal-personas" class="btn btn-lg btn-block btn-primary btn-search-persona"><i class="glyphicon glyphicon-search"></i> Seleccionar persona</button>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="datos persona col-md-offset-1 col-md-10">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h5>DATOS DE LA PERSONA</h5>
                                </div>
                                <div class="panel-body">
                                    <div class="col-md-4 col-xs-12 col-sm-12">
                                        <label>Legajo</label>
                                        <input type="hidden" name="id_persona" value="0">
                                        <input type="text" name="legajo" class="form-control" readonly="readonly" required>
                                    </div>
                                    <div class="col-md-4 col-xs-12 col-sm-12">
                                        <label>Nombre y apellido</label>
                                        <input type="text" name="nombre" class="form-control" readonly="readonly" required>
                                    </div>
                                    <div class="col-md-4 col-xs-12 col-sm-12">
                                        <label>Vencimiento licencia</label>
                                        <input type="text" name="vencimiento_licencia" class="form-control" readonly="readonly" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <div class="row">
                        <div class="datos vehiculo col-md-offset-1 col-md-10">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h5>FOTO DE LICENCIA</h5>
                                </div>
                                <div class="panel-body">
                                    <div class="col-md-4 col-xs-12 col-sm-12">
                                        <label>Imagen</label>

                                        <input type="file" name="archivo" id="archivo" required /> <br>
                                        <strong>Recomendación: recortar foto para que salga solo la licencia.</strong> <br>
                                    </div>
                                    <div class="col-md-4 col-xs-12 col-sm-12">
                                        <label>Nuevo vencimiento</label>
                                        <input type="date" name="nuevo_vencimiento" class="form-control" required>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>

                </div>
                <div class="panel-footer">
                    <div class="row">
                        <div class="botones guardar y cancelar col-md-offset-4 col-md-8">

                            <div class="col-md-6 col-xs-12 col-sm-12">
                                <button type="submit" class="btn btn-lg btn-block btn-success">Confirmar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </form>


    <!-- /.modal -->
    <div class="modal fade" id="modal-personas">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
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



</body>
<style type="text/css">
    th,
    td {
        text-align: center;
    }

    .swal-text {
        text-align: center;
    }
</style>
<script src="<?php echo base_url(); ?>public/sweetAlert/sweetAlert.min.js"></script>
<script src="<?php echo base_url(); ?>public/jquery/jquery-3.4.1.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        var base_url = "<?php echo base_url(); ?>";

        $(".btn-search-persona").on("click", function() {
            var id_secretaria = $("input[name='id_secretaria']").val();
            $.ajax({
                url: base_url + "Personas/getPersonasForEmitirTicket/",
                type: "POST",
                data: "id_secretaria=" + id_secretaria,
                success: function(r) {
                    $("#modal-personas .modal-body").html(r);
                }
            })
        })



        $(document).on('submit', '#user_form', function(event) {
            event.preventDefault();
            var id_persona = $("input[name='id_persona']").val();
            var vencimiento_licencia = $("input[name='vencimiento_licencia']").val();
            var nuevo_vencimiento = $("input[name='nuevo_vencimiento']").val();
            var extension = $('#archivo').val().split('.').pop().toLowerCase();
            if (extension != '') {
                if (jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
                    swal({
                                icon: "warning",
                                title: "Imagen invalida",
                                text: "Formatos permitidos: JPG, JPEG, PNG"
                            })
                    $('#archivo').val('');
                    return false;
                }
            }
            if (id_persona != '' && vencimiento_licencia != '' && nuevo_vencimiento != '') {
                $.ajax({
                    url: "<?php echo base_url() . 'Ticket/subirActualizacion/' ?>",
                    method: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        if (data == 1) {
                            swal({
                                icon: "success",
                                title: "Licencia actualizada correctamente",
                                timer: 2000,
                            })
                            setTimeout(function() {
                                location.reload();
                            }, 2000)
                        } else {
                            swal({
                                icon: "warning",
                                title: "Hubo un problema al subir la imagen",
                            })
                        }
                    }
                });
            } else {
                swal({
                        icon: "warning",
                        title: "Complete todos los campos",
                    })
            }

        })



    })
</script>