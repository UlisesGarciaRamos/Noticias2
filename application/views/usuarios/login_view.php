<!DOCTYPE html>
<html lang="es">    
    <head>
        <meta charset = "utf-8"/>
        <meta content = "Jose Manuel Gómez Alavez" name = "author"/>
        <meta content = "Pagina web de noticias usando bootstrap,jquery, codeigniter" name = "description" />
        <meta content = "jquery,boostrap 3.0, codeigniter,ajax" name = "keywords"/>
        <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/css/sweetalert.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/css/login_style.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/css/font-awesome/4.5.0/css/font-awesome.min.css');?>">
        <script type = "text/javascript" src = "<?php echo base_url();?>assets/js/sweetalert.min.js"></script>
        <script type = "text/javascript" href="<?php echo base_url('assets/js/bootstrap.min.js');?>"></script>
        <script type = "text/javascript" src = "<?php echo base_url();?>assets/js/jquery.js"></script>
        <script type = "text/javascript">
             $( document ).ready(function () {
                $("#login").on("click",function (e){
                    e.preventDefault();
                        var dir =  "<?php echo site_url()?>";
                        $.ajax({
                            data: $("#formulario").serialize(),
                            url: dir+"/usuarios/login_usuario",
                            type: "POST",
                            success:  function (response) {
                                var resp = JSON.parse(response);
                                console.log(resp);
                                if(resp.respuesta === "usuario"){
                                    swal({title: "Usuario",text: "Bienvenido al sistema",type: "success"});
                                    window.location.href = dir+"/usuarios/vista_usuario";
                                }else if(resp.respuesta === "admin"){
                                    swal({title: "Usuario",text: "Bienvenido al sistema",type: "success"});
                                    window.location.href = dir+"/usuarios/vista_admin";
                                }else if(resp.respuesta === "error"){
                                    swal({title: "Usuario",text: "Error en la contraseña o cuenta inexistente",type: "warning"});
                                }else if(resp.respuesta === "block"){
                                    swal({title: "Usuario",text: "Usuario bloqueado por limite de intentos excedidos,por favor consulte con el administrador",type: "error"});
                                }
                                
                            },
                            error: function(response){
                                swal({title: "Usuario",text: "Ha ocurrido un error con el servidor, por favor contacte con el administrador",type: "error"});
                                console.log(response);
                            }
				    	});
                        return false;
                });
            });
        </script>
    </head>
    <body>
        <div class="container">
            <div class="contenedor_principal">
                <h3 class="titulo_principal">Login o <a href="<?php echo site_url('usuarios/form_usuario');?>"> Registro de usuario</a></h3>
                <div class="row">
                    <div class="col-xs-12 col-sm-2">
                    </div>	
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-5">
                        <div class = "image">
                        <div class = "user_image"></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-5">	
                        <form class="" id = "formulario" autocomplete="off" method="POST">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="fa fa-user"></span></span>
                                <input type="text" class="form-control" name="c_usuario" placeholder="usuario">
                            </div>
                            <span class="help-block"></span>
                                                
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input  type="password" class="form-control" name="c_password" placeholder="Password">
                            </div>
                            <span class="help-block"></span>
                            <button id = "login" class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-2">
                        <label class="checkbox">
                            <input type="checkbox" value="remember-me">Recordarme
                        </label>
                    </div>
                    <div class="col-xs-12 col-sm-2">
                        <p class="forget_passw">
                            <a href="#">Olvidaste tu password?</a>
                        </p>
                    </div>
                </div>	    	
            </div>
        </div>
    </body>
</html>