<?php
require 'connect.php';

session_start();

if(session_destroy())
{
    header("Location: signup.php");
}
?>