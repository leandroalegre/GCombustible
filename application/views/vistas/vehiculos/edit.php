<?php if ($this->session->userdata("rol")==1){ ?>
<body style="background-color: #F3F3F3; width: 95%; margin: 3px auto">
    <div class="container" style="background-color: #EEEEEE">

<form method="POST" action="<?php echo base_url();?>Vehiculos/update">
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading cleafix">
                    <h2 style="text-align: center;">Datos del <br> vehículo</h2>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="marca">MARCA:</label>
                        <input type="hidden" name="id_v" value="<?php echo $v->id; ?>">
                        <input type="text" name="marca" class="form-control" required="required" autocomplete="off" placeholder="Marca" value="<?php echo $v->marca ?>">
                    </div>
                    <div class="form-group">
                        <label for="modelo">MODELO:</label>
                        <input type="text" name="modelo" class="form-control" required="required" autocomplete="off" placeholder="Modelo" value="<?php echo $v->modelo ?>">
                    </div>
                    <div class="form-group">
                        <label for="telefono">DOMINIO:</label>
                        <input type="text" name="dominio" class="form-control" required="required" autocomplete="off" placeholder="DOMINIO" value="<?php echo $v->dominio ?>">
                    </div>
					<div class="form-group">
                        <label for="telefono">CAPACIDAD M3 GNC:</label>
                        <input type="number" name="m3_gnc" class="form-control" autocomplete="off" placeholder="DOMINIO" value="<?php echo $v->m3_gnc ?>">
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
                        <label>SECRETARÍA:</label><select class="form-control" name="id_sec" id="id_sec">
                            <option value="<?php echo $v->id_sec ?>" selected><?php echo $v->nom_sec ?></option>
                            <?php foreach ($sec as $s): ?>
                                <?php if ($v->nom_sec!=$s->nombre){ ?>
                                <option value="<?php echo $s->id;?>"><?php echo $s->nombre;?></option>
                            <?php } ?>
                            <?php endforeach ?>


                        </select>
                    </div>
                    <div class="form-group">
                        <label>DIRECCIÓN:</label><select class="form-control" name="id_dir" id="id_dir">
                            <option value="<?php echo $v->id_dir ?>" selected><?php echo $v->nom_dir ?></option>
                            <?php foreach ($dir as $d): ?>
                                <?php if ($v->nom_dir!=$d->nombre){ ?>
                                <option value="<?php echo $d->id_dir;?>"><?php echo $d->nombre;?></option>
                            <?php } ?>
                            <?php endforeach ?>

                        </select>
                    </div>
                    <div class="form-group">
                        <label>ÁREA:</label><select class="form-control" name="id_area" id="id_area">
                            <option value="<?php echo $v->id_are ?>" selected><?php echo $v->nom_ar ?></option>
                            <?php foreach ($ar as $a): ?>
                                <?php if ($v->nom_ar!=$a->nombre_ar){ ?>
                                <option value="<?php echo $a->id_area;?>"><?php echo $a->nombre_ar;?></option>
                                <?php } ?>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>

            </div>
        </div>
    </div>

	<div class="col-md-offset-2 col-md-8">
                            <div class="panel panel-default">
                                
                                <div class="panel-body">
                                   <div class="selects">
                                   <div class="container">
    <div class="row">
        <div class="col-md-2 col-sm-8"> <div class="form-group">
                                        <label>Numero de llavero:</label>
                                        <input type="number" value="<?php echo $v->num_llavero ?>" class="form-control" name="num_llavero" >
                                    </div></div>
									<div class="col-md-3 col-sm-8"> <div class="form-group">
                                        <label>Codigo de llavero, click para editar</label> <input id="check-tarjeta" type="checkbox">
										<input type="hidden" id="id_row_tarjeta" name="id_row_tarjeta">
										<input type="text" name="id_tarjeta" id="id_tarjeta" value="<?php echo $v->id_tarjeta ?>" class="form-control" required="required" readonly autocomplete="off" placeholder="Pase la tarjeta por el lector">
                                    </div></div>
        <div class="col-md-2 col-sm-8">  <div class="form-group">
                                        <label>¿Es vehiculo particular?</label>
                                        <select name="tipo_vehiculo" id="" class="form-control">
                                            <option value="<?php echo $v->tipo_vehiculo ?>" selected><?php echo $v->tipo ?></option>
                                            <?php if($v->tipo_vehiculo==0){ ?>
                                                <option value="1">Si</option>
                                            <?php }else{ ?>
                                                <option value="0">No</option>
                                            <?php } ?>
                                        </select>
                                    </div></div>
    </div>
</div>
                                   
                                  
                                    
                                </div>
                                
                            </div>
                        </div>
                    </div>

                </div>


</div>
<br>
<button type="submit" style="width: 25%; margin: 0 auto; display: block" class="btn btn-success btn-add" onclick="alert()">EDITAR VEHICULO</button>
</form>
</div>
</body>
                                            <?php }else{ ?>
                                               
<body style="background-color: #F3F3F3; width: 95%; margin: 3px auto">
    <div class="container" style="background-color: #EEEEEE">

<form method="POST" action="<?php echo base_url();?>Vehiculos/update">
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading cleafix">
                    <h2 style="text-align: center;">Datos del <br> vehículo</h2>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="marca">MARCA:</label>
                        <input type="hidden" name="id_v" value="<?php echo $v->id; ?>">
                        <input type="text" name="marca" class="form-control" required="required" autocomplete="off" placeholder="Marca" value="<?php echo $v->marca ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="modelo">MODELO:</label>
                        <input type="text" name="modelo" class="form-control" required="required" autocomplete="off" placeholder="Modelo" value="<?php echo $v->modelo ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="telefono">DOMINIO:</label>
                        <input type="text" name="dominio" class="form-control" required="required" autocomplete="off" placeholder="DOMINIO" value="<?php echo $v->dominio ?>" readonly>
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
                        <label>SECRETARÍA:</label><select class="form-control" name="id_sec" id="id_sec">
                            <option value="<?php echo $v->id_sec ?>" selected><?php echo $v->nom_sec ?></option>
                            


                        </select>
                    </div>
                    <div class="form-group">
                        <label>DIRECCIÓN:</label><select class="form-control" name="id_dir" id="id_dir">
                            <option value="<?php echo $v->id_dir ?>" selected><?php echo $v->nom_dir ?></option>
                           

                        </select>
                    </div>
                    <div class="form-group">
                        <label>ÁREA:</label><select class="form-control" name="id_area" id="id_area">
                            <option value="<?php echo $v->id_are ?>" selected><?php echo $v->nom_ar ?></option>
                            
                        </select>
                    </div>
                </div>

            </div>
        </div>
    </div>

     <div class="col-md-offset-2 col-md-8">
                            <div class="panel panel-default">
                                
                                <div class="panel-body">
                                   <div class="selects">
                                   <div class="container">
    <div class="row">
        <div class="col-md-2 col-sm-8"> <div class="form-group">
                                        <label>Numero de llavero:</label>
                                        <input type="number" value="<?php echo $v->num_llavero ?>" class="form-control" name="num_llavero" >
                                    </div></div>
									<div class="col-md-3 col-sm-8"> <div class="form-group">
                                        <label>Codigo de llavero, click para editar</label> <input id="check-tarjeta" type="checkbox">
										<input type="hidden" id="id_row_tarjeta" name="id_row_tarjeta">
										<input type="text" name="id_tarjeta" id="id_tarjeta" value="<?php echo $v->id_tarjeta ?>" class="form-control" required="required" readonly autocomplete="off" placeholder="Pase la tarjeta por el lector">
                                    </div></div>
        <div class="col-md-2 col-sm-8">  <div class="form-group">
                                        <label>¿Es vehiculo particular?</label>
                                        <select name="tipo_vehiculo" id="" class="form-control">
                                            <option value="<?php echo $v->tipo_vehiculo ?>" selected><?php echo $v->tipo ?></option>
                                            <?php if($v->tipo_vehiculo==0){ ?>
                                                <option value="1">Si</option>
                                            <?php }else{ ?>
                                                <option value="0">No</option>
                                            <?php } ?>
                                        </select>
                                    </div></div>
    </div>
</div>
                                   
                                  
                                    
                                </div>
                                
                            </div>
                        </div>
                    </div>

                </div>


</div>
<br>
<button type="submit" style="width: 25%; margin: 0 auto; display: block" class="btn btn-success btn-add" onclick="alert(); setearIdTarjeta()">EDITAR VEHICULO</button>
</form>
</div>
</body>
                                            <?php } ?>
<script src="<?php echo base_url();?>public/sweetAlert/sweetAlert.min.js"></script>

<script type="text/javascript">
var base_url = "<?php echo base_url();?>";

$("#check-tarjeta").on("click", function(){
	if($("#check-tarjeta").prop('checked')){
		setearAllTarjetas();
		drawInterval = setInterval(function(){
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
	}else{
		clearInterval(drawInterval);
	}
	
})


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

function setearAllTarjetas(){
    $.ajax({
        url: base_url + "Tarjeta/setearTodasAbm/"
    })
}

    $(document).on("change", "#id_sec", function(){
            $("#id_sec option:selected").each(function () {
               id_sec = $('#id_sec').val();
                $.post("<?php echo base_url() ?>Vehiculos/getDirecciones", {
                    id_sec: id_sec
                }, function (data) {
                    $("select[name='id_dir']").html(data);
                });
            });
        });


         $(document).on("change", "#id_dir", function(){
            $("#id_dir option:selected").each(function () {
                id_dir = $('#id_dir').val();
                id_sec = $('#id_sec').val();
                $.post("<?php echo base_url() ?>Vehiculos/getAreas", {
                    id_dir: id_dir, id_sec : id_sec
                }, function (data) {
                    $("select[name='id_area']").html(data);
                });
            });
        });

 

    function alert(){
        swal({
            icon: "success",
            title: "Exito!",
            text: "Vehículo editado correctamente"
        })
    }
</script>
