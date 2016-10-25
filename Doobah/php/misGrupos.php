<?php
	session_start();
	require_once("php/redirigir.php");
	ifIsNotLogged();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Doobah!</title>
		<link href="style/cabecera.css" rel="stylesheet" type="text/css" />
		<link href="style/barraSuperior.css" rel="stylesheet" type="text/css" />
		<link href="style/inicio.css" rel="stylesheet" type="text/css" />
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
						<li><a href="misGrupos.php">Grupo</a></li>
					</ul>
				</div>
				<div id="actividades">
					<button id= "botonActividades" onclick="location.href='misActividades.php'" type="button">Mis actividades</button>
				</div>
				<div id="nuevoGrupo">
					<button  id= "botonGrupo" onclick="location.href='creargrupo.php'" type="button">Crear nuevo grupo</button>
				</div>
			</div>
			
			<div id="contenido">
				<fieldset id="favoritos" class="grupos"> <legend><a href="misGrupos.php">Mis grupos</a></legend>
					<?php 
						include('php/dameMisGrupos.php'); 
					?>
				</fieldset>			
			</div>

			<!-- Pie -->
			<?php
				include('pie.php');
			?>
		</div>
			<div id="popC"></div>
		</div>
	</body>
</html>