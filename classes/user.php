<?php
class USER
{
    private $db;

    function __construct($DB_con)
    {
        $this->db = $DB_con;
    }


    public function doLogin($username,$password)
    {
        try
        {
            $stmt = $this->conn->prepare("SELECT id, username, email, password FROM users WHERE username=:uname");
            $stmt->execute(array(':usname'=>$username));
            $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
            if($stmt->rowCount() == 1)
            {
                if(password_verify($password, $userRow['password']))
                {
                    $_SESSION['user_session'] = $userRow['id'];
                    return true;
                }
                else
                {
                    return false;
                }
            }
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }

    public function is_loggedin()
    {
        if(isset($_SESSION['user_session']))
        {
            return true;
        }
    }

    public function redirect($url)
    {
        header("Location: $url");
    }

    public function doLogout()
    {
        session_destroy();
        unset($_SESSION['user_session']);
        return true;
    }
}
?>