<?php
	session_start();
	require_once("php/redirigir.php");
	ifIsNotLogged();
	include('php/recopilarDatosAnuncio.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="icon" href="icons/favicon.ico" type="image/x-icon" sizes="16x16">
		<title>Doobah!</title>
        <link href="style/cabecera.css" rel="stylesheet" type="text/css" />
		<link href="style/barraSuperior.css" rel="stylesheet" type="text/css" />
		 <link href="style/crear.css" rel="stylesheet" type="text/css" />
        <link href="style/crearActividad.css" rel="stylesheet" type="text/css" />
		<link href="style/pie.css" rel="stylesheet" type="text/css" />
			
		<script src="js/jquery-1.9.1.min.js" type="text/javascript"></script>   
		<script src="js/popUp.js" type="text/javascript"></script>
		<script src="js/mostrarImagen.js" type="text/javascript"></script>
		<script src="http://code.jquery.com/jquery-latest.js"></script>
		<script type="text/javascript" src="js/selects.js"></script>
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
                        <li><a href="infoAnuncio.php">Fiesta de la espuma</a></li>
                        <li><a href="modAnuncio.php?idAnuncio=<?php echo $idAnuncio?>">Modificar anuncio</a></li>
					</ul>
				</div>
			</div>
			<div id="contenedor">
				<fieldset id="crear_actividad" class="actividad"> <legend><a href="modAnuncio.php">Modificar anuncio</a></legend>
					<div id="foto"> <img id="fotoImg" class="fotoprincipal" src= '<?php echo($foto_Anuncio);?>'></div>
					<div id="contenido" >	
						<form action=<?php echo("./php/modificaAnuncio.php?idAnuncio=$idAnuncio"); ?> method="post" enctype="multipart/form-data">
							<div class="div_form">
								<label>Nombre:</label>
								<input type="text" name="nombre" maxLength="30" value='<?php echo($nombreAn);?>'>
							</div>
							<div class="div_form">
								<label>Fecha del evento:</label>
									<?php
										$date = Date('Y-m-d');
										$value = $fecha_evento;
										echo("<input id='fecha' name='fecha' type='date' min='".$date."' max='31-12-2999' value= $value>");
									?>
							</div>	
							<div class="div_form">
								<label>Horario:</label>
								<input type="time" name="hora" value='<?php echo($hora);?>'>
							</div>	
							<div class="div_form">	
								<label>Lugar:</label>
								<input type="text" name="ciudad" maxLength="30" value='<?php echo($lugar);?>'>
							</div>	
							<div class="div_form">
								<label>Temática:</label>
								<select name="tema" id="tema">
									<option value="default">Seleccione un tema</option>
									<?php
										include("./php/dameTaxonomias.php");
									?>
								</select>
								<select name="taxonomia" id="taxonomia" disabled>
								</select>
							</div>
							<div class="div_form">	
								<label>Foto Anuncio:</label>
								<input id="file_url" type='file' name="fotoAnun" title="Seleccionar archivo">
							</div>	
							<div class="div_form">	
								<label>Descripcion:</label>
								<textarea name="descripcion" rows="4" cols="60" ><?php echo($descripcion);?></textarea>
							</div>	
							<div class="div_button">
								<button class="btn" name="createprofile" type="submit">Actualizar</button>
								<button class="btncan" name="createprofile" onclick="location.href='infoAnuncio.php'" type="button">Cancelar</button>
							</div>
						</form>
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