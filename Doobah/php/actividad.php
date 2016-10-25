<?php 
	require_once "DAO_General.php";
	require_once "grupo.php";
	
	class Actividad {

		private $id_a;
		private $nombre;
		private $fecha_actividad;
		private $lugar;
		private $taxonomia;
		private $subtaxonomia;
		private $foto_principal;
		private $descripcion;
		private $id_g;


				
		public function __construct(){
			// Esta es la estructura si necesitamos tener varias "contructoras". 
			$arguments = func_get_args();
			$num = sizeof($arguments);
			
			switch($num){
				case 0;
					break;
				case 1:
					$this->id_a 			= $arguments[0];
					break;
				case 2:
					$this->id_a 			= $arguments[0];
					$this->nombre 			= $arguments[1];
					break;
				case 3:
					$this->id_a			    = $arguments[0];
					$this->nombre 			= $arguments[1];
					$this->fecha_actividad 	= $arguments[2];              
					break;	
				case 5:
					$this->nombre 			= $arguments[0];
					$this->fecha_actividad 	= $arguments[1];
					$this->lugar		 	= $arguments[2];
					$this->foto_principal 	= $arguments[3];
					$this->descripcion 		= $arguments[4];				
					break;					
				
				case 7:
					$this->id_a 			= $arguments[0];
					$this->nombre 			= $arguments[1];
					$this->fecha_actividad 	= $arguments[2];
					$this->lugar		 	= $arguments[3];
					$this->foto_principal 	= $arguments[4];
					$this->descripcion 		= $arguments[5];				
					$this->id_g			 	= $arguments[6];
					break;
					
				case 8:
					$this->nombre 			= $arguments[0];
					$this->fecha_actividad 	= $arguments[1];
					$this->lugar		 	= $arguments[2];
					$this->taxonomia		= $arguments[3];
					$this->subtaxonomia		= $arguments[4];		
					$this->foto_principal 	= $arguments[5];
					$this->descripcion 		= $arguments[6];				
					$this->id_g			 	= $arguments[7];
					break;
					
				case 9:
					$this->id_a 			= $arguments[0];
					$this->nombre 			= $arguments[1];
					$this->fecha_actividad 	= $arguments[2];
					$this->lugar		 	= $arguments[3];
					$this->taxonomia		= $arguments[4];
					$this->subtaxonomia		= $arguments[5];			
					$this->foto_principal 	= $arguments[6];
					$this->descripcion 		= $arguments[7];				
					$this->id_g			 	= $arguments[8];
					break;
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
		
		public function crearActividad($nick){
			creaActividad($this, $nick, $this->id_g);
		}
		
		/*Obtener usuario por nick o por correo*/
		public function obtenerActividad($campo, $value){
			$result = dameActividad($campo, $value);
			if($result->num_rows != 0){
				$row = $result->fetch_row();
				return Actividad::montaActividades($row);
			}
		}
		public static function unirseActividad($IDActividad,$nick){
			$result = entrarActividad($IDActividad,$nick);
		}
		public static function abandonarActividad($IDActividad,$nick){
			$result = dejarActividad($IDActividad, $nick);
		}
		public function ActualizarActividad(){
			modificarActividad($this);
			return true;
		}
		public static function obtenerActividadesUsuario($nick){
			$result = dameActividades($nick);
			if($result->num_rows != 0){
				$lista = array();
				while ($row = $result->fetch_row()){
					$actividad = Actividad::montaActividades($row);
					array_push($lista, $actividad);
				}
			return $lista;
			}
		}
		public static function dameActiGrupos($id_g){
			$result = dameActividadesGrupo($id_g);
			if($result->num_rows != 0){
				$lista = array();
				while ($row = $result->fetch_row()){
					$actividad = Actividad::montaActividades($row);
					array_push($lista, $actividad);
				}
			return $lista;
			}
		}
		
		public static function dameParticisActi($id_a){
			$result = dameParticipantesActividad($id_a);
			if($result->num_rows != 0){
				$lista = array();
				while ($row = $result->fetch_row()){
					$usuario = Usuario::montaUsuario($row);
					array_push($lista, $usuario);
				}
			return $lista;
			}
		}

		public function esAdminDeLaActividad($nick){
			$result = dameAdminActividad($this->id_a);
			$esAdmin = false;
			while(!$esAdmin && ($row = $result->fetch_row())){
				$esAdmin = ($row[0]  == $nick);
			}
			return $esAdmin;
		}
		
		public function eliminarLaActividad(){
			eliminarActividad($this->id_a);
		}
		
		public static function montaActividades($row){
		$actividad = new Actividad(	$row[0], 	// ida
									$row[1], 	// nombre
									$row[2],	// fecha_actividad
									$row[3], 	// lugar
									$row[4],	// taxonomia
									$row[5],	// subtaxonomia
									$row[6], 	// foto_principal
									$row[7], 	// descripcion
									$row[8]		// id_g
							);			
		return $actividad;
		}
	}
?>