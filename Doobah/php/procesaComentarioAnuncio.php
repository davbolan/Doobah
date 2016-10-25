<?php
	session_start(); //localizar sesion

	require_once "comentario.php";
	require_once "anunciante.php";		
		
	// 1. Capturamos los datos del formulario

	$comment		= limpiar_cadena($_REQUEST["comment"]);
	$idAnuncio	= limpiar_cadena($_REQUEST['idAnuncio']);


	
	
	if( empty($comment) ||empty($idAnuncio) ){ //Error si hay algún campo vacio

	}
	
	else{

		Comentario::crearComentarioAnuncio($idAnuncio,$_SESSION["nick"],$comment);
		header("Location: ../anuncio_v.php?idAnuncio=".$idAnuncio."");
	}
	
	
	function limpiar_cadena($cadena) {
		$cadena = trim($cadena);
		$cadena = stripslashes($cadena);
		$cadena = htmlspecialchars($cadena);
		return $cadena;
	}

		function time_to_hours($time) { 
		$hours = substr($time, 0, -6); 
		$minutes = substr($time, -5, 2); 
		$seconds = substr($time, -2); 

		return $hours; 
	}
		function time_to_min($time) { 
		$hours = substr($time, 0, -6); 
		$minutes = substr($time, -5, 2); 
		$seconds = substr($time, -2); 

		return $minutes; 
	}
		function time_to_sec($time) { 
		$hours = substr($time, 0, -6); 
		$minutes = substr($time, -5, 2); 
		$seconds = substr($time, -2); 

		return $seconds; 
	}
?>