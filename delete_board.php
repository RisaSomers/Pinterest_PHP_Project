<?php

spl_autoload_register(function ($class) {
    include_once("classes/".$class.".php");
});


session_start();

$pdo = Db::getInstance();
$stmt = $pdo->prepare("DELETE FROM board WHERE userID = :userid AND boardID = :boardID");
$stmt->bindValue(":userid", $_SESSION["id"]);
$stmt->bindValue(":boardID", $_GET["id"]);
if ($stmt->execute()) {
    // successvol verwijderd
    header("Location: user_uploads.php?success=Board successfully deleted!");
} else {
    //  niet verwijderd
    header("Location: user_uploads.php?error=Error: Could not delete item");
}
