<?php

    include_once("classes/db.class.php");

class users
{
    private $m_sfirstname;
    private $m_slastname;
    private $m_semail;
    private $m_spassword;

    public function getMSfirstname()
    {
        return $this->m_sfirstname;
    }

    /**
     * @param mixed $m_sFullName
     */
    public function setMSfirstname($m_sfirstname)
    {
        $this->m_sfirstname = $m_sfirstname;
    }

    /**
     * @return mixed
     */
    public function getMSlastname()
    {
        return $this->m_slastname;
    }

    /**
     * @param mixed $m_sUserName
     */
    public function setMSlastname($m_slastname)
    {
        $this->m_slastname = $m_slastname;
    }

    /**
     * @return mixed
     */
    public function getMSemail()
    {
        return $this->m_semail;
    }

    /**
     * @param mixed $m_sEmail
     */
    public function setMSemail($m_semail)
    {
        $this->m_semail = $m_semail;
    }

    /**
     * @return mixed
     */
    public function getMSpassword()
    {
        return $this->m_spassword;
    }

    /**
     * @param mixed $m_sPassword
     */
    public function setMSpassword($m_spassword)
    {
        $this->m_spassword = $m_spassword;
    }
    


    public function save() {
        $conn = Db::getInstance();
        
        $stmt = $conn->prepare("INSERT INTO users (firstname, lastname, password, email) VALUES (:firstname, :lastname, :password, :email)");
        print_r($this);
        $stmt->bindValue(":firstname", $this->m_sfirstname);
        $stmt->bindValue(":lastname", $this->m_slastname);
        $stmt->bindValue(":password", $this->m_spassword);
        $stmt->bindValue(":email", $this->m_semail);
        return $stmt->execute();
    }
    
    public function updateSubscriptions(){
        $conn = Db::getInstance();
        
        foreach ($topics as $topics) {
            $stmt = $conn->prepare("INSERT INTO Users_Topics (topics_id, email) VALUES (:email, :id)");
            $stmt->bindValue(":email", $this->m_sUsername);
            $stmt->bindValue(":id", $_SESSION["id"]);
            
            if (!$conn->execute()) {
                throw new Exception("Could not insert subs");
            }
        }
  
    }


}

class profilechange extends users
{

    /*public function update($name, $email, $pass)
    {
        $conn = Db::getInstance();
        
        $current_id = $_SESSION['id'];
        
        if (empty($pass))
        {
            $statement = $conn->prepare('UPDATE Users SET name=:firstname,email=:email WHERE id=:id');

        }
        else
        {
            $this->password = $pass;
            $statement = $conn->prepare('UPDATE Users SET name=:name,password=:password,email=:email,branch=:branch,description=:description WHERE id=:id');
            $statement->bindValue(':password',$this->password);
        }
        
        $statement->bindValue(':firstname',$name);
        $statement->bindValue(':email',$email);
        $statement->bindValue(':id',$current_id);
        $statement->execute();

        header('location: index.php');
    }

    public function getAll()
    {
        $conn = Db::getInstance();
        
        $allposts = $conn->query("SELECT * FROM Users");
        return $allposts;
    }*/
    
    public function oploadAvatar($avater){
        $imageFileType = pathinfo(basename($avatar["name"]), PATHINFO_EXTENSION);
        $fileName = md5($this->username.time()) . "." . $imageFileType;
        $target_file = "oploads/avatars/" . $fileName;
        
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif"){
            throw new Exception("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
        }
        
        if(!move_uploaded_file($avatar["tmp_name"], $target_file)){
            throw new Exception("Could not upload file");
        }
        
        $current_user = $_SESSION["email"];
        $conn = Db::getInstance();
        $statement = $conn->prepare("UPDATE Users SET avatar = :avatar WHERE email = :email");
        $statement->bindValue(":email", $current_user);
        $statement->bindValue(":avatar", $fileName);
        $_SESSION["avatar"] = $fileName;
        
        return $statement->execute();
    }
    
    public function update(){
        $_SESSION["lastname"] = $this->lastname;
        $_SESSION["email"] = $this->email;
        $_SESSION["firstname"] = $this->firstname;
        
        if(empty($this->password)){
            $conn = Db::getInstance();
            
            $statement = $conn->prepare("UPDATE Users SET firstname = :firstname, lastname = :lastname, email = :email WHERE email = :email2");
            $statement->bindValue(":firstname", $this->firstname);
            $statement->bindValue(":lastname", $this->lastname);
            $statement->bindvalue(":email", $this->email);
            $statement->bindValue(":email2", $_SESSION["email"]);
            
            return $statement->execute();
        }
        
        else{
            $conn = Db::getInstance();
            $statement = $conn->prepare("UPDATE Users SET lastname = :lastname, firstname = :firstname, email = :email, password = :password WHERE email = :email2");
            $statement->bindValue(":lastname", $this->lastname);
            $statement->bindValue(":firstname", $this->firstname);
            $statement->bindValue(":email", $this->email);
            
            $options = ["cost" => 11];
            
            $hash = password_hash($this->password, PASSWORD_DEFAULT, $options);
            $statement->bindValue(":password", $hash);
            $statement->bindValue(":email2", $_SESSIONS["email"]);
            
            return $statement->execute();
        }
    }

}



