<?php
class Produto {	
   
	private $produtosTable = 'produtos';	
	private $con;
	
	public function __construct($db){
        $this->con = $db;
    }	    
	
	public function itemsList(){		
		$stmt = $this->con->prepare("SELECT id, name, price, description, images, status FROM ".$this->produtosTable. " where status=1 order by id_categoria desc");				
		$stmt->execute();			
		$result = $stmt->get_result();		
		return $result;	
	}

	public function itemsSearch($q){
		$stmt = $this->con->prepare("SELECT id, name, price, description, images, status FROM ".$this->produtosTable. " where status=1 AND name like '%$q%' or description like '%$q%'");				
		$stmt->execute();		
		$result = $stmt->get_result();	
		return $result;
	}

	public function itemsCategorie($cat){
		$stmt = $this->con->prepare("SELECT id, name, price, description, images, status FROM ".$this->produtosTable. " where status=1 AND id_categoria='$cat'");				
		$stmt->execute();		
		$result = $stmt->get_result();	
		return $result;
	}
}
?>