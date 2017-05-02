 $( document ).ready(function () {
    $("#enviar").on("click",function (){
        if($("#password").val() === $("#password2").val()){
						var nombre = $("#nombre").val();
						var apellidos = $("#apellidos").val();
						var usuario = $("#usuario").val();
						var email = $("#email").val();
						var password = $("#password").val();
						$.ajax({
						data: {"nombre":nombre,"apellidos":apellidos,"usuario":usuario,"email":email,"password":password},
						url: <?php echo base_url();?>"usuarios/agregar_usuario",
						type: "POST",
						success:  function (response) {
							console.log(response.respuesta);
							swal({title: "Usuario",text: "Datos actualizados correctamente",type: "success"});
						},
						error: function(response){
							console.log(response.respuesta);
						}
					});
					}else{
						swal({title: "Password",text: "Las contraseñas no coinciden",type: "warning"});
					}
    });
});