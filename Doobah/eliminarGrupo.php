<?php

	session_start(); //localizar sesion

	require_once ("php/grupo.php");
	require_once ("php/DAO_General.php");	
		
	// 1. Capturamos los datos del formulario
	$idGrupo 	 	 = $_GET["idGrupo"];
	eliminarGrupo($idGrupo);
	$ag = $_REQUEST['ag'];
	if ($ag == 1){ 
		header("Location: ./inicio.php?exito=1");
	}
	else {
		header("Location: ./admin.php?exito=1");
	}
?>