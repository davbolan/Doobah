<?php

	require_once ("./php/actividad.php");
		
	// 1. Capturamos los datos del formulario
	$idActividad 	 	 = $_REQUEST["idActividad"];

	if(!empty($idActividad) && is_numeric($idActividad)){		
		$actividad = new Actividad($idActividad);	
		$actividad = $actividad->obtenerActividad("id_a", $idActividad);

		if(!is_null($actividad)){
			$nombreAct			= $actividad->nombre;
			$fecha_actividad	= $actividad->fecha_actividad;
			list($fecha, $hora) = explode (' ' ,$fecha_actividad);
			$lugar				= $actividad->lugar;
			$foto_Actividad		= $actividad->foto_principal;
			$descripcion		= $actividad->descripcion;
			$id_g				= $actividad->id_g;
			$nickCrear			= $actividad->nickCrear;
		}
		else{
			header("Location: ".$_SESSION['main_page']."?error=11");
		}
	}
	else 
			header("Location: ".$_SESSION['main_page']."?error=11");
		
	
?>