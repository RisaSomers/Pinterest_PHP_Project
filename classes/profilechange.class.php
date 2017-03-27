<?PHP

include_once("user.php");

class profilechange extends users
{






    public function update($name, $email, $pass)
    {
        $conn = Db::getInstance();
        $current_id = $_SESSION['id'];
        if (empty($pass))
        {
            $statement = $conn->prepare('UPDATE users SET name=:FullName,email=:Email WHERE id=:id');

        }
        else
        {
            $this->Password = $pass;
            $statement = $conn->prepare('UPDATE users SET name=:name,password=:Password,email=:Email,branch=:branch,description=:description WHERE id=:id');
            $statement->bindValue(':Password',$this->Password);
        }
        $statement->bindValue(':FullName',$name);
        $statement->bindValue(':Email',$email);
        $statement->bindValue(':id',$current_id);
        $statement->execute();

        header('location: index.php');

        /*$statement = $conn->prepare('UPDATE student SET name=?,email=?,password=?,picture=?,year=?,branch=?,description=?');
        $statement->execute(array($this->Name, $this->Email, $this->Password, $this->Picture, $this->Year, $this->Branch, $this->Description));*/
    }

    public function getAll()
    {
        $conn = Db::getInstance();
        $allposts = $conn->query("SELECT * FROM student");
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

?>