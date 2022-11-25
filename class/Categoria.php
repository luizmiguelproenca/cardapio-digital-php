<?php
class Categoria {	
   
	private $categoriasTable = 'categorias';	
	private $con;
	
	public function __construct($db){
        $this->con = $db;
    }	    
	
	public function categoriasList(){		
		$stmt = $this->con->prepare("SELECT id, nome, imagem, status FROM ".$this->categoriasTable. " where status=1 order by id desc");				
		$stmt->execute();			
		$result = $stmt->get_result();		
		return $result;	
	}

	public function nomeCategoria($id){		
		$stmt = $this->con->prepare("SELECT nome FROM ".$this->categoriasTable. " WHERE id = ".$id);				
		$stmt->execute();			
		$result = $stmt->get_result();		
		$item = $result->fetch_assoc();
		return $item['nome'];	
	}
}
?>