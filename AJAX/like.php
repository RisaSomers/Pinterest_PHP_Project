<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
/**
 * Created by PhpStorm.
 * User: Yoerias
 * Date: 17/04/2017
 * Time: 20:20
 */
header("Content-Type: application/json");
include_once("../classes/Db.php");
include_once("../classes/Items.php");


$error = array(
    "success" => false,
    "count" => 0
);

session_start();

if (!empty($_POST["post_id"])) {
    $p = new Items();
    $p->setId($_POST["post_id"]);
    if (!$p->checkIfInteracted()) {
        $pdo = Db::getInstance();
        $stmt = $pdo->prepare("INSERT INTO likes (user_id, post_id) VALUES (:userid, :postid)");
        $stmt->bindValue("userid", $_SESSION["id"]);
        $stmt->bindValue("postid", $_POST["post_id"]);
        $stmt->execute();
        $error["success"] = true;
        $error["count"] = $p->getLike();
    } else {
        $error["success"] = false;
        $error["count"] = $p->getLike();
    }
}

echo json_encode($error);
