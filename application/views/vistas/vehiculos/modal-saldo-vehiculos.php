<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h1 style="text-align: center;"></h1>
            </div>
            <div class="panel-body">
               
            <h4 style="font-family: verdana;"><b style="color: #337AB7">VEHICULO:</b> <?php echo $v->marca." ".$v->modelo." ".$v->dominio;?></h4>
		<?php if($v->flag_litros==1){ ?> 
                <h4 style="font-family: verdana;"><b style="color: #337AB7">SALDO ACTUAL</b> <?php echo $v->maximo_mensual. " LITROS";?></h4>
		<?php }else{?>
			<h4 style="font-family: verdana;"><b style="color: #337AB7">SALDO ACTUAL</b> <?php echo "$".$v->maximo_mensual;?></h4>
		<?php } ?>
                <h4 style="font-family: verdana;"><b style="color: #337AB7">MOTIVO</b> <?php echo $v->motivo;?></h4>
                
            
                <div class="panel panel-danger">
                    <div class="panel-heading">
					<?php if($v->flag_litros==1){ ?> 
                        <h2 style="text-align: center;">LITROS A OTORGAR</h2>
                        <h4 style="text-align: center;">Los litros asignados se le sumarán a los litros existentes.</h4>
						<?php }else{?>
							<h2 style="text-align: center;">MONTO A OTORGAR</h2>
                        <h4 style="text-align: center;">El monto asignado se le sumará al monto existente.</h4>
							<?php } ?>
                    </div>
                    <div class="panel-body">
                        <div class="input-group" >
						<?php if($v->flag_litros==0){ ?>
							<span class="input-group-addon">$</span>
						<?php }else{ ?>
							<span class="input-group-addon">LITROS</span>
						<?php } ?>
                            <input type="number" class="form-control" required="required" name="monto">
                            <input type="hidden" name="id_vehiculo" value="<?php echo $v->id_vehiculo ?>">
                            <input type="hidden" name="maximo_mensual" value="<?php echo $v->maximo_mensual ?>">
                            <input type="hidden" name="id_solicitud" value="<?php echo $v->id_solicitud ?>">
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
        var id_solicitud = $("input[name='id_solicitud']").val();
        var monto = $("input[name='monto']").val();
        var maximo_mensual = $("input[name='maximo_mensual']").val();
        var id_vehiculo = $("input[name='id_vehiculo']").val();
       

        intMonto = parseInt(monto);
        intmaximo_mensual = parseInt(maximo_mensual);

        var suma = intMonto + intmaximo_mensual;


        if (monto == "") {
            swal({
                icon: "warning",
                title: "Ingresar monto."
            })
        }else{
            var base_url = "<?php echo base_url();?>";
                
                $.ajax({
                    url: base_url + "Vehiculos/ingresarMaximoVehiculo/",
                    type: "POST",
                    data: "id_solicitud="+id_solicitud+"&monto="+monto+"&suma="+suma+"&id_vehiculo="+id_vehiculo+"&maximo_mensual="+maximo_mensual,
                    success:function(r){
                        if (r == "true") {
                            swal({
                                icon: "success",
                                title: "Monto ingresado.",
                                text: "Solcitud confirmada.",
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
