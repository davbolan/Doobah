<?php
	session_start(); //localizar sesion

	require_once "grupo.php";	
		
	// 1. Capturamos los datos del formulario
	$nombreGrupo  	 = limpiar_cadena($_REQUEST["inNombre"]);
	$ciudad 	 	 = limpiar_cadena($_REQUEST["ciudad"]);
	$tema 	    	 = $_REQUEST["tema"];
	$taxonomia	 	 = $_REQUEST["taxonomia"];
	$foto  	         = "./img/groups/default_group";
	$descripcion 	 = limpiar_cadena($_REQUEST["descripcion"]);
	$tipo	 	 	 = 'privado';

	if(isset($_REQUEST["publico"])){
		$tipo = 'publico';
	}
	
	if( empty($nombreGrupo) || empty($ciudad) || empty($tema) || empty($taxonomia) || empty($descripcion)){ //Error si hay algún campo vacio
		header("Location: ../creargrupo.php?error=1"); 
	}
	
	else{
	
	
		if(!empty($_FILES['fotoGrupo']['name'])){
			$nameFile 		= $_FILES["fotoGrupo"]['name'];
			$typeFile 		= $_FILES["fotoGrupo"]['type'];
			$tmpArray 		= explode(".", $nameFile);
			$fileExtension  = end($tmpArray);
			$sizeFile 		= $_FILES["fotoGrupo"]['size'];
			$tmpFile  		= $_FILES["fotoGrupo"]["tmp_name"];
			
			// Extension de archivo no admitido
			if (($typeFile != "image/jpeg") && ($typeFile != "image/png") && ($typeFile != "image/gif")){
				header("Location: ../crearGrupo.php?error=6");
			}
			
			// El archivo es demasiado grande.
			if ($sizeFile > 2048000){
				header("Location: ../crearGrupo.php?error=7");
			}
			
			do{
				$newName = generateRandomString(20).'.'.$fileExtension;
			}while(file_exists("./img/groups/".$newName));
			
			$foto = "./img/groups/$newName";
			rename("$tmpFile", ".".$foto);
		}	

		$grupo = new Grupo($nombreGrupo, $ciudad, $tipo, $tema, $taxonomia, $foto, $descripcion);
		$creado = $grupo = $grupo->crearGrupo($_SESSION["nick"]);
		if(!$creado){
			header("Location: ../creargrupo.php?error=2"); 
		}
		
		header("Location: ../misGrupos.php");
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