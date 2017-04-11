<?php
class Topics{
    private $m_sDescription;
    private $m_sUsername;
    public function __set($name, $value)
    {
        switch ($name){
            case "Description":
                if ($value != "") {
                    $this->m_sDescription = $value;
                    break;
                }else{
                    throw new Exception("You need to choose at least one topic");
                }
            case "Username":
                if ($value != "") {
                    $this->m_sUsername = $value;
                }else{
                    throw new Exception("You need to choose at least one topic");
                }
                break;
        }
    }
    public function __get($name)
    {
        switch ($name){
            case "Description":
                    return $this->m_sDescription;
                    break;
            case "Username":
                    return $this->m_sUsername;
                break;
        }
    }
    public function getTopics(){
        $conn = Db::getInstance();
        $stateAllTopics = $conn->prepare("SELECT * FROM Topics");
        $stateAllTopics->execute();
        return $stateAllTopics;
    }
    
    public function updateSubscriptions(){

        
        
        $conn = Db::getInstance();
        foreach ($subscriptions as $sub) {
            $stmt = $conn->prepare("INSERT INTO Users_Topics (topics_id, email) VALUES (:email, :id)");
            $stmt->bindValue(":email", $this->m_sUsername);
            $stmt->bindValue(":id", $_SESSION["id"]);
            if (!$conn->execute()) {
                throw new Exception("Could not insert subs");
            }
        }
        
        
        
    }
    public function checkTopics(){
        $conn = Db::getInstance();
        $userID = $conn->prepare("select id from Users where firstname = :firstname");
        $userID->bindValue(':firstname', $this->m_sUsername);
        $userID->execute();
        while ($id = $userID->fetch()){
            $top = $conn->prepare("select * from Users_Topics where email = :userID");
            $top->bindValue(":userID", $id['email']);
            $top->execute();
            return $top->rowCount();
        }
    }
}