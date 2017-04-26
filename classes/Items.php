<?php

class Items
{
    private $url;
    private $image;
    private $description;
    private $id;

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }



    public function __construct()
    {
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $filename = md5($image["name"] . time()) . "." . pathinfo($image["name"], PATHINFO_EXTENSION);

        $extension = pathinfo($image["name"], PATHINFO_EXTENSION);

        if ($extension != "jpg" && $extension != "png" && $extension != "jpeg" && $extension != "gif")
            throw new Exception("Only JPG, JPEG, PNG & GIF files are allowed");

        if ($image["size"] > 3000000)
            throw new Exception("Your file is to big, maximum 3MB");

        if (move_uploaded_file($image["tmp_name"], "uploads/posts/" . $filename)) {
            $this->image = $filename;
        } else {
            throw new Exception("File could not be uploaded");
        }

    }

    /**
     * @return mixed
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        if (empty($description)) {
            throw new Exception("Description may not be empty");
        } else {
            $this->description = $description;
        }
    }

    public function create()
    {
        $conn = Db::getInstance();
        
        if (empty($this->url)) {
            echo "IMG";
            $stmt = $conn->prepare("INSERT INTO items (Image,  user_id, Beschrijving, uploaded) VALUES (:image, :user_id, :beschrijving, :uploaded)");
            $stmt->bindValue(":image", $this->image);
            $stmt->bindValue(":user_id", $_SESSION["id"]);
        } else {
            echo "URL";
            $stmt = $conn->prepare("INSERT INTO items (Url, Beschrijving, user_id, uploaded) VALUES (:url, :beschrijving, :user_id, :uploaded)");
            $stmt->bindValue(":url", $this->url);
            $stmt->bindValue(":user_id", $_SESSION["id"]);
        }

        $stmt->bindValue(":beschrijving", $this->description);
        $stmt->bindValue(":uploaded", time());
        $stmt->execute();
    }
    
    public function getDetail()
    {
        $conn = Db::getInstance();
        
        $statement = $conn->prepare("SELECT Image, Beschrijving FROM items WHERE id = :id");
        $statement->bindValue(":id", $_SESSION["id"]);
        $statement->execute();
    }

    public function getLike()
    {
        $pdo = Db::getInstance();
        $stmt = $pdo->prepare("SELECT count(*) as 'likes' FROM likes WHERE post_id = :postid");
        $stmt->bindValue(":postid", $this->id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC)["likes"];
    }

    public function getDislike()
    {
        $pdo = Db::getInstance();
        $stmt = $pdo->prepare("SELECT count(*) as 'dislikes' FROM dislikes WHERE post_id = :postid");
        $stmt->bindValue(":postid", $this->id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)["dislikes"];
    }

    public function checkIfInteracted()
    {
        $pdo = Db::getInstance();
        $stmt = $pdo->prepare("SELECT count(*) as 'dislikes' FROM dislikes WHERE user_id = :userid AND post_id = :postid");
        $stmt->bindValue(":userid", $_SESSION["id"]);
        $stmt->bindValue(":postid", $this->id);
        $stmt->execute();
        if ($stmt->fetch(PDO::FETCH_ASSOC)["dislikes"] == 1) {
            return true;
        }

        $pdo = Db::getInstance();
        $stmt = $pdo->prepare("SELECT count(*) as 'likes' FROM likes WHERE user_id = :userid AND post_id = :postid");
        $stmt->bindValue(":userid", $_SESSION["id"]);
        $stmt->bindValue(":postid", $this->id);
        $stmt->execute();
        if ($stmt->fetch(PDO::FETCH_ASSOC)["likes"] == 1) {
            return true;
        }

        return false;
    }




    public function checkIfLiked($post)
    {
        $pdo = Db::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM likes WHERE post_id = :postid AND user_id = :userid");
        $stmt->bindValue(":userid", $_SESSION["id"]);
        $stmt->bindValue(":postid", $post);
        $stmt->execute();
        if (empty($stmt->fetch())) {
            return false;
        } else {
            return true;
        }
    }

    public function checkIfDisliked($post)
    {
        $pdo = Db::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM dislikes WHERE post_id = :postid AND user_id = :userid");
        $stmt->bindValue(":userid", $_SESSION["id"]);
        $stmt->bindValue(":postid", $post);
        $stmt->execute();
        if (empty($stmt->fetch())) {
            return false;
        } else {
            return true;
        }
    }
}
