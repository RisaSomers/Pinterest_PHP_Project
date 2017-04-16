<?php

$perpage = 3;
$mysqli = new mysqli('localhost','root','','Pinterest_PHP');

if($mysqli->connect_error){
    die('Error : ('.$mysqli->connect_errno.')'.$mysqli->connect_error);
}

$numpage = filter_var($_POST['page'], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);

if(!is_numeric($numpage)){
    header('HTTP/1.1 500 Invalid page number!');
    exit();
}

$positie = (($numpage-1) * $perpage);
$statement = $mysqli->prepare("SELECT  Image, Beschrijving FROM items LIMIT ?, ?");
$statement->bind_param("dd", $positie, $perpage);
$statement->execute();
$statement->bind_result($row["image"], $message);


while($row = $statement->fetch())
    
    echo "<div class='well well-sm'><b><img src=uploads/posts/". $row['Image'] . ' class="thumbnail"alt="">'.$message.'</div>';

