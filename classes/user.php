<?php
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


}



