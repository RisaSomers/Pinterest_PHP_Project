<?php

Class Items {
    private $url;
    private $image;
    private $description;

    public function __construct() {

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
        
        if (move_uploaded_file($image["tmp_name"], "uploads/posts/" . $filename)) {
            $this->image = $filename;
        } 
        
        else {
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

    public function create() {
        $conn = Db::getInstance();
        if (!empty($this->image)) {
            $stmt = $pdo->prepare("INSERT INTO items (Image, Beschrijving) VALUES (:image, :beschrijving)");
            $stmt->bindValue(":image", $this->image);
        } else {
            $stmt = $pdo->prepare("INSERT INTO items (Url, Beschrijving) VALUES (:url, :beschrijving)");
            $stmt->bindValue(":url", $this->url);
        }
        $stmt->bindValue(":beschrijving", $this->description);
        return $stmt->execute();

    }
}