<?php 
	require_once "DAO_General.php";
	require "usuario.php";
	
	class Taxonomia {

		private $id;
		private $value;

		public function __construct(){
			// Esta es la estructura si necesitamos tener varias "contructoras". 
			$arguments = func_get_args();
			$num = sizeof($arguments);
			
			switch($num){
				case 2;
					$this->id			= $arguments[0];
					$this->value		= $arguments[1];
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
			
		public function getSubTax(){
		$result = dameSubatxonomia($this->id);
		if($result->num_rows != 0){
			$i = 0;
			while ($row = $result->fetch_row()){
				$taxo = montaTaxonomia($row);
				$array = array($i => $taxo);
				$i = $i + 1;
			}
			return $array;
		}
		
		
		public static function  montaTaxonomia($row){
			$taxo = new Taxonomia(	$row[0], 	// id
									$row[1], 	// valor

									);			
			return $taxo;
		}
	public static function getTax(){
		$result = dameTaxonomias();
		if($result->num_rows != 0){
			$i = 0;
			while ($row = $result->fetch_row()){
				$taxo = montaTaxonomia($row);
				$array = array($i => $taxo);
				$i = $i + 1;
			}
			return $array;
		}
	}
		
	}

?>