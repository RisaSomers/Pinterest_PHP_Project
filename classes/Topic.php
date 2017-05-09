<?php




class Topic
{
    private $m_sDescription;
    private $m_sUsername;
    
    public function __set($name, $value)
    {
        switch ($name) {
                
            case "Description":
                if ($value != "") {
                    $this->m_sDescription = $value;
                    break;
                } else {
                    throw new Exception("You need to choose at least one topic");
                }
                
            case "Username":
                if ($value != "") {
                    $this->m_sUsername = $value;
                    break;
                } else {
                    throw new Exception("You need to choose at least one topic");
                }
        }
    }
    
    public function __get($name)
    {
        switch ($name) {
                
            case "Description":
                    return $this->m_sDescription;
                    break;
                
            case "Username":
                    return $this->m_sUsername;
                    break;
        }
    }
    
    public function getTopics()
    {
        $conn = Db::getInstance();
        
        $stateAllTopics = $conn->prepare("SELECT * FROM Topics");
        $stateAllTopics->execute();
        return $stateAllTopics;
    }
    
    public function updateSubscriptions($subscriptions)
    {
        $conn = Db::getInstance();
        
        foreach ($subscriptions as $sub) {
            $statement = $conn->prepare("INSERT INTO Users_Topics (email, topics_id) VALUES (:email, :topics_id)");
            $statement->bindValue(":email", $_SESSION['email']);
            $statement->bindValue(":topics_id", $sub);
            $statement->execute();
        }
    }
    
    public function getUserPosts()
    {
        $conn = Db::getInstance();
        
        $statement = $conn->prepare("SELECT topics_id FROM Users_Topics WHERE email = :email");
        $statement->bindValue(":email", $_SESSION["email"]);
        $statement->execute();
        $subscribed_tags = $statement->fetchAll(PDO::FETCH_ASSOC);
        $temp = array_map(function ($tag) {
            return $tag["topics_id"];
        }, $subscribed_tags);
        $tags = implode(", ", array_fill(0, count($temp), '?'));


        $statement = $conn->prepare("
            SELECT DISTINCT *
            FROM items_topics
            INNER JOIN items ON items_topics.items = items.id
            WHERE items_topics.item
            IN (" . $tags . ")
            GROUP BY items_topics.item
            ORDER BY items.id DESC
            LIMIT 3
        ");

        foreach ($temp as $k => $id) {
            $statement->bindValue(($k+1), $id);
        }

        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function checkTopics()
    {
        $conn = Db::getInstance();
        
        $userID = $conn->prepare("SELECT id FROM Users WHERE firstname = :firstname");
        $userID->bindValue(':firstname', $this->m_sUsername);
        $userID->execute();
        
        while ($id = $userID->fetch()) {
            $top = $conn->prepare("SELECT * FROM Users_Topics WHERE email = :userID");
            $top->bindValue(":userID", $id['email']);
            $top->execute();
            return $top->rowCount();
        }
    }
}
