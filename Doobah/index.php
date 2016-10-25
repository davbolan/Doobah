<?php
	session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="icon" href="icons/favicon.ico" type="image/x-icon" sizes="16x16">
		<title>Doobah!</title>
		<link href="./style/estilosLanding.css" rel="stylesheet" type="text/css" />
	</head>

	<body id="cuerpo">
		<div class="splash">
		  <p><img src="img/logoDoobah.png" alt="logo" name="logo" width="364" height="134" id="logo" /></p>
		</div>
		<div class="DataForm" >
		<h2>Identifíquese</h2>
		  <form action="./php/procesarLogin.php" method="post" name="loginForm">
			  <div class="divTable">
				  <div class="divRow">
					<div class="divCell">Nombre de usuario</div>
					<div class="divCell">
					  <input name="usuario" type="text" size="20" value="">
					</div>
				  </div>
				  <div class="divRow">
					<div class="divCell">Contraseña</div>
					<div class="divCell">
					  <input name="pass" type="password" size="20" value="">
					  <?php
								$visible="hidden";
								$msg="";
								if(isset($_GET["error"])){
									if( $_GET["error"] == 1){
										$visible="";
										$msg="Rellene todos los campos";
									}
									elseif($_GET["error"] == 2){
										$visible="";
										$msg="Nombre de usuario o contraseña incorrectos";
									}
								}
								echo("<label $visible id ='passIncorrecto' class='label_incorrecto'>$msg</label>")
							
						?>
					</div>
				  </div>
				</div>
				<div>
				  <input name="recordar" type="checkbox" value="Recordar contraseña">
				  <label>Recordar contraseña </label>
				</div>
				<div>
					<p><a href="register.php">Registrarse</a></p>
					<p><a href="recordarPass.php">He olvidado mi contraseña</a></p>
				</div>
				<div>
				  <input class="mainButton" name="enviar" type="submit" value="Entrar">
				</div>
		  </form>
		</div>
	</body>
</html>
