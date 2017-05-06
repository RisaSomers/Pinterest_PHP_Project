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
$postID = $_POST['postID'][0];
$conn = Db::getInstance();


$sql = $conn->prepare("SELECT items.Url, items.id, items.Beschrijving FROM Items WHERE items.user_id = $userID AND items.id = $postID");
$result = $sql->execute();


echo '<pre>';

print "<table>";
 while($row = $sql->fetch()){
    print '<tr>
            <td class="well well-lg">
            <h4 style="margin-left:5%;">'.$row['Beschrijving'].'</h4>
            <input type="checkbox" value="" />
            <a href="detail.php?id='.$row['id'].'"><img name="myimage" src="'.$row['Url'].'" alt="Image" style="width:200px;" /></a>
            </td>
          </tr>';

    }
print "</table>";

echo '</pre>';
