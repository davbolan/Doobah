<?php
	session_start();
	require_once("php/redirigir.php");
	require_once("php/actividad.php");
	require_once("php/comentario.php");
	require_once("php/usuario.php");
	ifIsNotLogged();
	include('php/recopilarDatosActividad.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="icon" href="icons/favicon.ico" type="image/x-icon" sizes="16x16">
		<title>Doobah!</title>
		<link href="./style/actividad.css" rel="stylesheet" type="text/css" />
		<link href="./style/cabecera.css" rel="stylesheet" type="text/css" />
		<link href="./style/pie.css" rel="stylesheet" type="text/css" />
		<link href="style/barraSuperior.css" rel="stylesheet" type="text/css" />
				
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
					<li><a href="misActividades.php">Mis Actividades</a></li>
					<li><a href="infoActividad.php?idActividad=<?php echo($idActividad);?>"><?php echo $actividad->nombre;?></a></li>
  				</ul>
  			</div>
	  	</div>
			<div id="contenido">
				<div id="infoActividad">
					<div id="fotoActividad">
						<fieldset class="informacion"> <legend><?php echo $actividad->nombre;?></legend>
							<img src='<?php echo $actividad->foto_principal;?>'>
						</fieldset>
					</div>
					<div id="participantes">
						 <fieldset class="integrantes"> <legend>Participantes</legend>
							<div id="scroll">
								<?php
									$lista = Actividad::dameParticisActi($idActividad);
									if (count($lista)>0){
										foreach ($lista as $valor) {
											echo ("	<div>
														<a href='perfilUsuario.php?nick=".$valor->nick."'><span>".$valor->nick."</span><img id= 'admin' src='".$valor->avatar."'></a>		    
													</div>");
										}
									}
									else{
										echo ("	<div>
													<p>No existen usuarios para esta actividad</p>			    
												</div>");
									}	
								?>
							</div>
						 </fieldset>
					</div>
				</div>
				<div id="actDescripcion">
					<fieldset class="descripcion"> <legend>Descripcion de la actividad</legend>
						<h1><?php echo $actividad->nombre;?></h1>
						<p>Fecha: <?php echo $actividad->fecha_actividad;?></p>
						<p>Lugar: <?php echo $actividad->lugar;?></p>
						<p><?php echo $actividad->descripcion;?></p>
 					</fieldset>
				</div>
				
				
				<?php
					$isParticipante = false;
					$isAdminGrupo = false;
					$isAdmin = false;
					$miUser = null;
					////////nuevo
					$nick1 = $_SESSION["nick"];
					$usuario = new Usuario($nick1);
					///////////////
					$usuarios = Actividad::dameParticisActi($idActividad);
					//////nuevo
					$usuario = $usuario->obtenerUsuario("nick");
					////////////////
					if ($usuarios != -1){
						if (count($usuarios)>0){
							foreach ($usuarios as $user) {
								if ($_SESSION["nick"] == $user->nick){
									$isParticipante = true;
									$miUser =  $user;
								}
							}
						}
						if ($miUser!=null){
							if ($miUser->isAdmin == 1){
								$isAdminGrupo = true;
							}
							if ($miUser->tipo == 'admin'){
								$isAdmin = true;
							}
						}
					}
					/////////////////nuevo
					if ($usuario->tipo == 'admin'){
						$isAdmin = true;
					}
					/////////////////
					if ($isAdminGrupo || $isAdmin){
						$dir = "misGrupos.php";					
						echo ("	<div id='confGrupo'>

									<BUTTON class='boton' name='inscribirse' id='inscribirse' onclick='location.href=\"modActividad.php?idActividad=$actividad->id_a\"'>Modificar actividad</button>
									<BUTTON class='boton' name='inscribirse' id='inscribirse' onclick='location.href=\"eliminarActividad.php?idActividad=$actividad->id_a\"'>Eliminar Actividad</button>");

						echo ("		</div>");
					}
					else if ($isParticipante){
						$dir2 = "php/procesarParticipantesACtividad.php?tipoOp=abandonar&idActividad=$idActividad";
						echo ("	
									<div><BUTTON class='boton rojo' name='abandonar' onclick='location.href=\"$dir2\"' id='abandonar' type='submit'>Abandonar Actividad</BUTTON></div>
								");
					}
					else {
						$dir = "php/procesarParticipantesActividad.php?tipoOp=insertar&idActividad=$idActividad";
						echo (	"
									<div><BUTTON class='boton verde' name='inscribirse' onclick='location.href=\"$dir\"' id='inscribirse' type='submit'>Apuntarse a Actividad</BUTTON></div>
								");
					}
									
				?>
				
				
				<div id="comentarios">
						 <fieldset class="comentarios"> <legend>Comentarios</legend>
							<div id="bloque_comentario">
								<div class= "texto">
								<?php
									$lista = Comentario::obtenerComentarioActividad($idActividad);
									if (count($lista)>0){
										foreach ($lista as $valor) {
											$usuario = new Usuario($valor->nick);
											$usuario = $usuario->obtenerUsuario('nick');
										
											
											echo ("	<div class='persona'>
														<a href='perfilUsuario.php?nick=".$valor->nick."'><img src='".$usuario->avatar."'><span>".$valor->nick."</span></a><span>".$valor->fecha."</span>
													</div>");
			
											echo ("	<div class='comentario'>
														<label>".$valor->comentario."</label>
													</div>");		
										}

									}
									else{
										echo ("	<div>
													<p>No existen comentarios para esta actividad</p>	
												</div>");
									}	
								?>

								</div>
								<div class= "realizar">
									<form method="POST" action="php/procesaComentario.php">
										<label id="label_com">Comenta:</label>
										<input textarea name='comment' id='comment'></textarea>
										<input type='submit' value='Enviar' class='btn'>
										<input type='hidden' name=idActividad value=<?php echo $idActividad ?>>
									</form>
								</div>
									
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