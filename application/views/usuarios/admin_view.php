<!DOCTYPE html>
<html lang = "es">
    <head>
        <meta name = "author" content = "Jose Manuel Gomez Alavez">
        <meta content = "Pagina web de noticias usando bootstrap,jquery, codeigniter" name = "description" />
        <meta content = "jquery,boostrap 3.0, codeigniter,ajax" name = "keywords"/>
        <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/css/sweetalert.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/css/font-awesome/4.5.0/css/font-awesome.min.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/css/estilo_admin.css');?>">
        <script type = "text/javascript" src = "<?php echo base_url();?>assets/js/sweetalert.min.js"></script>
        <script type = "text/javascript" src = "<?php echo base_url();?>assets/js/jquery.js"></script>
        <script type = "text/javascript" src = "<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
        <script type = "text/javascript">
             $( document ).ready(function () {
                 var dir =  "<?php echo site_url()?>";
                $("#usuario").on("click",function(e){
                    window.location.href = dir+"/usuarios/tabla_usuario_admin";
                });
                $("#principal").on("click",function(e){
                    window.location.href = dir+"/usuarios/cont_principal_admin";
                });

                $(".eliminar").on("click",function(e){
                    id_usuario = $(this).attr('id');
                    swal({
		    			title: "Esta seguro que desea eliminar a este usuario?!",
		    			text: "Una vez efectuado esta accion no será posible revertirla",
		    			type: "warning",
		    			showCancelButton:true,
		    			confirmButtonColor: "#DD6B55",
		    			confirmButtonText: "Eliminar",
		    			cancelButtonText: "Cancelar",
		    			closeOnConfirm: false,
		    			closeOnCancel: false},
		    			function(isConfirm){
		    				if(isConfirm){
                                $.ajax({
                                        data: {"id_usuario":id_usuario},
                                        url: dir+"/usuarios/eliminar_usuario",
                                        type: "POST",
                                        success:  function (response) {
                                            window.location.href = dir+"/usuarios/tabla_usuario_admin";
                                        },
                                        error: function(response){
                                            swal({title: "Usuario",text: "Ha ocurrido un error con el servidor, por favor contacte con el administrador",type: "error"});
                                            console.log(response);
                                        }
                                    });
		    				}else{  }
		    			});
                }); 
            });
        </script>
    </head>
    <!-- Inicia barra de navegacion (barra de menu principal del admin)-->
  
    <body>
          <nav class = "navbar  barra-menu navbar-fixed-top" role = "navigation">
            <div class = "container-fluid">
                <div class = "navbar-header">
                    <a class = "navbar-brand">Panel de administrador</a>
                </div>
                <ul class = "nav navbar-nav">
                </ul>
                <ul class = "nav navbar-nav navbar-right">
                    <li><a href="#">Enlace #3</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <?php echo $this->session->userdata('nombre');?> <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                        <li><a href="#">Perfil</a></li>
                        <li><a href="<?php echo site_url('usuarios/cerrar_sesion');?>">Cerrar sesion</a></li>
                        </ul>
                    </li>
                </ul>
                <form class="navbar-form navbar-right">
                    <input type="text" class="form-control" placeholder="Buscar">
                </form>
            </div>
        </nav>
        <div class = "container-fluid">
            <div class = "row">
                <divc class = "col-sm-3 col-md-2 sidebar">
                    <ul class = "nav nav-sidebar">
                        <li class = "active"><a href="#">Opciones<span class="sr-only">(current)</span></a></li>
                        <li id = "principal"><a href="#">Principal</a></li> 
                        <li id = "usuario"><a href="#">Usuarios</a></li> 
                        <li><a href="#">Administrador</a></li>
                        <li><a href="#">Mensajes</a></li>
                        <li><a href="#">Perfil</a></li>
                        <li><a href="#">Alertas</a></li>
                    </ul>
                </div>
                <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                    <h1 class="page-header">Panel de administrador</h1>
                    <?=$vista?>
                </div>
            </div>
        </div>
    </body>
</html>