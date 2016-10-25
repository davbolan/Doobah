<?php

	require_once('grupo.php');

	
	$lista = Grupo::obtenerGrupos($_SESSION['nick']);
	if (count($lista)>0){
		foreach ($lista as $valor) {
			echo ("	<div>
						<a href='infoGrupo.php?idGrupo=".$valor->id_g."'><img src='".$valor->foto_principal."'></a>
						<a href='infoGrupo.php?idGrupo=".$valor->id_g."'>".$valor->nombre."</a>			    
					</div>");
		}
	}
	else{
		echo ("	<div>
					<p>No perteneces a ningún grupo!</p>			    
				</div>");
	}
?>