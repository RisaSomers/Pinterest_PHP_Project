<?php

spl_autoload_register(function ($class) {
    include_once("classes/".$class.".php");
});


session_start();

if (!empty($_SESSION['email'])) {
} else {
    header('Location: login.php');
}

$boardID = $_GET['id'];
$userID = $_SESSION['id'];

$conn = Db::getInstance();
$getPosts = $conn->prepare("SELECT DISTINCT board.boardID, board.userID, board.postID, items.Url, items.Image
FROM board
JOIN items on postID = items.id
WHERE board.userID = $userID AND board.boardID = $boardID");
$getPosts->execute();
$p = $getPosts->fetch();



$conn = Db::getInstance();
$stmtb = $conn->prepare("SELECT board.boardID, board.userID, board.private, board.boardTitle, users.firstname, users.lastname FROM
board INNER JOIN users ON board.userID=users.id WHERE board.boardID = $boardID;");
$stmtb->execute();
$row = $stmtb->fetch();



$query = $conn->prepare("SELECT * FROM items WHERE user_id = $userID");
$query->execute();


?><!DOCTYPE html>
<html lang="en">

<head>
    <?php include("includes/header.php"); ?>

<title>Board Detail</title>

</head>

<body>

<!-- Navigation -->
<?php require_once("includes/menu.php"); ?>


<!-- Page Content -->

<div id="container-fluid">
  <nav aria-label="...">
  <ul class="pager">
    <a href="user_uploads.php"><button type="button" class="btn btn-danger btn-lg">
  <span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span> Terug naar uw overzicht
</button></a>
  </ul>
</nav>

            <div class="container well well-lg">
                <h1><?php echo $row['boardTitle']; ?></h1>

                <a href="detail.php?id=<?php echo $p['postID']?>">
                  <?php if (!empty($p['Url'])): ?>
                      <img src="<?php print $p['Url'] ?>" alt="<?php print $p['postID'] ?>">
                  <?php else: ?>
                      <img src="uploads/posts/<?php print $p['Image'] ?>"
                           alt="<?php print $row['postID'] ?>">
                  <?php endif; ?>
                </a>
          </div>
  </div>

<div class="container-fluid well well-lg">
  <?php while( $row = $stmtb->fetch()) : ?>

  <h1 class="page-header">Items toevoegen aan board: <?php echo $row['boardTitle']; ?></h1>

  <?php endwhile ?>

  <div class="form-group">

    <div id="results"></div>

  <form action="" method="post">
      <label for="sel1">Selecteer uw items:</label>

      <select class="form-control" id="sel1"multiple>

        <?php
            while ($q = $query->fetch()){
              echo '<option value="' . $q['id'] . '">' . $q['Beschrijving'] . '</option>';
            }
        ?>

      </select><br>

</form>

</div>


</div>

<!-- Bootstrap Core JavaScript -->
<script src="js/script.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
