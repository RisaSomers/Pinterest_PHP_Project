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
        return $this->private;
    }

    /**
     * @param mixed $privateSwitch
     */
    public function setPrivateSwitch($privateSwitch)
    {
      $this->private = $privateSwitch;
    }

    public function getUserID()
    {
        return $this->userID;
    }

    /**
     * @param mixed $userID
     */
    public function setUserID($userID)
    {
        $this->userID = $userID;
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

    public function loadBoards($userID)
    {
            $conn = Db::getInstance();
            $statementBoards = $conn->prepare("SELECT board.boardID, board.userID, board.private, board.boardTitle, users.firstname, users.lastname FROM
 board INNER JOIN users ON board.userID=users.id WHERE board.userID = :userID;");
            $statementBoards->bindValue(':userID', $userID);
            $statementBoards->execute();
            return $statementBoards;
        }

    public function setBoardTitle($boardTitle)
    {
        if (empty($boardTitle)) {
            throw new Exception("Title can not be empty!");
        } else {
            $this->boardTitle = $boardTitle;
        }
    }
    public function savePostToBoard($postID)
    {
$conn = db::getInstance();
$statement = $conn->prepare("INSERT INTO postboard (boardID, postID) VALUES (:boardID, :postID);");
$statement->bindValue(":boardID", $this->boardID);
$statement->bindValue(":postID", $postid);
return $statement->execute();

    }
}
