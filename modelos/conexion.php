<?php

class Conexion{

	static public function conectar(){

		if(!empty($_SERVER["HTTPS"]) && ("on" == $_SERVER["HTTPS"])){


		$link = new PDO("mysql:host=localhost;dbname=u539586759_sponsors",                    
			            "u539586759_sponsors",                    
			            "Zenen12345$");

		}else{
			$link = new PDO("mysql:host=localhost;dbname=d3",                    
			            "root",                    
			            "");
		}
		$link->exec("set names utf8");

		return $link;

	}

}
?>