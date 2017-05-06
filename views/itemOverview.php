<?php

spl_autoload_register(function ($class) {
    include_once("classes/".$class.".php");
});

session_start();

if (!empty($_SESSION['email'])) {
} else {
    header('Location: login.php');
}

$userID = $_SESSION['id'];


echo '<pre>';
print_r($_POST);
echo '</pre>';
