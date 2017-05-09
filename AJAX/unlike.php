<?php
header("Content-Type: application/json");
session_start();
spl_autoload_register(function ($class) {
    include_once("../classes/".$class.".php");
});


$error = array(
    "success" => false,
    "count" => 0
);

if (!empty($_GET["post_id"])) {
    $p = new Item();
    $p->setId($_GET["post_id"]);
    $u = new User();
    if ($p->checkIfLiked($_GET["post_id"])) {
        $pdo = Db::getInstance();
        $stmt = $pdo->prepare("DELETE FROM likes WHERE user_id = :userid AND post_id = :postid");
        $stmt->bindValue(":postid", $_GET["post_id"]);
        $stmt->bindValue(":userid", $_SESSION["id"]);
        if ($stmt->execute()) {
            $error["count"] = $p->getLike();
            $error["success"] = true;
        } else {
            $error["count"] = $p->getLike();
        }
    }
}
echo json_encode($error);
