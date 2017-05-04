<?php
/**
 * Created by PhpStorm.
 * User: Yoerias
 * Date: 22/04/17
 * Time: 20:32
 */

spl_autoload_register(function ($class) {
    include_once("classes/".$class.".php");
});


session_start();

$pdo = Db::getInstance();
$stmt = $pdo->prepare("DELETE FROM items WHERE user_id = :userid AND id = :postid");
$stmt->bindValue(":userid", $_SESSION["id"]);
$stmt->bindValue(":postid", $_GET["id"]);
if ($stmt->execute()) {
    // successvol verwijderd
} else {
    //  niet verwijderd
    header("Location: index.php?error=Could not delete item");
}
