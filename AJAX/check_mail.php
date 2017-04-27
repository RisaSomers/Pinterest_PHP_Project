<?php
header("Content-Type: application/json");
session_start();
spl_autoload_register(function ($class) {
	include_once("../classes/" . $class . ".php");
});

$pdo = Db::getInstance();
$stmt = $pdo->prepare("SELECT count(*) as val FROM users WHERE email=:email");
$stmt->bindValue(":email", $_POST['email']);
$stmt->execute();
$val = $stmt->fetch(PDO::FETCH_ASSOC);
$return = array(
	"success" => true,
	'message' => $val
);

echo json_encode($return);