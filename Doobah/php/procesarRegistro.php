<?php
	session_start();
		
	require_once "usuario.php";
	require_once "anunciante.php";	
	require_once "redirigir.php";
	
	ifIsNotLogged();	
	
	// 1. Capturamos los datos del formulario
	$nick = limpiar_cadena($_REQUEST["usuario"]);
	$pass1 = limpiar_cadena($_REQUEST["pass1"]);
	$pass2 = limpiar_cadena($_REQUEST["pass2"]);
	$email = $_REQUEST["email"];
	$tipo = 'registrado';
	$avatar = "./img/users/default_user.jpg";
	
	if(isset($_REQUEST["anunciante"])){
		$tipo = 'anunciante';
	}
	
	// 2. Comprobamos la validez de los campos
	if( empty($nick) || empty($pass1)  || empty($pass2) || empty($email)){ //Error si hay algún campo vacio
		header("Location: ../register.php?error=1"); 
	}
	elseif(strlen($pass1) < 5){ // La contraseña deben tener una longitud minima de 5 caracteres
		header("Location: ../register.php?error=2");
	}
	elseif($pass1 != $pass2){ // Error si las contraseñas no coinciden
		header("Location: ../register.php?error=3");
	}
	elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){ //Error si el email no contiene '@' o '.'
		header("Location: ../register.php?error=4");	
	}
	
	else{
		// 3. Intentamos registrar el usuario
		$tipo = 'registrado';
		if(isset($_REQUEST["anunciante"]) && $_REQUEST["anunciante"] == 'anunciante'){
			$tipo = $_REQUEST["anunciante"];
		}
		
		$usuario = new Usuario($nick, $pass1, $email, $tipo, $avatar);
		$registrado = $usuario->registrarUsuario();
		$anunciante = null;
		
		if($registrado && $tipo == 'anunciante'){
			$anunciante = new Anunciante($nick);
			$anunciante->registrarAnunciante();
		}
		
		// 4. Si registrado es false, es porque ya existe el usuario por lo que lanzamos un mensaje de error.
		if(!$registrado){
			header("Location: ../register.php?error=5");
		}
		// 5. Si registrado es true, es que se ha creado correctamente. Creamos la sesion y redirigimos a su perfil.
		else{
			$_SESSION["login"] 			= true;
			$_SESSION["nick"] 			= $usuario->nick;
			$_SESSION["fecha_nac"] 		= "";
			$_SESSION["nombreCompleto"] = "";
			$_SESSION["tipo"] 			= $usuario->tipo;
			$_SESSION["descripcion"] 	= "";
			$_SESSION["ciudad"] 		= "";
			$_SESSION["email"] 			= $usuario->email;
			$_SESSION["avatar"] 		= $avatar;
			if($tipo == 'anunciante'){
				$_SESSION["cif"] 		= $anunciante->cif;
				$_SESSION["fecha_alta"] = $anunciante->fecha_alta;
				$_SESSION["main_page"] 	= "./inicioAnunciante.php";
			}
			elseif($tipo == 'admin'){
				$_SESSION["main_page"] 	= "./admin.php";
			}
			else{
				$_SESSION["main_page"] 	= "./inicio.php";
			}
			header("Location: ../perfil.php");
		}
	}
	
	function limpiar_cadena($cadena) {
		$cadena = trim($cadena);
		$cadena = stripslashes($cadena);
		$cadena = htmlspecialchars($cadena);
		return $cadena;
	}
?>