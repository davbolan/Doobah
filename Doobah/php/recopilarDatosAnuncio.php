<?php

	require_once ("./php/anuncio.php");
		
	// 1. Capturamos los datos del formulario
	$idAnuncio	 	 = $_REQUEST["idAnuncio"];

	if(!empty($idAnuncio) && is_numeric($idAnuncio)){		
		$anuncio = new Anuncio($idAnuncio);	
		$anuncio = $anuncio->obtenerAnuncio("id_an", $idAnuncio);

		if(!is_null($anuncio)){
			$nombreAn			= $anuncio->nombre;
			$fecha_evento	    = $anuncio->fecha_evento;
			list($fecha, $hora) = explode (' ' ,$fecha_evento);
			$lugar				= $anuncio->lugar;
			$foto_Anuncio		= $anuncio->foto_principal;
			$descripcion		= $anuncio->descripcion;
			$nickCrear			= $anuncio->nickCrear;
		}
		else{
			header("Location: ".$_SESSION['main_page']."?error=14");
		}
	}
	else 
			header("Location: ".$_SESSION['main_page']."?error=15");
		
	
?>