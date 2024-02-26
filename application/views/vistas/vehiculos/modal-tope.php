<input type="hidden" name="id_vehiculo" value="<?php echo $v->id; ?>">
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h4><?php echo "Vehiculo -" . $v->marca . " " . $v->modelo . " " . $v->dominio ?></h4>
            </div>
            <div class="panel-body">

                <div class="container">
                    <div class="row">
						<?php if($v->flag_litros==1){ ?>
						<div class="col-md-offset-1 col-md-2 col-sm-8"><label>Maximo actual <strong>en litros</strong></label></div>
						<?php }else{?>
							<div class="col-md-offset-1 col-md-2 col-sm-8"><label>Maximo actual <strong>en pesos</strong></label></div>
						<?php }?>
                    </div>
                    <div class="row">
                        <div class="col-md-offset-1 col-md-2 col-sm-8"><input type="text" readonly name="maximo_actual" class="form-control" value="<?php echo $v->maximo_mensual; ?>"> </div>
                    </div>
                    <div class="row">
					<?php if($v->flag_litros==1){ ?>
						<div class="col-md-offset-1 col-md-2 col-sm-8"><label>Nuevo maximo <strong>en litros</strong></label></div>
						<?php }else{?>
							<div class="col-md-offset-1 col-md-2 col-sm-8"><label>Nuevo maximo <strong>en pesos</strong></label></div>
							<?php }?>
                    </div>
                    <div class="row">
                        <div class="col-md-offset-1 col-md-2 col-sm-8"><input type="number" name="nuevo_maximo" class="form-control"> </div>
                    </div>
                </div>


            </div>

        </div>
    </div>
</div>
</div>
<div class="modal-footer">
    <button class="btn btn-success btn-confirmar">Confirmar</button>
    <button type="button" class="btn btn-danger pull-right btn-cerrar-modal-vehiculos" data-dismiss="modal">Cerrar</button>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        var base_url = "<?php echo base_url(); ?>";


        $(".btn-confirmar").on("click", function() {
            var id_vehiculo = $("input[name=id_vehiculo]").val();
            var nuevo_maximo = $("input[name=nuevo_maximo]").val();
            var maximo_actual = $("input[name=maximo_actual]").val();
            if (nuevo_maximo == "") {
                swal({
                    icon: "warning",
                    title: "Complete el nuevo maximo",
                })
            } else {

                swal({
                        title: "¿Confirma el maximo mensual de " + nuevo_maximo + "?",
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
                                    url: base_url + "Vehiculos/nuevoMaximo",
                                    type: "POST",
                                    data: "id_vehiculo=" + id_vehiculo + "&nuevo_maximo=" + nuevo_maximo + "&maximo_actual=" + maximo_actual,
                                    success: function(r) {
                                        if (r = true) {
                                            swal({
                                                icon: "success",
                                                title: "Operación exitosa",
                                                timer: 2000,
                                            })
                                            setTimeout(function(){
                                                window.location = base_url + "Vehiculos";
                                            },2000)
                                        }
                                    }
                                })
                        }
                    });
            }
        })



    })
</script>
