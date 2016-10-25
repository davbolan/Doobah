<?php

	require_once('DAO_General.php');
if (isset($_GET['idGrupo'])) {
	echo "idGrupo";
	$id_g = $_REQUEST['idGrupo'];
	if ($id_g == "null"){
		$lista = dameTaxonomias(-1);
		if (count($lista)>0){
		foreach ($lista as $valor) {
			echo utf8_encode("<option value=".$valor['taxo'].">".$valor['taxo']."</option>");
		}
	}
	}
	else {
	$lista = dameTaxonomias($id_g);
	if (count($lista)>0){
		foreach ($lista as $valor) {
			echo utf8_encode("<option value=".$valor['taxonomia'].">".$valor['taxonomia']."</option>");
		}
	}
	}
}

else if (isset($_GET['idAnuncio'])) {//if ($id_an = $_REQUEST['idAnuncio']){
	echo "idAnuncio";
	$id_an = $_REQUEST['idAnuncio'];
	if ($id_an == "null"){
		$lista = dameTaxonomiasAnuncio(-1);
		if (count($lista)>0){
		foreach ($lista as $valor) {
			echo utf8_encode("<option value=".$valor['taxo'].">".$valor['taxo']."</option>");
		}
	}
	}
	else {
	$lista = dameTaxonomiasAnuncio($id_an);
	if (count($lista)>0){
		foreach ($lista as $valor) {
			echo utf8_encode("<option value=".$valor['taxonomia'].">".$valor['taxonomia']."</option>");
		}
	}
	}
}

else{
	echo "NAH";
	$lista = dameTaxonomias(-1);
		if (count($lista)>0){
		foreach ($lista as $valor) {
			echo utf8_encode("<option value=".$valor['taxo'].">".$valor['taxo']."</option>");
		}
	}
}


?>