<?php

	require_once "grupo.php";	
		
	// 1. Capturamos los datos del formulario
	$idGrupo 	 	 = $_REQUEST["idGrupo"];

	if(!empty($idGrupo) && is_numeric($idGrupo)){
		
		$grupo = new Grupo($idGrupo);		
		$grupo = $grupo->obtenerGrupo("id_g", $idGrupo);

		if(!is_null($grupo)){
			$nombreGrupo = $grupo->nombre;
			$ciudad      = $grupo->ciudad;
			$tipo  		 = $grupo->privado;
			$fotoGrupo 	 = $grupo->foto_principal;
			$descripcion = $grupo->descripcion;
		}
		else{
			header("Location: ".$_SESSION['main_page']."?error=11");
		}
	}
	else 
			header("Location: ".$_SESSION['main_page']."?error=11");
		
	
?>