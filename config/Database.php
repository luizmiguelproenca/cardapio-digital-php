<?php
session_start();

class Database{
	
	private $host  = 'localhost';
    private $user  = 'root';
    private $password   = "";
    private $database  = "cardapio"; 
    
    public function getConexao(){		
		$con = new mysqli($this->host, $this->user, $this->password, $this->database);
		if($con->connect_error){
			die("Erro ao conectar ao MySQL: " . $con->connect_error);
		} else {
			return $con;
		}
    }
}
?>