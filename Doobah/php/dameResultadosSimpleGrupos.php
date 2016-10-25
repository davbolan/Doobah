<?php

	require_once('DAO_General.php');
	//require_once('usuario.php');
	require_once('grupo.php');
	//require_once('actividad.php');
	//require_once('procesarBusquedaAV.php');
	
	//$tipo = $_GET['tipo_busqueda'];
	$tipo = "grupos";
		$nombre = $_GET['search'];
		$result = busqueda_Simple($tipo,$nombre);
		$grupo = new Grupo();
	
		if($result->num_rows != 0){
			while ($row = $result->fetch_row()){
				$grupo = $grupo -> montaGrupo($row);
				echo ("	<div>
						<a href='resultadosBusqueda.php'><img src='".$grupo->foto_principal."'></a>
						<a href='resultadosBusqueda.php'>'".$grupo->nombre."'</a>			    
						</div>");
			}
		}
		else{
			echo ("	<div>
						<p>No se ha encontrado ningún resultado!</p>			    
					</div>");
		}
	
?>