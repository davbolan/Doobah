$(window).ready(function(){	
	
	$('#file_url').change(function(){
		 mostrarImagen(this);
		});
	
	function mostrarImagen(input) {
		 if (input.files && input.files[0]) {
		  var reader = new FileReader();
		  reader.onload = function (e) {
		   $('#fotoImg').attr('src', e.target.result);
		  }
		  reader.readAsDataURL(input.files[0]);
		 }
		}
		 
		
		
});		