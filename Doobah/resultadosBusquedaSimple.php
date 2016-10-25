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
		<link href="style/admin.css" rel="stylesheet" type="text/css" />
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
					<li><a href="resultadosBusquedaSimple.php">Resultados</a></li>
  				</ul>
  			</div>
	  	</div>
			
		<div id="contenido">
		
			<fieldset id="usuarios" class="grupos"> <legend>Usuarios Doobah!</legend>
			
			<?php 
						
						include('/php/dameResultadosSimpleUsuarios.php'); 
			?>
				
			</fieldset> 
			
  			<fieldset id="grupo" class="grupos"> <legend>Grupos Doobah!</legend>
			
			<?php 
						
						include('/php/dameResultadosSimpleGrupos.php');  
			?>
  			</fieldset>
  			
  			<fieldset id="actividades1" class="grupos">  <legend>Actividades Doobah!</legend>
			<?php 
		
						include('/php/dameResultadosSimpleActividades.php');  
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