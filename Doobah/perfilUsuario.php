<?php
	session_start();
	require_once("php/redirigir.php");
	require_once("php/recopilarDatosUsuario.php");
	ifIsNotLogged();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="icon" href="icons/favicon.ico" type="image/x-icon" sizes="16x16">
		<title>Doobah!</title>
		<link href="./style/cabecera.css" rel="stylesheet" type="text/css" />
		<link href="./style/barraSuperior.css" rel="stylesheet" type="text/css" />
		<link href="./style/crear.css" rel="stylesheet" type="text/css" />
		<link href="./style/perfil.css" rel="stylesheet" type="text/css" />
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
			
			<div id="contenido" >
				<fieldset id="perfil"> <legend><a href="perfil.php"><?php echo($nickU);?></a></legend>
					<div id="informacionUser">
						<a id="foto"><img class="fotoprincipal" src='<?php echo($avatarU);?>'></a>
						<div id="gruposUser">
							<?php
								$label = "";
								if($tipoU != 'anunciante'){
									echo("<a id='info'><h3>Miembro de:</h3></a>");								
									foreach($listaGrupos as $grupo){
										echo("<p>- <a href='infoGrupo.php?idGrupo=".$grupo->id_g."'>".$grupo->nombre."</a></p>");}																	
										$label = ($numGrupos == 0) ? 'No está en ningún grupo' : "Grupos: ".$numGrupos;												
								}
								?>
							<div>
								<a class='form_label'> <label><?php echo($label); ?></label></a>
							</div>
						</div>
					</div>
					<div class="">
						<form>			
							<div class="div_form">
								<?php $labelNombre = ($tipoU == 'anunciante') ? 'Empresa: ': 'Nombre completo: '?>
								<label id="nombre"  type="text" name="nombre"><?php echo($labelNombre." ".$nombreU);?></label>
							</div>
							<div class="div_form">
								<?php $labelFecha = ($tipoU == 'anunciante') ? 'Fecha de alta: '.$creacion: 'Edad: '.$edad?>
								<label id="edad"  type="text" name="edad"><?php echo($labelFecha);?></label>
							</div>
							<?php
								if($tipoU == 'anunciante'){
									echo("<div class='div_for'>");
										echo("<label id='cif'  type='text' name='cif'> CIF: ".$cifA."</label>");
									echo("</div>");	
								}
							?>					
							<div class="div_form">
								<label id="Descripcion"  type="text" name="Descripcion">Descripción: <?php echo($descripcionU);?></label>
							</div>	
							<div class="div_button">
								<button class="btn" type="button" onclick="location.href='<?php echo($_SESSION['main_page']);?>'">Cancelar</button>
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