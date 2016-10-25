
<?php
	session_start();
		
	require_once "DAO_General.php";		
	require_once "redirigir.php";
	
	
	ifIsNotLogged();	

	// 1. Capturamos los datos del formulario
	$search = $_REQUEST["search"];
	
	// 2. Nos vamos a la página que muestra los resultados
	
	header("Location: ../resultadosBusquedaSimple.php?search=$search");
	
	function limpiar_cadena($cadena) {
		$cadena = trim($cadena);
		$cadena = stripslashes($cadena);
		$cadena = htmlspecialchars($cadena);
		return $cadena;
	}
?>