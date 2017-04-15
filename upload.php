<?php

spl_autoload_register(function($class){
    include_once("classes/".$class.".class.php");
});

session_start();


if(!empty($_POST)){
    try {
        // create prepared statement
        $item = new Items();
        $item->setDescription($_POST["beschrijving"]);
        if (!empty($_POST["fileToUpload"])) {
            $item->setImage($_FILES["fileToUpload"]);
        } else {
            $item->setUrl($_POST["link"]);
        }

        $item->create();
        echo "Item is created";
        header("Location: index.php");
        
    }
    catch (Exception $e) {
        echo $e->getMessage();
    }
}

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

<h1>Upload your item!</h1>
<!-- Page Content -->
<div class="container">
    <form action="" method="post" id="upload" enctype="multipart/form-data">
        <label for="fileToUpload">Image</label>
        <input type="file" name="fileToUpload" id="fileToUpload">

        <label for="link">Image Link</label>
        <input type="url" name="link" id="link">

        <label for="beschrijving" id="labelbeschrijving">Beschrijving</label>
        <input type="text" name="beschrijving" id="beschrijving">

        <input type="submit" value="Upload Item" name="submit" id="submit">
    </form>
</div>

</div>

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
