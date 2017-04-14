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
	/*
	De methode Save dient om een nieuwe activity te bewaren in onze databank.
	De methode geeft boolean "true" terug wanneer het invoegen geslaagd is.
	Wanneer het invoegen van de subscriber niet gelukt is, geeft de functie "false" terug.
	Databank gegevens kunnen eventueel in een aparte klasse DbConnectie gestopt worden.
	*/
	{

		$bResult = false;
		
		$conn = Db::getInstance();
			
				//vergeet niet te beschermen tegen SQL Injection wanneer je een query uitvoert
				$statement = $conn->prepare("INSERT INTO comments (comments) VALUES ('".mysqli_real_escape_string($conn, $this->Text)."');");				
				if ($rResult = mysqli_query($conn, $statement) != false)
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
		  $conn = Db::getInstance();
        
			$statement = $conn->prepare("select * from comments ORDER BY id DESC LIMIT 5");
			$rResult = mysqli_query($conn, $statement);
			return $rResult;

		
			
	}
}
?>