<?php

	session_start(); //localizar sesion

	require_once "actividad.php";	
		
	// 1. Capturamos los datos del formulario
	 $idActividad 	 	 = $_GET["idActividad"];

	if(empty($idActividad) || !is_numeric($idActividad)){  // Error: formato incorrecto del ID. Es vacio o no es numerico.
		header("Location: ../misActividades.php?error=20");
	}
	else{
		$actividad = new Actividad($idActividad);
		$actividad = $actividad->obtenerActividad("id_a", $idActividad);
		
		if(is_null($actividad)){ // Error: No hay ningun grupo con este id.
			header("Location: ../misActividades.php?error=21");			
		}
		else{
				$nombreAct   = limpiar_cadena($_REQUEST["nombre"]);
				$fecha 		 = limpiar_cadena($_REQUEST["fecha"]);
				$hora		 = limpiar_cadena($_REQUEST["hora"]);
				$ciudad      = limpiar_cadena($_REQUEST["ciudad"]);
				
				$fotoA 	     = $actividad->foto_principal;
				$descripcion = limpiar_cadena($_REQUEST["descripcion"]);			
				
				if(!empty($_FILES['fotoActividad']['name'])){
					$nameFile 		= $_FILES["fotoActividad"]['name'];
					$typeFile 		= $_FILES["fotoActividad"]['type'];
					$tmpArray 		= explode(".", $nameFile);
					$fileExtension  = end($tmpArray);
					$sizeFile 		= $_FILES["fotoActividad"]['size'];
					$tmpFile  		= $_FILES["fotoActividad"]["tmp_name"];
					
				
					// Extension de archivo no admitido
					if (($typeFile != "image/jpeg") && ($typeFile != "image/png") && ($typeFile != "image/gif"))
						header("Location: ../infoActividad.php?idActividad=$idActividad&error=2");
						// El archivo es demasiado grande (Más de 5 MB).
					if($sizeFile > 5242880){
						header("Location: ../infoActividad.php?idActividad=$idActividad&error=3");
					}
					
					// Nombre de la nueva imagen
					do{
						$newName = generateRandomString().'.'.$fileExtension;
					}while(file_exists("./img/activities/".$newName));
						
					// Borrar la antigua imagen de usuario
					if(file_exists($fotoA))
						unlink($fotoA);
							
					$fotoA = "./img/activities/$newName";
					rename("$tmpFile", ".".$fotoA);
				}	
				
				$actividad->nombre =$nombreAct;
				
				$fecha2 = new DateTime($fecha);
				$fecha2->setTime(time_to_min($hora),time_to_sec($hora),time_to_hours($hora));
				$result = $fecha2->format('Y-m-d H:i:s');
				$actividad->fecha_actividad = $result;
				$actividad->ciudad = $ciudad;
				/*
					$grupos->taxonomia = $taxonomia;
					$grupos->subtaxonomia = $subtaxonomia;
				*/
				$actividad->foto_principal 	= $fotoA;
				$actividad->descripcion = $descripcion;
				
				$actividad->actualizarActividad();
				
				header("Location: ../misActividades.php?exito=1");
				/*
					Cuando haya una unica vista de info grupo, será;
					header("Location: ./infoGrupo.php?idGrupo=$id_Grupo");
				*/
			}
		}
		
		
	public static function limpiar_cadena($cadena) {
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
?>