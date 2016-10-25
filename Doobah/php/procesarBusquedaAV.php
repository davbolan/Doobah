
<?php
	session_start();
		
	require_once "DAO_General.php";		
	require_once "redirigir.php";
	
	
	ifIsNotLogged();	

	// 1. Capturamos los datos del formulario
	$tipoBusqueda = $_REQUEST["tipoBusqueda"];
	if ($tipoBusqueda == 'nombre'){	
		$nombre = limpiar_cadena($_REQUEST["Nombre"]);
		header("Location: ../resultadosBusqueda.php?tipo_busqueda=$tipoBusqueda&nombre=$nombre");
	}
	else{
		$tipo = $_REQUEST["tipoPrivacidad"];
		$taxonomia = $_REQUEST["tema"];
		$subtaxonomia = $_REQUEST["taxonomia"];
		$cantidad = $_REQUEST["cantidad"];
		header("Location: ../resultadosBusqueda.php?tipo_busqueda=$tipoBusqueda&tipo=$tipo&cantidad=$cantidad&taxonomia=$taxonomia&subtaxonomia=$subtaxonomia");
	}	
	
	// 2. Nos vamos a la página que muestra los resultados
	//header("Location: /doobah/resultadosBusqueda.php?nombre=$nombre");
	
	function limpiar_cadena($cadena) {
		$cadena = trim($cadena);
		$cadena = stripslashes($cadena);
		$cadena = htmlspecialchars($cadena);
		return $cadena;
	}
?>