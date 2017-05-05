<?php

spl_autoload_register(function ($class) {
    include_once("classes/".$class.".php");
});


session_start();

if (!empty($_SESSION['email'])) {
} else {
    header('Location: login.php');
}

$conn = Db::getInstance();

$statement = $conn->prepare("select * from items WHERE user_id = :userid order by id DESC limit 0,20");
$statement->bindValue(":userid", $_SESSION["id"]);
$statement->execute();
$res = $statement->fetchAll(PDO::FETCH_ASSOC);
$t = new Topics();
$feed = $t->getUserPosts();



    if (!empty($_POST)) {
        try {
            // create prepared statement
            $newBoard = new Board();
            $newBoard->setBoardName($_POST["boardTitle"]);
            if (empty($_POST['status'])){
                $privateSwitch = 0;
            } else {
                $privateSwitch = 1;
            }
            $newBoard->setPrivateSwitch($privateSwitch);
            if ($newBoard->create()){
                $feedback = "Board saved";
                header("Location: user_uploads.php?success=true");
            }

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

?><!DOCTYPE html>
<html lang="en">

<head>
    <?php include("includes/header.php"); ?>
    <meta charset="UTF-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">


    <!-- Custom CSS -->
    <link href="css/thumbnail-gallery.css" rel="stylesheet">
    <link href="css/jquery.modal.css" rel="stylesheet">
    <script src="js/jquery.modal.js" type="text/javascript" charset="utf-8"></script>



    <title>IMDterest</title>

</head>

<body>

<!-- Navigation -->
<?php include("includes/menu.php"); ?>


<!-- Page Content -->

<div id="container">


    <div class="row">

        <div class="col-lg-12">
                <h1 class="page-header">Profile</h1>
                <h4>Create your own board!</h4>
                <?php if (isset($error)):?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>
                <?php if (isset($feedback)):?>
        <div class="alert alert-success"><?php echo $feedback; ?></div>
    <?php endif; ?>
            </div>
            <div class="col-xs-12 no-padding">
                <a href="#ex1" rel="modal:open"><button type="button" class="btn btn-info btn-lg" >Create Board</button></a>

                <div id="ex1" style="display:none;">
    <p>Let's make a board</p>

        <form action="" method="post" id="createBoard" enctype="multipart/form-data">
            <label for="boardTitle">Name</label>
            <input type="text" name="boardTitle" id="boardTitle">

            <label for="privateSwitch">Private?</label>
            <input id="privateSwitch" name="status" type="checkbox" checked>
            <br>
            <input type="submit" value="Submit" />
        </form>
        <p><a href="#" rel="modal:close">Close</a> or press ESC</p>
  </div>

        <div class="col-lg-12">
            <h1 class="page-header">My uploads</h1>

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
</body>
</html>
