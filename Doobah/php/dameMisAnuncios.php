<?php

	require_once('php/anuncio.php');

	
	$lista = Anuncio::obtenerAnuncioUsuario($_SESSION['nick']);
	if (count($lista)>0){
		foreach ($lista as $valor) {
			echo ("	<div>
						<a href='infoAnuncio.php?idAnuncio=".$valor->id_an."'><img src='".$valor->foto_principal."'></a>
						<a href='infoAnuncio.php?idAnuncio=".$valor->id_an."'>".$valor->nombre."</a>			    
					</div>");
		}
	}
	else{
		echo ("	<div>
					<p>No has creado ningun anuncio!</p>			    
				</div>");
		}
?>