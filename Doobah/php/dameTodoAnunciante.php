<?php
		
		require_once ('php/usuario.php');
		
		function obtenerAnunciante(){
			$result = dameTodoAnunciante();
			if($result->num_rows != 0){
				$lista = array();
				while ($row = $result->fetch_row()){
					$anunciante = usuario::montaUsuario($row);
					array_push($lista, $anunciante);
				}
			return $lista;
			}
		}
		
		$lista = obtenerAnunciante();
		if (count($lista)>0){
		foreach ($lista as $valor) {
				//este perfil no es
				echo ("	<div>
						
						<a href='perfilUsuario.php?nick=".$valor->nick."'><img src='".$valor->avatar."'></a>
						<a href='perfilUsuario.php?nick=".$valor->nick."'>'".$valor->nick."'</a>		    
						</div>"
						);
									}
		}
		else{
				echo ("	<div>
						<p>Lista vacia</p>			    
						</div>");
			}
		
?>