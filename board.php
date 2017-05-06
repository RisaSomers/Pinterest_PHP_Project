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
$stmtb = $conn->prepare("SELECT board.boardID, board.userID, board.private, board.boardTitle, users.firstname, users.lastname FROM
board INNER JOIN users ON board.userID=users.id WHERE board.boardID = $boardID;");
$stmtb->execute();

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
    <li class="previous"><a href="user_uploads.php"><span aria-hidden="true">&larr;</span> Terug naar je overzicht</a></li>
  </ul>
</nav>
    <?php while( $row = $stmtb->fetch()) : ?>
    <h1 class="page-header">Items toevoegen aan board: <?php echo $row['boardTitle']; ?></h1>
    <?php endwhile ?>
            <div class="container well well-lg">

          </div>
  </div>


<div class="container-fluid well well-lg">


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

      <button type="button" class="btn btn-success" name="submit">Toevoegen aan board</button>
</form>

</div>


</div>
<script type="text/javascript">
  $("#sel1").on("change", function(){
    function clearpost(){
      $("#results").val("");
    }

    var selected = $(this).val();
    makeAjaxRequest(selected);
    function makeAjaxRequest(opts){
      $.ajax({
        type:"POST",
        data:{opts: opts},
        url:"views/itemOverview.php",
        success:function(res){
          $("#results").html("<p>Uw items : " + res + "</p>");
        }
      })
    }

  })
</script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>
