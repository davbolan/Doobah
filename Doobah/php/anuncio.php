<?php 
	require_once "DAO_General.php";
		
	/*if(isset($_GET["funcion"])){
		$funcion = $_GET["funcion"];
		
		if($funcion == "existeActividad"){
			if(isset($_GET["param1"])){
				 echo(existeActividad($_GET["param1"]));
			}
		}
		
	}
	
	function existeActividad($campo, $valor){
		$result = dameActividad($campo, $valor);	
		$disponibilidad  = ($result->num_rows == 0) ? "disponible":"existe";	
		return $disponibilidad;
	}*/
	
	class Anuncio {

		private $id_an;
		private $nombre;
		private $fecha_evento;
		private $lugar;
		private $descripcion;
		private $taxonomia;
		private $subtaxonomia;
		private $foto_principal;
		private $nickCrear;

				
		public function __construct(){
			// Esta es la estructura si necesitamos tener varias "contructoras". 
			$arguments = func_get_args();
			$num = sizeof($arguments);
			
			switch($num){
				case 0;
					break;
				case 1:
					$this->id_an 			= $arguments[0];
					break;
				case 2:
					$this->id_an 			= $arguments[0];
					$this->nombre 			= $arguments[1];
					break;
				case 3:
					$this->id_g 			= $arguments[0];
					$this->nombre 			= $arguments[1];
					$this->fecha_evento 	= $arguments[2];              
					break;	
				case 7:
					$this->nombre 			= $arguments[0];
					$this->fecha_evento 	= $arguments[1];
					$this->lugar		 	= $arguments[2];
					$this->descripcion 		= $arguments[3];
					$this->taxonomia        = $arguments[4];
					$this->subtaxonomia     = $arguments[5];
					$this->foto_principal 	= $arguments[6];
						
					break;
				case 8:
					$this->id_an 			= $arguments[0];
					$this->nombre			= $arguments[1];
					$this->fecha_evento 	= $arguments[2];
					$this->lugar		 	= $arguments[3];
					$this->descripcion 		= $arguments[4];
					$this->taxonomia        = $arguments[5];
					$this->subtaxonomia     = $arguments[6];
					$this->foto_principal 	= $arguments[7];
						
					break;
				case 9:
					$this->id_an 			= $arguments[0];
					$this->nombre 			= $arguments[1];
					$this->fecha_evento 	= $arguments[2];
					$this->lugar		 	= $arguments[3];
					$this->descripcion 		= $arguments[4];
					$this ->taxonomia       = $arguments[5];
					$this ->subtaxonomia    = $arguments[6];
					$this->foto_principal 	= $arguments[7];				
					$this->nickCrear		= $arguments[8];
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
		
		public function crearAnuncio($nick){
			creaAnuncio($this, $nick);
		}
		
		/*Obtener usuario por nick o por correo*/
		public function obtenerAnuncio($campo, $value){
			$result = dameAnuncio($campo, $value);
			if($result->num_rows != 0){
				$row = $result->fetch_row();
				return Anuncio::montaAnuncio($row);
			}
		}
		
		public static function obtenerAnuncioUsuario($nick){
			$result = dameAnuncios($nick);
			if($result->num_rows != 0){
				$lista = array();
				while ($row = $result->fetch_row()){
					$anuncio = Anuncio::montaAnuncio($row);
					array_push($lista, $anuncio);
				}
			return $lista;
			}
		}
		
		public function ActualizarAnuncio(){
			modificarAnuncio($this);
			return true;
		}

		public static function montaAnuncio($row){
		
		$anuncio = new Anuncio(		$row[0], 	// idan
									$row[1], 	// nombre
									$row[2],	// fecha_evento
									$row[3], 	// lugar				
									$row[4], 	// descripcion
									$row[5],	// taxonomia
									$row[6],	// subtaxonomia
									$row[7] 	// foto_principal
							);			
		return $anuncio;
		}
	}
?>