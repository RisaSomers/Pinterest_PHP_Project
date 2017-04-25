<?php
include_once('classes/Db.class.php');

class boards
{
    private $boardTitle;
    private $privateSwitch;

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
    {
        $this->privateSwitch = $privateSwitch;
    }

    public function create()
    {
        $conn = Db::getInstance();
        $stmt = $conn->prepare("INSERT INTO board (boardTitle) VALUES (:boardTitle)");
        print_r($this);
        $stmt->bindValue(":boardTitle", $this->$boardTitle);
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
