<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h1 style="text-align: center;"><?php echo $nombre_sec;?></h1>
            </div>
            <div class="panel-body">
                <input type="hidden" name="id_soli" value="<?php echo $id_soli;?>">
                <input type="hidden" name="id_sec" value="<?php echo $id_sec;?>">
                <input type="hidden" name="saldo_actual_secretaria" value="<?php echo $saldo_sec;?>">
                <h4 style="font-family: verdana;"><b style="color: #337AB7">SALDO ACTUAL DE LA SECRETARIA:</b> <?php echo "$".$saldo_sec;?></h4>
                <hr>
                <br>
                <div class="panel panel-danger">
                    <div class="panel-heading">
                        <h2 style="text-align: center;">MONTO A OTORGAR</h2>
                    </div>
                    <div class="panel-body">
                        <div class="input-group" >
                            <span class="input-group-addon">$</span>
                            <input type="number" class="form-control" required="required" name="monto">
                        </div>
                    </div>
                </div>
                <button class="btn btn-block btn-success btn-verde btn-lg">CONFIRMAR</button>         
            </div>
        </div>
    </div>
</div>
<style type="text/css">
    .swal-text{
        text-align: center;
    }
</style>
<script src="<?php echo base_url();?>public/sweetAlert/sweetAlert.min.js"></script>
<script type="text/javascript">
    $(".btn-verde").on("click", function(){
        var id_soli = $("input[name='id_soli']").val();
        var id_sec = $("input[name='id_sec']").val();
        var saldo_sec = $("input[name='saldo_actual_secretaria']").val();
        var monto = $("input[name='monto']").val();

        intMonto = parseInt(monto);
        intSaldoSec = parseInt(saldo_sec);

        if (monto == "") {
            swal({
                icon: "warning",
                title: "Ingresar monto."
            })
        }else if(monto <= 0){
            swal({
                        icon: "error",
                        title: "Monto no permitido.",
                        text: "Solo esta permitido ingresar montos mayor a 0.",
            })
        }else{
            var base_url = "<?php echo base_url();?>";
            $.ajax({
                url: base_url + "Ticket/ingresarMontoAprobarSolicitud/",
                type: "POST",
                data: "id_soli="+id_soli+"&id_sec="+id_sec+"&saldo_sec="+saldo_sec+"&monto="+monto,
                success:function(r){
                    if (r == "true") {
                        swal({
                            icon: "success",
                            title: "Solicitud aprobada.",
                            timer: 2000,
                        })
                        setTimeout(function(){
                            location.reload();
                        },2000)
                    }else{
                        swal({
                            icon: "error",
                            title: "Hubo un error al realizar la operación."
                        })
                    }
                }
            })
        }
    })
</script>