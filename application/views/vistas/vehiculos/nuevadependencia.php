<style type="text/css">
    td, th{
        text-align: center;
    }
</style>
<body style="background-color: #F3F3F3; width: 95%; margin: 3px auto">
    <div class="container">
        <h3></h3>
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>NUEVA DEPENDENCIA</strong>
            </div>
            <div class="panel-body">                
                <div class="row">
                    <div class="col-md-offset-2 col-md-8">
                        <div class="form-group">
                            <label for="detalle">DEPENDENCIA:</label>
                            <input type="text" name="dependencia" class="form-control" placeholder="Nombre dependencia">
                        </div>
                    </div>
                </div>                                                                           
                <div class="row" align="center">
                    <div class="col-md-12"> 		
                        <button type="button" class="btn btn-success btn-add">Cargar dependencia</button>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-offset-2 col-md-8">
                        <div class="table-responsive">
                            <table id="tabla1" class="table table-hover">
                                <thead>
                                    <th>ID</th>
                                    <th>DEPENDENCIA</th>                                  
                                </thead>
                                <tbody>
                                    <?php if (!empty($dependencias)): ?>
                                    <?php foreach ($dependencias as $d): ?>
                                    <tr>
                                        <td><?php echo $d->id_dependencia; ?></td>
                                        <td><?php echo $d->dependencia; ?></td>                                   
                                    </tr>
                                    <?php endforeach ?>
                                    <?php endif ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>    
            </div>
        </div>
    </div>
</body>
<script type="text/javascript">
    var base_url = "<?php echo base_url();?>";
        $(".btn-add").on("click", function(){
            var dependencia = $("input[name='dependencia']").val();
            if (dependencia == "") {
                swal({
                    icon: "warning",
                    title: "Completar todos los campos.",
                })
            }else{
                $.ajax({
                    url: base_url + "Vehiculos/crear_dependencia/",
                    type: "POST",
                    data: "dependencia="+dependencia,
                    success:function(resp){
                        if (resp == "true") {
                            swal({
                                icon: "success",
                                title: "Operación exitosa",
                                timer: 2000,
                            })
                            setTimeout(function(){
                                window.location = base_url + "Vehiculos";
                            },2000)
                        }else if (resp == "false"){
                            swal({
                                icon: "error",
                                title: "Hubo un problema al realizar la operación",
                            })
                        }
                    }
                })
            }
        })
</script>