<!DOCTYPE html>
<html>
    <head>
        <title>Iniciar sesion</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="shortcut icon" href="<?php echo base_url(); ?>favicon.ico"/>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="<?php echo base_url();?>public/bootstrap/css/bootstrap.min.css">
        <!-- JQuery ui css -->
        <link rel="stylesheet" href="<?php echo base_url();?>public/jquery-ui/jquery-ui.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?php echo base_url();?>public/font-awesome/css/font-awesome.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo base_url();?>public/dist/css/AdminLTE.min.css">
        <!-- DataTables -->
        <link rel="stylesheet" href="<?php echo base_url();?>public/datatables.net-bs/css/dataTables.bootstrap.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
        folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="<?php echo base_url();?>public/dist/css/skins/_all-skins.min.css">
    </head>
    <body>
        <div class="row" style="margin-top: 40px">
            
        </div>
        <div class="row">
            <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
                <div class="panel panel-default" style="box-shadow: 5px 5px 5px grey">
                    <div class="panel-heading clearfix">
                        <div class="col-md-12">
                            <h1 style="text-align: center; font-family: arial">Sistema de vales</h1>
                        </div>
                    </div>
                    <div class="panel-body">
                        <h2 class="form-signin-heading" style="text-align: center; color: #F17434; font-family: arial"><b>Generar Contraseña</b></h2>
                        <br>
                        <input type="text" id="input" class="form-control" id="username" name="username" value="<?php echo $busca;?>" placeholder="" autofocus="" readonly=""/>
                        <span class="help-block" id="span" style="color: red; margin: 0 auto; width: 90%; display: none">El campo de Usuario es requerido</span>
                        <br id='br'>
                        <div class="input-group" id="input">
                            <input type="password"  id="password" style="border-radius: 10px 0px 0px 10px;" class="form-control" name="password" placeholder="Contraseña">
                            <span id="show-hide-passwd" style="border-radius: 0px 10px 10px 0px;" class="input-group-addon"><i id="icon" action="hide" class="glyphicon glyphicon-eye-open"></i></span>
                        </div>
                    </BR>

                        <div class="input-group" id="input">
                            <input type="password"  id="passwordrep" style="border-radius: 10px 0px 0px 10px;" class="form-control" name="passwordrep" placeholder="Repetir contraseña">
                            <span id="show-hide-passwds" style="border-radius: 0px 10px 10px 0px;" class="input-group-addon"><i id="icon" action="hide" class="glyphicon glyphicon-eye-open"></i></span>
                        </div>
                        
                        <br>      
                        <button class="btn btn-lg btn-block pull-right btn-login" id="entrar" style="background-color: #F17434; color: white; width: 40%; box-shadow: 5px 5px 5px grey" type="button">GUARDAR</button>
                    </div>
                </div>
            </div>
        </div>
    </body>

    <style type="text/css">
        span{
            cursor: pointer;
        }
        #input{
            width: 90%;
            margin: 0 auto;
            border-radius: 10px;
        }
    </style>

    <script src="<?php echo base_url();?>public/jquery/jquery-3.4.1.min.js"></script>
    <!-- jQuery 3 -->
    <script src="<?php echo base_url();?>public/jquery-ui/jquery-ui.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="<?php echo base_url();?>public/bootstrap/js/bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="<?php echo base_url();?>public/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <!-- DataTables -->
    <script src="<?php echo base_url();?>public/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url();?>public/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url();?>public/fastclick/lib/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url();?>public/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url();?>public/dist/js/demo.js"></script>

    <!-- Sweet Alert -->
    <script src="<?php echo base_url();?>public/sweetAlert/sweetAlert.min.js"></script>

    <script type="text/javascript">
            var base_url = "<?php echo base_url();?>";

            $('#show-hide-passwd').on('click', function(e) {
                e.preventDefault();
                var current = $("#icon").attr('action');
                if (current == 'hide') {
                    $(this).prev().attr('type','text');
                    $("#icon").removeClass('glyphicon-eye-open').addClass('glyphicon-eye-close').attr('action','show');
                }
                if (current == 'show') {
                    $(this).prev().attr('type','password');
                    $("#icon").removeClass('glyphicon-eye-close').addClass('glyphicon-eye-open').attr('action','hide');
                    
                }
            });

            $('#show-hide-passwds').on('click', function(e) {
                e.preventDefault();
                var current = $("#icon").attr('action');
                if (current == 'hide') {
                    $(this).prev().attr('type','text');
                    $("#icon").removeClass('glyphicon-eye-open').addClass('glyphicon-eye-close').attr('action','show');
                }
                if (current == 'show') {
                    $(this).prev().attr('type','password');
                    $("#icon").removeClass('glyphicon-eye-close').addClass('glyphicon-eye-open').attr('action','hide');
                    
                }
            });
            $(".btn-login").on("click", function(){
                var username = $("input[name='username']").val();
                var password = $("input[name='password']").val();
                var passwordrep = $("input[name='passwordrep']").val();
                if (password == passwordrep) {
                        $.ajax({
                            url: base_url + "Login/generar_contrasena/"+username+"/"+password,
                            
                            success:function(resp){
                                            if (resp == "true") {
                                                swal({
                                                    title: "Exito!",
                                                    text: "Contraseña generada.",
                                                    icon: "success",
                                                    timer: 2000,
                                                });
                                                setTimeout(function(){
                                                    window.location= base_url;
                                                },2000);
                                            }
                                        }
                                })
                }else{
                     swal({
                                    icon: "error",
                                    title: "Las contraseñas no coinciden",
                                });
                }
            });

            
    </script>
</html>