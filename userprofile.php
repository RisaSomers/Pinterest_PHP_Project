<?php

spl_autoload_register(function($class){
    include_once("classes/".$class.".class.php");
});


session_start();

if ( !empty($_SESSION['email'] ) ){


}
else{
    header('Location: login.php');
}

if( !empty($_GET["user"]) ){
    
    $userid = $_GET["user"];
    
}

$conn = Db::getInstance();
$user = new users();
$statement = $conn->prepare("select * from items WHERE user_id = :userid order by id DESC limit 0,20");
$statement->bindValue(":userid", $userid);
$statement->execute();
$res = $statement->fetchAll(PDO::FETCH_ASSOC);
$t = new Topics();
$feed = $t->getUserPosts();

?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <?php include("includes/header.php"); ?>

    <title>IMDterest</title>

</head>

<body>

<!-- Navigation -->
<?php include("includes/menu.php"); ?>


<!-- Page Content -->

<div id="container">


    <div class="row">

        <div class="col-lg-12">
            <h1 class="page-header"><?php echo $user->getFirstnameUserO($userid)["0"]["firstname"] . "'s profile"; ?></h1>

        </div>

        <form action="" method="post">

            <div class="wrapper">
                <ul id="results">


                    <div class="container" style="margin:35px auto;">
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3 results">
                                
                                <button>Follow</button>

                                <?php

                                foreach( $res as $key => $row ){
                                    $pp = new Items();
                                    $pp->setId($row["id"]);
                                    $likes = $pp->getLike();
                                    $dislikes = $pp->getDislike();
                                    echo "<h2>" . $row['Beschrijving'] . "</h2>  
                           <a href='detail.php?id=" . $row['id'] . "'>
                           
                               <div class='post_img'>
                                   ";
                                    if (!empty($row['Url'])) {
                                        echo "<img src='" . $row['Url'] . "' alt='" . $row['id'] . "'>";
                                    } else {
                                        echo "<img src='uploads/posts/" . $row['Image'] . "' alt='" . $row['id'] . "'>";
                                    }
                                    echo "
                               </div>
                           </a>";
                                }?>

                            </div>
                        </div>

                </ul>
            </div>
        </form>

        <input type="hidden" id="result_no" value="20">
    </div>
    <button type='submit' name='more' id='more'>Load more</button>


</div>