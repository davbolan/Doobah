<?php
	// Configurar correo en http://drupalalsur.org/videos/enviar-correos-con-xampp-en-local
	session_start();
	require "usuario.php";
	
	$nombre  = $_POST["Nombre"];
	$email 	 = $_POST["email"];
	$asunto  = $_POST["motivo_consulta"];
	$mensaje = $_POST["message"];

	if(!empty($nombre) && !empty($email) && !empty($motivo) && !empty($mensaje)){	

		$tab = "&nbsp&nbsp&nbsp&nbsp";
			
		$destinatario  = "doobah.aw@gmail.com";		
		$asunto		.= " de " . $nombre;
		

		$mensaje  = "
		<html>
			<head>
				<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
				<title>Contacto</title>
			</head>
			<body>
				<div>
					<p></strong>Nombre del usuario: </strong>".$nombre."</p></br>
					<p></strong>Email de contacto: </strong>".$email."</p></br>
					<p></strong>Motivo de consulta: </strong>".$asunto."</p></br>
					<p></strong>Mensaje: </strong>".$mensaje."</p></br>
				</div>  
			</body>
		</html>";
		
		
		$cabeceras 	= 'To: '.$destinatario 						. "\r\n" .
					  'From: '.$email							. "\r\n" .
					  'Content-type: text/html;charset=utf-8' 	. "\r\n" .
					  'Reply-To: '.$email 						. "\r\n" .
					  'MIME-Version: 1.0';
	
		mail($destinatario, $asunto, $mensaje, $cabeceras);
	}
?>