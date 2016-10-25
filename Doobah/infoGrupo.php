<?php
	session_start();
	require_once("php/redirigir.php");	
	require_once('php/actividad.php');
	ifIsNotLogged();
	include('php/recopilarDatosGrupo.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="icon" href="icons/favicon.ico" type="image/x-icon" sizes="16x16">
		<title>Doobah!</title>
		<link href="style/cabecera.css" rel="stylesheet" type="text/css" />
		<link href="style/barraSuperior.css" rel="stylesheet" type="text/css" />
		<link href="style/infoGrupo.css" rel="stylesheet" type="text/css" />
		<link href="style/pie.css" rel="stylesheet" type="text/css" />
				
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
						<li><a href="misGrupos.php">Grupo</a></li>
						<li><a href="infoGrupo.php?idGrupo=<?php echo $grupo->id_g;?>"><?php echo $grupo->nombre;?></a></li>
					</ul>
				</div>
				<div id="actividades">
					<button id= "botonActividad" onclick="location.href='misActividades.php'" type="button">Mis actividades</button>
				</div>
				<div id="nuevoGrupo">
					<button  id= "botonGrupo" onclick="location.href='creargrupo.php'" type="button">Crear nuevo grupo</button>
				</div>
				
			
			</div>
			
			<div id="contenido">	
			<?php
				//$id_g =$_GET['idGrupo'];
				//$grupo = Grupo::obtenerGrupo('id_g',$id_g);
			?>
				<div id="infoGrupo">
					<div id="fotoGrupo">
						<fieldset class="informacion"> <legend><?php echo $grupo->nombre;?></legend>
							<img src='<?php echo $grupo->foto_principal;?>'>
						</fieldset>
					</div>
					<div id="participantes">
						 <fieldset class="integrantes"> <legend>Miembros del grupo</legend>
							<div id="scroll">
								<?php
									$lista = Grupo::dameUsuariosGrupos($idGrupo);
									if ($lista != -1){
										if (count($lista)>0){
											foreach ($lista as $valor) {
												echo ("	<div>
															<a href='perfilUsuario.php?nick=".$valor->nick."'><span>".$valor->nick."</span><img id= 'admin' src='".$valor->avatar."'></a>		    
														</div>");
											}
										}
									}
									else{
										echo ("	<div>
													<p>No existen usuarios para este grupo</p>			    
												</div>");
									}	
								?>
							</div>
						 </fieldset>
					</div>
				</div>
				<fieldset class="act"> <legend>Actividades del grupo</legend>
					<div id="actGrupo">
							<?php 
								$lista = Actividad::dameActiGrupos($idGrupo);
									if (count($lista)>0){
										foreach ($lista as $valor) {
											echo ("	
												<div class='actividad'>
													<div class='actInfo'>
														<a href='infoActividad.php?idActividad=".$valor->id_a."'><img class= 'actividadImagen' src='".$valor->foto_principal."'></a>
													</div>
													<img class='iconoAsistencia' id='imgPrivacidad' src='icons/icon-voy.png'>
													<h2>".$valor->nombre."</h2>
													<div class='actDesc'>
														<p>Fecha: ".$valor->fecha_actividad."</p>
														<p>Lugar: ".$valor->lugar."</p>
														<p>".$valor->descripcion."</p>		
													</div>
												</div>
												<hr/>
											");
										}
									}
									else{
										echo ("	<div>
													<p>No existen actividades para este grupo</p>			    
												</div>");
									}
							?>
								
					</div>
					
				</fieldset>
				<fieldset class="descripcion"><legend>Descripción</legend>
					<div id= "desGrupo">
					<?php 
						if ($grupo->privado == 'privado'){
							echo "<span id='privado'>Privado";
						}
						else{
							echo "<span id='publico'>Público";
						}
						echo "</span> ";
					?> 
					<p><?php echo $grupo->descripcion;?></p>
					</div>
				</fieldset>
				<?php
					$isParticipante = false;
					$isAdminGrupo = false;
					$isAdmin = false;
					$miUser = null;
					////////nuevo
					$nick1 = $_SESSION["nick"];
					$usuario = new Usuario($nick1);
					///////////////
					$usuarios = Grupo::dameUsuariosGrupos($idGrupo);
					//////nuevo
					$usuario = $usuario->obtenerUsuario("nick");
					////////////////
					if ($usuarios != -1){
						if (count($usuarios)>0){
							foreach ($usuarios as $user) {
								if ($_SESSION["nick"] == $user->nick){
									$isParticipante = true;
									if ($user!=null){
										if ($grupo->esAdminDelGrupo($user->nick)){
											$isAdminGrupo = true;
										}
										
									}
								}
							}
						}
						
					}
					/////////////////nuevo
					if ($usuario->tipo == "admin"){
						$isAdmin = true;
					}
					/////////////////
					if ($isAdminGrupo || $isAdmin){
						$dir = "misGrupos.php";					
						/**echo ("	<div id='confGrupo'>
									<button  id='propAct' type='button' onclick='location.href=\"crearActividad.php?idGrupo=$grupo->id_g\"'>Crear una actividad</button>
									<button  id='modGrupo' type='button' onclick='location.href=\"modGrupo.php\"'>Modificar grupo</button>");**/
							//////////////////nuevo
						echo ("	<div id='confGrupo'>
									<button  id='propAct' type='button' onclick='location.href=\"crearActividad.php?idGrupo=$grupo->id_g\"'>Crear una actividad</button>
									<button  id='modGrupo' type='button' onclick='location.href=\"modGrupo.php?idGrupo=$grupo->id_g\"'>Modificar grupo</button>
									<button  id='eliminarGrupo' type='button' onclick='location.href=\"php/procesarEliminarGrupo.php?idGrupo=$grupo->id_g\"'>Eliminar Grupo</button>");
									//////////////////////////
						if ($isParticipante){
							$dir2 = "php/procesarParticipantesGrupo.php?tipoOp=abandonar&idGrupo=$grupo->id_g";
							echo ("<button  id='salirGrupo' type='button' onclick='location.href=\"$dir2\"'>Dejar el grupo</button>");

						}
						echo ("		</div>");
						
						if (!$isParticipante){
							$dir = "php/procesarParticipantesGrupo.php?tipoOp=insertar&idGrupo=$grupo->id_g";
							echo (	"<div id='confGrupo'>
										<button  id='unirse' type='button' onclick='location.href=\"$dir\"'>Unirse</button>
									</div>");
						}
					}
					else if ($isParticipante){
						$dir2 = "php/procesarParticipantesGrupo.php?tipoOp=abandonar&idGrupo=$grupo->id_g";
						echo ("	<div id='confGrupo'>
									<button  id='propAct' type='button' onclick='location.href=\"crearActividad.php?idGrupo=$grupo->id_g\"'>Crear una actividad</button>
									<button  id='salirGrupo' type='button' onclick='location.href=\"$dir2\"'>Dejar el grupo</button>
								</div>");
					}
					else if ($grupo->privado == 'publico'){
						$dir = "php/procesarParticipantesGrupo.php?tipoOp=insertar&idGrupo=$grupo->id_g";
						echo (	"<div id='confGrupo'>
									<button  id='unirse' type='button' onclick='location.href=\"$dir\"'>Unirse</button>
								</div>");
					}					
				?>		
			<!-- Pie -->
			<?php
				include('pie.php');
			?>
		</div>	
			<div id="popC"></div>

	</body>
</html>