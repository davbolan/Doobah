<?php

	session_start(); //localizar sesion

	require_once ("php/actividad.php");
	require_once ("php/DAO_General.php");	
		
	// 1. Capturamos los datos del formulario
	$idActividad 	 	 = $_GET["idActividad"];
	eliminarActividad($idActividad);
	header("Location: ./admin.php?exito=1");

	
?>