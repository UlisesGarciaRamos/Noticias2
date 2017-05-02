<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Registro de usuario</title>
        <meta charset="UTF-8" />
        <meta name="description" content="Práctica 2 - Alta de usuario" />
        <meta name="keywords" content="HTML5, CSS3, GIT, GITHUB, PHP, MARIADB " />
        <meta name="author" content="Jose Manuel Gomez Alavez" />
        <link rel="stylesheet" href="<?php echo base_url('assets/css/sweetalert.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/css/estilo_altaU.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/css/font-awesome/4.5.0/css/font-awesome.min.css');?>">
        <script type = "text/javascript" src = "<?php echo base_url();?>assets/js/sweetalert.min.js"></script>
        <script type = "text/javascript" src = "<?php echo base_url();?>assets/js/jquery.js"></script>
        <script type = "text/javascript">

             $( document ).ready(function () {
                $("#enviar").on("click",function (e){
                    e.preventDefault();
                    if($("#password").val() === $("#password2").val()){
                        var dir =  "<?php echo site_url()?>";
                        var nombre = $("#nombre").val();
                        $.ajax({
                            data: $("#formulario").serialize(),
                            url: dir+"/usuarios/agregar_usuario",
                            type: "POST",
                            success:  function (response) {
                                var resp = JSON.parse(response);
                                console.log(resp);
                                if(resp.respuesta === "ok"){
                                    swal({title: "Usuario",text: "Datos actualizados correctamente",type: "success"});
                                }else if(resp.respuesta === "existe"){
                                    swal({title: "Usuario",text: "El usuario ya se encuentra registrado",type: "warning"});
                                }
                                
                            },
                            error: function(response){
                                swal({title: "Usuario",text: "Ha ocurrido un error con el servidor, por favor contacte con el administrador",type: "error"});
                                console.log(response);
                            }
				    	});
                        return false;
                    }else{
                       swal({title: "Password",text: "Las contraseñas no coinciden",type: "warning"});
                    }
                });
            });

        </script>
    </head>
    <body>
        <div class="contenedor">
            <div class="thumbnail">
                <h3>Alta de usuario</h3>
                <form method = "post" id = "formulario">
                    <div class="form-group">
                        <label for="inputNombre">Nombre</label>
                        <input type="text" id = "nombre" name="c_nombre" class="form-control"  placeholder="Nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="inputApellidos">Apellidos</label>
                        <input type="text" id = "apellidos" name="c_apellidos" class="form-control"  placeholder="Apellidos" required>
                    </div>
                    <div class="form-group">
                        <label for="inputUsuario">Usuario</label>
                        <input type="text" id = "usuario" name="c_usuario" class="form-control"  placeholder="Usuario" required>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail">Email</label>
                        <input type="email"  id = "email" name="c_email" class="form-control"  placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword">Contraseña</label>
                        <input type="password" id = "password" name="c_password" class="form-control" placeholder="Contraseña" required>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword">Confirmar contraseña</label>
                        <input type="password" id = "password2" class="form-control" placeholder="Contraseña" required>
                    </div>
                    <button type = "submit" id = "enviar" class="btn btn-primary">Regristrar</button>
                    <button type="reset" class="btn btn-primary">Limpiar</button>
                </form>
            </div>
        </div>
    </body>
</html>