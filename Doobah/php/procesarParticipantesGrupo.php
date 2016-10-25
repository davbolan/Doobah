<?php
	session_start(); //localizar sesion
	require_once "grupo.php";	
		
	// 1. Capturamos los datos del formulario
	$tipoOp = $_REQUEST["tipoOp"];
	$idGrupo = $_REQUEST["idGrupo"];
	
	// 2. Comprobamos la validez de los campos
	if(empty($idGrupo) || empty($tipoOp)){ //Error si hay algún campo vacio
		header("Location: ../index.php?error=1"); 
	}
	else{
		if ($tipoOp == "insertar"){
			Grupo:: unirseGrupo($idGrupo,$_SESSION["nick"],0);
		}
		else if ($tipoOp == "abandonar"){
			Grupo:: abandonarGrupo($idGrupo,$_SESSION["nick"]);
		}
		header("Location: ../misGrupos.php"); 

	}
	
?>

