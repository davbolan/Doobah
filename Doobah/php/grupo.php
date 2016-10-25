<?php 
	require_once "DAO_General.php";
	require_once "usuario.php";
	
	if(isset($_GET["funcion"])){
		$funcion = $_GET["funcion"];
		
		if($funcion == "existeGrupo"){
			if(isset($_GET["param1"])){
				 echo(existeGrupo("nombre" ,$_GET["param1"]));
			}
		}	
	}
	
	
	function existeGrupo($campo, $valor){
		$result = dameGrupo($campo, $valor);	
		$disponibilidad  = ($result->num_rows == 0) ? "disponible":"existe";	
		return $disponibilidad;
	}
	
	
	
	class Grupo {

		private $id_g;
		private $nombre;
		private $ciudad;
		private $privado;
		private $taxonomia;
		private $subtaxonomia;
		private $foto_principal;
		private $descripcion;

				
		public function __construct(){
			// Esta es la estructura si necesitamos tener varias "contructoras". 
			$arguments = func_get_args();
			$num = sizeof($arguments);
			
			switch($num){
				case 0;
					break;
				case 1:
					$this->id_g 			= $arguments[0];
					break;
				case 2:
					$this->id_g 			= $arguments[0];
					$this->nombre 			= $arguments[1];
					break;			
				case 5:
					$this->nombre 			= $arguments[0];
					$this->ciudad		 	= $arguments[1];
					$this->privado 			= $arguments[2];
					$this->foto_principal 	= $arguments[3];
					$this->descripcion 		= $arguments[4];				
					
					break;
				case 7:
					$this->nombre 			= $arguments[0];
					$this->ciudad		 	= $arguments[1];
					$this->privado 			= $arguments[2];
					$this->taxonomia		= $arguments[3];
					$this->subtaxonomia 	= $arguments[4];
					$this->foto_principal 	= $arguments[5];
					$this->descripcion 		= $arguments[6];
					break;
				case 8:
					$this->id_g 			= $arguments[0];
					$this->nombre 			= $arguments[1];
					$this->ciudad		 	= $arguments[2];
					$this->privado 			= $arguments[3];
					$this->taxonomia		= $arguments[4];
					$this->subtaxonomia 	= $arguments[5];
					$this->foto_principal 	= $arguments[6];
					$this->descripcion 		= $arguments[7];
				default:
					break;
			}
		}
		
		
		public function __get($property){
			if(property_exists($this, $property)){
				return $this->$property;
			}
		}

		public function __set($property, $value){
			if(property_exists($this, $property)){
				$this->$property = $value; 
			}
		}
		
		public function crearGrupo($nick){
			$creado = false;
			$grupo = $this->obtenerGrupo("nombre", $this->nombre);
			
			if(is_null($grupo)){
				creaGrupo($this,$nick);
				$creado = true;			
			}
			return $creado;
		}
		
		/*Obtener usuario por nick o por correo*/
		public static function obtenerGrupo($campo,$value){
			$grupo = null;
			$result = dameGrupo($campo,$value);
			if($result->num_rows != 0){
				$row = $result->fetch_row();
				return Grupo::montaGrupo($row);
			}
		}
		public static function unirseGrupo($id_g,$nick,$value_admin){
			$result = insertar_a_grupo($id_g,$nick,$value_admin);
		}
		public static function abandonarGrupo($id_g,$nick){
			$result = dejarGrupo($id_g,$nick);
		}
		public function actualizarGrupo(){
			modificarGrupo($this);
			return true;
		}
		public static function obtenerGrupos($nick){
			$result = dameGrupos($nick);
			if($result->num_rows != 0){
				$lista = array();
				while ($row = $result->fetch_row()){
					$grupo = Grupo::montaGrupo($row);
					array_push($lista, $grupo);
				}
			return $lista;
			}
		}
		public static function obtenerGruposRec($nick){
			$result = dameGrupoRec($nick);
			if($result->num_rows != 0){
				$lista = array();
				while ($row = $result->fetch_row()){
					$grupo = Grupo::montaGrupo($row);
					array_push($lista, $grupo);
				}
			return $lista;
			}
		}
		
		public static function dameUsuariosGrupos($id_g){
			$result = dameUsuariosGrupo($id_g);
			if($result->num_rows != 0){
				$lista = array();
				while ($row = $result->fetch_row()){
					$usuario = Usuario::montaUsuarioLargo($row);
					array_push($lista, $usuario);
				}
				return $lista;
			}
			else
				return -1;
		}	
		
		public function esAdminDelGrupo($nick){
			$result = dameAdminGrupo($this->id_g);
			$esAdmin = false;
			while(!$esAdmin && ($row = $result->fetch_row())){
				$esAdmin = ($row[0]  == $nick);
			}
			return $esAdmin;
		}
		
		public function eliminarElGrupo(){
			eliminarGrupo($this->id_g);
		}
				
		
		public static function montaGrupo($row){
			$grupo = new Grupo(	$row[0], 	// id_g
								$row[1], 	// nombre
								$row[2],	// ciudad
								$row[3], 	// privado
								$row[4], 	// taxonomia
								$row[5], 	// subtaxonomia
								$row[6],	// foto_principal
								$row[7]		// descripcion
							);			
			return $grupo;
		}
	}

?>