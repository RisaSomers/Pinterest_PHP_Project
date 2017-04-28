<?php

spl_autoload_register(function ($class) {
    include_once("classes/".$class.".php");
});


session_start();

if (!empty($_SESSION['email'])) {
} else {
    header('Location: login.php');
}

if (!empty($_GET["user"])) {
    $userid = $_GET["user"];
}

$conn = Db::getInstance();
$user = new Users();
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

       
       <button id="btnfollow">Follow</button>
        </div>

        <form action="" method="post">

            <div class="wrapper">
                <ul id="results">


                    <div class="container" style="margin:35px auto;"> 
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3 results">
                                
                                

                                <?php

                                foreach ($res as $key => $row) {
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


<script src="js/jquery.js"></script>
    
    
<script src="https://code.jquery.com/jquery-3.2.1.min.js"   integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="   crossorigin="anonymous"></script>
<script src="js/addFriend.js"></script>


<script>
    $(document).ready(function () {
        $("#btnfollow").on("click", function (e) {
            //console.log("clicked");

            // tekst vak uitlezen
            
            // via AJAX update naar databank sturen
            $.ajax({
                method: "POST",
                url: "AJAX/follow.php",
                data: { } //update: is de naam en update is de waarde (value)
            })

                .done(function (response) {

                    // code + message
                    if (response.code == 200) {

                        // iets plaatsen?
                        var li = $("<li style='display: none;'>");
                        li.html("<img id='avatar' src='" + response.avatar + "' </img>" + "   " + "  " + "<a href='http://localhost/GIT/Pinterest_PHP_Project/userprofile.php?user=" + response.id + "'>" + response.user + "</a>: " + response.message);
                        // waar?
                        $("#listupdates").prepend(li);
                        $("#listupdates li").first().slideDown();
                        $("#activitymessage").val("").focus();
                    }
                });

            e.preventDefault();
        });
    });
</script>