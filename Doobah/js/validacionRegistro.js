$(window).ready(function(){
				function correoValido(){
					 var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
					 var valido = regex.test($('#campoEmail').val().trim());
								
					return valido;
				}
			
				$("#campoEmail").change(function(){
					if(!correoValido($("#campoEmail").val()))
						$("#correoInvalido").show();
						
					else
						$("#correoInvalido").hide();
					
				});
				
				function comprobarContraseña(){
					 var pass1 = $("#pass1").val();
					 var pass2 = $("#pass2").val();
								
					return pass1==pass2;
				}
			
				$(".pass").change(function(){
					if(!comprobarContraseña()){
						$("#passIncorrecto").text("Las contraseñas no coinciden");
						$("#passIncorrecto").show();
					}	
					else{
						if($("#pass1").val().length < 5){
							$("#passIncorrecto").text("La contraseña debe tener al menos 5 caracteres");
							$("#passIncorrecto").show();
							
						}
						else
							$("#passIncorrecto").hide();
					}
						
				});
				
				$("#campoUser").change(function(){
					var url= "./php/usuario.php?funcion=existeUsuario&param1=nick&param2=" + $("#campoUser").val();
					var pep = $.get(url,usuarioExiste);
				});
				
				$("#campoEmail").change(function(){
					var url= "./php/usuario.php?funcion=existeUsuario&param1=email&param2=" + $("#campoEmail").val();
					var pep = $.get(url,usuarioExiste);
				});
				
				function usuarioExiste(data,status){
					if(status == "success"){
						if(data == "existe"){
							$("#usuarioExiste").show();		
						}
						else if(data == "disponible"){
							$("#usuarioExiste").hide();		
						}
					}
					
					
				}
				
				
	
});			


			