<header>
	<div id="cabecera" >
		<img class="fotocolor" 	src="img/header/colorR.jpg">
		<img class="fotogr" 	src="img/header/p2.jpg">
		<img class="fotogr" 	src="img/header/p1.jpg">
		<img class="fotocolor" 	src="img/header/colorO.jpg">
		<img class="fotogr" 	src="img/header/p3.jpg">
		<img class="fotocolor" 	src="img/header/colorV.jpg">
		<img class="fotocolor" 	src="img/header/colorR.jpg">
		<img class="fotogr" 	src="img/header/p7.jpg">
		<img class="fotocolor" 	src="img/header/colorG.jpg">
		<img class="fotogr" 	src="img/header/p4.jpg">
		<img class="fotocolor" 	src="img/header/colorA.jpg">
		<img class="fotogr" 	src="img/header/p5.jpg">
		<img class="fotocolor" 	src="img/header/colorV.jpg">
		<img class="fotogr" 	src="img/header/p6.jpg">
		<img class="fotogr" 	src="img/header/p3.jpg">				
	</div>
	
	<div id="logo">
		<?php
			echo("<a href=".$_SESSION['main_page']."><img src='img/logoDoobah.png'></a>");			
		?>
	</div>	
	
	<div id="busqueda">
	<form action="./php/procesarBusqueda.php" method="post" name="RegisterForm">
		<div id="lupa">
			<input type="text" id="search" name="search" placeholder="Buscar en Doobah!">
			<input type="submit" name="" value="" title="Buscar">
		</div>
		<p id="avanzada">Búsqueda Avanzada</p>
	</form>
	</div>
	
	<div id="usuario">
		<?php
			$avatar = $_SESSION['avatar'];
			$nick = $_SESSION['nick'];
			echo("<a href='perfil.php'><img src=$avatar></a>");
			echo("<p><a id='nombre' href='perfil.php'>$nick</a></p>");
		?>
		<p><a id="sesion" href="php/procesarLogout.php">Cerrar Sesión</a></p>
	</div>
</header>