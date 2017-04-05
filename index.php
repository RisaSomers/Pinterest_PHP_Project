<?php
include_once("classes/user.php");
include_once("classes/Db.class.php");
include_once("classes/Topics.class.php");

session_start();

<<<<<<< HEAD
	if ( isset($_SESSION['UserName'] ) ){
=======
	if ( isset($_SESSION['user_id'] ) ){
>>>>>>> origin/master

	}
	else{
		header('Location: login.php');
	}

		$conn= Db::getInstance();
		$sth = $conn->prepare("SELECT * FROM Topics LIMIT 1;");

		$sth->execute();

?><!DOCTYPE html>
<html lang="en">

<head>

    <?php include("includes/header.php"); ?>

    <title>IMDterest</title>

</head>

<body>

    <!-- Navigation -->
  <?php include("includes/menu.php"); ?>


    <!-- Page Content -->


    <div class="container">

        <div class="row">

            <div class="col-lg-12">
                <h1 class="page-header">Your feed</h1>

            </div>

            <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                <a class="thumbnail" href="#">
                  <?php while( $row = $sth->fetch() ):?>
                      <?php echo $row['Name'] ?>
                      <img src="<?php echo $row ['Image'] ?>" class="thumbnail"alt="">
                  <?php endwhile; ?>
                </a>
            </div>

        </div>

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; IMDterest 2017</p>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
