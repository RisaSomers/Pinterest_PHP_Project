<?php

    sql_autoload_register(function ($class){
        include_once("classes/".$class.".php");
    });

class users
{
    private $m_sFullName;
    private $m_sUserName;
    private $m_sEmail;
    private $m_sPassword;

    /**
     * users constructor.
     * @param $m_sFullName
     * @param $m_sUserName
     * @param $m_sEmail
     * @param $m_sPassword
     */
    public function __construct($m_sFullName, $m_sUserName, $m_sEmail, $m_sPassword)
    {
        $this->m_sFullName = $m_sFullName;
        $this->m_sUserName = $m_sUserName;
        $this->m_sEmail = $m_sEmail;
        $this->m_sPassword = $m_sPassword;
    }

    /**
     * @return mixed
     */
    public function getMSFullName()
    {
        return $this->m_sFullName;
    }

    /**
     * @param mixed $m_sFullName
     */
    public function setMSFullName($m_sFullName)
    {
        $this->m_sFullName = $m_sFullName;
    }

    /**
     * @return mixed
     */
    public function getMSUserName()
    {
        return $this->m_sUserName;
    }

    /**
     * @param mixed $m_sUserName
     */
    public function setMSUserName($m_sUserName)
    {
        $this->m_sUserName = $m_sUserName;
    }

    /**
     * @return mixed
     */
    public function getMSEmail()
    {
        return $this->m_sEmail;
    }

    /**
     * @param mixed $m_sEmail
     */
    public function setMSEmail($m_sEmail)
    {
        $this->m_sEmail = $m_sEmail;
    }

    /**
     * @return mixed
     */
    public function getMSPassword()
    {
        return $this->m_sPassword;
    }

    /**
     * @param mixed $m_sPassword
     */
    public function setMSPassword($m_sPassword)
    {
        $this->m_sPassword = $m_sPassword;
    }

    public function Save(){



        $conn= Db::getInstance();

        //query schrijven
        $statement = $conn->prepare("INSERT INTO Users (FullName, UserName, Email, Password) VALUES(:FullName, :UserName, :Email, :Password)"); 
        $statement->bindValue(":FullName", $this->FullName); 
        $statement->bindValue(":UserName", $this->UserName); 
        $statement->bindValue(":Email", $this->Email); 
        $statement->bindValue(":Password", $this->Password);

        return $statement->execute();
    }



}



