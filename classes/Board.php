<?php


class Board
{
    private $boardTitle;
    private $privateSwitch;
    private $boardID;
    private $postid;
    private $userID;

    public function __construct()
    {
    }

    /**
     * @return mixed
     */
    public function getBoardTitle()
    {
        return $this->boardTitle;
    }

    /**
     * @param mixed $boardName
     */
    public function setBoardName($boardTitle)
    {
        $this->boardTitle = $boardTitle;
    }

    /**
     * @return mixed
     */
    public function getPrivateSwitch()
    {
        return $this->privateSwitch;
    }

    /**
     * @param mixed $privateSwitch
     */
    public function setPrivateSwitch($privateSwitch)
    { if($privateSwitch == 1) {
        $this->privateSwitch = $privateSwitch;
    } else {

    }

    }

    public function create()
    {
        $conn = Db::getInstance();
        $stmt = $conn->prepare("INSERT INTO board (boardTitle, userID, private) VALUES (:boardTitle, :userID, :private)");
        $stmt->bindValue(":boardTitle", $this->boardTitle);
        $stmt->bindValue(":userID", $_SESSION["id"]);
        $stmt->bindValue(":private", $this->private);
        return $stmt->execute();
    }

    public function setBoardTitle($boardTitle)
    {
        if (empty($boardTitle)) {
            throw new Exception("Title can not be empty!");
        } else {
            $this->boardTitle = $boardTitle;
        }
    }
}
