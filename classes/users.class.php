<?php
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
            $stmt = $conn->prepare("INSERT INTO users_topics (topics_id, email) VALUES (:email, :id)");
            $stmt->bindValue(":email", $this->m_sUsername);
            $stmt->bindValue(":id", $_SESSION["id"]);
            
            if (!$conn->execute()) {
                throw new Exception("Could not insert subs");
            }
        }
  
    }

    public function upload($test)
    {
        $target_dir ="uploads/";
        $uploadOk = 1;
        $imageFileType = pathinfo(basename($test['avatar']['name']),PATHINFO_EXTENSION);
        $target_file = $target_dir .md5($_SESSION['email'].time()).".". $imageFileType;
        $check = getimagesize($test['avatar']['tmp_name']);
        if ($check !== false){
            $uploadOk = 1;
        }
        else {
            echo "file is not an image";
            $uploadOk = 0;

        }


        if (file_exists($target_file)){
            $uploadOk = 0;

        }
        if ($_FILES["avatar"]["size"] > 500000000000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        }
        else {
            if (move_uploaded_file($test["avatar"]["tmp_name"], $target_file)) {
                $conn = db::getInstance();
                $statement = $conn->prepare("UPDATE users SET avatar = :avatar WHERE id = :id");
                $statement->bindValue(":avatar",$target_file);
                $statement->bindValue(":id",$_SESSION["id"]);
                $statement->execute();
                $_SESSION['avatar'] = $target_file;
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }

    }
        
    
    public function update(){
      
        if(empty($this->password) && empty($this->firstname)){
            $conn = Db::getInstance();
            
            $statement = $conn->prepare("UPDATE users SET email = :email2 WHERE id = :id");
            $statement->bindValue(":email2", $_SESSION["email"]);
            $statement->bindValue(":id", $_SESSION["id"]);
            return $statement->execute();
        }
        
        elseif(empty($this->password) && empty($this->email)){
            $conn = Db::getInstance();
            
            $statement = $conn->prepare("UPDATE users SET firstname = :firstname WHERE id = :id");
            $statement->bindValue(":firstname", $_SESSION["firstname"] );
            $statement->bindValue(":id", $_SESSION["id"]);
            return $statement->execute();
        }
        
        elseif(empty($this->password)){
            $conn = Db::getInstance();
            
            $statement = $conn->prepare("UPDATE users SET firstname = :firstname, email = :email2 WHERE id = :id");
            $statement->bindValue(":firstname", $_SESSION["firstname"] );
            $statement->bindValue(":email2", $_SESSION["email"]);
            $statement->bindValue(":id", $_SESSION["id"]);
            return $statement->execute();
        }
        
        elseif(!empty($_POST["firstname"]) && !empty($_POST["email"])){
            $conn = Db::getInstance();
            $statement = $conn->prepare("UPDATE users SET firstname = :firstname, email = :email2, password = :password WHERE id = :id");
            $statement->bindValue(":firstname", $_POST['firstname']);
            $statement->bindValue(":email2", $_POST["email"]);
            $statement->bindValue(":id", $_SESSION["id"]);
            
            
            $options = ["cost" => 11];
            
            $hash = password_hash($this->password, PASSWORD_DEFAULT, $options);
            $statement->bindValue(":password", $hash);

            return $statement->execute();
        }  
        
       
        
    }
    
        public function getAll(){
            
        $conn = Db::getInstance();
        
        $allposts = $conn->query("SELECT * FROM users");
        return $allposts;

}
    public function getAllUser(){
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT * FROM users WHERE id = :id");
        $statement->bindValue(":id", $_SESSION["id"]);
        $statement->execute();
        $allUser = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        return $allUse;
    }
    
    
}