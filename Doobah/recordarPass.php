<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Doobah!</title>
		<link href="style/estilosLanding.css" rel="stylesheet" type="text/css" />
	</head>
	<body id="cuerpo">
		<div class="splash">
			<img src="img/logoDoobah.png" alt="logo" name="logo" width="364" height="134" id="logo" />
		</div>
		<div class="DataForm" >
			<h2>He olvidado mi contraseña</h2>
			<p>Introduce tu email para recibir una nueva contraseña de acceso a tu cuenta.</p>
			<form action="./php/procesarRecordarPass.php" method="post" name="RememberForm">
				<div class="divTable">
					<div class="divRow">
						<div class="divCell">E-mail</div>
						<div class="divCell">
							<input name="email" type="text" size="20">
						</div>
					</div>
				</div>
				<p><a href="index.php">Volver</a></p>
				<input class="mainButton" name="remember" type="submit" value="Recibir contraseña" id="rememberButton">
			</form>
		</div>
	</body>
</html>
