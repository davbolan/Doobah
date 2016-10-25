<?php

	session_start(); //localizar sesion

	require_once "grupo.php";	
		
	// 1. Capturamos los datos del formulario
	$idGrupo 	 	 = $_GET["idGrupo"];

	if(empty($idGrupo) || !is_numeric($idGrupo)){  // Error: formato incorrecto del ID. Es vacio o no es numerico.
		header("Location: ../misGrupos.php?error=12");
	}
	else{
		$grupo = new Grupo($idGrupo);
		$grupo = $grupo->obtenerGrupo("id_g", $idGrupo);
		
		if(is_null($grupo)){ // Error: No hay ningun grupo con este id.
			header("Location: ../misGrupos.php?error=13");			
		}
		else{
			$nombreOrig = limpiar_cadena($_REQUEST["nombreOrig"]);
			$nombreGrupo = limpiar_cadena($_REQUEST["nombre"]);		
			$proceder = true;
			
			if($nombreOrig != $nombreGrupo){								// Si ha cambiado el nombre.
				$grupoAux = $grupo->obtenerGrupo("nombre", $nombreGrupo);	// Buscamos un grupo con ese nombre.
				$proceder = is_null($grupoAux);								// Podemos proceder si el grupo es null
			}
			
			if(!$proceder){	// Error: Ya existe un grupo con ese nombre
				header("Location: ../misGrupos.php?error=14");	
			}
			else{
				$ciudad      = limpiar_cadena($_REQUEST["ciudad"]);
				$fotoG 	     = $grupo->foto_principal;
				$descripcion = limpiar_cadena($_REQUEST["descripcion"]);
				$tipo	 	 = 'privado';
				/*
				$taxonomia = tal;
				$subtaxonomia = cual;
				*/
				
				if(isset($_REQUEST["publico"])){
					$tipo = 'publico';
				}	
				
				if(!empty($_FILES['fotoGrupo']['name'])){
					$nameFile 		= $_FILES["fotoGrupo"]['name'];
					$typeFile 		= $_FILES["fotoGrupo"]['type'];
					$tmpArray 		= explode(".", $nameFile);
					$fileExtension  = end($tmpArray);
					$sizeFile 		= $_FILES["fotoGrupo"]['size'];
					$tmpFile  		= $_FILES["fotoGrupo"]["tmp_name"];
					
				
					// Extension de archivo no admitido
					if (($typeFile != "image/jpeg") && ($typeFile != "image/png") && ($typeFile != "image/gif"))
						header("Location: ../infoGrupo.php?idGrupo=$id_Grupo&error=2");
						// El archivo es demasiado grande (Más de 5 MB).
					if($sizeFile > 5242880){
						header("Location: ../infoGrupo.php?idGrupo=$id_Grupo&error=3");
					}
					
					// Nombre de la nueva imagen
					do{
						$newName = generateRandomString().'.'.$fileExtension;
					}while(file_exists("./img/groups/".$newName));
						
					// Borrar la antigua imagen de usuario
					if(file_exists($fotoG))
						unlink($fotoG);
							
					$fotoG = "./img/groups/$newName";
					rename("$tmpFile", ".".$fotoG);
				}	
				
				$grupo->nombre =$nombreGrupo;
				$grupo->ciudad = $ciudad;
				/*
					$grupos->taxonomia = $taxonomia;
					$grupos->subtaxonomia = $subtaxonomia;
				*/
				$grupo->privado = $tipo;
				$grupo->foto_principal 	= $fotoG;
				$grupo->descripcion = $descripcion;
				
				$grupo->actualizarGrupo();
				
				header("Location: ../infoGrupo.php?idGrupo=$id_Grupo&=exito=1");
				/*
					Cuando haya una unica vista de info grupo, será;
					header("Location: ./infoGrupo.php?idGrupo=$id_Grupo");
				*/
			}
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
?>