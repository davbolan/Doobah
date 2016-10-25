<?php
		
		require_once('php/grupo.php');
		
		
		function obtenerGrupos(){
			$result = dameTodoGrupos();
			if($result->num_rows != 0){
				$lista = array();
				while ($row = $result->fetch_row()){
					$grupo = grupo::montaGrupo($row);
					array_push($lista, $grupo);
				}
			return $lista;
			}
		}
		
		
		$lista = obtenerGrupos();
		if (count($lista)>0){
		foreach ($lista as $valor) {
				echo ("	<div>
						<a href='infoGrupo.php?idGrupo=".$valor->id_g."'><img src='".$valor->foto_principal."'></a>
						<a href='infoGrupo.php?idGrupo=".$valor->id_g."'>'".$valor->nombre."'</a>			    
						</div>");
									}
		}
		else{
				echo ("	<div>
						<p>Lista vacia</p>			    
						</div>");
			}
		
?>