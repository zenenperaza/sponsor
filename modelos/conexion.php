<?php

class Conexion{

	static public function conectar(){

		$link = new PDO("mysql:host=localhost;dbname=d3",                    
			            "root",                    
			            "");

		return $link;

	}

}
?>