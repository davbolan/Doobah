<?php

	require_once('grupo.php');

	
	$lista = Grupo::obtenerGruposRec($_SESSION['nick']);
	if (count($lista)>0){
		foreach ($lista as $valor) {
			echo ("	<div>
						<a href='infoGrupo.php?idGrupo=".$valor->id_g."'><img src='".$valor->foto_principal."'></a>
						<a href='infoGrupo.php?idGrupo=".$valor->id_g."'>".$valor->nombre."</a>");
			if ($valor->privado=="Privado" || $valor->privado=="privado"){
				echo ("<img class='iconoCandado' id='imgPrivacidad' src='icons/cerrado24.png'>");
			}
			else{
				echo ("<img class='iconoCandado' id='imgPrivacidad' src='icons/abierto24.png'>");
			}
			echo ("</div>");
		}
	}
	else{
		echo ("	<div>
					<p>Lo sentimos, no existen grupos a los que no pertenezcas que podamos recomendarte</p>			    
				</div>");
	}
?>