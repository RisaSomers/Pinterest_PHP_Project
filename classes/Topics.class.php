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
                    throw new Exception("You need to choose at least One topic");
                }
            case "Username":
                if ($value != "") {
                    $this->m_sUsername = $value;
                }else{
                    throw new Exception("You need to choose at least One topic");
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
    public function addToDatabase(){
        $conn = Db::getInstance();
        $stmt = $conn->prepare("INSERT INTO Users_Topics(Email, Topics_id) SELECT u.id, t.id from users u, topics t where (u.username = :username and t.description = :description)");
        $stmt->bindValue(':username', $this->m_sUsername);
        $stmt->bindValue(':description', $this->m_sDescription);
        $check = $stmt->execute();
        return $check;
    }
    public function checkTopics(){
        $conn = Db::getInstance();
        $userID = $conn->prepare("select id from Users where Username = :username");
        $userID->bindValue(':username', $this->m_sUsername);
        $userID->execute();
        while ($id = $userID->fetch()){
            $top = $conn->prepare("select * from Users_Topics where Email = :userID");
            $top->bindValue(":userID", $id['Email']);
            $top->execute();
            return $top->rowCount();
        }
    }
}