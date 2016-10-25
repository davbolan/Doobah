<?php 
	require_once "DAO_General.php";

	class Comentario {

		private $id;
		private $nick;
		private $id_a;
		private $comentario;
		private $fecha;
	
		public function __construct(){
			// Esta es la estructura si necesitamos tener varias "contructoras". 
			$arguments = func_get_args();
			$num = sizeof($arguments);
			
			switch($num){
				case 0;
					break;
				case 3:
					$this->nick			= $arguments[0];
					$this->id_a			= $arguments[1];
					$this->comentario	= $arguments[2];
					break;
				case 4:
					$this->nick			= $arguments[0];
					$this->id_a			= $arguments[1];
					$this->comentario	= $arguments[2];
					$this->fecha		= $arguments[3];
			
					break;	
				case 5:
					$this->id	 			= $arguments[0];
					$this->nick				= $arguments[1];
					$this->id_a				= $arguments[2];
					$this->comentario		= $arguments[3];
					$this->fecha			= $arguments[4];				
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
		
		public static function crearComentario($id_a,$nick,$comentario){
			anadirComentario($id_a, $nick, $comentario);
		}
		public static function crearComentarioAnuncio($id_a,$nick,$comentario){
			anadirComentarioAnuncio($id_a, $nick, $comentario);
		}
		
		public static function obtenerComentarioActividad($idActividad){
			$result = dameComentarios($idActividad);
			if($result->num_rows != 0){
				$lista = array();
				while ($row = $result->fetch_row()){
					$comentario = Comentario::montaComentario($row);
					array_push($lista, $comentario);
				}
			return $lista;
			}
		}
		public static function obtenerComentarioAnuncio($idAnuncio){
			$result = dameComentariosAnuncio($idAnuncio);
			if($result->num_rows != 0){
				$lista = array();
				while ($row = $result->fetch_row()){
					$comentario = Comentario::montaComentario($row);
					array_push($lista, $comentario);
				}
			return $lista;
			}
		}
		

		public static function montaComentario($row){
		$comentario = new Comentario($row[0], 	// id
									$row[1], 	// nick
									$row[2],	// id_a
									$row[3], 	// comentario				
									$row[4]); 	// fecha

		return $comentario;
		}
	}
?>