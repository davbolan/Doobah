<?php
	session_start();
	require_once("php/redirigir.php");
	ifIsNotLogged();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="icon" href="icons/favicon.ico" type="image/x-icon" sizes="16x16">
		<title>Doobah!</title>
		<link href="style/cabecera.css" rel="stylesheet" type="text/css" />
		<link href="style/barraSuperior.css" rel="stylesheet" type="text/css" />
		<link href="style/misActividades.css" rel="stylesheet" type="text/css" />
		<link href="style/pie.css" rel="stylesheet" type="text/css" />
				
		<script src="js/jquery-1.9.1.min.js" type="text/javascript"></script>   
		<script src="js/popUp.js" type="text/javascript"></script>
	</head>
	<body>
		<div id="overlay" class="overlay-container"></div>
		<div id="contenedor">
			<!-- Cabecera-->
			<?php
				include('cabecera.php');
			?>
			
		<div id="barraSuperior">
  			<div id="breadcrumb">
				<ul>
					<li><a href="inicio.php">Inicio</a></li>
					<li><a href="misActividades.php">Mis Actividades</a></li>
  				</ul>
  			</div>
			<div id="nuevoGrupo">
				<button  id= "botonGrupo" onclick="location.href='crearActividad.php?idGrupo=null'" type="button">Crear nueva actividad</button>
			</div>
	  	</div>
			<!--A partir de aqui -->
			<div id="contenedor">
				<div id="contenido">	
				<fieldset id="misactividades" class="grupos"> <legend><a href="misActividades.php">Mis Actividades</a></legend>
					<?php 
						include('/php/dameMisActividades.php'); 
					?>
				</fieldset>
				</div>
			</div>
			
			<!-- Pie -->
			<?php
				include('pie.php');
			?>
		</div>
			<div id="popC"></div>
	</body>
</html>