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
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!-- DataTables -->
        
        <!-- AdminLTE Skins. Choose a skin from the css/skins
        folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="<?php echo base_url();?>public/dist/css/skins/_all-skins.min.css">
        <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.96.1/js/materialize.min.js"></script>
        <style type="text/css">
            *:before, *:after { content: ''; }
hr {
  border: 0;
  margin: 1.35em auto;
  max-width: 100%;
  background-position: 50%;
  box-sizing: border-box;
}
.shine {
  height: 20px;
  width: 60%;
  background-image: radial-gradient(
    farthest-side at 50% -50%,
    hsla(0, 0%, 0%, 0.5),
    hsla(0, 0%, 0%, 0));
  position: relative; 
}

.shine::before {
  height: 1px;
  position: absolute;
  top: -1px;
  left: 0;
  right: 0;
  background-image: linear-gradient(
    90deg,
    hsla(0, 0%, 0%, 0),
    hsla(0, 0%, 0%, 0.75) 50%,
    hsla(0, 0%, 0%, 0));
}
        </style>

    </head>

    <body>
  <div class="row center-align">
    <div class="col offset-l3 l6">
    <img class="responsive-img" src="<?php echo base_url();?>public/images/logo-gris-grande.png" style="height: auto; margin-top: -5%">
    </div>
  
                    </div>
                    <div class="panel-body">
                      <div class="l12">
                            <h3 style="text-align: center;">Sistema de vales</h3>
                        </div>
                        <h4 class="form-signin-heading" style="text-align: center; color: #F17434;"><b>Iniciar sesion</b></h4>
                       
   

 <div class="row">
    <form class="col s12">
        <div class="col s12 m8 offset-m2 l4 offset-l4">
        <div class="card-panel" style="-webkit-box-shadow: 1px 1px 14px -3px rgba(0,0,0,0.75);
-moz-box-shadow: 1px 1px 14px -3px rgba(0,0,0,0.75);
box-shadow: 1px 1px 14px -3px rgba(0,0,0,0.75);">
      <div class="row">
        <div class="input-field col s10 ">
          <i class="mdi-action-account-circle prefix"></i>
                <input id="username" name="username" type="text" class="validate" autofocus placeholder="Usuario" />
                <label for="email">Usuario</label>
                <span class="help-block" id="span" style="color: red; margin: 0 auto; width: 90%; display: none">El campo de Usuario es requerido</span>
        </div>
        <div class="input-field col s10 ">
          <i class="mdi-communication-vpn-key prefix"></i>
                <input id="password" type="password" name="password" class="validate" placeholder="Contraseña" />
                <label for="password">Contraseña</label>
                </div>
                <div class="input-field col s2">
                <span class="material-icons" id="eye-open" onclick="mostrarContrasena()" style="margin-top: 22%; margin-left: -60%">visibility_off</span>
                
        </div>
      </div>
      <div class="row center-align">
                <button class="btn waves-effect waves-light btn-login" id="entrar" style="background-color: #FF8C00; color: white" type="button">Ingresar</button>
            </div>
      </div>
      </div>
    </form>
  </div>
        
</body>

    <style type="text/css">
        span{
            cursor: pointer;
        }
        #input{
            width: 90%;
            margin: 0 auto;
            border-rºº  11º adius: 10px;
        }
    </style>

    
    <script src="<?php echo base_url();?>public/sweetAlert/sweetAlert.min.js"></script>

    <script type="text/javascript">
            var base_url = "<?php echo base_url();?>";


              function mostrarContrasena(){
      var tipo = document.getElementById("password");
      if(tipo.type == "password"){
          tipo.type = "text";
          $(".material-icons").text("visibility");
          
      }else{
          tipo.type = "password";
          $(".material-icons").text("visibility_off");
      }
  }

            $(document).keypress(function(e) {
                if(e.which == 13) {
                    $(".btn-login").click();
                }
            });

             $(".btn-login").on("click", function(){
                var username = $("input[name='username']").val();
                var password = $("input[name='password']").val();
                if (username == "" || username == null) {
                    $("#span").css({"display":"block"});
                }
                if (password == "" || password == null){
                var password = "0";
                    $.ajax({

                        url: base_url + "login/newpass/"+username+"/"+password+"/",
                        success:function(r){
                            if (r=="false") {
                                
                                 swal({
                                    icon: "error",
                                    title: "El usuario no existe o ya tiene una contraseña generada",
                                });
                            }else{
                                window.location = base_url + "Login/vista/"+r;
                            }
                        }
                        })  
                }else{

                    $("#span").css({"display":"none"});
                    $.ajax({
                        url: base_url + "login/login",
                        type: "POST",
                        data:"username="+username+"&password="+password,
                        success:function(r){
                          
                            if (r == "false"){
                                swal({
                                    icon: "error",
                                    title: "Usuario y/o contraseña incorrectos",
                                });
                            }
                            else{
                                window.location = base_url;
                            }
                        }
                    })
                }
            });

    </script>
</html>
