<?php

	session_start(); //localizar sesion

	require_once "usuario.php";	
		
	// 1. Capturamos los datos del formulario
	$nick 	 	 = $_SESSION["nick"];
	$avatar  	 = $_SESSION["avatar"];
	$tipo 		 = $_SESSION["tipo"];
	$nombre  	 = limpiar_cadena($_REQUEST["nombre"]);
	$fecha 		 = (!empty($_REQUEST["fecha"])) ? limpiar_cadena($_REQUEST["fecha"]) : "" ;
	$passAnt 	 = limpiar_cadena($_REQUEST["passAnt"]);
	$passN	 	 = limpiar_cadena($_REQUEST["nueva_pass"]);
	$passN2	 	 = limpiar_cadena($_REQUEST["nueva_pass2"]);
	$ciudad  	 = limpiar_cadena($_REQUEST["ciudad"]);
	$descripcion = limpiar_cadena($_REQUEST["message"]);;

	$usuario = new Usuario($_SESSION["nick"]);
	$usuario = $usuario->obtenerUsuario("nick");
	
	if((!empty($passN) || !empty($passN2)) && empty($passAnt)){ // introduzca su antigua contraseña si quiere una nueva contraseña
		header("Location: ../perfil.php?error=1");
	}
	elseif(!empty($passAnt) && (empty($passN) || empty($passN2))){ // Contraseña nueva no introducida
		header("Location: ../perfil.php?error=2");
	}
	elseif(!empty($passAnt) && !empty($passN) && !empty($passN2)){ // Posible caso correcto
		$tmpPass = $usuario->encriptarPass($passAnt , $usuario->salt);
		if($passN != $passN2){
			header("Location: ../perfil.php?error=3");
		}
		elseif( strlen($passN) < 5){ // Contraseña muy corta
			header("Location: ../perfil.php?error=4");
		}
		elseif($tmpPass != $usuario->password) 
			header("Location: ../perfil.php?error=5");
		
		$passN = $tmpPass; 
	}
	

	
	if(!empty($_FILES['fotoU']['name'])){
		$nameFile 		= $_FILES["fotoU"]['name'];
		$typeFile 		= $_FILES["fotoU"]['type'];
		$tmpArray 		= explode(".", $nameFile);
		$fileExtension  = end($tmpArray);
		$sizeFile 		= $_FILES["fotoU"]['size'];
		$tmpFile  		= $_FILES["fotoU"]["tmp_name"];
		
	
		// Extension de archivo no admitido
		if (($typeFile != "image/jpeg") && ($typeFile != "image/png") && ($typeFile != "image/gif"))
			header("Location: ../perfil.php?error=6");

		// El archivo es demasiado grande (Más de 5 MB).
		if($sizeFile > 5242880){
			header("Location: ../perfil.php?error=7");
		}
		
		// Nombre de la nueva imagen
		$newName = $_SESSION["nick"].'.'.$fileExtension;;
			
		// Borrar la antigua imagen de usuario
		if(file_exists ($avatar)){
			unlink($avatar);
		}
		$avatar = "./img/users/$newName";
		rename("$tmpFile", ".".$avatar);
		
		$_SESSION['avatar'] = $avatar;
	}	
	
	$usuario->nombreCompleto 	  = $nombre;
	$usuario->fecha_nac   = $fecha;
	if(!empty($passN))
		$usuario->password = $passN;
	$usuario->ciudad 	  = $ciudad;
	$usuario->descripcion = $descripcion;
	$usuario->avatar 	  = $avatar;
	
	$usuario->actualizarPerfil();
	
	if($tipo == 'anunciante'){
		$anunciante = new Anunciante($nick);
		$anunciante->cif = limpiar_cadena($_REQUEST["cif"]);
		$anunciante->modificarAnunciante();
	}
	header("Location: .".$_SESSION['main_page']);
	
	function limpiar_cadena($cadena) {
		$cadena = trim($cadena);
		$cadena = stripslashes($cadena);
		$cadena = htmlspecialchars($cadena);
		return $cadena;
	}
?>