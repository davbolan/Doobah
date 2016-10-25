<?php
	session_start();
	require "php/redirigir.php"; // Comprueba si existe una sesion y redirige.
	ifIsNotLogged();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="icon" href="icons/favicon.ico" type="image/x-icon" sizes="16x16">
		<title>Doobah!</title>
		<link href="./style/cabecera.css" rel="stylesheet" type="text/css" />
		<link href="./style/barraSuperior.css" rel="stylesheet" type="text/css" />
		<link href="./style/crear.css" rel="stylesheet" type="text/css" />
		<link href="./style/perfil.css" rel="stylesheet" type="text/css" />
		<link href="./style/pie.css" rel="stylesheet" type="text/css" />
		
		<script src="js/jquery-1.9.1.min.js" type="text/javascript"></script>   
		<script src="js/popUp.js" type="text/javascript"></script>
		<script src="js/mostrarImagen.js" type="text/javascript"></script>
	</head>
	<body>
		<div id="overlay" class="overlay-container"></div>
		<div id="contenedor">
			<!-- Cabecera-->
			<?php
				include('cabecera.php');
			?>
			
			<div id="contenido" >
				<fieldset id="perfil"> <legend><a href="perfil.php">Mi Perfil</a></legend>
					<h1><?php echo($_SESSION['nick']);?></h1>
					<div id="informacionUser">
						<a id="foto"><img id="fotoImg" class="fotoprincipal" src="<?php echo($_SESSION['avatar']);?>"></a>
					</div>
		
					<div>
						<form action="php/modificarPerfil.php" method="post" enctype="multipart/form-data">
							<div class="div_form">
								<label><?php if($_SESSION["tipo"] != 'anunciante') echo("Nombre y Apellidos:"); else echo("Empresa: "); ?>
								</label>
								<input id="nombre"  type="text" name="nombre" value='<?php echo($_SESSION['nombreCompleto']);?>'>
							</div>	
							<div class="div_form">
								<?php
									$tipo = $_SESSION["tipo"];
									if($tipo =='anunciante'){
										echo("<label>Fecha de alta: </label>");
										echo("<label id='fecha'>".date("d-m-Y",strtotime($_SESSION['fecha_alta']))."<label>");
									}
									else{
										$value = (!empty($_SESSION["fecha_nac"])) ? "value='".$_SESSION["fecha_nac"]."'" : "";
										echo("<label>Fecha de nacimiento</label>");
										echo("<input id='fecha' name='fecha' type='date' min='01-01-1950' max='".date('Y-m-d')."' $value>");
									}
								?>
							</div>
							<?php
								if($tipo =='anunciante'){
									echo("<div class='div_form'>");
									echo("	   <label>CIF: </label>");
									echo("	   <input id='cif' name='cif' value='".$_SESSION["cif"]."'>");
									echo("</div>");
								}
							?>
							<div class="div_form">
								<label>Antigua contraseña:</label>
								<input id="passA"  type="password" name="passAnt">
							</div>			
							<div class="div_form">
								<label>Nueva Contraseña:</label>
								<input id="passN"  type="password" name="nueva_pass">
							</div>	
							<div class="div_form">
								<label>Confirmar nueva contraseña:</label>
								<input id="passN2"  type="password" name="nueva_pass2">
							</div>
							<div class="div_form">
								<label>Ciudad:</label>
								<input id="ciudad"  type="text" name="ciudad" value='<?php echo($_SESSION['ciudad']);?>'>
							</div>	
							<div class="div_form">	
								<label>Email:</label>
								<label id="labelEmail"><?php echo($_SESSION['email']);?></label>
							</div>	
							<div class="div_form">
								<?php $label = ($tipo != 'anunciante') ? "Información personal:" : "Información del anunciante:" ?>
								<label><?php echo($label); ?></label>
								<textarea  id="infor" name="message" rows="7" cols="45"><?php echo($_SESSION['descripcion']);?></textarea>
							</div>	
							<div class="div_form">	
								<label>Subir foto:</label>
								<input id="file_url" type='file' name="fotoU" title="Seleccionar archivo"/>
							</div>	
							<div class="div_button">	
								<button class="btn" type="submit">Actualizar datos</button>
								<button class="btncan" type="button" onclick="location.href='<?php echo($_SESSION['main_page']);?>'">Cancelar</button>
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