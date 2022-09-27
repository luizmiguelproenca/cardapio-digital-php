<?php
class Produtos {	
   
	private $produtosTable = 'produtos';	
	private $con;
	
	public function __construct($db){
        $this->con = $db;
    }	    
	
	public function itemsList(){		
		$stmt = $this->con->prepare("SELECT id, name, price, description, images, status FROM ".$this->produtosTable. " where status=1");				
		$stmt->execute();			
		$result = $stmt->get_result();		
		return $result;	
	}
}
?>