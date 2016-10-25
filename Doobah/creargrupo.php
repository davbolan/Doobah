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
		<link href="./style/creargrupo.css" rel="stylesheet" type="text/css" />
		  <link href="style/crear.css" rel="stylesheet" type="text/css" />
		<link href="./style/cabecera.css" rel="stylesheet" type="text/css" />
		<link href="./style/pie.css" rel="stylesheet" type="text/css" />
		<link href="style/barraSuperior.css" rel="stylesheet" type="text/css" />
		
		<script src="js/jquery-1.9.1.min.js" type="text/javascript"></script>   
		<script src="js/popUp.js" type="text/javascript"></script>
		<script src="js/mostrarImagen.js" type="text/javascript"></script>
		<script src="js/validacionGrupo.js" type="text/javascript"></script>
		<script type="text/javascript" src="js/selects.js"></script>
	</head>
	<body>
		<div id="contenedor">			
			<!-- Cabecera-->
			<?php
				include('cabecera.php');
			?>
			
		<div id="barraSuperior">
  			<div id="breadcrumb">
				<ul>
					<li><a href="<?php echo($_SESSION["main_page"]);?>">Inicio</a></li>
					<li><a href="creargrupo.php">Crear Grupo</a></li>
  				</ul>
  			</div>
	  	</div>
			<!--A partir de aqui -->
			<div id="contenedor">
				<fieldset id="crear_grupos" class="grupos"> <legend><a href="creargrupo.php">Crear nuevo grupo</a></legend>
					<H1>Haz contactos nuevos ahora mismo</H1>
					<div id="foto"> <img id="fotoImg" class="fotoprincipal" src="img/groups/default_group.jpg"></div>
					<div id="contenido" >	
						<form action="./php/procesarCrearGrupo.php" method="post" name="RegisterForm" enctype="multipart/form-data">
							<p>Para crear el grupo y empezar a unir contactos, rellene los siguientes datos:</p>
							<div class="div_form">
								<label>Nombre:</label>
								<input id="inNombre" type="text" name="inNombre" maxLength="30" value="">
								<?php
									$visible="hidden";
									if(isset($_GET["error"]) && $_GET["error"] == 2){
										$visible="";
									}
									echo("<p $visible id ='grupoExiste' class='label_incorrecto'>Nombre de grupo ya existente</p>")
								?>
							
							</div>
							<div class="div_form">
								<label>Ciudad:</label>
								<INPUT type="text" name="ciudad" maxLength="30" value="">
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
								<label>Foto Grupo:</label>
								<input id="file_url" type='file' name="fotoGrupo" title="Seleccionar archivo">
							</div>
							<div class="div_form">	
								<input id="publico" type="checkbox" name="publico" value="Publico" checked> 
								<label for="publico">Grupo Público.</label>
							</div>	
							<div class="div_form">
								<label>Descripcion:</label>
								<textarea name="descripcion" rows="4" cols="60" ></textarea>
							</div>	
							<div class="div_button">
								<button class="btn" name="createprofile" onclick="location.href='misGrupos.php'" type="submit">Crear Grupo</button>
								<button class="btncan" name="cancel" onclick="location.href='misGrupos.php'" type="button">Cancelar</button>
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
	</body>
</html>
