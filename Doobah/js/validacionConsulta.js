
	$("#enviarConsulta").on("click",function(event) {
			var nombre = $(".nombreC").val();
			var email = $(".emailC").val();
			var motivo = $(".motivo_consulta").val();
			var mensaje = $(".messageC").val();
			
			
			if(nombre == ""){			
				mostrarError("Introduce un nombre.");
				$(".nombreC").focus();
				return false;
			}		
			else if(email == ""){
				mostrarError("Introduce un email de contacto");
				$(".emailC").focus();
				return false;
			}			
			else if(!correoValido(email)){
				mostrarError("El formato del email es invalido (foo@dominio.com)");
				$(".emailC").focus();
				return false;
			}
			else if(mensaje == ""){
				mostrarError("Rellene el campo con su opinión o problema");
				$(".messageC").focus();
				return false;
			}
			else{
			
				ocultarError()
				var datos = 'nombre='+ nombre + '&email=' + email + '&motivo=' + motivo + '&mensaje=' + mensaje;
				$.ajax({
					type: "POST",
					url: "./php/procesarConsulta.php",
					data: datos,
					success: function() { /* Mensaje enviado */},
					error: function()  {alert("error");/* No se pudo enviar el mensaje*/ }
				});
				$('.overlay-container').click();
			}
			
	function mostrarError(error){
		var labelError = $("#labelError");
		labelError.show();
		labelError.text(error);
	}
	
	function ocultarError(){
		var labelError = $("#labelError");
		labelError.hide();
		labelError.text("</br>");
	}
	
	function correoValido(email){
		var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
		var valido = regex.test(email);
								
		return valido;
	}
	});



/*function enviarConsulta(){
	alert("mensaje error");
			var nombre = $(".motivo_consulta").val();
			var email = $(".email").val();
			var motivo = $(".motivo_consulta").val();
			var mensaje = $(".message").val();
			
			if(mensaje == ""){
				alert("mensaje error");
				mostrarError("Cuentanos tu problema");
				$(".mensaje").focus();
				return false;
			}
			else if(!correoValido(email)){
				mostrarError("El formato del email es invalido");
				$(".email").focus();
				return false;
			}
			else if(email == ""){
				mostrarError("Introduce un email de contacto");
				$(".email").focus();
				return false;
			}
			else if(nombre == ""){
				mostrarError("Introduce tu nombre");
				$(".nombre").focus();
				return false;
			}
			else{
				ocultarError()
				var datos = 'nombre='+ nombre + '&email=' + email + '&motivo=' + motivo + '&mensaje=' + mensaje;
				$.ajax({
					type: "POST",
					url: "./php/procesarConsulta.php",
					data: datos,
					success: function() { /* Mensaje enviado /},
					error: function()  {/* No se pudo enviar el mensaje/ }
				});
				$('.overlay-container').click();
			}
			
			function mostrarError(error){
		var labelError = $("labelError");
		labelError.show();
		labelError.text(error);
	}
	
	function ocultarError(){
		var labelError = $("labelError");
		labelError.hide();
		labelError.text("");
	}
	
	function correoValido(email){
		var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
		var valido = regex.test(email);
								
		return valido;
	}
}*/