<?php

	require_once('DAO_General.php');
	//require_once('usuario.php');
	//require_once('grupo.php');
	require_once('php/actividad.php');
	//require_once('procesarBusquedaAV.php');
	
	//$tipo = $_GET['tipo_busqueda'];
		$tipo = "actividades";
		$nombre = $_GET['search'];
		$result = busqueda_Simple($tipo,$nombre);
		$actividad = new Actividad();
		if($result->num_rows != 0){
			while ($row = $result->fetch_row()){
				$actividad = $actividad -> montaActividades($row);
				echo ("	<div>
						<a href='resultadosBusqueda.php'><img src='".$actividad->foto_principal."'></a>
						<a href='resultadosBusqueda.php'>'".$actividad->nombre."'</a>			    
						</div>");
			}
		}
		else{
			echo ("	<div>
						<p>No se ha encontrado ningún resultado!</p>			    
					</div>");
		}

?>