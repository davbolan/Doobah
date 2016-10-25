<?php
	session_start();
	require "grupo.php";
	
	$idGrupo = $_REQUEST["idGrupo"];
	$nick 	 = $_SESSION["nick"];
	$tipo 	 = $_SESSION["tipo"];
	$pagina  = ("tipo" == "admin") ? $_SESSION["main_page"] : "../misGrupos.php";

	if(empty($idGrupo)){	
		header("Location: ".$pagina."?error=100");
	}
	else{
		$grupo = new Grupo($idGrupo);
		$grupo = $grupo->obtenerGrupo("id_g", $idGrupo);

		if(is_null($grupo)){
			header("Location: ".$pagina."?error=101");
		}
		else{
			// Si es administrador de la pagina o al menos es administrador del grupo...
			if(($tipo == "admin") || $grupo->esAdminDelGrupo($nick)){ // Filtro por si alguien intenta eliminra un grupo dese la URL.
				$grupo->eliminarElGrupo();
				header("Location: ".$pagina."?exito=300");
			}
			else{
				header("Location: ".$pagina."?error=101"); // No tienes permisos suficientes para eliminar el grupo
			}
		}
	}
?>