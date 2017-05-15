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
        switch ($p_sProperty) {
            case "Text":
                $this->m_sText = $p_vValue;
                break;
        }
    }
    
    public function __get($p_sProperty)
    {
        $vResult = null;
        switch ($p_sProperty) {
        case "Text":
            $vResult = $this->m_sText;
            break;
        }
        return $vResult;
    }
    
    public function Save()
    {
        $conn = Db::getInstance();
        
        $statement = $conn->prepare("INSERT INTO comments (id_user, id_item, comments) VALUES (:iduser, :iditem, :comments)");
        $statement->bindValue(":iduser", $_SESSION['id']);
        $statement->bindValue(":iditem", $_POST["postID"]);
        $statement->bindValue(":comments", $_POST["update"]);
        return $statement->execute();
    }
    
    public function GetRecentActivities()
    {
        $conn = Db::getInstance();
     
        $statement = $conn->prepare("select * from comments ORDER BY id DESC LIMIT 5");
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }
    
    public function GetCommentsFromPost()
    {
        $conn = Db::getInstance();
        
        $statement = $conn->prepare("SELECT * FROM comments WHERE id_item = :id_item");
        $statement->bindValue(":id_item", $_GET["id"]);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }
    
    public function Comments()
    {
        $conn = Db::getInstance();
        
        $statement = $conn->prepare("select c.*, u.firstname as firstname, u.avatar as avatar from comments c inner join users u on u.id = c.id_user where c.id_item = :items");
        $statement->bindValue(":items", $_GET["id"]);
        $statement->execute();
        $comments = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $comments;
    }
}
