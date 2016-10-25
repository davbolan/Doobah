<?php	
	function ifIsLogged(){		
		if(isset($_SESSION["login"]) && $_SESSION["login"] && isset($_SESSION["main_page"])){
			header("Location: ".$_SESSION['main_page']);
		}
	}
	
	function ifIsNotLogged(){
		if(!isset($_SESSION["login"])){
			header("Location: ./index.php");
		}
	}
?>