<?php
		
		require_once ('php/usuario.php');
		
		
		function obtenerUsuarios(){
			$result = dameTodoUsuarios();
			if($result->num_rows != 0){
				$lista = array();
				while ($row = $result->fetch_row()){
					$usuarios = usuario::montaUsuario($row);
					array_push($lista, $usuarios);
				}
			return $lista;
			}
		}
		
		$lista = obtenerUsuarios();
		if (count($lista)>0){
		foreach ($lista as $valor) {
				echo ("	<div>
						<a href='perfilUsuario.php?nick=".$valor->nick."'><img src='".$valor->avatar."'></a>
						<a href='perfilUsuario.php?nick=".$valor->nick."'>'".$valor->nombreCompleto."'</a>
						
						</div>");
									}
		}
		else{
				echo ("	<div>
						<p>Lista vacia</p>			    
						</div>");
			}
		
?>