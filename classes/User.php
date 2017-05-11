<?php

class User
{
    private $m_sfirstname;
    private $m_slastname;
    private $m_semail;
    private $m_spassword;
    private $m_savatar;

    // link naar default avatar
    private $avatar_url = 'uploads/users/default/avatar.png';

	/**
	 * @return mixed
	 */
	public function getMSavatar()
	{
		return $this->m_savatar;
	}

	/**
	 * @param mixed $m_savatar
	 */
	public function setMSavatar($m_savatar)
	{
		$this->m_savatar = $m_savatar;
	}

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
    


    public function save()
    {
        $conn = Db::getInstance();
        
        $stmt = $conn->prepare("INSERT INTO users (firstname, lastname, password, email, avatar) VALUES (:firstname, :lastname, :password, :email, :avatar)");
        $stmt->bindValue(":firstname", $this->m_sfirstname);
        $stmt->bindValue(":lastname", $this->m_slastname);
        $stmt->bindValue(":password", $this->m_spassword);
        $stmt->bindValue(":email", $this->m_semail);
        $stmt->bindValue(":avatar", $this->avatar_url);
        $stmt->execute();

				$stmt = $conn->prepare("SELECT id FROM users WHERE email = :email");
				$stmt->bindValue(':email', $this->m_semail);
				$stmt->execute();
				return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function updateSubscriptions()
    {
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

    public function upload($files)
    {
        $target_dir ="uploads/";
        $uploadOk = 1;
        $imageFileType = pathinfo(basename($files['avatar']['name']), PATHINFO_EXTENSION);
        $target_file = $target_dir .md5($_SESSION['email'].time()).".". $imageFileType;
        $check = getimagesize($files['avatar']['tmp_name']);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            return "File is not an image";
        }


        if (file_exists($target_file)) {
            $uploadOk = 0;
        }
        if ($_FILES["avatar"]["size"] > 500000000000000) {
            return "Sorry, your file is too large.";
        }
        $imageFileType = strtolower($imageFileType);
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif") {
            return "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        }
        if ($uploadOk == 0) {
            return "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($files["avatar"]["tmp_name"], $target_file)) {
                $conn = db::getInstance();
                $statement = $conn->prepare("UPDATE users SET avatar = :avatar WHERE id = :id");
                $statement->bindValue(":avatar", $target_file);
                $statement->bindValue(":id", $_SESSION["id"]);
                $statement->execute();
                $_SESSION['avatar'] = $target_file;
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }

        return true;
    }
        
    
    public function updateEmail($email)
    {
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "Foutief e-mailadres";
      } else {
        $_SESSION['email'] = $email;

        $conn = Db::getInstance();

        $statement = $conn->prepare("UPDATE users SET email = :email WHERE id = :id");
        $statement->bindValue(":email", $email);
        $statement->bindValue(":id", $_SESSION["id"]);
        return $statement->execute();
      }
    }

    public function updatePass($pass1, $pass2, $pass_rep) {
    	$me = $this->getAllUserSpecific($_SESSION['id']);
			$validPassword = password_verify($pass1, $me['password']);
			if ($validPassword == true) {
				if (strlen($pass2) >= 6) {
					if ($pass2 == $pass_rep) {
						$conn = Db::getInstance();
						$statement = $conn->prepare("UPDATE users SET password = :password WHERE id = :id");
						$statement->bindValue(":id", $_SESSION["id"]);
						$options = ["cost" => 11];
						$hash = password_hash($pass2, PASSWORD_DEFAULT, $options);
						$statement->bindValue(":password", $hash);
						return $statement->execute();
					} else {
						throw new Exception('Je nieuwe wachtwoorden komen niet overeen');
					}
				} else {
					throw new Exception('Het wachtwoord moet minstens 6 karakters zijn');
				}
			} else {
				throw new Exception('Je oud wachtwoord klopt niet');
			}
		}
    
    public function getAll()
    {
        $conn = Db::getInstance();
        
        $allposts = $conn->query("SELECT * FROM users");
        return $allposts;
    }
    
    public function getAllUser()
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT * FROM users WHERE id = :id");
        $statement->bindValue(":id", $_SESSION["id"]);
        $statement->execute();
        $allUser = $statement->fetch(PDO::FETCH_ASSOC);
        
        return $allUser;
    }
    
    public function getAllUserSpecific($id)
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT * FROM users WHERE id = :id");
        $statement->bindValue(":id", $id);
        $statement->execute();
        $allUser = $statement->fetch(PDO::FETCH_ASSOC);
        
        return $allUser;
    }
    
    
    public function getFirstnameUser()
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT firstname FROM users WHERE id = :id");
        $statement->bindValue(":id", $_SESSION["id"]);
        $statement->execute();
        $allUser = $statement->fetchAll(PDO::FETCH_OBJ);
        
        return $allUser;
    }
    
    public function getFirstnameUserO($id)
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT firstname FROM users WHERE id = :id");
        $statement->bindValue(":id", $id);
        $statement->execute();
        $allUser = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        return $allUser;
    }
    
        public function setFollowers($id)
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare("INSERT INTO followlist (userid, followid) VALUES (:userid, :followid)");
        $statement->bindValue(":userid", $_SESSION["id"]);
        $statement->bindValue(":followid", $id);
        $statement->execute();
        $allUser = $statement->fetch(PDO::FETCH_ASSOC);
        
        return $allUser;
    }
    
    public function getFollowFeed(){
        $conn = Db::getInstance();
        
        $statement = $conn->prepare("SELECT i.* FROM items i INNER JOIN followlist f ON i.user_id = f.followerid WHERE f.userid = :userid");
        $statement->bindValue(":userid", $_SESSION["id"]);
        $statement->execute();
        $followPost = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        return $followPost;
    }
    
}
