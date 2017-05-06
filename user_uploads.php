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

$userID = $_SESSION['id'];

$stmtb = $conn->prepare("SELECT board.boardID, board.userID, board.private, board.boardTitle, users.firstname, users.lastname FROM
board INNER JOIN users ON board.userID=users.id");
$stmtb->execute();

$check = $conn->prepare("SELECT * FROM boards WHERE userID = $userID;");
$check->execute();
$boards = $check->fetch(PDO::FETCH_ASSOC);





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
            $newBoard->setUserID($userID);
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
                <h1 class="page-header">Create your own board!</h1>
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
      <h1 class="page-header">My Boards</h1>

  </div>
              <div class="container" style="margin:35px auto;">
                  <?php while( $row = $stmtb->fetch()) : ?>
                      <div class="row">
                        <a href="board.php?id=<?php echo $row['boardID']; ?>">
                        <div class="col-md-6 col-md-offset-3 results well well-lg">

                              <h2> <?php echo $row['boardTitle']; ?></h2>


                              <a href="delete_board.php?id=<?php echo $row['boardID']; ?>">
                            <button type="button" class="btn btn-default" aria-label="Delete">
                                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Delete
                            </button></a>


                            <h6> <?php echo $row['private']; ?></h6>
                            <a href="./userprofile.php?user=<?php echo $row['userID']; ?>">

                                <?php echo $row['firstname']; ?></a>
                        </div></a>

                      </div>
                          <?php endwhile ?>
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
