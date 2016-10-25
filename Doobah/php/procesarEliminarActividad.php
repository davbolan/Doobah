<?php
	session_start();
	require "actividad.php";
	
	$idActividad = $_REQUEST["idActividad"];
	$nick 		 = $_SESSION["nick"];
	$tipo 		 = $_SESSION["tipo"];
	$pagina 	 = ("tipo" == "admin") ? $_SESSION["main_page"] : "../misActividades.php";

	if(empty($idActividad)){	
		header("Location: ".$pagina."?error=500");			// Esta actividad no existe y no se pudo eliminar 
	}
	else{
		$actividad = new Actividad($idActividad);
		$actividad = $actividad->obtenerActividad("id_a", $idActividad);
		
		if(is_null($actividad)){
			header("Location: ".$pagina."?error=100");		// Esta actividad no existe y no se pudo eliminar
		}
		else{
			// Si es administrador de la pagina o al menos es administrador de la actividad...
			if(($tipo == "admin") || $actividad->esAdminDeLaActividad($nick)){ // Filtro por si alguien intenta eliminra una actividad dese la URL.
				$actividad->eliminarLaActividad();
				header("Location: ".$pagina."?exito=400");
			}
			else{
				header("Location: ".$pagina."?error=201"); // No tienes permisos suficientes para eliminar la actividad
			}
		}
	}
?>