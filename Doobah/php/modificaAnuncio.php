<?php

	session_start(); //localizar sesion

	require_once "anuncio.php";	
		
	// 1. Capturamos los datos del formulario
	 $idAnuncio 	 	 = $_GET["idAnuncio"];

	if(empty($idAnuncio) || !is_numeric($idAnuncio)){  // Error: formato incorrecto del ID. Es vacio o no es numerico.
		header("Location: ../inicioAnunciante.php?error=30");
	}
	else{
		$anuncio = new Anuncio($idAnuncio);
		$anuncio = $anuncio->obtenerAnuncio("id_an", $idAnuncio);
		
		if(is_null($anuncio)){ // Error: No hay ningun anuncio con este id.
			header("Location: ../inicioAnunciante.php?error=31");			
		}
		else{
				$nombreAn    = limpiar_cadena($_REQUEST["nombre"]);
				$fecha 		 = limpiar_cadena($_REQUEST["fecha"]);
				$hora		 = limpiar_cadena($_REQUEST["hora"]);
				$ciudad      = limpiar_cadena($_REQUEST["ciudad"]);
				
				$fotoAnun 	   = $anuncio->foto_principal;
				$descripcion = limpiar_cadena($_REQUEST["descripcion"]);			
				
				if(!empty($_FILES['fotoAnun']['name'])){
					$nameFile 		= $_FILES["fotoAnun"]['name'];
					$typeFile 		= $_FILES["fotoAnun"]['type'];
					$tmpArray 		= explode(".", $nameFile);
					$fileExtension  = end($tmpArray);
					$sizeFile 		= $_FILES["fotoAnun"]['size'];
					$tmpFile  		= $_FILES["fotoAnun"]["tmp_name"];
					
				
					// Extension de archivo no admitido
					if (($typeFile != "image/jpeg") && ($typeFile != "image/png") && ($typeFile != "image/gif"))
						header("Location: ../anuncio.php?idAnuncio=$idAnuncio&error=2");
						// El archivo es demasiado grande (Más de 5 MB).
					if($sizeFile > 5242880){
						header("Location: ../anuncio.php?idAnuncio=$idAnuncio&error=3");
					}
					
					// Nombre de la nueva imagen
					do{
						$newName = generateRandomString().'.'.$fileExtension;
					}while(file_exists("./img/announcement/".$newName));
						
					// Borrar la antigua imagen de usuario
					if(file_exists($fotoAnun))
						unlink($fotoAnun);
							
					$fotoAnun = "./img/announcement/$newName";
					rename("$tmpFile", ".".$fotoAnun);
				}	
				
				$anuncio->nombre =$nombreAn;
				
				$fecha2 = new DateTime($fecha);
				$fecha2->setTime(time_to_min($hora),time_to_sec($hora),time_to_hours($hora));
				$result = $fecha2->format('Y-m-d H:i:s');
				
				$anuncio->fecha_evento = $result;
				$anuncio->ciudad = $ciudad;
				/*
					$grupos->taxonomia = $taxonomia;
					$grupos->subtaxonomia = $subtaxonomia;
				*/
				$anuncio->foto_principal 	= $fotoAnun;
				$anuncio->descripcion = $descripcion;
				
				$anuncio->actualizarAnuncio();
				
				header("Location: ../inicioAnunciante.php");
			
		}
}
		
		
	function limpiar_cadena($cadena) {
		$cadena = trim($cadena);
		$cadena = stripslashes($cadena);
		$cadena = htmlspecialchars($cadena);
		return $cadena;
	}
	
	function generateRandomString($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
		return $randomString;
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