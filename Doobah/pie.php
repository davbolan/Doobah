<footer id="pieDePagina">
	<div id="pieIzq">	
		<?php
			$url = "inicio.php";
			 switch($_SESSION["tipo"]){
				case "anunciante":
						$url = "inicioAnunciante.php";
						break;
				case "registrado":		
					   $url = "inicio.php";
						break;
				case "administrador":		
					    $url = "inicioAdmin.php";
						break;
				}		
			echo("<a id='logoFooter' href=$url><img src='img/logoDoobah.png' alt='Pagina principal' name='logoDobah' width='180' id='logo'/></a>");			
		?>	
	</div>
	
	<div id="pieDer">
		<div id="filaEnlaces">
			<ul id="enlaces">
				<li><a class="linksFooter" href="inicio.php"> Doobah.com </a></li>
				<li><p id="nosotros" class="linksFooter"> Sobre nosotros </p></li>
				<li><p id="contacto" class="linksFooter"> Contacto </p></li>
				<li><p id="policy" class="linksFooter"> Política de Cookies </p></li>
			</ul>
		</div>
		
		<div id="filaInfo">
			©2015 Todos los derechos reservados
		</div>
		
		<div id="filaRedesSociales">
			<a class="iconoRedSocial" id="link_yt" href="https://www.youtube.com/Doobah"  target="_blank"><img alt="youtube"  src="./icons/youtube-icon-24.png" /></a>
			<a class="iconoRedSocial" id="link_fb" href="https://www.facebook.com/Doobah" target="_blank"><img alt="facebook" src="./icons/fb-icon-24.png" /></a>
			<a class="iconoRedSocial" id="link_tw" href="https://twitter.com/Doobah"      target="_blank"><img alt="twitter"  src="./icons/twitter-icon-24.png" /></a>
		</div>
	</div>
</footer>