<?php

    include_once("classes/Db.class.php");

class users
{
    private $m_sfirstname;
    private $m_slastname;
    private $m_semail;
    private $m_spassword;

    /**
     * users constructor.
     * @param $m_sFullName
     * @param $m_sUserName
     * @param $m_sEmail
     * @param $m_sPassword
     */


    /**
     * @return mixed
     */
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
        $stmt = $conn->prepare("INSERT INTO Users (firstname, lastname, password, email) VALUES (:firstname, :lastname, :password, :email)");
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

    public function update($name, $email, $pass)
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

        /*$statement = $conn->prepare('UPDATE student SET name=?,email=?,password=?,picture=?,year=?,branch=?,description=?');
        $statement->execute(array($this->Name, $this->Email, $this->Password, $this->Picture, $this->Year, $this->Branch, $this->Description));*/
    }

    public function getAll()
    {
        $conn = Db::getInstance();
        $allposts = $conn->query("SELECT * FROM Users");
        return $allposts;
    }
/*
    public function getOne($m_pId)
    {
        $conn = Db::getInstance();
        $one = $conn->prepare("SELECT * FROM student WHERE id = :id");
        $one->bindValue(':id',$m_pId);
        $one->execute();
        return $one->fetch();
    }

    public function checkPass($val1, $val2)
    {
        if ($val1 != $val2)
        {
            throw new Exception("Passwords don't match!");
        }
    }
*/

}



