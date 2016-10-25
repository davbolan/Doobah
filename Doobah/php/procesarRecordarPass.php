<?php
	session_start();
	require "usuario.php";
	
	$email = $_REQUEST["email"];

	if(empty($email)){	
		header("Location: ../recordarPass.php?error=20");
	}
	else{
		$usuario = new Usuario();
		$usuario->email = $email;
		$usuario = $usuario->obtenerUsuario("email");
		
		if(is_null($usuario)){
			header("Location: ../recordarPass.php?error=21"); // No hay ningún usuario con este e-mail registrado. Por favor, introdúzcalo de nuevo.
		}
		else{
			// Generamos una nueva contraseña
			$newPass = $usuario->regenerarPass();
			// Enviamos la nueva contraseña al email del usuario
			enviarPass($usuario, $newPass);
			
			header("Location: ../index.php?exito=6"); // Revise su correo para obtener su nueva contraseña.
		}
		
	}
	
	function enviarPass($usuario, $newPass){
	
		$tab = "&nbsp&nbsp&nbsp&nbsp";
		
		$nick		= $usuario->nick;
		$nombre 	= $usuario->nombrecompleto;
			
		$destinatario  = $usuario->email;
		
		$asunto		= "Recuperación de contraseña de Doobah!";
		
		/*$mensaje = "Estimado usuario:
		
						En respuesta a su solicitud para recuperar la contraseña de su usuario en Doobah!, hemos generado una totalmente nueva.".
						"Por favor, rogamos que cambie su contraseña una vez haya podido acceder a su cuenta, desde su perfil.
						
						Usuario: 	".$nick."
						Contraseña: ".$newPass."
						
						Si usted no es usuario de www.doobah.com ni ha solicitado ninguna recuperación de contraseña rogamos que ignore este ".
						"mensaje y/o responda al mismo explicando esta situación.
						
						Muchas gracias por confiar en Doobah!";*/
		
		$mensaje  = "
		<html>
			<head>
				<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
				<title>Cambio de contraseña</title>
			</head>
			<body>
				<div>
					<p>Estimado usuario:</p></br>
					<p>En respuesta a su solicitud para recuperar la contraseña de su usuario en Doobah!, hemos generado una totalmente nueva.</p>
					<p>Por favor, rogamos que cambie su contraseña desde su perfil una vez haya podido acceder a su cuenta.</p></br>
					<p>".$tab."Usuario: ".$tab."&nbsp<strong>".$nick."</strong></p>
					<p>".$tab."Contraseña: <strong>".$newPass."</strong></p></br>
					<p>Si usted no es usuario de <strong>www.doobah.com</strong> ni ha solicitado ninguna recuperación de contraseña rogamos que ignore este mensaje y/o responda al mismo explicando esta situación.</p></br>	  
					<p>Muchas gracias por confiar en Doobah!</p>
				</div>  
			</body>
		</html>";
		
		$to = (empty($nombre)) ? $destinatario : $nombre.' &lt'.$destinatario.'&gt';
		
		$cabeceras 	= 'To: '.$to 								. "\r\n" .
					  'From: doobah.aw@gmail.com' 				. "\r\n" .
					  'Content-type: text/html;charset=utf-8' 	. "\r\n" .
					  'Reply-To: doobah.aw@gmail.com' 			. "\r\n" .
					  'MIME-Version: 1.0';
		
		mail($destinatario, $asunto, $mensaje, $cabeceras);
	}
?>