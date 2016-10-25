<?php

	require_once('./php/actividad.php');

	
$lista = Actividad::obtenerActividadesUsuario($_SESSION['nick']);
						if (count($lista)>0){
							foreach ($lista as $valor) {
								echo ("	<div>
											<a href='infoActividad.php?idActividad=".$valor->id_a."'><img src='".$valor->foto_principal."'></a>
											<a href='infoActividad.php?idActividad=".$valor->id_a."'>".$valor->nombre."</a>			    
										</div>");
							}
						}
						else{
							echo ("	<div>
										<p>No estás apuntado a ninguna actividad!</p>			    
									</div>");
						}
?>