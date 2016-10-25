<fieldset id="fieldsetPopup"> <legend>Contacto</legend>
	<form action="" enctype="text/plain" method="post" name="form1" class="centrado" id="formContacto">
		<label class="titulos">Nombre</label>
		<input id="nombre" class="nombreC" type="text" name="Nombre" /> 
		<label class="titulos"> Email</label>
		<input id="email" class="emailC" type="text" name="email" />			
		<div id="motivos">
			<input type='hidden' name='<?php echo("http://".$_SERVER['HTTP_HOST'].':'.$_SERVER['SERVER_PORT'].$_SERVER['REQUEST_URI']);?>'>
			<label class="titulos">Motivo de contacto:</label>
			<div>
				<input name="motivo_consulta" type="radio" id="motivo_sugerencia" value="Sugerencia" checked="checked">Sugerencia
			</div>
			<div>
				<input name="motivo_consulta" type="radio" id="motivo_evaluacion" value="Evaluacion">Evaluación
			</div>
			<div>
				<input name="motivo_consulta" type="radio" id="motivo_critica" value="Critica" >Crítica
			</div>
			<div>
				<input name="motivo_consulta" type="radio" id="consulta" value="´Consulta" >Consulta			
			</div>
		</div>
						
		<label for="opinion" class="titulos">Escriba aquí su consulta.</label>					
		<textarea  id="opinion" class="messageC" name="message" rows="7" cols="45"></textarea>		 
		<label hidden id ='labelError' class='msgError'></br></label>	
		<input type="submit" class="boton-azul" id="enviarConsulta" name="enviar" value="Enviar consulta">		 
	</form>
</fieldset>
