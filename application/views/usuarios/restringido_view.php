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
                swal({
		    			title: "Acceso restringido!",
		    			text: "Esta pagina es exclusiva para usuarios registrados",
		    			type: "warning",
		    			showCancelButton:true,
		    			confirmButtonColor: "#DD6B55",
		    			confirmButtonText: "Registrarse",
		    			cancelButtonText: "Salir",
		    			closeOnConfirm: false,
		    			closeOnCancel: false},
		    			function(isConfirm){
		    				if(isConfirm){
		    					swal({title: "Redireccionando",text: "registro de usuarios",type: "success"},function(){
		    							window.location.href = "<?php echo site_url('usuarios/form_usuario');?>";		  	
		    						  });	
		    				}else{
		    					window.location.href = "<?php echo site_url('usuarios/vista_login');?>";
		    				}
		    			});

             });
        </script>
    </head>
    <!-- Inicia barra de navegacion (barra de menu principal del admin)-->
  
    <body>
          <nav class = "navbar navbar-nav" role = "navigation">
            <div class = "container-fluid">
                <div class = "navbar-header">
                    <a class = "navbar-brand">Acceso restringido</a>
                </div>
                <ul class = "nav navbar-nav">
                </ul>
                <ul class = "nav navbar-nav navbar-right">
                    <li><a href="#">Enlace #3</a></li>
                </ul>
            </div>
        </nav>
    </body>
</html>