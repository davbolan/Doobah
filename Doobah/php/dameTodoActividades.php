<?php
		
		require_once ('php/actividad.php');
		
		
		function obtenerActividades(){
			$result = dameTodoActividades();
			if($result->num_rows != 0){
				$lista = array();
				while ($row = $result->fetch_row()){
					$actividades = actividad::montaActividades($row);
					array_push($lista, $actividades);
				}
			return $lista;
			}
		}
		
		$lista = obtenerActividades();
		if (count($lista)>0){
		foreach ($lista as $valor) {
				echo ("	<div>
						<a href='infoActividad.php?idActividad=".$valor->id_a."'><img src='".$valor->foto_principal."'></a>
						<a href='infoActividad.php?idActividad=".$valor->id_a."'>'".$valor->nombre."'</a>			    
						</div>");
									}
		}
		else{
				echo ("	<div>
						<p>Lista vacia</p>			    
						</div>");
			}
		
?>