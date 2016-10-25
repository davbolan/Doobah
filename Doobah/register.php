<?php
	session_start();
	require "php/redirigir.php"; // Comprueba si existe una sesion y redirige.	
	ifIsLogged();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="icon" href="icons/favicon.ico" type="image/x-icon" sizes="16x16">
		<title>Doobah!</title>
		<link href="style/estilosLanding.css" rel="stylesheet" type="text/css" />
		<script src="js/jquery-1.9.1.min.js" type="text/javascript"></script>   
		<script src="js/validacionRegistro.js" type="text/javascript"></script>
	
	</head>
	<body id="cuerpo">
		<div class="splash">
			<img src="img/logoDoobah.png" alt="logo" name="logo" width="364" height="134" id="logo" />
		</div>
		<div class="DataForm" >
			<h2>Registro</h2>
			<form action="./php/procesarRegistro.php" method="post" name="RegisterForm">
				<div class="divTable">
					<div class="divRow">
						<div class="divCell">Nombre de usuario</div>
						<div class="divCell">
							<input id="campoUser" name="usuario" type="text" size="20" value="" >
						</div>
					</div>
					<div class="divRow">
						<div class="divCell">Contraseña</div>
						<div class="divCell">
							<input id="pass1" class ="pass" name="pass1" type="password" size="20" value="">
						</div>
					</div>
					<div class="divRow">
						<div class="divCell">Repita su contraseña</div>
						<div class="divCell">
							<input id="pass2" class ="pass" name="pass2" type="password" size="20" value="" >
							
							<?php
								$visible="hidden";
								$msg="";
								if(isset($_GET["error"])){
									if( $_GET["error"] == 2){
										$visible="";
										$msg="La contraseña debe tener al menos 5 caracteres";
									}
									elseif($_GET["error"] == 3){
										$visible="";
										$msg="Las contraseñas no coinciden";
									}
								}
								echo("<label $visible id ='passIncorrecto' class='label_incorrecto'>$msg</label>")
							?>

						</div>
					</div>
					<div class="divRow">
						<div class="divCell">E-mail</div>
						<div class="divCell">
							<input id="campoEmail" name="email" type="text" size="20" >
							<?php
								$visible="hidden";
								if(isset($_GET["error"]) && $_GET["error"] == 4){
									$visible="";
								}
								echo("<label $visible id ='correoInvalido' class='label_incorrecto'>Correo Inválido</label>")
							?>
						</div>
					</div>
					<div>
						<input name="anunciante" type="checkbox" value="anunciante">
						<a href="#" class="tooltip-right" data-tooltip="Utiliza las ventajas que te ofrece Doobah para anunciar los eventos de tu empresa.">
						<label>Soy anunciante</label></a>
					</div>
					<div>
						<?php
							$visible="hidden";
							if(isset($_GET["error"]) && $_GET["error"] == 1){
								$visible="";
							}
							echo("<label $visible id ='camposVacios' class='label_incorrecto'>*Rellene todos los campos</label>");
					
							$visible="hidden";
							if(isset($_GET["error"]) && $_GET["error"] == 5){
								$visible="";
							}
							echo("<label $visible id ='usuarioExiste' class='label_incorrecto'>Nombre de usuario o correo existente</label>")
						?>
					</div>
				</div>
				<div>
					<p><a href="index.php">Ya estoy registrado</a></p>
					<input class="mainButton" name="register" type="submit" value="Registrarse" id="registerButton"">
				</div>
			</form>
		</div>
	</body>
</html>
