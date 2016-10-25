<?php
	session_start(); //localizar sesion

	require_once "actividad.php";	
		
	// 1. Capturamos los datos del formulario
	$nombreActividad = limpiar_cadena($_REQUEST["nombre"]);
	$fecha	 	 	 = limpiar_cadena($_REQUEST["fecha"]);
	$hora	 	 	 = limpiar_cadena($_REQUEST["hora"]);
	$lugar	 	 	 = limpiar_cadena($_REQUEST["ciudad"]);
	$idGrupo 	     = $_REQUEST["idGrupo"];
	$tema 	    	 = $_REQUEST["tema"];
	$taxonomia	 	 = $_REQUEST["taxonomia"];
	$foto  	         = "./img/activities/default_activity.jpg";
	$descripcion 	 = limpiar_cadena($_REQUEST["descripcion"]);
	
	if( empty($nombreActividad) || empty($fecha) || empty($hora) || empty($lugar)|| empty($taxonomia) || empty($tema) ||  empty($descripcion)){ //Error si hay algún campo vacio
		header("Location: ../crearActividad.php?error=1"); 
	}
	
	else{
	
	
		if(!empty($_FILES['fotoActividad']['name'])){
			$nameFile 		= $_FILES["fotoActividad"]['name'];
			$typeFile 		= $_FILES["fotoActividad"]['type'];
			$tmpArray 		= explode(".", $nameFile);
			$fileExtension  = end($tmpArray);
			$sizeFile 		= $_FILES["fotoActividad"]['size'];
			$tmpFile  		= $_FILES["fotoActividad"]["tmp_name"];
			
			// Extension de archivo no admitido
			if (($typeFile != "image/jpeg") && ($typeFile != "image/png") && ($typeFile != "image/gif"))
				header("Location: ../misActividades.php?error=6");

			// El archivo es demasiado grande.
			if($sizeFile > 2048000){
				header("Location: ../misActividades.php?error=7");
			}
			
			do{
				$newName = generateRandomString(20).'.'.$fileExtension;
			}while(file_exists("./img/activities/".$newName));
			
			
			
			$foto = "./img/activities/$newName";
			rename("$tmpFile", ".".$foto);
		}	
		
		$fecha2 = new DateTime($fecha);
		$fecha2->setTime(time_to_min($hora),time_to_sec($hora),time_to_hours($hora));
		$result = $fecha2->format('Y-m-d H:i:s');
		//echo $fecha2->format('U = Y-m-d H:i:s') . "\n";
		
		
		$actividad = new Actividad( $nombreActividad ,$result, $lugar, $tema, $taxonomia, $foto, $descripcion,$idGrupo);
		$actividad = $actividad->crearActividad($_SESSION["nick"]);
		header("Location: ../misActividades.php");
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