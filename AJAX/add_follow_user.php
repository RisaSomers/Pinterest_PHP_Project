<?php

spl_autoload_register(function ($class) {
    include_once("classes/".$class.".php");
});


if($_POST['user_id'])
{
$user_id=$_POST['user_id'];
$user_id = mysql_escape_String($user_id);


$sql_in = "INSERT into followlist (followerid,userid) values ('$uid','$userid')";
mysql_query( $sql_in);

}

?>