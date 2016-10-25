$(document).ready(function() {
	
	$("#contacto").on("click",function(event) {
			$("#popC").show();
			$("#overlay").addClass('overlay-container');
			$("#popC").load('contacto.php');
			$("head").append($("<link href='style/pop-up.css' rel='stylesheet' type='text/css' />"))
			$.getScript("./js/validacionConsulta.js");
	});
	
	$("#nosotros").on("click",function(event) {
			$("#popC").show();
			$("#overlay").addClass('overlay-container');
			$("#popC").load('nosotros.php');
			$("head").append($("<link href='style/pop-up.css' rel='stylesheet' type='text/css' />"))
	});
	$("#policy").on("click",function(event) {
			$("#popC").show();
			$("#overlay").addClass('overlay-container');
			$("#popC").load('policy.php');
			$("head").append($("<link href='style/pop-up.css' rel='stylesheet' type='text/css' />"))
	});
	
	$("#avanzada").on("click",function(event) {
			$("#popC").show();
			$("#overlay").addClass('overlay-container');
			$("#popC").load('busquedaAvanzada.php');
			$("head").append($("<link href='style/pop-up.css' rel='stylesheet' type='text/css' />"))
	});
	
	$('.overlay-container').on("click",function(event) {
			$("#popC").hide();
			$("#overlay").removeClass('overlay-container');
	});
	
});