
<fieldset id="fieldsetPopup"> <legend>Búsqueda avanzada</legend>
	<script src="http://code.jquery.com/jquery-latest.js"></script>
	<script type="text/javascript" src="js/selects.js"></script>
	<div id="busquedaAvanzada">
	<form action="./php/procesarBusquedaAV.php" method="post" name="RegisterForm">
		<input type="radio" id="porNombre" name="tipoBusqueda" value="nombre" checked>
		<label for="porNombre" class="titulos-grandes" >Búsqueda de usuarios</label>											
		<div class="opciones" id="buscarPorNombre"><input class="texto" id="campoNombre"  type="text" name="Nombre"/></div>
																		
		<input type="radio" id="porTipo" name="tipoBusqueda" value="grupo">
		<label for="porGrupo" class="titulos-grandes">Búsqueda de grupos </label>											
		<div class="opciones" id="buscarPorTipo">												
								<!-- Con javascript se ocultaria y mostrarian campos según el tipo de búsqueda elegida-->
								
								<!-- Privacidad-->
			<div id="privacidad" class="apartados">
				<label id="labelPrivacidad" class="titulos">Privacidad del grupo:</label>
				<div>
					<input type="radio" id="radioPublico" name="tipoPrivacidad" value="publico" checked>
					<label for="radioPublico">Público</label>
				</div>
				<div>
					<input type="radio" id="radioPrivado" name="tipoPrivacidad" value="privado">
					<label for="radioPrivado">Privado</label>
				</div>
			</div>							

								<!-- Temática-->						
			<div id="tematica" class="apartados">
				<label id="labelTematica"  class="titulos" for="tematica">Tematica</label>
				<div>
					<label>Temática:</label>
					<select name="tema" id="tema">
						<option value="default">Seleccione un tema</option>
							<?php
								include("./php/dameTaxonomias.php");
							?>
					</select>
					<select name="taxonomia" id="taxonomia" disabled>
					</select>
				</div>
			</div>								
								
								<!-- Integrantes-->
			<div id="integrantes" class="apartados">
				<label for="numIntegrantes" class="titulos">Número de integrantes:</label>
				<div>
					<select id="numIntegrantes" class="taxonomias" name="cantidad">
						<option value="daIgual">Me da igual</option>
						<option value="01-10">Entre 1 y 10</option>
						<option value="11-20">Entre 11 y 20</option>
						<option value="21-30">Entre 21 y 30</option>
						<option value="31-40">Entre 31 y 40</option>
						<option value="41-50">Entre 41 y 50</option>									
					</select>
				</div>
			</div>							
		</div>
		<input class="boton-azul" name="find" type="submit" value="Buscar" id="realizarBusqueda">
	</form>
	</div>
</fieldset>
			