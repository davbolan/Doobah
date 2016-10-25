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
						<li><a href="<?php echo($_SESSION["main_page"]);?>">Inicio</a></li>						
					</ul>
				</div>
				<div id="actividades">
					<button id="botonActividades" type="button" onClick="location.href='crearAnuncio.php'">Crear anuncio</button>
				</div>
			</div>
			
			<div id="contenido">
				<fieldset id="actCercanas" class="grupos"> <legend><a href="">Anuncios</a></legend>
						<?php 
						include('php/dameMisAnuncios.php'); 
						?>
					<div>
						<button class="botonVerMas" id="botonVerMasFav" type="button" name="" value="" title="masGruposF">Ver más...</button>
					</div>
				</fieldset>		
			</div>

			<!-- Pie -->
			<?php
				include('pie.php');
			?>
		</div>
			<div id="popC"></div>
	</body>
</html>