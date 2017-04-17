<?php
/*
Deze klasse dient om subscribers te laten inschrijven 
op onze nieuwsbrief.
*/
class Activity
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
	
	public function Save()

	{
        $conn = Db::getInstance();
		$bResult = false;


				//vergeet niet te beschermen tegen SQL Injection wanneer je een query uitvoert
				$statement = $conn->prepare("INSERT INTO comments (id_user, id_item, comments) VALUES (':id_user, :id_item,".mysqli_real_escape_string($link, $this->Text)."');");
                $statement = bindValue(":id_user", $_SESSION["id"]);
                $statement = bindValue(":id_item", $row['id']);
                
				if ($rResult = mysqli_query($link, $statement) != false)
				{	
					$bResult = true;	
				}
				else
				{
					// er zijn geen query resultaten, dus query is gefaald
					throw new Exception('Caramba! Could not update your status!');	
				}

		return $bResult;
	}
	
	public function GetRecentActivities()
	{
		if ($link = mysqli_connect($this->m_sHost, $this->m_sUser, $this->m_sPassword, $this->m_sDatabase))
		{
			$sSql = "select * from comments ORDER BY id DESC LIMIT 5";
			$rResult = mysqli_query($link, $sSql);
			return $rResult;
		}
		else
		{
			// er kon geen connectie gelegd worden met de databank
			throw new Exception('Ooh my, something terrible happened to the database connection');
		}


	}
}
?>