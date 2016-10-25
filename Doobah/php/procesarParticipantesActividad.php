<?php
	session_start(); //localizar sesion
	require_once "actividad.php";	
		
	// 1. Capturamos los datos del formulario
	$tipoOp = $_REQUEST["tipoOp"];
	$idActividad = $_REQUEST["idActividad"];
	
	// 2. Comprobamos la validez de los campos
	if(empty($idActividad) || empty($tipoOp)){ //Error si hay algún campo vacio
		header("Location: ../index.php?error=1"); 
	}
	else{
		if ($tipoOp == "insertar"){
			Actividad:: unirseActividad($idActividad,$_SESSION["nick"],0);
		}
		else if ($tipoOp == "abandonar"){
			Actividad:: abandonarActividad($idActividad,$_SESSION["nick"]);
		}
		header("Location: ../misActividades.php"); 

	}
	
?>

