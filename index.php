<?php
include_once("classes/user.class.php");
include_once("classes/Db.class.php");
include_once("classes/topics.class.php");

session_start();

	if ( !empty($_SESSION['user_id'] ) ){


	}
	else{
		header('Location: login.php');
	}

		$conn= Db::getInstance();
		$sth = $conn->prepare("SELECT * FROM items;");

		$sth->execute();

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


    <div class="container">

        <div class="row">

            <div class="col-lg-12">
                <h1 class="page-header">Your feed</h1>

            </div>
                  <?php while( $row = $sth->fetch() ):?>

            <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                <a class="thumbnail" href="#">
                      <img src="uploads/posts/<?php echo $row['Image'] ?>" class="thumbnail"alt="">

                </a>
            </div>
                    <?php endwhile; ?>

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