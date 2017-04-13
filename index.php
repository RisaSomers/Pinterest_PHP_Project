<?php
include_once("classes/user.class.php");
include_once("classes/db.class.php");
include_once("classes/topics.class.php");

session_start();

	if ( !empty($_SESSION['email'] ) ){


	}
	else{
		header('Location: login.php');
	}

		
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


    <div class="container">

        <div class="row">

            <div class="col-lg-12">
                <h1 class="page-header">Your feed</h1>

            </div>

        
        
        
        
        <?php foreach($feed as $f): ?>
                   
                    <div class="col-md-4">
                        <div class="post" data-id="<?php echo $f["id"]; ?>">
                            <div class="post-title"><a href="post.php?id=<?php echo $f["id"]; ?>"><?php echo $f["Beschrijving"]; ?></a></div>
                            <a href="post.php?id=<?php echo $f["id"]; ?>"><div class="post-img" style="background: url('uploads/posts/<?php echo $f["Image"]; ?>') center center; background-size: cover;"></div></a>
                        </div>
                    </div>
                    
                <?php endforeach; ?>
        
        
        
        
        
        
        
        
        
        

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