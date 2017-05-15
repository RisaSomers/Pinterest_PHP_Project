<?php


class Board
{
    private $boardTitle;
    private $privateSwitch;
    private $boardID;
    private $postID;
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
    public function savePostToBoard($postID, $boardID)
    {
        try {
            $sql = "UPDATE board SET postID=:postID WHERE boardID=:boardID";
            $statement = $this->getConnection()->prepare($sql);

            if (!$statement) {
                throw new Exception('The SQL statement can not be prepared!');
            }

            $statement->bindValue(':postID', $postID, PDO::PARAM_STR);
            $statement->bindValue(':boardID', $boardID, $this->getInputParameterDataType($boardID));

            if (!$statement->execute()) {
                throw new Exception('The PDO statement can not be executed!');
            }

            return $statement->rowCount() > 0 ? true : false;
        } catch (PDOException $pdoException) {
            echo '<pre>' . print_r($pdoException, true) . '</pre>';
            exit();
        } catch (Exception $exception) {
            echo '<pre>' . print_r($exception, true) . '</pre>';
            exit();
        }
    }

    private function getInputParameterDataType($value)
    {
        $dataType = PDO::PARAM_STR;
        if (is_int($value)) {
            $dataType = PDO::PARAM_INT;
        } elseif (is_bool($value)) {
            $dataType = PDO::PARAM_BOOL;
        }
        return $dataType;
    }


    public function getConnection()
    {
        $conn = Db::getInstance();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $conn->setAttribute(PDO::ATTR_PERSISTENT, true);
        return $conn;
    }
}
