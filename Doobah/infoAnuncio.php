<?php
	session_start();
	require_once("php/redirigir.php");
	require_once("php/anuncio.php");
	require_once("php/usuario.php");
	require_once("php/anunciante.php");
	require_once("php/comentario.php");
	ifIsNotLogged();
	include('php/recopilarDatosAnuncio.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="icon" href="icons/favicon.ico" type="image/x-icon" sizes="16x16">
		<title>Doobah!</title>
		<link href="./style/cabecera.css" rel="stylesheet" type="text/css" />
		<link href="./style/barraSuperior.css" rel="stylesheet" type="text/css" />
		<link href="./style/actividad.css" rel="stylesheet" type="text/css" />
		<link href="./style/pie.css" rel="stylesheet" type="text/css" />
				
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
					<li><a href="infoAnuncio.php=?<?php echo $anuncio->id_an;?>"><?php echo $anuncio->nombre;?></a></li>
  				</ul>
  			</div>
			<div id="nuevoAnun">
				<button id= "botonGrupo" onclick="location.href='crearAnuncio.php'" type="button">Crear anuncio</button>
			</div>
	  	</div>

			<div id="contenido">
				<div id="infoActividad">
					<div id="fotoActividad">
						<fieldset class="informacion"> <legend><?php echo $anuncio->nombre;?></legend>
							<img src='<?php echo $anuncio->foto_principal;?>'>
						</fieldset>
					</div>
				</div>
				<div id="actDescripcion">
					<fieldset class="descripcion"> <legend>Descripcion del anuncio</legend>
						<h1><?php echo $anuncio->nombre;?></h1>
						<p>Fecha: <?php echo $anuncio->fecha_evento;?></p>
						<p>Lugar: <?php echo $anuncio->lugar;?></p>
						<p><?php echo $anuncio->descripcion;?></p>
 					</fieldset>
				</div>
				<div><BUTTON class="boton" name="inscribirse" id="inscribirse" onclick="location.href='<?php echo("modAnuncio.php?idAnuncio=$anuncio->id_an") ?>'" type="button">Modificar anuncio</BUTTON></div>
				<div><BUTTON class="boton rojo" name="abandonar" id="abandonar" onclick="location.href='inicioAnunciante.php'" type="button">Eliminar anuncio</BUTTON></div>
				<div id="comentarios">
						 <fieldset class="comentarios"> <legend>Comentarios</legend>
							<div class= "texto">
								<?php
									$lista = Comentario::obtenerComentarioAnuncio($anuncio->id_an);
									if (count($lista)>0){
										foreach ($lista as $valor) {
											$usuario = new Usuario($valor->nick);
											$usuario = $usuario->obtenerUsuario('nick');
										
											
											echo ("	<div> <a href='perfilUsuario.php?nick=".$valor->nick."'><img src=\"".$usuario->avatar."\"><span>".$usuario->nick."</span></a></br>");
											echo ("	<label>".$valor->comentario."</label></br><span>".$valor->fecha."</span></br></div>");
										}
									}
									else{
										echo ("	<div>
													<p>No existen comentarios para esta actividad</p>			    
												</div>");
									}	
								?>
							</div>
							<div class= "texto">
									<form method="POST" action="php/procesaComentarioAnuncio.php">
										<label id="label_com">Comenta:</label>
										<input textarea name='comment' id='comment'></textarea>
										<input type='hidden' name=idAnuncio value=<?php echo $anuncio->id_an ?>>
										<input type='submit' value='Enviar' class='btn'>
									</form>
								</div>							
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