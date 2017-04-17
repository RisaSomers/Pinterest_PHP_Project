<?php

spl_autoload_register(function($class){
    include_once("classes/".$class.".class.php");
});


session_start();

	if ( !empty($_SESSION['email'] ) ){


	}

    $conn = Db::getInstance();
    $details = new Items();
    $id = $_GET['id'];
    $details = $conn->prepare("SELECT * FROM items WHERE id = $id;");
    $details->execute();

?><!DOCTYPE html>
<html lang="en">

<head>
    <?php include("includes/header.php"); ?>
    <title>IMDterest - Upload Item</title>

    <style>

        h1 {
            margin-left: 10%;
            margin-bottom: 30px;
        }

        #fileToUpload {
            margin-bottom: 25px;
        }

        #link {
            display: block;
        }

        #labelbeschrijving {
            display: block;
        }
        #beschrijving {
        height: 80px;
        }

        #submit {
            display: block;
            margin-top: 40px;
        }


    </style>
</head>

<body>

<!-- Navigation -->
<?php include("includes/menu.php"); ?>

<a href="index.php">Go back to the homepage</a>

<?php foreach($details as $row => $detail): ?>

<h1><?php echo $detail['Beschrijving']; ?></h1>



<!-- Page Content -->
<div class="container">
  
  <div class="col-lg-3 col-md-4 col-xs-6 thumb">
<a class="thumbnail" href="">
<img src="uploads/posts/<?php echo $detail['Image']; ?>" class="thumbnail"alt="">
    </a>
    </div>
   
</div>


<?php endforeach; ?>

<!-- Footer -->
<footer>
    <div class="row">
        <div class="col-lg-12">
            <p>Copyright &copy; IMDterest 2017</p>
        </div>
    </div>
</footer>


<!-- /.container -->

<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

</body>

</html>
