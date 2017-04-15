<?php
/*
Deze klasse dient om subscribers te laten inschrijven 
op onze nieuwsbrief.
*/
class comments
{
	private $m_sText;
	
	//DB settings, kunnen ook in include geplaatst worden
	
	public function __set($p_sProperty, $p_vValue)
	{
		switch($p_sProperty)
		{
			case "Text":
				$this->m_sText = $p_vValue;
				break;
		}	   
	}
	
	public function __get($p_sProperty)
	{
		$vResult = null;
		switch($p_sProperty)
		{
		case "Text": 
			$vResult = $this->m_sText;
			break;
		}
		return $vResult;
	}
	
	public function Save($item_id){

        
        $conn = Db::getInstance();
        
        $statement = $conn->prepare("INSERT INTO comments (comments, id_user, id_item) VALUES :comments, :id_user, :id_item");
        $statement->bindValue(":comments", $this->Text);
        $statement->bindValue(":id_user", $SESSION["id"]);
        $statement->bindValue(":id_item", $item_id);
        $statement->execute();
	}
	
	public function GetRecentActivities()
	{
		  $conn = Db::getInstance();
        
			$statement = $conn->prepare("select * from comments ORDER BY id DESC LIMIT 5");
            $statement->execute();
	        return $statement->fetchAll(PDO::FETCH_ASSOC);

		
			
	}
    
    public function getItemComments($item){
        $conn = Db::getInstance();
        
        $statement = $conn->prepare("SELECT comments FROM comments WHERE id_item = :id_item");
        $statement->bindValue("id_item", $item);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }
}
?>