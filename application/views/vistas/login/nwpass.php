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
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.96.1/css/materialize.min.css">
    <!-- JQuery ui css -->

    <link rel="stylesheet" href="<?php echo base_url();?>public/jquery-ui/jquery-ui.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url();?>public/font-awesome/css/font-awesome.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url();?>public/dist/css/AdminLTE.min.css">
    <!-- DataTables -->

        <!-- AdminLTE Skins. Choose a skin from the css/skins
            folder instead of downloading all of them to reduce the load. -->
            <link rel="stylesheet" href="<?php echo base_url();?>public/dist/css/skins/_all-skins.min.css">
            <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.96.1/js/materialize.min.js"></script>
        </head>
        <body>
          <div class="row center-align">
            <img src="<?php echo base_url();?>public/images/logo-gris-grande.png" style="width: 70%;
            height: auto; margin-top: -5%">

            <div class="col-md-12" style="margin-top: -2%">
                <h3 style="text-align: center;">Sistema de vales</h3>
            </div>
        </div>
        <div class="panel-body">
            <h4 class="form-signin-heading" style="text-align: center; color: #F17434;"><b>Generar Contraseña</b></h4>


        </div>
        <div class="row">
            <div class="col s12 m8 offset-m2 l4 offset-l4">
                <div class="card-panel" style="-webkit-box-shadow: 1px 1px 14px -3px rgba(0,0,0,0.75);
-moz-box-shadow: 1px 1px 14px -3px rgba(0,0,0,0.75);
box-shadow: 1px 1px 14px -3px rgba(0,0,0,0.75);">
                <div class="row">
                  <form action="#" method="" class="col s12">
                    <div class="row">
                      <div class="input-field col s11">
                        <i class="mdi-action-account-circle prefix"></i>


                        <input id="username" name="username" value="<?php echo $busca;?>" readonly type="text" class="validate"/>
                        <label for="email">Usuario</label>   
                    </div>
                </div>
                <div class="row">
                  <div class="input-field col s11">
                    <i class="mdi-communication-vpn-key prefix"></i>
                    <input id="password" type="password" name="password" placeholder="Contraseña" autofocus class="validate"/>
                    <label for="password">Contraseña</label>
                </div>
            </div>

            <div class="row">
              <div class="input-field col s11">
                <i class="mdi-communication-vpn-key prefix"></i>
                <input id="passwordrep" type="password" name="passwordrep" placeholder="Repetir contraseña" class="validate"/>
                <label for="passwordrep">Repetir contraseña</label>
            </div>
        </div>
        <div class="row center-align">
            <button class="btn waves-effect waves-light btn-login" id="entrar" style="background-color: #FF8C00; color: white" type="button">Ingresar</button>
        </div>
    </form>  
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

    $(document).keypress(function(e) {
        if(e.which == 13) {
            $(".btn-login").click();
        }
    });


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

        if (password == "" && passwordrep=="") {
            swal({
               title: "Error!",
               text: "Debe ingresar las contraseñas.",
               icon: "warning",
               timer: 2000,
           })
        }else{
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
                title: "Error!",
                text: "Las contraseñas no coinciden."
            });
           }
       }
   });


</script>
</html>