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
				session_start();
				include('cabecera.php');
			?>
			
			<div id="barraSuperior">
				<div id="breadcrumb">
					<ul>
						<li><a href="<?php echo($_SESSION["main_page"]);?>">Inicio</a></li>
						<li><a href="recGrupos.php">Grupos Recomendados</a></li>
					</ul>
				</div>
				<div id="actividades">
					<button id= "botonActividades" type="button" onClick="location.href='crearActividad.php'">Mis actividades</button>
				</div>
				<div id="nuevoGrupo">
					<button  id= "botonGrupo" type="button" onClick="location.href='creargrupo.php'">Crear nuevo grupo</button>
				</div>
			</div>
			
			<div id="contenido">
				<fieldset id="recomendados" class="grupos"> <legend><a href="">Grupos recomendados</a></legend>
					<?php 
						include('/php/dameGruposRec.php'); 
					?>
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