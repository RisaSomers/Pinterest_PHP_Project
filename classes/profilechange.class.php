<?PHP

include_once("user.php");
include_once("Db.class.php");

class profilechange extends users
{

<<<<<<< HEAD





=======
>>>>>>> origin/master
    public function update($username, $email, $pass)
    {
        $conn = Db::getInstance();
        $current_id = $_SESSION['user_id'];
        if (empty($pass))
        {
<<<<<<< HEAD
            $statement = $conn->prepare("UPDATE users SET name=:UserName,email=:Email WHERE id=:id");
=======
            $statement = $conn->prepare('UPDATE Users SET UserName=:UserName,Email=:Email WHERE id=:id');
>>>>>>> origin/master

        }
        else
        {
            $this->Password = $pass;
<<<<<<< HEAD
            $statement = $conn->prepare("UPDATE users SET UserName=:username,password=:Password,email=:Email WHERE id=:id");
            $statement->bindValue(':Password',$this->Password);
        }
        $statement->bindValue(':UserName',$Username);
        $statement->bindValue(':Email',$Email);
=======
            $statement = $conn->prepare('UPDATE Users SET UserName=:UserName,Password=:Password,Email=:Email WHERE id=:id');
            $statement->bindValue(':Password',$pass);
        }
        $statement->bindValue(':UserName',$username);
        $statement->bindValue(':Email',$email);
>>>>>>> origin/master
        $statement->bindValue(':id',$current_id);
        $statement->execute();

        header('location: index.php');
    }

    public function getAll()
    {
        $conn = Db::getInstance();
        $allposts = $conn->query("SELECT * FROM Users");
        return $allposts;
    }

    public function getOne($m_pId)
    {
        $conn = Db::getInstance();
        $one = $conn->prepare("SELECT * FROM Users WHERE id = :id");
        $one->bindValue(':id',$m_pId);
        $one->execute();
        return $one->fetch();
    }

    public function checkPass($val1, $val2)
    {
    	if ($val1 == "") {
				throw new Exception("Passwords can't be empty");
			} elseif ($val1 != $val2) {
				throw new Exception("Passwords don't match!");
			}
    }
<<<<<<< HEAD


}

?>
=======
}
>>>>>>> origin/master
