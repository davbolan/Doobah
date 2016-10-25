<?php
define('DB_SERVER','localhost');
define('DB_USER','root');
define('DB_PASSWORD','');
define('DB_SCHEMA','doobah');

function conectarBD(){
	$connection = new mysqli(DB_SERVER,DB_USER,DB_PASSWORD,DB_SCHEMA);
	if (mysqli_connect_errno()) {
	  echo "Error en la conexión con la base de datos: " . mysqli_connect_error();
	  return null;
	}
	return $connection;
}
function desconectarDB($connection){
	$connection -> close();
}

/**********************************************************/
/* Funciones de acceso en modo lectura a la base de datos */
/**********************************************************/

// Recibimos un usuario a partir del correo o del nick

function dameUsuario($campo,$value){
	
	$query = "SELECT * FROM usuarios WHERE ".$campo." = '".$value."'";
	$connection = conectarBD();
	$result=null;
	$result = $connection -> query($query)
				or die ($connection->error." en la linea".(__LINE__-1));
	desconectarDB($connection);
	
	return $result;
}

function dameAnunciante($campo, $value){
	$query = "SELECT * FROM anunciante WHERE ".$campo." = '".$value."'";
	$connection = conectarBD();
	$result=null;
	$result = $connection -> query($query)
				or die ($connection->error." en la linea".(__LINE__-1));
	desconectarDB($connection);
	
	return $result;
	
}

function dameGrupos($nick){
	$query = "SELECT * FROM grupos where id_g in (SELECT id_g FROM pertenecer_grupo where nick = '".$nick."')";
	$connection =conectarBD();
	$result=null;
	$result = $connection -> query($query) or die ($connection->error." en la linea".(__LINE__-1));
	desconectarDB($connection);
	return $result;
}

function dameGrupos_act($IDActividad){
	$query = "SELECT * FROM grupos where id_g in (SELECT id_g FROM actividades where id_a = ".$IDActividad.")";
	$connection =conectarBD();
	$result=null;
	$result = $connection -> query($query) or die ($connection->error." en la linea".(__LINE__-1));
	desconectarDB($connection);
	return $result;
}

function dameGrupo($campo,$value){
	
	$query = "SELECT * FROM grupos WHERE ".$campo." = '".$value."'";
	$connection = conectarBD();
	$result=null;
	$result = $connection -> query($query)
				or die ($connection->error." en la linea".(__LINE__-1));
	desconectarDB($connection);
	
	return $result;
}

function dameActividad($campo,$value){
	
	$query = "SELECT * FROM actividades WHERE ".$campo." = '".$value."'";
	$connection = conectarBD();
	$result=null;
	$result = $connection -> query($query)
				or die ($connection->error." en la linea".(__LINE__-1));
	desconectarDB($connection);
	
	return $result;
}

function dameActividades($nick){
	$query = "SELECT * FROM actividades where id_a in (SELECT id_a FROM participar_actividad where nick = '".$nick."')";
	$connection =conectarBD();
	$result=null;
	$result = $connection -> query($query) or die ($connection->error." en la linea".(__LINE__-1));
	desconectarDB($connection);
	return $result;
}
function dameAnuncio($campo,$value){
	
	$query = "SELECT * FROM anuncios WHERE ".$campo." = '".$value."'";
	$connection = conectarBD();
	$result=null;
	$result = $connection -> query($query)
				or die ($connection->error." en la linea".(__LINE__-1));
	desconectarDB($connection);
	
	return $result;
}

function dameAnuncios($nick){
	$query = "SELECT * FROM anuncios where id_an in (SELECT id_an FROM publica_anuncio where nick = '".$nick."')";
	$connection =conectarBD();
	$result=null;
	$result = $connection -> query($query) or die ($connection->error." en la linea".(__LINE__-1));
	desconectarDB($connection);
	return $result;
}

//Devuelve una serie de grupos recomendados
function dameGrupoRec($nick){
	$query = "SELECT * FROM grupos where id_g NOT IN(SELECT id_g FROM pertenecer_grupo WHERE nick = '".$nick."' ) LIMIT 0, 10 ";
	$connection =conectarBD();
	$result=null;
	$result = $connection -> query($query) or die ($connection->error." en la linea".(__LINE__-1));
	desconectarDB($connection);
	return $result;
}
function dameUsuariosGrupo($IDGrupo){
	//$query = "SELECT * from usuarios u, pertenecer_grupo WHERE u.nick IN (SELECT nick FROM pertenecer_grupo WHERE id_g=".$IDGrupo.") GROUP BY u.nick";
	$query = "SELECT * from usuarios u, pertenecer_grupo p WHERE u.nick IN (SELECT nick FROM pertenecer_grupo WHERE id_g=".$IDGrupo.") AND id_g=".$IDGrupo." GROUP BY u.nick, id_g";
	$connection =conectarBD();
	$result=null;
	$result = $connection -> query($query) or die ($connection->error." en la linea".(__LINE__-1));
	desconectarDB($connection);
	return $result;
}
function dameParticipantesActividad($IDActividad){
	$query = "SELECT * from usuarios WHERE nick IN (SELECT nick FROM participar_actividad WHERE id_a=" .$IDActividad.")";
	$connection =conectarBD();
	$result=null;
	$result = $connection -> query($query) or die ($connection->error." en la linea".(__LINE__-1));
	desconectarDB($connection);
	return $result;
}
function dameActividadesGrupo($IDGrupo){
	$fecha = date('Y-m-d');
	$newdate = strtotime(str_replace('/', '-', $fecha));
	$query = "SELECT * from actividades WHERE id_a IN (SELECT id_a FROM participar_actividad WHERE id_g=" .$IDGrupo.") AND fecha_actividad>='".$fecha."'";
	$connection =conectarBD();
	$result=null;
	$result = $connection -> query($query) or die ($connection->error." en la linea".(__LINE__-1));
	desconectarDB($connection);
	return $result;
}
function dameComentarios($IDActividad){
	$query = "SELECT * from comentar_actividad WHERE id_a=" .$IDActividad."";
	$connection =conectarBD();
	$result=null;
	$result = $connection -> query($query) or die ($connection->error." en la linea".(__LINE__-1));
	desconectarDB($connection);
	return $result;
}
function dameComentariosAnuncio($IDAnuncio){
	$query = "SELECT * from comentar_anuncio WHERE id_an=" .$IDAnuncio."";
	$connection =conectarBD();
	$result=null;
	$result = $connection -> query($query) or die ($connection->error." en la linea".(__LINE__-1));
	desconectarDB($connection);
	return $result;
}
// Devuelve el id de un grupo
function dame_IDG($nombre){
	$query = "SELECT DISTINCT id_g FROM grupos WHERE nombre='".$nombre."'";
	$connection =conectarBD();
	$result = $connection -> query($query)
					or die ($connection->error." en la linea".(__LINE__-1));
	desconectarDB($connection);
	return $result;
}
// Devuelve el id de una actividad
function dame_IDA($nombre){
	$query = "SELECT DISTINCT id_a FROM actividades WHERE nombre='".$nombre."'";
	$connection =conectarBD();
	$result = $connection -> query($query)
					or die ($connection->error." en la linea".(__LINE__-1));
	desconectarDB($connection);
	return $result;
}
// Devuelve el id de un anuncio
function dame_IDAN($nombre){
	$query = "SELECT DISTINCT id_an FROM anuncios WHERE nombre='".$nombre."'";
	$connection =conectarBD();
	$result = $connection -> query($query)
					or die ($connection->error." en la linea".(__LINE__-1));
	desconectarDB($connection);
	return $result;
}
// Devuelve todas las taxonomías
function dameTaxonomias($id_g){
	if ($id_g == -1 || $id_g == null){
		$query = "SELECT * FROM taxonomia";
	}
	else {
		$query = "SELECT * FROM grupos WHERE id_g=".$id_g;
	}
	$connection =conectarBD();
	$result = $connection -> query($query)
					or die ($connection->error." en la linea".(__LINE__-1));
	desconectarDB($connection);
	return $result;
}
function dameTaxonomiasAnuncio($id_an){
	if ($id_an == -1 || $id_an == null){
		$query = "SELECT * FROM taxonomia";
	}
	else {
		$query = "SELECT * FROM anuncios WHERE id_an=".$id_an;
	}
	$connection =conectarBD();
	$result = $connection -> query($query)
					or die ($connection->error." en la linea".(__LINE__-1));
	desconectarDB($connection);
	return $result;
}
// Devuelve las subtaxonomias de una determinada taxonomia
function dameSubtaxonomia($taxo){
	$query = "SELECT * FROM subtaxonomia WHERE id_s IN(SELECT id_s from relacion_taxonomia WHERE id_t IN(SELECT id_t FROM taxonomia WHERE taxo='".$taxo."'))";
	$connection =conectarBD();
	$result = $connection -> query($query)
					or die ($connection->error." en la linea".(__LINE__-1));
	desconectarDB($connection);
	return $result;
}
function busqueda_porNombre($nombre){
	$query = "SELECT * FROM usuarios WHERE nick LIKE '%".$nombre."%' OR nombreCompleto LIKE '%".$nombre."%'";
	$connection =conectarBD();
	$result = $connection -> query($query)
					or die ($connection->error." en la linea".(__LINE__-1));
	desconectarDB($connection);
	return $result;
}
function busqueda_porGrupo($tipo,$taxonomia,$subtaxonomia,$cantidad){
	if ($cantidad == "01-10"){
		$query = "SELECT * FROM grupos WHERE taxonomia='".$taxonomia."' AND subtaxonomia='".$subtaxonomia."' AND privado='".$tipo."' AND id_g IN (SELECT id_g FROM pertenecer_grupo group by id_g HAVING count(*)<11 and count(*)>0)";
	}
	else if ($cantidad == "11-20"){
		$query = "SELECT * FROM grupos WHERE taxonomia='".$taxonomia."' AND subtaxonomia='".$subtaxonomia."' AND privado='".$tipo."' AND id_g IN (SELECT id_g FROM pertenecer_grupo group by id_g HAVING count(*)<21 and count(*)>10)";
	}
	else if ($cantidad == "21-30"){
		$query = "SELECT * FROM grupos WHERE taxonomia='".$taxonomia."' AND subtaxonomia='".$subtaxonomia."' AND privado='".$tipo."' AND id_g IN (SELECT id_g FROM pertenecer_grupo group by id_g HAVING count(*)<31 and count(*)>20)";
	}
	else if ($cantidad == "31-40"){
		$query = "SELECT * FROM grupos WHERE taxonomia='".$taxonomia."' AND subtaxonomia='".$subtaxonomia."' AND privado='".$tipo."' AND id_g IN (SELECT id_g FROM pertenecer_grupo group by id_g HAVING count(*)<41 and count(*)>30)";
	}
	else if ($cantidad == "41-50"){
		$query = "SELECT * FROM grupos WHERE taxonomia='".$taxonomia."' AND subtaxonomia='".$subtaxonomia."' AND privado='".$tipo."' AND id_g IN (SELECT id_g FROM pertenecer_grupo group by id_g HAVING count(*)<51 and count(*)>40)";
	}
	else {
		$query = "SELECT * FROM grupos WHERE taxonomia='".$taxonomia."' AND subtaxonomia='".$subtaxonomia."' AND privado='".$tipo."'";
	}
	$connection =conectarBD();
	$result = $connection -> query($query)
					or die ($connection->error." en la linea".(__LINE__-1));
	desconectarDB($connection);
	return $result;
}
function busqueda_Simple($tipo,$nombre){
	if ($tipo=="usuarios"){
		$query = "SELECT * FROM ".$tipo." WHERE nick LIKE '%".$nombre."%' OR nombreCompleto LIKE '%".$nombre."%'";
	}
	else {
		$query = "SELECT * FROM ".$tipo." WHERE nombre LIKE '%".$nombre."%'";
	}
	$connection =conectarBD();
	$result = $connection -> query($query)
					or die ($connection->error." en la linea".(__LINE__-1));
	desconectarDB($connection);
	return $result;
}
function dameAdminGrupo($idGrupo){
	$es_admin = 1;
	$query = "SELECT nick FROM pertenecer_grupo WHERE id_g=".$idGrupo." AND es_admin='".$es_admin."'";
	$connection =conectarBD();
	$result = $connection -> query($query)
					or die ($connection->error." en la linea".(__LINE__-1));
	desconectarDB($connection);
	return $result;
}
function dameAdminActividad($idActividad){
	$es_admin = 1;
	$query = "SELECT nick FROM participar_actividad WHERE id_a=".$idActividad." AND es_admin='".$es_admin."'";
	$connection =conectarBD();
	$result = $connection -> query($query)
					or die ($connection->error." en la linea".(__LINE__-1));
	desconectarDB($connection);
	return $result;
}
/***************************************************************/
/* Funciones de acceso en modo modificación a la base de datos */
/***************************************************************/

function creaUsuario($usuario){
	$nick = $usuario -> nick;
	$password = $usuario -> password;
	$email = $usuario -> email;
	$tipo = $usuario -> tipo;
	$salt = $usuario -> salt;
	$avatar   = $usuario -> avatar;
	
	$query = "INSERT INTO usuarios (nick,password,fecha_nac,nombreCompleto,tipo,descripcion,avatar,ciudad,email,salt) 
			 VALUES ('".$nick."', '".$password."', null, null, '".$tipo."' ,null, '".$avatar."', null,'".$email."','".$salt."')";
	$connection = conectarBD();
	$connection -> query($query)
					or die ($connection->error. " en la línea ".(__LINE__-1));
	desconectarDB($connection);
}

function creaAnunciante($Anunciante){
	$nick = $Anunciante -> nick;
	$fecha_alta = $Anunciante -> fecha_alta;
	$cif = $Anunciante-> cif;
	
	$query = "INSERT INTO anunciante (nick,fecha_alta,cif) VALUES ('".$nick."','".$fecha_alta."','".$cif."')";
	
	$connection = conectarBD();
	$connection -> query($query)
					or die ($connection->error." en la linea ".(__LINE__-1));
	desconectarDB($connection);

}
function creaAnuncio($Anuncio,$nick){	
	$nombre = $Anuncio -> nombre;
	$fecha_evento = $Anuncio -> fecha_evento;
	$lugar = $Anuncio -> lugar;
	$descripcion = $Anuncio -> descripcion;
	$taxonomia = $Anuncio -> taxonomia;
	$subtaxonomia = $Anuncio -> subtaxonomia;
	$foto_principal = $Anuncio -> foto_principal;
	
	$query = "INSERT INTO anuncios (nombre,fecha_evento,lugar,descripcion,taxonomia,subtaxonomia,foto_principal) VALUES ('".$nombre."','".$fecha_evento."','".$lugar."','".$descripcion."','".$taxonomia."','".$subtaxonomia."','".$foto_principal."')";
	
	$connection = conectarBD();
	$connection -> query($query)
					or die ($connection->error." en la linea ".(__LINE__-1));
	desconectarDB($connection);
	$IDAN = dame_IDAN($nombre);
	$id_an = $IDAN->fetch_row();
	insertar_a_publicar($id_an[0],$nick);
}

function creaGrupo($Grupo, $nick){
	$nombre = $Grupo -> nombre;
	$ciudad = $Grupo -> ciudad;
	$privado = $Grupo -> privado;
	$taxonomia = $Grupo -> taxonomia;
	$subtaxonomia = $Grupo -> subtaxonomia;
	$foto_principal = $Grupo -> foto_principal;
	$descripcion = $Grupo -> descripcion;
	$query = "INSERT INTO grupos (nombre,ciudad,privado,taxonomia,subtaxonomia,foto_principal,descripcion) 
			  VALUES ('".$nombre."','".$ciudad."','".$privado."','".$taxonomia."','".$subtaxonomia."','".$foto_principal."','".$descripcion."')";
	
	$connection = conectarBD();
	$connection -> query($query)
					or die ($connection->error." en la linea".(__LINE__-1));
	desconectarDB($connection);
	$IDG = dame_IDG($nombre);
	$id_g = $IDG->fetch_row();
	insertar_a_grupo($id_g[0],$nick,1);
}
// La actividad puede ser creada por un usuario individual o
// por un usuario desde un grupo. Si IDG es null, será por un usuario individual
function creaActividad($Actividad, $nick, $IDG){
	$nombre = $Actividad -> nombre;
	$fecha_actividad = $Actividad -> fecha_actividad;
	$lugar = $Actividad -> lugar;
	$foto_principal = $Actividad -> foto_principal;
	$descripcion = $Actividad -> descripcion;
	$id_g = $IDG;
	$query = "INSERT INTO actividades (nombre,fecha_actividad,lugar,foto_principal,descripcion,id_g) 
			  VALUES ('".$nombre."','".$fecha_actividad."','".$lugar."','".$foto_principal."','".$descripcion."','".$id_g."')";
	
	$connection = conectarBD();
	$connection -> query($query)
					or die ($connection->error." en la linea".(__LINE__-1));
	desconectarDB($connection);
	$IDA = dame_IDA($nombre);
	$id_a = $IDA->fetch_row();
	insertar_a_actividades($id_a[0],$nick);
}
//mete el anuncio creado en la relacion publica_anuncio
function insertar_a_publicar($id_an,$nick){
	$fecha_publica = getDate();
	$query = "INSERT INTO publica_anuncio(nick,id_an,fecha_publica) VALUES('".$nick."', ".$id_an.",'".$fecha_publica."')";
	$connection = conectarBD();
	$connection -> query($query)
					or die ($connection->error." en la linea".(__LINE__-1));
	desconectarDB($connection);
}
//mete el grupo creado en la relacion pertenecer_grupo
function insertar_a_grupo($id_g,$nick,$value_admin){
	$query = "INSERT INTO pertenecer_grupo(nick,id_g,es_admin) VALUES('".$nick."', ".$id_g.",".$value_admin.")";
	$connection = conectarBD();
	$connection -> query($query)
					or die ($connection->error." en la linea".(__LINE__-1));
	desconectarDB($connection);
}
//mete la actividad creada por un usuario en la relacion participar_actividad
function insertar_a_actividades($id_a,$nick){
	$value_admin=1;
	$query = "INSERT INTO participar_actividad(nick,id_a,es_admin) VALUES('".$nick."', ".$id_a.",".$value_admin.")";
	$connection = conectarBD();
	$connection -> query($query)
					or die ($connection->error." en la linea".(__LINE__-1));
	desconectarDB($connection);
}
function modificarUsuario($Usuario){
	
	$nick = $Usuario -> nick;
	$password = $Usuario -> password;
	$fecha_nac = $Usuario -> fecha_nac;
	$nombreCompleto = $Usuario -> nombreCompleto;
	$tipo = $Usuario -> tipo;
	$descripcion = $Usuario -> descripcion;
	$avatar = $Usuario -> avatar;
	$ciudad = $Usuario -> ciudad;
	$email = $Usuario -> email;
	$salt = $Usuario -> salt;
	
	$query= "UPDATE usuarios SET nick='".$nick."',password='".$password."',fecha_nac='".$fecha_nac."',nombreCompleto='".$nombreCompleto."',tipo='".$tipo."',descripcion='".$descripcion."',
			avatar='".$avatar."',ciudad='".$ciudad."',email='".$email."',salt='".$salt."' WHERE nick='".$nick."' ";
	
	$connection = conectarBD();
	$connection -> query($query)
					or die ($connection->error." en la linea".(__LINE__-1));
	desconectarDB($connection);
}
function modificarActividad($actividad){
	$id_a = $actividad -> id_a;
	$nombre = $actividad -> nombre;
	$fecha_actividad = $actividad -> fecha_actividad;
	$ciudad = $actividad -> lugar;
	$taxonomia = $actividad -> taxonomia;
	$subtaxonomia = $actividad -> subtaxonomia;
	$foto_principal = $actividad -> foto_principal;
	$descripcion = $actividad -> descripcion;
	
	$query="UPDATE actividades SET nombre='".$nombre."' ,fecha_actividad='".$fecha_actividad."' ,lugar='".$ciudad."',taxonomia='".$taxonomia."',subtaxonomia='".$subtaxonomia."',foto_principal='".$foto_principal."',descripcion='".$descripcion."' WHERE id_a =".$id_a ;
	
	$connection = conectarBD();
	$connection -> query($query)
					or die ($connection->error." en la linea".(__LINE__-1));
	desconectarDB($connection);
}

function modificarAnuncio($anuncio){
	$id_an = $anuncio -> id_an;
	$nombre = $anuncio -> nombre;
	$fecha_evento = $anuncio -> fecha_evento;
	$ciudad = $anuncio -> lugar;
	$descripcion = $anuncio -> descripcion;
	$taxonomia = $anuncio -> taxonomia;
	$subtaxonomia = $anuncio -> subtaxonomia;
	$foto_principal = $anuncio -> foto_principal;
	
	
	$query="UPDATE anuncios SET nombre='".$nombre."',fecha_evento='".$fecha_evento."',lugar='".$ciudad."',descripcion='".$descripcion."' ,taxonomia='".$taxonomia."',subtaxonomia='".$subtaxonomia."',foto_principal='".$foto_principal."' WHERE id_an =".$id_an ;
	
	$connection = conectarBD();
	$connection -> query($query)
					or die ($connection->error." en la linea".(__LINE__-1));
	desconectarDB($connection);
}

function modificarAnunciante($Anunciante){

	$nick = $Anunciante -> nick;
	$fecha_alta = $Anunciante -> fecha_alta;
	$cif = $Anunciante -> cif;
	
	$query ="UPDATE anunciante SET cif= '".$cif."' WHERE nick='".$nick."'";
	$connection = conectarBD();
	$connection -> query($query)
					or die ($connection->error." en la linea".(__LINE__-1));
	desconectarDB($connection);
}
function modificarGrupo($Grupo){
	$id_g = $Grupo -> id_g;
	$nombre = $Grupo -> nombre;
	$ciudad = $Grupo -> ciudad;
	$privado = $Grupo -> privado;
	$taxonomia = $Grupo -> taxonomia;
	$subtaxonomia = $Grupo -> subtaxonomia;
	$foto_principal = $Grupo -> foto_principal;
	$descripcion = $Grupo -> descripcion;
	
	$query="UPDATE grupos SET nombre='".$nombre."',ciudad='".$ciudad."',privado='".$privado."',taxonomia='".$taxonomia."',subtaxonomia='".$subtaxonomia."',foto_principal='".$foto_principal."',descripcion='".$descripcion."' WHERE id_g =".$id_g ;
	
	$connection = conectarBD();
	$connection -> query($query)
					or die ($connection->error." en la linea".(__LINE__-1));
	desconectarDB($connection);
}
function dejarGrupo($IDGrupo,$nick){
	$value_admin=1;
	$query ="DELETE FROM pertenecer_grupo WHERE nick='".$nick."' AND id_g=".$IDGrupo." ";
	//$query .="UPDATE pertenecer_grupo SET es_admin=".$value_admin." WHERE id_g=".$IDGrupo." LIMIT 0,1";
	$connection = conectarBD();
	$connection -> multi_query($query)
					or die ($connection->error." en la linea".(__LINE__-1));
	desconectarDB($connection);
	ECHO ("usuario abandona grupo");
	
}
function dejarActividad($IDActividad, $nick){
	
	$value_admin=1;
	$query = "DELETE FROM participar_actividad WHERE nick='".$nick."'AND id_a=".$IDActividad."";
	//$query .="UPDATE participar_actividad SET es_admin=".$value_admin." WHERE id_a=".$IDGrupo." LIMIT 0,1";
	
	$connection = conectarBD();
	$connection -> multi_query($query)
					or die ($connection->error." en la linea".(__LINE__-1));
	desconectarDB($connection);
	ECHO ("usuario abandona actividad");
	
}
function entrarEnGrupo($IDGrupo,$nick){

	$value_admin = 0;
	$query = "INSERT INTO pertenecer_grupo(nick,id_g,es_admin) VALUES ('".$nick."','".$IDGrupo."',".$value_admin.") ";
	$connection = conectarBD();
	$connection -> query($query)
					or die ($connection->error." en la linea".(__LINE__-1));
	desconectarDB($connection);

}

function entrarActividad($IDActividad,$nick){

	$value_admin = 0;
	$query = "INSERT INTO participar_actividad(nick,id_a,es_admin) VALUES ('".$nick."','".$IDActividad."',".$value_admin.") ";
	$connection = conectarBD();
	$connection -> query($query)
					or die ($connection->error." en la linea".(__LINE__-1));
	desconectarDB($connection);
}
function anadirComentario($IDActividad,$nick,$comentario){
	
	$fecha = date("Y-m-d H:i:s");
	$newdate = strtotime(str_replace('/', '-', $fecha));

	$query = "INSERT INTO comentar_actividad(nick,id_a,comentario,fecha_comenta)VALUES ('".$nick."','".$IDActividad."','".$comentario."','".$fecha."')";
	$connection = conectarBD();
	$connection -> query($query)
					or die ($connection->error." en la linea".(__LINE__-1));
	desconectarDB($connection);
}
function anadirComentarioAnuncio($IDAnuncio,$nick,$comentario){
	
	$fecha = date("Y-m-d H:i:s");
	$newdate = strtotime(str_replace('/', '-', $fecha));

	$query = "INSERT INTO comentar_anuncio(nick,id_an,comentario,fecha_comenta)VALUES ('".$nick."','".$IDAnuncio."','".$comentario."','".$fecha."')";
	$connection = conectarBD();
	$connection -> query($query)
					or die ($connection->error." en la linea".(__LINE__-1));
	desconectarDB($connection);
}

/*************admin***********/

function dameTodoUsuarios(){
	$query = "SELECT * FROM usuarios";
	$connection =conectarBD();
	$result=null;
	$result = $connection -> query($query) or die ($connection->error." en la linea".(__LINE__-1));
	desconectarDB($connection);
	return $result;
}

function dameTodoGrupos(){
	$query = "SELECT * FROM grupos";
	$connection =conectarBD();
	$result=null;
	$result = $connection -> query($query) or die ($connection->error." en la linea".(__LINE__-1));
	desconectarDB($connection);
	return $result;
}

function dameTodoActividades(){
	$query = "SELECT * FROM actividades";
	$connection =conectarBD();
	$result=null;
	$result = $connection -> query($query) or die ($connection->error." en la linea".(__LINE__-1));
	desconectarDB($connection);
	return $result;
}

function dameTodoAnunciante(){
	$query = "SELECT * FROM usuarios where tipo='anunciante'";
	$connection =conectarBD();
	$result=null;
	$result = $connection -> query($query) or die ($connection->error." en la linea".(__LINE__-1));
	desconectarDB($connection);
	return $result;
}
function eliminarGrupo($IDG){
	$query = "DELETE FROM grupos WHERE id_g = '".$IDG."'";
	$connection =conectarBD();
	$result=null;
	$result = $connection -> query($query) or die ($connection->error." en la linea".(__LINE__-1));
	desconectarDB($connection);
	return $result;
}

function eliminarActividad($IDA){
	$query = "DELETE FROM actividades WHERE id_a = '".$IDA."'";
	$connection =conectarBD();
	$result=null;
	$result = $connection -> query($query) or die ($connection->error." en la linea".(__LINE__-1));
	desconectarDB($connection);
	return $result;
}

?>