<?php

	require_once('DAO_General.php');
	require_once('usuario.php');
	//require_once('grupo.php');
	//require_once('actividad.php');
	//require_once('procesarBusquedaAV.php');
	
	//$tipo = $_GET['tipo_busqueda'];
		$tipo = "usuarios";
		$nombre = $_GET['search'];
		$result = busqueda_Simple($tipo,$nombre);
		$usuario = new Usuario();
	
		if($result->num_rows != 0){
			while ($row = $result->fetch_row()){
				$usuario = $usuario -> montaUsuario($row);
				echo ("	<div>
						<a href='resultadosBusqueda.php'><img src='".$usuario->avatar."'></a>
						<a href='resultadosBusqueda.php'>'".$usuario->nombreCompleto."'</a>			    
						</div>");
			}
		}
		else{
			echo ("	<div>
						<p>No se ha encontrado ningún resultado!</p>			    
					</div>");
		}		

?>