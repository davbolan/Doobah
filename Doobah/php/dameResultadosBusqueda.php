<?php

	require_once('DAO_General.php');
	require_once('usuario.php');
	require_once('grupo.php');
	//require_once('procesarBusquedaAV.php');
	
	$tipo_busqueda = $_GET['tipo_busqueda'];
	if ($tipo_busqueda == "nombre"){
		$nombre = $_GET['nombre'];
		$result = busqueda_porNombre($nombre);
		$usuario = new Usuario();
	
		if($result->num_rows != 0){
			while ($row = $result->fetch_row()){
				$usuario = $usuario -> montaUsuario($row);
				echo ("	<div>
						<a href='perfilUsuario.php?nick=".$usuario->nick."'><img src='".$usuario->avatar."'></a>
						<a href='perfilUsuario.php?nick=".$usuario->nick."'>'".$usuario->_nombreCompleto."'</a>			    
						</div>");
			}
		}
		else{
			echo ("	<div>
						<p>No se ha encontrado ningún resultado!</p>			    
					</div>");
		}
	}
	else {
		$tipo = $_GET['tipo'];
		$taxonomia = $_GET['taxonomia'];
		$subtaxonomia = $_GET['subtaxonomia'];
		$cantidad = $_GET['cantidad'];
		$result = busqueda_porGrupo($tipo,$taxonomia,$subtaxonomia,$cantidad);
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
	}
?>