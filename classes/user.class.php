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
    
    public function upload(){
/*** check if a file was uploaded ***/
if(is_uploaded_file($_FILES['userfile']['tmp_name']) && getimagesize($_FILES['userfile']['tmp_name']) != false)
    {
    /***  get the image info. ***/
    $size = getimagesize($_FILES['userfile']['tmp_name']);
    /*** assign our variables ***/
    $type = $size['mime'];
    $imgfp = fopen($_FILES['userfile']['tmp_name'], 'rb');
    $size = $size[3];
    $name = $_FILES['userfile']['name'];
    $maxsize = 99999999;


    /***  check the file is less than the maximum file size ***/
    if($_FILES['userfile']['size'] < $maxsize )
        {
        /*** connect to db ***/
        $conn = Db::getInstance();

                /*** set the error mode ***/
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            /*** our sql query ***/
        $statement = $conn->prepare("UPDATE Users SET avatar = :avatar WHERE email = :email");

        /*** bind the params ***/
       
        $statement->bindValue(":avatar", $imgfp, PDO::PARAM_LOB);
        $statement->bindValue(":email", $_SESSION["email"]);
        

        /*** execute the query ***/
        $statement->execute();
        }
        
    else
        {
        /*** throw an exception is image is not of type ***/
        throw new Exception("File Size Error");
        }
    }
else
    {
    // if the file is not less than the maximum allowed, print an error
    throw new Exception("Unsupported Image Format!");
    }
}
        
    
/*    public function update(){
        $_SESSION["firstname"] = $firstname;
        $_SESSION["email"] = $email;
        $_SESSION["password"] = $password;
        
        if(empty($this->password)){
            $conn = Db::getInstance();
            
            $statement = $conn->prepare("UPDATE Users SET firstname = :firstname, email = :email WHERE email = :email2");
            $statement->bindValue(":firstname", $this->firstname);
            $statement->bindvalue(":email", $this->email);
            $statement->bindValue(":email2", $_SESSION["email"]);
            
            return $statement->execute();
        }
        
        else{
            $conn = Db::getInstance();
            $statement = $conn->prepare("UPDATE Users SET firstname = :firstname, email = :email, password = :password WHERE email = :email2");
            $statement->bindValue(":firstname", $this->firstname);
            $statement->bindValue(":email", $this->email);
            
            $options = ["cost" => 11];
            
            $hash = password_hash($this->password, PASSWORD_DEFAULT, $options);
            $statement->bindValue(":password", $hash);
            $statement->bindValue(":email2", $_SESSIONS["email"]);
            
            return $statement->execute();
        }  
        
    }*/
    
        public function getAll(){
            
        $conn = Db::getInstance();
        
        $allposts = $conn->query("SELECT * FROM Users");
        return $allposts;
    


}
}