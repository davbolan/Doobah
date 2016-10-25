<?php

	session_start();
	if(isset($_SESSION["login"])){
		unset($_SESSION["login"]);
		unset($_SESSION["nick"]);
		unset($_SESSION["fecha"]);	
		unset($_SESSION["nombreCompleto"]);			
		unset($_SESSION["email"]);
		unset($_SESSION["avatar"]);
		unset($_SESSION["ciudad"]);
		unset($_SESSION["descripcion"]);
		
		if($_SESSION["tipo"] == 'anunciante'){
			unset($_SESSION["cif"]);
			unset($_SESSION["fecha_alta"]);
		}
		unset($_SESSION["tipo"]);
	}
	session_destroy();
	header("Location: ../index.php");

?>