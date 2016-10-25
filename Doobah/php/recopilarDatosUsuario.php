<?php

	//session_start(); //localizar sesion
	
	require_once "grupo.php";	// Grupo ya tiene incluido usuario
	require_once "usuario.php";
		
	// 1. Capturamos los datos del formulario
	$nickU = $_GET["nick"];
	if(!empty($nickU) /*&& limpiar_cadena($user)*/){
		
		if($nickU == $_SESSION["nick"]){
			header("Location: perfil.php");
		}
		else{	
			$user = new Usuario($nickU);		
			$user = $user->obtenerUsuario("nick");

			if(!is_null($user)){
				$nombreU 	= $user->nombreCompleto;
				$ciudadU      	= $user->ciudad;		
				$tipoU  			= $user->tipo;
				$descripcionU 	= $user->descripcion;
				$avatarU 	 	= $user->avatar;	
				
				if($tipoU == 'anunciante'){
					$anunciante = new Anunciante($nickU);		
					$anunciante = $anunciante->obtenerAnunciante("nick");
					$cifA 		= $anunciante->cif;
					$creacion  =  $anunciante->fecha_alta;

				}
				else{
					$edad			= calcularEdad($user->fecha_nac);
					$listaGrupos 	= Grupo::obtenerGrupos($nickU);
					$numGrupos 		= count($listaGrupos);
				}
			}		
			else{
				header("Location: ".$_SESSION['main_page']."?error=9");
			}	
		}
	}
	else 
		header("Location: ".$_SESSION['main_page']."?error=10");
	
		function calcularEdad($fecha){
			list($y, $m, $d) = explode("-", $fecha);
			$y_dif = date("Y") - $y;
			$m_dif = date("m") - $m;
			$d_dif = date("d") - $d;
			if ((($d_dif < 0) && ($m_dif == 0)) || ($m_dif < 0))
				$y_dif--;
			return $y_dif;
		}
		

	
?>