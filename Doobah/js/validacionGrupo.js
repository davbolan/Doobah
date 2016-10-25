$(window).ready(function(){
			
				$("#inNombre").change(function(){
				 var nombreAntiguo = $("#hiNombre").val();
				 var nombre = $("#inNombre").val();
			
					if(nombreAntiguo == nombre){
						$("#grupoExiste").hide();
					}	
					else {
						var url= "./php/grupo.php?funcion=existeGrupo&param1=" + $("#inNombre").val();
						var pep = $.get(url,hayGrupo);
					}
				});
				
				function hayGrupo(data,status){
					if(status == "success"){
						if(data == "existe"){
							$("#grupoExiste").show();		
						}
						else if(data == "disponible"){
							$("#grupoExiste").hide();		
						}
					}
				}
				
				
	
});			
