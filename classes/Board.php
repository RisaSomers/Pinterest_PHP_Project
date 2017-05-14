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
            $boards = $statementBoards->fetchAll(PDO::FETCH_ASSOC);
            return $boards;
        }

    public function setBoardTitle($boardTitle)
    {
        if (empty($boardTitle)) {
            throw new Exception("Title can not be empty!");
        } else {
            $this->boardTitle = $boardTitle;
        }
    }

    private function getInputParameterDataType($value) {
    $dataType = PDO::PARAM_STR;
    if (is_int($value)) {
        $dataType = PDO::PARAM_INT;
    } elseif (is_bool($value)) {
        $dataType = PDO::PARAM_BOOL;
    }
    return $dataType;
}
    public function savePostToBoard($postID)
    {
$conn = Db::getInstance();
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

$statement = $conn->prepare("UPDATE board (postID) SET postID='$postid' WHERE boardID = :boardID;");
$statement->bindValue(":boardID",$boardID, $this->getInputParameterDataType($boardID));
$statement->bindValue(":postID", $postid);
return $statement->execute();

    }



}
