<?php
	session_start(); //localizar sesion

	require_once "usuario.php";	
		
	// 1. Capturamos los datos del formulario
	$nick = limpiar_cadena($_REQUEST["usuario"]);
	$pass = limpiar_cadena($_REQUEST["pass"]);

	// 2. Comprobamos la validez de los campos
	if(empty($nick) || empty($pass)){ //Error si hay algún campo vacio
		header("Location: ../index.php?error=1"); 
	}
	else{
		// 3. Intentamos loguear el usuario
		$usuario = new Usuario($nick, $pass);
		$usuario = $usuario->loginUsuario();
		
		// 4. Si recibimos un usuario nulo, es porque no existe por lo que lanzamos mensaje de error
		if(is_null($usuario)){
			header("Location: ../index.php?error=2");
		}
		// 5. Si recibimos el usuario, es que se ha logueado correctamente. Creamos la sesion y las cookies si son necesaras y redirigimos al inicio correspondiente.
		else{
			crearSesion($usuario);
			header("Location: .".$_SESSION["main_page"]);
		}
	}
	
	function crearSesion($usuario){
		$_SESSION["login"] 			= true;
		$_SESSION["nick"] 			= $usuario->nick;
		$_SESSION["fecha_nac"] 		= $usuario->fecha_nac;
		$_SESSION["nombreCompleto"] = $usuario->nombreCompleto;
		$_SESSION["tipo"] 			= $usuario->tipo;
		$_SESSION["descripcion"] 	= $usuario->descripcion;
		$_SESSION["ciudad"] 		= $usuario->ciudad;
		$_SESSION["email"] 			= $usuario->email;
		$_SESSION["avatar"] 		= $usuario->avatar;
		
		
		if($usuario->tipo == 'anunciante'){
			$anunciante = new Anunciante($usuario->nick);
			$anunciante = $anunciante->loginAnunciante();
			$_SESSION["cif"] = $anunciante->cif;
			$_SESSION["fecha_alta"] = $anunciante->fecha_alta;	
			$_SESSION["main_page"] 	= "./inicioAnunciante.php";
		}
		elseif($usuario->tipo == 'admin'){
			$_SESSION["main_page"] 	= "./admin.php";
		}
		else{
			$_SESSION["main_page"] 	= "./inicio.php";
		}
	}
	
	function limpiar_cadena($cadena) {
		$cadena = trim($cadena);
		$cadena = stripslashes($cadena);
		$cadena = htmlspecialchars($cadena);
		return $cadena;
	}
	
?>

